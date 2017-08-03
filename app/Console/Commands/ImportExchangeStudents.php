<?php

namespace App\Console\Commands;


use App\Models\Person;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use SebastianBergmann\Environment\Console;
use Illuminate\Database\QueryException;


class ImportExchangeStudents extends Command
{
    /**
     * The name and sdents:Import
speedy@speedy-ThinkPad-Edge-E430:/var/www/iscweb$ php artisan ExchangeStignature of the console command.
     *
     * @var string
     */
    protected $signature = 'ExchangeStudents:Import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import Exchange students from xml file';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }



    /**
     * Execute the console command.
     *
     * @return mixed
     */

    private $firstNameKey = "jmeno";
    private $lastNameKey = "prijmeni";
    private $emailKey = "e_mail";
    private $birthDayKey = "dat._narozeni";
    private $semestersKey = "sem.";
    private $facultyKey = "fakulta";
    private $schoolKey = 'skola';
    private $sexKey = 'zm';
    private $countryKey = 'narodnost';
    private $personalNumberKey = 'rodny_kod';
    private $noteKey = 'pozn.';
    private $cancellingNotes = ['nepřijede', 'zrušil', 'zrušila', 'neprijede', 'zrusil', 'zrusila'];

    public function handle()
    {
        // Set start Row to second Row
        config(['excel.import.startRow' => 2 ]);
        $exchangeStudents = Excel::load(storage_path('app/public/') . 'Seznam_studentu_17_18.xls')
            ->takeRows(2)->get();
        $dontComeCount = 0;
        $alreadyInCount = 0;
        $importedCount = 0;
        foreach ($exchangeStudents as $exchangeStudent)
        {
            if (in_array($exchangeStudent[$this->noteKey], $this->cancellingNotes))
            {
                $this->info( $exchangeStudent[$this->emailKey]
                    . ' skip because of note: ' . $exchangeStudent[$this->noteKey]);
                $dontComeCount++;
                continue;
            }
            elseif ($this->createUser($exchangeStudent))
            {
                $this->createExchangeStudent($exchangeStudent);
                // TODO create exchange Student
                $importedCount++;
            }
            else
            {
                // TODO message about how in is exchangeStudent in database
                $alreadyInCount++;
            }
        }

        $this->line('Don\'t come: ' . $dontComeCount);
        $this->line('Already in: ' . $alreadyInCount);
        $this->line('Imported: ' . $importedCount);
        $this->line('Total count: ' . ($dontComeCount + $alreadyInCount + $importedCount));
    }


    /**
     * Create user and person instance and try to save it into db
     *
     * @param $data : any collection
     * @return bool
     */
    private function createUser($data) : bool
    {
        try
        {
            $user = new User();
            $user->email = $data[$this->emailKey];
            $user->save();

            // create person
            $person = new Person();
            $person->id_user = $user->id_user;
            $person->first_name = $data[$this->firstNameKey];
            $person->last_name = $data[$this->lastNameKey];
            $person->age = $data[$this->birthDayKey]->year;
            $person->sex = $this->getSex($data);
            $person->save();
        }
        catch (QueryException $e)
        {
            return false;
        }

        return true;
    }

    private function createExchangeStudent($data)
    {

    }

    private function getSex($data) : string
    {
        switch ($data[$this->sexKey])
        {
            case 'M':
                return 'M';
            case 'Z':
                return 'F';
            default:
                return $data[$this->sexKey];
        }
    }


}