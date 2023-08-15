<?php

namespace App\Http\Controllers\Partak;

use App\Http\Requests\Partak\BuddyUpdateRequest;
use App\Models\Buddy;
use App\Models\EventReservation;
use App\Models\Role;
use App\Models\Semester;
use App\Models\Person;
use App\Models\Country;
use App\Http\Controllers\Controller;
use App\Models\Faculty;
use Laracasts\Utilities\JavaScript\JavaScriptFacade as JavaScript;

class BuddiesController extends Controller
{
    public function index()
    {
        $this->authorize('acl', 'buddy.view');

        return view('partak.users.buddies.index')->with([
            'notVerifiedBuddies' => Buddy::with('person.user')->notVerified()->notDenied()->get()
        ]);
    }

    public function show(Buddy $buddy)
    {
        $this->authorize('acl', 'buddy.view');

        $semester = Semester::getCurrentSemester();
        if ($buddy->degree_buddy) {
            $myStudents = $buddy->degreeStudents();
        } else {
            $myStudents = $buddy->exchangeStudents();
        }
        $myStudents = $myStudents->bySemester($semester->semester)->with('person.user')->get();
        $semester = ucfirst($semester->getFullName());

        $reservedTrips = $buddy->user->reservations()->with('event.trip')->get()
            ->map(function (EventReservation $reservation) {
                return $reservation->event->trip;
            });

        return view('partak.users.buddies.show')->with([
            'buddy' => $buddy,
            'myStudents' => $myStudents,
            'currentSemester' => $semester,
            'attendedTrips' => $buddy->trips()->with('event')->get(),
            'reservedTrips' => $reservedTrips,
        ]);
    }

    public function edit(Buddy $buddy)
    {
        $this->authorize('acl', 'buddy.edit');

        JavaScript::put([
            'jsoptions' => ['roles' => Role::all(), 'sroles' => $buddy->user->roles]
        ]);
        return view('partak.users.buddies.edit')->with([
            'buddy' => $buddy,
            'faculties' => Faculty::getOptions(),
            'diets' => Person::getAllDiets(),
            'countries' => Country::getOptions(),
        ]);
    }

    public function update(BuddyUpdateRequest $request, Buddy $buddy)
    {
        $buddy->load('person.user');

        $data = $request->validated();

        $data['degree_buddy'] ??= false;

        $buddy->person->user->update($data);
        $buddy->person->updateWithIssuesAndDiet($data);
        $buddy->update($data);

        if ($request->exists('roles')) {
            $roles = explode(',', $request->roles);
            $user = $buddy->user;
            if ($roles[0] == "") {
                $roles = [];
            }
            $user->roles()->sync($roles);
        }

        return back()->with(['successUpdate' => true,]);
    }
}
