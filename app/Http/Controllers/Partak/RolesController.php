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
        $roles = Role::with('users.person')
            ->where('title', '<>', 'partak')
            ->where('title', '<>', 'exchange_student')
            ->where('title', '<>', 'buddy')
            ->where('title', '<>', 'samoplatce')
            ->where('title', '<>', 'author')
            ->get();
        
        // Predefined roles order
        $predefined = [
            'supervisor' => [
                'title' => 'Supervisor'
            ],
            'admin' => [
                'title' => 'Admin'
            ],
            'board' => [
                'title' => 'Board'
            ],
            'buddyManager' => [
                'title' => 'Buddy coordinator'
            ],
            'hr' => [
                'title' => 'Human relations'
            ],
            'integreatCoordinator' => [
                'title' => 'inteGREAT coordinator'
            ],
            'team' => [
                'title' => 'Team'
            ],
            'point' => [
                'title' => 'Point'
            ]
        ];

        foreach ($roles as $role) {
            if (isset($predefined[$role->title])) {
                $predefined[$role->title]['id_role'] = $role->id_role;
                $predefined[$role->title]['users'] = $role->users;
            } else {
                $predefined[$role->title] = [
                    'id_role' => $role->id_role,
                    'title' => $role->title,
                    'role' => $role
                ];
            }
        }

        return view('partak.roles.dashboard')->with(['roles' => $predefined]);
    }

    public function showPartaks()
    {
        $partaks = User::with('person', 'person.exchangeStudent', 'person.buddy')
            ->whereHas('roles', function ($query) {
                $query->where('title', 'partak');
            })->get();

        return view('partak.roles.partaks')->with('partaks', $partaks);
    }

    public function removeRole($userId, $roleId)
    {
        $user = User::find($userId);
        if (!$user) {
            return back()->withErrors(['user' => 'User not found.']);
        }

        if ($roleId == 'partak') {
            $role = Role::where('title', 'partak')->first();
            $roleId = $role->id_role;
        } else {
            $role = Role::find($roleId);
        }

        if (!$role) {
            return back()->withErrors(['user' => 'Role not found.']);
        }

        if(Auth::user()->cant('acl', 'roles.' . $role->title) && Auth::user()->cant('acl', 'roles.all')) {
            return back()->withErrors(['role' => 'You do not have permission to remove the role <strong>' . $role->title] . '</strong>');
        }

        $user->roles()->detach($roleId);
        return back()->with([
            'successRemove' => 'Role <strong>' . $role->title . '</strong> successfully removed from
            <strong>' . $user->person->first_name . ' ' . $user->person->last_name . '</strong> '
        ]);
    }
}
