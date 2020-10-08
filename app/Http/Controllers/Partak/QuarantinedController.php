<?php

namespace App\Http\Controllers\Partak;

use App\Http\Controllers\Controller;
use App\Models\ExchangeStudent;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class QuarantinedController extends Controller
{
    public function list()
    {
        $this->authorize('acl', 'quarantined');

        return view('partak.users.quarantined.list')
            ->with(['users' => $this->quarantinedStudents()]);
    }

    public function export()
    {
        $this->authorize('acl', 'quarantined');

        $users = $this->quarantinedStudents();

        $excel = Excel::create(
            'quarantined-students-' . Carbon::now()->format('Y-m-d'),
            function ($excel) use ($users) {
                $excel->sheet('Quarantined students', function ($sheet) use ($users) {
                    $sheet->loadView(
                        'partak.users.quarantined.excel',
                        ['users' => $users]
                    );
                });
            }
        );

        return $excel->download('xls');
    }

    private function quarantinedStudents()
    {
        return ExchangeStudent::findQuarantined()
            ->orderByDesc('quarantined_until')
            ->get();
    }
}
