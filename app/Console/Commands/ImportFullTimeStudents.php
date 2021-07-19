<?php

namespace App\Console\Commands;

class ImportFullTimeStudents extends ImportExchangeStudents
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:fullTimeStudents';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import Full-time students from Excel / OpenDocument spreadsheet (.xls, .xlsx, .ods)';

    protected $fullTime = true;
}