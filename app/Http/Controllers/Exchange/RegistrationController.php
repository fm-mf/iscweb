<?php

namespace App\Http\Controllers\Exchange;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Laracasts\Utilities\JavaScript\JavaScriptFacade as JavaScript;

class RegistrationController extends Controller
{
    public function showForm(string $id)
    {
        $event = Event::findByHash($id)->firstOrFail();

        JavaScript::put([
            'EVENT_HASH' => $id
        ]);

        return view('exchange.form', [
            'event' => $event
        ]);
    }
}