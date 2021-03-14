<?php

namespace App\Console\Commands;

use App\Imports\ExchangeStudentsImport;
use App\Models\Semester;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImportExchangeStudents extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:exchangeStudents';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import Exchange students from Excel / OpenDocument spreadsheet (.xls, .xlsx, .ods)';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $files = collect(Storage::files('import'))->filter(function ($fileName) {
            return Str::endsWith($fileName, ['.xls', '.xlsx', '.ods']);
        })->map(function ($fileName) {
            return Str::replaceFirst('import/', '', $fileName);
        })->toArray();

        $answer = $this->choice(
            'Please, choose from the available files to import',
            $files
        );
        $fileName = $answer;
        $filePath = Storage::path("import/{$answer}");

        $answer = $this->ask(
            'Row number of the row with column headings',
            ExchangeStudentsImport::DEFAULT_HEADING_ROW_NUMBER
        );
        while (!($headingRowNumber = filter_var($answer, FILTER_VALIDATE_INT)) || $headingRowNumber < 1) {
            $answer = $this->ask('Row number has to be a positive integer, try again');
        }

        $semesters = Semester::all()->map(function ($semester) {
            return $semester->name;
        })->toArray();

        $answer = $this->choice(
            'Choose a semester in which the students should be imported to',
            $semesters
        );

        $semester = Semester::findByName($answer);

        if (($validator = ExchangeStudentsImport::importFileValidator($filePath, $headingRowNumber))->fails()) {
            $this->error('Selected file does not have necessary structure.');
            foreach ($validator->errors()->all() as $error) {
                $this->error($error);
            }
            return;
        }

        $import = (new ExchangeStudentsImport())
            ->setImportSemester($semester)
            ->setHeadingRowNumber($headingRowNumber);
        $import->withOutput($this->output)
            ->import($filePath);

        $import->writeLog($fileName, $semester->semester);

        $this->getOutput()->success([
            __('import.success_title'),
            '',
            ' – ' . trans_choice('import.success_info_imported', $import->countImported),
            ' – ' . trans_choice('import.success_info_in_buddy', $import->countAlreadyExistBuddy),
            ' – ' . trans_choice('import.success_info_in_ex_st', $import->countAlreadyExistExSt),
            ' – ' . trans_choice('import.success_info_not_coming', $import->countNotComing),
            '',
            trans_choice('import.success_info_total', $import->total()),
        ]);
    }
}
