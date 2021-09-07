<?php

namespace App\Console\Commands;

use App\Mail\NoBuddyEmail;
use App\Models\ExchangeStudent;
use Illuminate\Console\Command;
use App\Facades\Settings ;
use Illuminate\Support\Facades\Mail;

class SendEmailNoBuddy extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:noBuddy';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends an email to Exchange students without Buddy';

    private $count = 0;

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
     * @return void
     */
    public function handle()
    {
        $semester = Settings::get('currentSemester');
        $exchangeStudents = ExchangeStudent::with(['person', 'user'])
            ->availableToPick($semester)
            ->get();

        $exchangeStudents->each(function (ExchangeStudent $exchangeStudent) {
            Mail::send(new NoBuddyEmail($exchangeStudent));
            $this->info("Sending email to {$exchangeStudent->user->email}");
            $this->count++;
        });

        $this->info("$this->count emails sent");
    }
}
