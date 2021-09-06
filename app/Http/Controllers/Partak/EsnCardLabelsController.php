<?php

namespace App\Http\Controllers\Partak;

use App\Http\Controllers\Controller;
use App\Imports\EsnCardLabelsImport;
use App\Models\Semester;
use Barryvdh\DomPDF\Facade as PDF;
use GuzzleHttp\Client;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;

class EsnCardLabelsController extends Controller
{

    public function index()
    {
        $this->authorize('acl', 'users.import');

        return view('partak.esn-card-labels.index');
    }

    public function store()
    {
        $this->authorize('acl', 'users.import');

        $data = request()->validate([
            'list_of_students' => ['required', 'file', 'mimes:xls,xlsx,ods'],
            'heading_row_number' => ['required', 'integer', 'min:1'],
            'university_name' => ['required', 'string'],
            'section_name' => ['required', 'string'],
            'valid_from' => ['required', 'date'],
        ]);

        $import = (new EsnCardLabelsImport())
            ->setHeadingRowNumber(intval($data['heading_row_number']));

        $studentData = $import->prepareData(
            Excel::toCollection(
                $import,
                request()->file('list_of_students')
            )->first()
        );

        $semester = Semester::getCurrentSemester()->semester;

        if (!File::exists(storage_path('fonts'))) {
            File::makeDirectory(storage_path('fonts'));
        }
        File::put(
            $fontPath = storage_path('fonts/RobotoCondensed-Light.ttf'),
            (new Client())
                ->get('https://github.com/google/fonts/raw/main/apache/roboto/static/RobotoCondensed-Light.ttf')
                ->getBody()
        );

        $pdf = PDF::loadView('partak.esn-card-labels.pdf', [
            'students' => $studentData,
            'section' => $data['section_name'],
            'university' => $data['university_name'],
            'validFrom' => Carbon::parse($data['valid_from']),
            'title' => 'ESNcard labels – ' . $semester . ' (' . today()->toDateString() . ')',
            'fontPath' => $fontPath,
        ]);

        return $pdf->stream('esn-card-labels_' . $semester . '_' . today()->toDateString() . '.pdf');
    }
}
