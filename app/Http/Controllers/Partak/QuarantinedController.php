<?php

namespace App\Http\Controllers\Partak;

use App\Http\Controllers\Controller;
use App\Models\ExchangeStudent;

class QuarantinedController extends Controller
{
    public function index()
    {
        $this->authorize('acl', 'quarantined');
        $users = ExchangeStudent::findQuarantined()->get();

        return view('partak.users.quarantined')->with(['users' => $users]);
    }
}
