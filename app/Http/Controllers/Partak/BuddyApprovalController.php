<?php

namespace App\Http\Controllers\Partak;

use App\Events\BuddyVerified;
use App\Http\Controllers\Controller;
use App\Models\Buddy;

class BuddyApprovalController extends Controller
{
    public function update(Buddy $buddy)
    {
        $this->authorize('acl', 'buddy.verify');

        $data = request()->validate([
            'verified' => ['required', 'string', 'in:y,d'],
        ]);

        if ($data['verified'] === 'y') {
            return $this->approveBuddy($buddy);
        }

        return $this->denyBuddy($buddy);
    }

    protected function approveBuddy(Buddy $buddy)
    {
        $buddy->setVerified();

        event(new BuddyVerified($buddy));

        return redirect()->route('partak.users.buddies.index')->with([
            'success' => "Buddy {$buddy->person->full_name} has been approved",
        ]);
    }

    protected function denyBuddy(Buddy $buddy)
    {
        $buddy->setDenied();

        return redirect()->route('partak.users.buddies.index')->with([
            'success' => "Buddy {$buddy->person->full_name} has been denied",
        ]);
    }
}
