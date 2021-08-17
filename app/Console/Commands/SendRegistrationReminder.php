<?php

namespace App\Console\Commands;

use App\Mail\RegistrationReminderMail;
use App\Models\ExchangeStudent;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendRegistrationReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:reminder {semester}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends email to not yet registered exchange students';

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
        $semester = $this->argument('semester');
        $exchangeStudents = ExchangeStudent::with(['person', 'user'])
            ->withoutFilledProfile($semester)
            ->get();

        $exchangeStudents->each(function (ExchangeStudent $student) {
            Mail::send(new RegistrationReminderMail($student));
            $this->info("Sending email to {$student->user->email}");
            $this->count++;
        });

        $this->info("{$this->count} emails sent");
    }
}
