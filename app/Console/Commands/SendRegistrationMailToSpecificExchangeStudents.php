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
        $count = 0;
        foreach ($emails as $email) {
            $student = ExchangeStudent::with('person.user')->byEmail($email)->get();
            Mail::to($email)->send(new RegistrationMail($student));
            $this->info("Sending email to " . $email);
            $count++;
        }
        $this->info($count);
    }
}
