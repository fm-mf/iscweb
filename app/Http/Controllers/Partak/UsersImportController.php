<?php

namespace App\Http\Controllers\Partak;

use App\Http\Controllers\Controller;
use App\Http\Requests\UsersImportRequest;
use App\Imports\ExchangeStudentsImport;
use App\Models\Semester;

class UsersImportController extends Controller
{
    public function index()
    {
        $this->authorize('acl', 'users.import');

        $semesters = Semester::all();

        return view('partak.users.import.index', compact('semesters'));
    }

    public function store(UsersImportRequest $request)
    {
        if (($importFileValidator = $request->importFileValidator())->fails()) {
            return redirect()
                ->route('partak.users.import.index')
                ->withInput()
                ->withErrors($importFileValidator, 'fileStructure');
        }

        $data = $request->validated();

        $file = $data['import_file'];
        $headingRowNumber = $data['heading_row_number'];
        $semester = Semester::find($data['semester']);

        $import = (new ExchangeStudentsImport())
            ->setImportSemester($semester)
            ->setHeadingRowNumber($headingRowNumber);
        $import->import($file);
        $import->writeLog($file->getClientOriginalName(), $semester->semester);

        return redirect()->route('partak.users.import.index')->with([
            'output' => $import->messages,
            'success' => [
                'imported' => $import->countImported,
                'alreadyInExchange' => $import->countAlreadyExistExSt,
                'alreadyInBuddy' => $import->countAlreadyExistBuddy,
                'notComing' => $import->countNotComing,
                'total' => $import->total(),
            ],
        ]);
    }
}
