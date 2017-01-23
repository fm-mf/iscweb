<?php

namespace App\Console\Commands;

use App\Models\ExchangeStudent;
use Illuminate\Console\Command;

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
        $exchangeStudents = ExchangeStudent::with('person.user')->byUniqueSemester($semester)->limit(20)->get();
        foreach ($exchangeStudents as $student) {
            $this->info("Sending email to " . $student->person->user->email);
        }
    }
}
