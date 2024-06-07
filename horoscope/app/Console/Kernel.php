<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();

        // DBバックアップコマンド
        if (app()->isProduction()) {
            $schedule->command('backup:clean --disable-notifications')->dailyAt('07:50');
            $schedule->command('backup:run --only-db --disable-notifications')->dailyAt('17:00');
        }

        // stg環境と本番環境のみ実行（製本直送APIからの結果レスポンスはstg環境と本番環境のみのため）
        if (env('APP_ENV') !== 'development') {
            // 一括発送コマンド 10分に1回実行
            $schedule->command('command:BulkShippingBooks')->everyTenMinutes();
    
            // 単発発送コマンド 5分に1回実行
            $schedule->command('command:ShippingBook')->everyFiveMinutes();
        }
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
