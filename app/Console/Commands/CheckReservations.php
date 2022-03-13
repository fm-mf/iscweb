<?php

namespace App\Console\Commands;

use App\Mail\ReservationCancelledMail;
use App\Models\EventReservation;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class CheckReservations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'events:reservations';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checks for expired reservations and cancels them';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $expired = EventReservation::findExpired();

        $expired->each(function ($reservation) {
            /** @var EventReservation $reservation */

            $reservation->delete();

            if ($reservation->is_confirmed) {
                try {
                    Mail::to($reservation->user->email)
                        ->send(new ReservationCancelledMail($reservation));
                } catch (\Exception $ex) {
                    $this->error("Failed to send email to {$reservation->user->email}");
                    $this->error($ex);
                }
            }
        });
    }
}
