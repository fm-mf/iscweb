<?php

namespace App\Http\Controllers\Exchange;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventReservation;
use Laracasts\Utilities\JavaScript\JavaScriptFacade as JavaScript;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ReservationController extends Controller
{
    public function showForm(string $id, string $cancelHash = null)
    {
        /** @var Event */
        $event = Event::findByHash($id)->firstOrFail();

        // Check if reservation exists
        if ($cancelHash !== null) {
            $reservation = EventReservation::findByHash($cancelHash);

            if (!$reservation) {
                throw new NotFoundHttpException("Reservation was not found");
            }
        }

        JavaScript::put([
            'EVENT_HASH' => $id,
            'EVENT_QUESTIONS' => $event->questions()->get()
        ]);

        return view('exchange.reservation', [
            'event' => $event,
            'canReserve' => $event->trip->canRegister(),
            'cancellationHash' => $cancelHash,
            'isCancellation' => $cancelHash !== null
        ]);
    }
}
