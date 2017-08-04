<?php

namespace App\Console\Commands;


use App\Models\Buddy;
use App\Models\ExchangeStudent;
use App\Models\Person;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Database\QueryException;
use Maatwebsite\Excel\Facades\Excel;


class ImportExchangeStudents extends Command
{
    /**
     * The name and sdents:Import
     * speedy@speedy-ThinkPad-Edge-E430:/var/www/iscweb$ php artisan ExchangeStignature of the console command.
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

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Set start Row to second Row
        config(['excel.import.startRow' => 2]);
        $exchangeStudents = Excel::load(storage_path('app/public/') . 'Seznam_studentu_17_18.xls')
            /*->takeRows(2)*/
            ->get();
        $dontComeCount = 0;
        $alreadyInCount = 0;
        $importedCount = 0;
        foreach ($exchangeStudents as $exchangeStudent) {
            if (in_array($exchangeStudent[$this->noteKey], $this->cancellingNotes)) {
                $this->info($exchangeStudent[$this->lastNameKey]
                    . ' ' . $exchangeStudent[$this->firstNameKey]
                    . ' skip because of note: ' .
                    $exchangeStudent[$this->noteKey]);
                $dontComeCount++;
                continue;
            } elseif ($this->createUser($exchangeStudent)) {
                $this->createExchangeStudent($exchangeStudent);
                // TODO create exchange Student
                $importedCount++;
            } else {
                dd($exchangeStudent);
                $message = $this->getWhyNotImportedMessage($exchangeStudent[$this->emailKey]);
                $this->info($message);
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
    private function createUser($data): bool
    {
        try {
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
        } catch (QueryException $e) {
            return false;
        }

        return true;
    }

    private function getSex($data): string
    {
        switch ($data[$this->sexKey]) {
            case 'M':
                return 'M';
            case 'Z':
                return 'F';
            default:
                return $data[$this->sexKey];
        }
    }

    private function createExchangeStudent($data)
    {

    }

    private function getWhyNotImportedMessage(string $email): string
    {
        $coma = false;
        $message = $email . ' is: ';
        $exchangeStudent = ExchangeStudent::with('semesters')
            ->whereHas('person.user', function ($query) use ($email) {
                $query->where('email', $email);
            })->first();

        $buddyExists = Buddy::whereHas('person.user', function ($query) use ($email) {
            $query->where('email', $email);
        })->exists();

        if (isset($exchangeStudent)) {
            $coma = true;
            $message .= 'Exchange Student(';
            $message .= $this->getSemestersToString($exchangeStudent) . ')';
        }

        if ($buddyExists) {
            if ($coma) $message .= ', ';
            $message .= 'Buddy';
        }

        if ($message === $email . ' is: ') {
            $message .= 'only user';
        }

        return $message;
    }

    private function getSemestersToString(ExchangeStudent $exchangeStudent): string
    {
        $semesters = '';
        foreach ($exchangeStudent->semesters as $semester) {
            $semesters .= $semester->semester;
        }
        return $semesters;
    }


}