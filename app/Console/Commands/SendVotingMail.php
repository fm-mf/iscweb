<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Facades\Settings ;
use App\Mail\VotingMail;
use App\Mail\VotingMailPartak;
use App\Models\ExchangeStudent;
use App\Models\Buddy;
use Illuminate\Support\Facades\Mail;

class SendVotingMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:voting';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends out email with a link to the voting form';

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
     * @return mixed
     */


    public function handle()
    {
        $semester = Settings::get('currentSemester');
        $exchangeStudents = ExchangeStudent::with('person.user')
            ->bySemester($semester)->get();
        $emailsSentToExchangeStudents = 0;

        $this->info("=== Sending emails to exchange students");
        foreach ($exchangeStudents as $student) {
            $this->info("Sending email to " . $student->person->user->email);
            Mail::to($student->person->user->email)->send(new VotingMail($student));
            ++$emailsSentToExchangeStudents;
        }
        $this->info($emailsSentToExchangeStudents . " emails sent to exchange students");

        $emailsSentToPartaks = 0;
        $partaks = Buddy::partak()->get();
        $this->info("=== Sending emails to partaks");
        foreach ($partaks as $partak) {
            $this->info("Sending email to " . $partak->person->user->email);
            Mail::to($partak->person->user->email)->send(new VotingMailPartak($partak));
            ++$emailsSentToPartaks;
        }
        $this->info($emailsSentToPartaks . " emails sent to partaks");
    }   
}