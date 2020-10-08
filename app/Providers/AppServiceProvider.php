<?php

namespace App\Providers;

use App\Account;
use Exception;
use Illuminate\Console\Scheduling\Event;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        try {
            DB::connection()->getPdo();

            if (Schema::hasTable(Account::getTableName()))
                view()->share('accounts', Account::all());

        } catch (Exception $e) {
            Log::error('Database does not exist yet');
            abort(500, "Database does not exist yet");
        }

        Event::macro('noLimit', function() {
            return $this;
        });
    }
}
