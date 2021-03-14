<?php

namespace App\Console\Commands;

use App\Imports\ExchangeStudentsImport;
use App\Traits\UsersImportConsoleQuestions;
use App\Traits\ValidatesImportFile;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class ImportExchangeStudents extends Command
{
    use UsersImportConsoleQuestions;
    use ValidatesImportFile;

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
        $fileName = $this->askForFile();
        $filePath = Storage::path("import/{$fileName}");

        $headingRowNumber = $this->askForHeadingRowNumber();

        $semester = $this->askForSemester();

        $fullTime = $this->fullTime ?? $this->askIfFullTime();

        if (($validator = self::importFileValidator($filePath, $headingRowNumber))->fails()) {
            $this->error('Selected file does not have necessary structure.');
            foreach ($validator->errors()->all() as $error) {
                $this->error($error);
            }
            return;
        }

        $import = (new ExchangeStudentsImport())
            ->setImportSemester($semester)
            ->setHeadingRowNumber($headingRowNumber)
            ->setFullTime($fullTime);

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
