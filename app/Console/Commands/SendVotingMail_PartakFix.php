<?php

namespace App\Console\Commands;

use App\Mail\VotingMailPartak_whereHashIsNull;
use App\Models\User;
use Illuminate\Console\Command;
use App\Settings\Facade as Settings;
use App\Mail\VotingMail;
use App\Mail\VotingMailPartak;
use App\Models\ExchangeStudent;
use App\Models\Buddy;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class SendVotingMail_PartakFix extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:votingPartakFix';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends out email with a link to the voting form to Partaks whit hash NULL';

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
        $emailsSentToPartaks = 0;
        $partaks = Buddy::partak()->with('person.user')->whereHas('person.user', function ($query) {
            return $query->whereNull('hash');
        })->get();
        $this->info("=== Sending emails to partaks");
        foreach ($partaks as $partak) {
            $this->info("Sending email to " . $partak->person->user->email);
            $this->info("Name: " . $partak->person->getFullName());
            $partak->person->user->hash = $this->generateHash();
            $partak->person->user->update();
            Mail::to($partak->person->user->email)->send(new VotingMailPartak_whereHashIsNull($partak));
            ++$emailsSentToPartaks;
        }
        $this->info($emailsSentToPartaks . " emails sent to partaks");
    }

    protected function generateHash()
    {
        $hash =  Str::random(32);
        if (User::findByHash($hash)) {
            return $this->generateHash();
        } else {
            return $hash;
        }


    }
}