<?php

namespace App\Console\Commands;

use App\Task;
use Aws\Ec2\Ec2Client;
use Carbon\Carbon;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;

class DeleteSnapshot extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'snapshot:delete {--task-id=} {--frequency=hourly} {--owner=} {--region=} {--age=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete old snapshots';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Log::info('Running snapshot:delete');
        if (!is_null($this->option('task-id'))) {
            $task = Task::find($this->option('task-id'));
            if (!is_null($task)) {
                Config::set('aws.credentials.key', $task->account->access_key_id);
                Config::set('aws.credentials.secret', $task->account->secret_key_id);
                Config::set('aws.region', $task->account->default_region);
                Config::set('aws.owner_id', $task->account->owner_id);
            }
        }

        $owner = $this->option('owner') ?? config('aws.owner_id');
        $age = $this->option('age');
        $region = $this->option('region') ?? config('aws.region');


        $config = [
            'version' => 'latest',
            'credentials' => [
                'key' => config('aws.credentials.key'),
                'secret' => config('aws.credentials.secret')
            ],
            'region' => $region
        ];

        $this->info(json_encode($config));
        try {
            $ec2 = new Ec2Client($config);

            $frequency = $this->option('frequency');

            $results = null;
            if ($frequency === "untagged") {
                try {
                    $results = $ec2->describeSnapshots([
                        'OwnerIds' => [$owner],
                    ]);
                } catch (Exception $ex) {
                    $this->error($ex->getMessage());
                }

            } else {
                try {
                    $params = [
                        'OwnerIds' => [$owner],
                        'Filters' => [
                            [
                                'Name' => 'tag:Backup',
                                'Values' => [$frequency],
                            ],
                        ],
                    ];
                    $this->info(json_encode($params));
                    $results = $ec2->describeSnapshots($params);
                } catch (Exception $ex) {
                    $this->error($ex->getMessage());
                }

            }

            $old = new Carbon();

            $this->info('Frequency: ' . $frequency);

            switch ($frequency) {
                case 'Daily':
                    $num = $age ?? 9;
                    $msg = "Snapshot is old if older than $num days";
                    $this->info($msg);
                    $old = $old->subDays($num);
                    break;
                case 'Weekly':
                    $num = $age ?? 5;
                    $msg = "Snapshot is old if older than $num weeks";
                    $this->info($msg);
                    $old = $old->subweeks($num);
                    break;
                case 'Hourly':
                    $num = $age ?? 30;
                    $msg = "Snapshot is old if older than $num hours";
                    $this->info($msg);
                    $old = $old->subHours($num);
                    break;
                case 'Monthly':
                    $num = $age ?? 14;
                    $msg = "Snapshot is old if older than $num months";
                    $this->info($msg);
                    $old = $old->subMonths($num);
                    break;
            }

            if ($results === null) {
                $this->error("No Snapshots found");
                return 1;
            }

            $all = $results->toArray();

            $snapshots = $all['Snapshots'];

            $this->info("Found " . count($snapshots) . " snapshots with Frequency: " . $frequency);


            $oldSnaps = 0;
            $newSnaps = 0;
            $deleted = 0;
            foreach ($snapshots as $snap) {
                $obj = (Object)$snap;

                $snapDate = new Carbon($obj->StartTime->jsonSerialize());

                if ($snapDate < $old) {
                    $oldSnaps += 1;
                    $id = $obj->SnapshotId;
                    $this->info('Snapshot date: ' . $snapDate);
                    $this->info('Deleting Snapshot: ' . $id);

                    try {
                        $ec2->deleteSnapshot(['SnapshotId' => $id]);
                        $deleted += 1;
                        sleep(1);
                    } catch (Exception $e) {
                        $this->error($e->getMessage());
                    }
                } else {
                    $this->info('Snapshot date: ' . $snapDate . ' is newer than ' . $old);
                    $newSnaps += 1;
                }
            }
            $this->info("Found $newSnaps new snapshots" . PHP_EOL);
            $this->info("Found $oldSnaps old snapshots" . PHP_EOL);
            $this->info("$deleted snapshots were successfully deleted" . PHP_EOL);
        }
        catch (Exception $ex) {
            $this->error($ex->getMessage());
        }

        return 0;
    }
}
