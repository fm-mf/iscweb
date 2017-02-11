<?php

namespace App\Http\Controllers\Partak;

use App\Models\Buddy;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RolesController extends Controller
{
    public function showDashboard()
    {
        $roles = Role::with('users.person')->where('title', '<>', 'partak')->where('title', '<>', 'samoplatce')->get();
        return view('partak.roles.dashboard')->with(['roles' => $roles]);
    }

    public function removeRole($userId, $roleId)
    {
        $user = User::find($userId);
        if (!$user) {
            return back()->withErrors(['user' => 'User not found.']);
        }

        $role = Role::find($roleId);
        if (!$role) {
            return back()->withErrors(['user' => 'Role not found.']);
        }

        if(Auth::user()->cant('acl', 'roles.' . $role->title) && Auth::user()->cant('acl', 'roles.all')) {
            return back()->withErrors(['role' => 'You do not have permission to remove the role <strong>' . $role->title] . '</strong>');
        }

        $user->roles()->detach($roleId);
        return back()->with([
            'successRemove' => 'Role <strong>' . $role->title . '</strong> successfully removed from
            <strong>' . $user->person->first_name . $user->person->last_name . '</strong> '
        ]);
    }
}
