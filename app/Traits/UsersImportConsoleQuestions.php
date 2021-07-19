<?php

namespace App\Traits;

use App\Imports\ExchangeStudentsImport;
use App\Models\Semester;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait UsersImportConsoleQuestions
{
    protected function askForFile(): string
    {
        $files = collect(Storage::files('import'))->filter(function ($fileName) {
            return Str::endsWith($fileName, ['.xls', '.xlsx', '.ods']);
        })->map(function ($fileName) {
            return Str::replaceFirst('import/', '', $fileName);
        })->toArray();

        return $this->choice(
            'Please, choose from the available files to import',
            $files
        );
    }

    protected function askForHeadingRowNumber(): int
    {
        $answer = $this->ask(
            'Row number of the row with column headings',
            ExchangeStudentsImport::DEFAULT_HEADING_ROW_NUMBER
        );

        while (!($headingRowNumber = filter_var($answer, FILTER_VALIDATE_INT)) || $headingRowNumber < 1) {
            $answer = $this->ask('Row number has to be a positive integer, try again');
        }

        return $answer;
    }

    protected function askForSemester(): Semester
    {
        $semesters = Semester::all()->map(function ($semester) {
            return $semester->name;
        })->toArray();

        $answer = $this->choice(
            'Choose a semester in which the students should be imported to',
            $semesters
        );

        return Semester::findByName($answer);
    }

    protected function askIfFullTime(): bool
    {
        $answer = $this->choice(
            'Choose whether you are importing regular exchange students or full-time students',
            [
                'Regular exchange students',
                'Full-time students'
            ],
            0
        );

        return strcmp($answer, 'Full-time students') === 0;
    }
}