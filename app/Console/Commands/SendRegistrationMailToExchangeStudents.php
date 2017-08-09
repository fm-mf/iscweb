<?php

namespace App\Console\Commands;

use App\Mail\RegistrationMail;
use App\Models\ExchangeStudent;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendRegistrationMailToExchangeStudents extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:registrations {semester}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends out emails with registration information to exchange students';

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
        $semester = $this->argument('semester');
        $exchangeStudents = ExchangeStudent::with('person.user')->byUniqueSemester($semester)->get();
        foreach ($exchangeStudents as $student) {
            // Mail::to($student->person->user->email)->send(new RegistrationMail($student));
            $this->info("Sending email to " . $student->person->user->email);
        }
    }
}
