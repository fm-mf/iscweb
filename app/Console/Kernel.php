<?php

namespace App\Console;

use App\Console\Commands\SendRegistrationMailToExchangeStudents;
use App\Console\Commands\SendRegistrationReminder;
use App\Console\Commands\SendVotingMail_PartakFix;
use App\Console\Commands\VerificationFix;
use App\Console\Commands\SendVotingMail;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        SendRegistrationMailToExchangeStudents::class,
        SendRegistrationReminder::class,
        VerificationFix::class,
        SendVotingMail::class,
        SendVotingMail_PartakFix::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
