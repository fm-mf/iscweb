<?php

namespace App\Http\Controllers\Partak;

use App\Events\BuddyVerified;
use App\Exceptions\UserDoesntExist;
use App\Models\Buddy;
use App\Models\ExchangeStudent;
use App\Models\Role;
use App\Models\Semester;
use App\Models\User;
use App\Models\Person;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Faculty;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laracasts\Utilities\JavaScript\JavaScriptFacade as JavaScript;

class BuddiesController extends Controller
{
    protected function profileValidator(array $data, $id)
    {
        $validator = Validator::make($data, [
            'phone' => 'max:15',
            'age' => [
                'numeric',
                'min:1991',
                'max:2154'
            ],
            'email' => [
                'required',
                'max:255',
                'email',
                Rule::unique('users')->ignore($id, 'id_user'),
            ],
            'id_country' => 'required',
        ]);

        $validator->after(function ($validator) use ($data, $id) {
            if (!key_exists('roles', $data)) {
                return;
            }

            $loggedUser = Auth::user();
            if ($loggedUser->can('acl', 'roles.all')) {
                return;
            }

            $editedUser = User::find($id);
            $newRoles = Role::whereIn('id_role', explode(',', $data['roles']))->get();
            $oldRoles = $editedUser->roles()->get();

            $rolesToRemove = $oldRoles->diff($newRoles);
            $rolesToAdd = $newRoles->diff($oldRoles);

            foreach ($rolesToAdd as $role) {
                if ($loggedUser->cant('acl', 'roles.' . $role->title)) {
                    $validator->errors()->add('roles', 'You do not have permission to assign the role ' . $role->title);
                }
            }

            foreach ($rolesToRemove as $role) {
                if ($loggedUser->cant('acl', 'roles.' . $role->title)) {
                    $validator->errors()->add('roles', 'You do not have permission to remove the role ' . $role->title);
                }
            }
        });

        return $validator;
    }

    public function showBuddiesDashboard()
    {
        $this->authorize('acl', 'buddy.view');
        return view('partak.users.buddies.dashboard')->with([
            'notVerifiedBuddies' => Buddy::with('person.user')->notVerified()->notDenied()
        ]);
    }

    public function showBuddyDetail($id)
    {
        $this->authorize('acl', 'buddy.view');
        $buddy = Buddy::findBuddy($id);
        if ($buddy == null)
            throw new UserDoesntExist("Buddy does not exist !!!");
        $semester = Semester::getCurrentSemester();
        $myStudents = $buddy->exchangeStudents()->bySemester($semester->semester)->with('person.user')->get();
        $semester = ucfirst($semester->getFullName());
        return view('partak.users.buddies.detail')->with([
            'buddy' => $buddy,
            'myStudents' => $myStudents,
            'currentSemester' => $semester
        ]);
    }

    public function removeExStudentFromBuddy($id_buddy, $id_exStudent)
    {
        $this->authorize('acl', 'buddy.remove');
        $exStudent = ExchangeStudent::find($id_exStudent);
        $exStudent->removeBuddy();
        $removeSuccess = 'Buddy for exchange student with name ' . $exStudent->person->first_name . ' ' . $exStudent->person->last_name . ' was removed.';
        return back()->with(['removeSuccess' => $removeSuccess]);
    }

    public function showEditFormBuddy($id)
    {
        $this->authorize('acl', 'buddy.edit');
        $buddy = Buddy::with('person.user')->find($id);
        if ($buddy == null)
            throw new UserDoesntExist("Buddy does not exist !!!");

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



    public function submitEditFormBuddy(Request $request, $id)
    {
        $this->authorize('acl', 'buddy.edit');
        $this->profileValidator($request->all(), $id)->validate();

        $buddy = Buddy::with('person.user')->find($id);

        $data = [];
        foreach ($request->all() as $key => $value) {
            if ($value) {
                $data[$key] = $value;
            }
        }
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

    public function approveBuddy($user_id)
    {
        $this->authorize('acl', 'buddy.verify');
        $buddy = Buddy::find($user_id);
        if ($buddy) {
            $buddyName = $buddy->person->first_name . ' ' . $buddy->person->last_name;
            $buddy->setVerified();
            event(new BuddyVerified($buddy));
            return redirect('/partak/users/buddies')->with(['success' => 'Buddy ' . $buddyName . 'has been approved']);
        } else {
            return redirect('/partak/users/buddies')->withErrors(['approve' => 'Buddy was not found in our database.']);
        }
    }

    public function denyBuddy($user_id)
    {
        $this->authorize('acl', 'buddy.verify');
        $buddy = Buddy::find($user_id);
        if ($buddy) {
            $buddyName = $buddy->person->first_name . ' ' . $buddy->person->last_name;
            $buddy->setDenied();
            return redirect('/partak/users/buddies')->with(['success' => 'Buddy ' . $buddyName . ' has been denied']);
        } else {
            return redirect('/partak/users/buddies')->withErrors(['approve' => 'Buddy was not found in our database.']);
        }
    }
}
