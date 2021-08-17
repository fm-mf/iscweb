<?php

namespace App\Console\Commands;

use App\Mail\RegistrationMail;
use App\Models\ExchangeStudent;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendRegistrationMailToSpecificExchangeStudents extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:single-registration {email*}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends an exchange student\'s registration email to specified email addresses';

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
     * @return mixed
     */
    public function handle()
    {
        $emails = $this->argument('email');
        $students = ExchangeStudent::with(['person', 'user'])->getByEmails($emails);

        $students->each(function (ExchangeStudent $student) {
            Mail::send(new RegistrationMail($student));
            $this->info("Sending email to {$student->user->email}");
            $this->count++;
        });

        $this->info($this->count);
    }
}
