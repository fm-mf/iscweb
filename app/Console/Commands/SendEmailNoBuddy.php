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
        $exchangeStudents = ExchangeStudent::with('person.user')
                ->wantBuddy()
                ->whereNotNull('about')
                ->whereDoesntHave('buddy')
                ->byUniqueSemester($semester)
                ->get();
        $emailsSent = 0;
        foreach ($exchangeStudents as $student) {
            $this->info("Sending email to " . $student->person->email);
            Mail::to($student->person->email)->send(new NoBuddyEmail());
            ++$emailsSent;
        }
        $this->info($emailsSent . " emails sent");
    }
}
