<?php

namespace App\Console\Commands;

use App\Models\Buddy;
use Carbon\Carbon;
use Illuminate\Console\Command;

class VerificationFix extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'verificationfix';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fix verified buddies';

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
        $verifiedBuddies = Buddy::with('person.user')->where('active', 'y')->whereHas('person.user', function($query) {
            //$query->where('created_at', '>', Carbon::create(2017, 1, 21)->timestamp);
            $this->info(Carbon::create(2017, 1, 21, 0, 0, 0)->toDateTimeString());
            $query->where('created_at', '>', Carbon::create(2017, 1, 21, 0, 0, 0)->toDateTimeString());
        })->get();

        foreach ($verifiedBuddies as $buddy) {
            $buddy->verified = 'y';
            $buddy->save();
            $this->info('Buddy ' . $buddy->person->first_name. ' ' . $buddy->person->last_name . ' set to verified');
        }
        $this->info('Done!');
    }
}
