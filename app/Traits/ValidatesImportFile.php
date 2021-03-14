<?php

namespace App\Traits;

use App\Imports\ExchangeStudentsImport;
use Illuminate\Support\Facades\Validator as ValidatorFacade;
use Illuminate\Validation\Validator;
use Maatwebsite\Excel\HeadingRowImport;

trait ValidatesImportFile
{
    protected static function importFileValidator(
        string $filePath,
        int $headingRowIndex = ExchangeStudentsImport::DEFAULT_HEADING_ROW_NUMBER
    ): Validator
    {
        $headingRows = (new HeadingRowImport($headingRowIndex))
            ->toCollection($filePath);

        return ValidatorFacade::make($headingRows->first()->first()->flip()->all(), [
            ExchangeStudentsImport::FIRST_NAME_KEY => ['required'],
            ExchangeStudentsImport::LAST_NAME_KEY => ['required'],
            ExchangeStudentsImport::NATIONALITY_KEY => ['required'],
            ExchangeStudentsImport::SEX_KEY => ['required'],
            ExchangeStudentsImport::SCHOOL_KEY => ['required'],
            ExchangeStudentsImport::FACULTY_KEY => ['required'],
            ExchangeStudentsImport::SEMESTER_KEY => ['required'],
            ExchangeStudentsImport::DATE_OF_BIRTH_KEY => ['required'],
            ExchangeStudentsImport::EMAIL_KEY => ['required'],
            ExchangeStudentsImport::NOTE_KEY => ['required'],
        ]);
    }
}