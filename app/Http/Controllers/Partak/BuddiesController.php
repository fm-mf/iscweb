<?php

namespace App\Http\Controllers\Partak;

use App\Models\Buddy;
use App\Models\ExchangeStudent;
use App\Models\Role;
use App\Models\User;
use Doctrine\Common\Proxy\Autoloader;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Settings\Facade as Settings;
use App\Models\Faculty;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Laracasts\Utilities\JavaScript\JavaScriptFacade as JavaScript;

class BuddiesController extends Controller
{
    protected function profileValidator(array $data, $id)
    {
        $validator = Validator::make($data, [
            'phone' => 'max:15',
            'age' => 'digits:4',
            'email' => 'required|max:255|email',
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
        $semester = Settings::get('currentSemester');
        $myStudents = $buddy->exchangeStudents()->bySemester($semester)->with('person.user')->get();

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
        $removeSuccess = 'Buddy for exchange student with name '. $exStudent->person->first_name .' '. $exStudent->person->last_name .' was removed.';
        return back()->with(['removeSuccess' => $removeSuccess]);
    }

    public function showEditFormBuddy($id)
    {
        $this->authorize('acl', 'buddy.edit');
        $buddy = Buddy::with('person.user')->find($id);

        JavaScript::put([
            'jsoptions' => ['roles' => Role::all(), 'sroles' => $buddy->user()->roles]
            ]);
        return view('partak.users.buddies.edit')->with([
            'buddy' => $buddy,
            'faculties' => Faculty::getOptions()
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
        $buddy->person->update($data);
        $buddy->update($data);

        if ($request->exists('roles')) {
            $roles = explode(',', $request->roles);
            $user = $buddy->user();
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
            $buddy->setVerified();
            return back()->with(['success' => 'Buddy has been approved']);
        } else {
            return back()->withErrors(['approve' => 'Buddy was not found in our database.']);
        }
    }

    public function denyBuddy($user_id)
    {
        $this->authorize('acl', 'buddy.verify');
        $buddy = Buddy::find($user_id);
        if ($buddy) {
            $buddy->setDenied();
            return back()->with(['success' => 'Buddy has been denied']);
        } else {
            return back()->withErrors(['approve' => 'Buddy was not found in our database.']);
        }
    }
}
