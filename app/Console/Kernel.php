<?php

namespace App\Console;

use App\Task;
use Exception;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        //Check if database exists
        try {
            DB::connection()->getPdo();
        } catch (Exception $e) {
            Log::error('Database does not exist yet');
            abort(500, "Database does not exist yet");
        }

        // Check for tasks table
        if (Schema::hasTable(Task::getTableName())) {

            $tasks = Task::all();

            foreach ($tasks as $task) {
                $schedule
                    ->command($task->command, explode(' ', $task->arguments . " --task-id=$task->id"))
                    ->{$task->frequency}()
                    ->{$task->limit ?? 'noLimit'}()
                    ->before(fn() => $task->setConfig());
            }
        }
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
