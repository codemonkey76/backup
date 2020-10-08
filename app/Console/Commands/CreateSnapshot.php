<?php

namespace App\Console\Commands;

use App\Task;
use Aws\Ec2\Ec2Client;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;

class CreateSnapshot extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'snapshot:create {--task-id=} {--tag=Hourly} {--region=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        Log::info('Running snapshot:create');
        if (!is_null($this->option('task-id'))) {
            $task = Task::find($this->option('task-id'));
            if (!is_null($task)) {
                Config::set('aws.credentials.key', $task->account->access_key_id);
                Config::set('aws.credentials.secret', $task->account->secret_key_id);
                Config::set('aws.region', $task->account->default_region);
            }
        }
        $region = $this->option('region') ?? config('aws.region');

        $config = [
            'version' => 'latest',
            'credentials' => [
                'key' => config('aws.credentials.key'),
                'secret' => config('aws.credentials.secret')
            ],
            'region' => $region
        ];

        Log::info(json_encode($config));

        $ec2 = new Ec2Client($config);
        $results = $ec2->describeVolumes([
            [
                'Filter' => [
                    'Name' => 'attachment.status',
                    'Values' => ['attached']
                ]
            ], [
                'Filter' => [
                    'Name' => 'tag:Environment',
                    'Values' => ['Production']
                ]
            ]
        ]);

        $volumes = $results->toArray()['Volumes'];
        $this->info('Found ' . count($volumes) . ' volumes attached and with production tag');
        $tag = $this->option('tag');

        foreach ($volumes as $volume) {
            $obj = (Object)$volume;

            if (empty($obj->Attachments)) {
                $this->info('No attached instance');
                continue;
            }

            $attachment = (Object)$obj->Attachments[0];

            //Get instance and ensure it is running
            $results = $ec2->describeInstances(['InstanceIds' => [$attachment->InstanceId]])->toArray();
            $instance = data_get($results, 'Reservations.0.Instances.0');
            //dd($instance);

            $tagName = collect(data_get($instance, 'Tags'))->where('Key', 'Name')->first();
            if ($tagName === null)  {
                $instanceName = "Unnamed";
            }
            else {
                $instanceName = $tagName['Value'];
            }
            $volumeBlock = $attachment->Device;
            $date = (new Carbon())->format('Ymd');
            $state = data_get($instance, 'State.Name');
            $this->info('State = ' . $state);

            if ($state === "running") {
                //Only snapshot running instances
                $this->info("Creating snapshot Backup of $instanceName-$volumeBlock-$date");

                $snap = $ec2->createSnapshot([
                    'Description' => "Backup of $instanceName-$volumeBlock-$date",
                    'VolumeId' => "$obj->VolumeId"
                ]);
                $snapshotId = $snap->toArray()['SnapshotId'];
                sleep(15); //Avoid AWS rate limiting

                $this->info('Adding tag: Backup=' . $tag);

                $ec2->createTags([
                    'Resources' => [
                        $snapshotId
                    ],
                    'Tags' => [
                        [
                            'Key' => 'Backup',
                            'Value' => $tag
                        ]
                    ]
                ]);
            }
            else {
                $this->info("Skipping, instance not running");
            }
        }
        return 0;
    }
}
