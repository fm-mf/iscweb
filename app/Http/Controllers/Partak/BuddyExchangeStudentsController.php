<?php

namespace App\Http\Controllers\Partak;

use App\Http\Controllers\Controller;
use App\Models\Buddy;
use App\Models\ExchangeStudent;

class BuddyExchangeStudentsController extends Controller
{
    public function destroy(Buddy $buddy, ExchangeStudent $exchangeStudent)
    {
        $this->authorize('acl', 'buddy.remove');

        $exchangeStudent->removeBuddy();
        $removeSuccess = "Buddy for exchange student with name ‘{$exchangeStudent->person->full_name}’ was removed.";

        return back()->with([
            'removeSuccess' => $removeSuccess
        ]);
    }
}
