<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        Commands\CekAlfaDosen::class,
        Commands\CekAlfaMahasiswa::class,
    ];

    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // Menjalankan command cek alfa dosen dan mahasiswa setiap hari jam 23:59
        $schedule->command('cek:alfa-dosen')->dailyAt('23:59');
        $schedule->command('cek:alfa-mahasiswa')->dailyAt('23:59');
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
