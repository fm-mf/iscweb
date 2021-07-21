<?php

namespace App\Http\Controllers\Partak;

use App\Exports\QuarantinedStudentsExport;
use App\Http\Controllers\Controller;
use App\Models\ExchangeStudent;

class QuarantinedController extends Controller
{
    public function list()
    {
        $this->authorize('acl', 'quarantined');

        return view('partak.users.quarantined.list')
            ->with(['users' => ExchangeStudent::findQuarantined()]);
    }

    public function export()
    {
        $this->authorize('acl', 'quarantined');

        return new QuarantinedStudentsExport(ExchangeStudent::findQuarantined());
    }
}
