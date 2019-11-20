<?php

namespace App\Http\Controllers\Exchange;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Laracasts\Utilities\JavaScript\JavaScriptFacade as JavaScript;

class ReservationController extends Controller
{
    public function showForm(string $id)
    {
        $event = Event::findByHash($id)->firstOrFail();

        JavaScript::put([
            'EVENT_HASH' => $id,
            'EVENT_QUESTIONS' => $event->questions()->get()
        ]);

        return view('exchange.reservation', [
            'event' => $event
        ]);
    }
}
