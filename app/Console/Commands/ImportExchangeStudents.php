<?php

namespace App\Console\Commands;


use App\Loggers\ImportLogger;
use App\Models\Buddy;
use App\Models\Country;
use App\Models\ExchangeStudent;
use App\Models\Faculty;
use App\Models\Person;
use App\Models\Semester;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Database\QueryException;
use Maatwebsite\Excel\Facades\Excel;


class ImportExchangeStudents extends Command
{
    /**
     * The name and sdents:Import
     *
     * @var string
     */
    protected $signature = 'exchangeStudents:import {fileName}';

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
    private $filePath;

    private $logger;

    private $fallSemesterCz = 'Z';
    private $fallSemesterEn = 'fall';
    private $springSemesterCz = 'L';
    private $springSemesterEn = 'spring';
    private $bothSemestersCz = 'ZL';

    private $firstNameKey = 'jmeno';
    private $lastNameKey = 'prijmeni';
    private $emailKey = 'e_mail';
    private $birthDayKey = 'dat._narozeni';
    private $semestersKey = 'sem.';
    private $facultyKey = 'fakulta';
    private $schoolKey = 'skola';
    private $sexKey = 'zm';
    private $countryKey = 'narodnost';
    private $personalNumberKey = 'rodny_kod';
    private $noteKey = 'pozn.';
    private $cancellingNotes = ['nepřijede', 'zrušil', 'zrušila', 'neprijede', 'zrusil', 'zrusila'];

    private $previousSemester;
    private $currentSemester;
    private $nextSemester;

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
        $this->initial();
        // Set start Row to second Row
        config(['excel.import.startRow' => 2]);
        $exchangeStudents = Excel::load($this->filePath)
            /*->takeRows(2)*/
            ->get();
        $dontComeCount = 0;
        $alreadyInCount = 0;
        $importedCount = 0;
        $lineNumber = 0;
        foreach ($exchangeStudents as $exchangeStudent) {
            $lineNumber++;
            $this->info($lineNumber . ': ' . $exchangeStudent[$this->emailKey]);
            if (in_array($exchangeStudent[$this->noteKey], $this->cancellingNotes) || $exchangeStudent[$this->emailKey] == null) {
                $this->info($exchangeStudent[$this->lastNameKey]
                    . ' ' . $exchangeStudent[$this->firstNameKey]
                    . ' skip because of note: ' .
                    $exchangeStudent[$this->noteKey]);
                $dontComeCount++;
            } elseif ($this->createExchangeStudent($exchangeStudent)) {
                $importedCount++;
            } else {
                $alreadyInCount++;
            }
            $this->info('/////////////////////////////////////////////////////////////////////////////');
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
     * @return User
     * @throws \Exception
     */
    private function createUser($data): User
    {
        $shouldCreateEx = true;
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
            $this->writeOutException('Email already exists', $data[$this->emailKey], $e);
            $user = User::where('email', $data[$this->emailKey])->first();
            $shouldCreateEx = $this->userAlreadyExists($user, $data);
            if (!$shouldCreateEx) {
                throw new \Exception('Exchange Student already exists.');
            }
        }
        return $user;
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

    private function createExchangeStudent($data): bool
    {
        try {
            $user = $this->createUser($data);
        } catch (\Exception $e) {
            return false;
        }

            $exchangeStudent = new ExchangeStudent();
            $exchangeStudent->id_user = $user->id_user;
            $exchangeStudent->school = $data[$this->schoolKey];
            $exchangeStudent->id_country = Country::getCountryIdFromTwoLetter($data[$this->countryKey]);

            $exchangeStudent->id_accommodation = 21;
            $exchangeStudent->id_faculty = Faculty::getFacultyFromAbbreviation($data[$this->facultyKey])->id_faculty;
            $exchangeStudent->save();
            $this->addSemesters($exchangeStudent, $data);
            $this->info('ExchangeStudent created');
            $this->logger->addLine($exchangeStudent);
            return true;
    }

    private function getSemestersToString(ExchangeStudent $exchangeStudent): string
    {
        $semesters = '';
        foreach ($exchangeStudent->semesters as $semester) {
            $semesters .= $semester->semester . ', ';
        }
        return $semesters;
    }

    private function setSemesters()
    {
        $this->currentSemester = Semester::getCurrentSemester();
        try {
            $this->previousSemester = $this->currentSemester->previousSemester();
        } catch (\Exception $exception) {
            $this->previousSemester = null;
        }

        $this->nextSemester = $this->currentSemester->nextSemester();
    }

    private function initial()
    {
        $fileName = $this->argument('fileName');
        $this->filePath = storage_path('app/import/') . $fileName;
        $this->setSemesters();
        $this->logger = new ImportLogger('import_' . $fileName . '_' . $this->currentSemester->semester . '.log');
    }

    private function writeOutException(String $message, string $email, \Exception $exception)
    {
        $this->warn($email . ': cannot be imported--> ' . $message);
        $this->logger->addLine('Exception: ' . $exception->getMessage());
    }

    private function userAlreadyExists(User $user, $data): bool
    {
        $createExchangeStudent = false;
        $message = $user->email . ' is: ';
        $exchangeStudent = ExchangeStudent::with(['semesters'])
            ->whereHas('person.user', function ($query) use ($user) {
                $query->where('email', $user->email);
            })->first();

        $buddyExists = Buddy::with('exchangeStudents')
            ->whereHas('person.user', function ($query) use ($user) {
                $query->where('email', $user->email);
            })->first();

        if (isset($exchangeStudent)) {
            $ex = $message . 'Exchange Student(';
            $ex .= $this->getSemestersToString($exchangeStudent) . ')';
            $this->info($ex);

            $this->addSemesters($exchangeStudent, $data);
        } else {
            $createExchangeStudent = true;
        }
        if (isset($buddyExists)) {
            $message = 'Is Buddy';
            if (!isset($buddyExists->exchangeStudents)) {
                $buddyExists->delete();
                $message .= ' and was deleted because didn\'t have ExchangeStudent';
            }
            $this->info($message);
        }
        return $createExchangeStudent;
    }


    private function addSemesters(ExchangeStudent $exchangeStudent, $data)
    {
        $hasCurrentSemester = false;
        $hasPreviousSemester = false;
        $hasNextSemester = false;
        if (isset($exchangeStudent->semesters)) {
            $hasNextSemester = $exchangeStudent->semesters->contains($this->nextSemester);
            $hasPreviousSemester = $exchangeStudent->semesters->contains($this->previousSemester);
            $hasCurrentSemester = $exchangeStudent->semesters->contains($this->currentSemester);
        }
        $currentFall = strpos($this->currentSemester->semester, 'fall') !== false;

        $message = 'Add ';
        $semestersCz = str_split($data[$this->semestersKey]);
        $semestersIds = [];
        foreach ($semestersCz as $semester) {
            $wantsFall = $semester === $this->fallSemesterCz;
            // Vim, ze je to komplikovany, ale prijde mi to citelnejsi, nez nejaka komprimovana verze
            if ($currentFall) {
                if ($wantsFall && !$hasCurrentSemester) {
                    array_push($semestersIds, $this->currentSemester->id_semester);
                    $this->info($message . $this->currentSemester);
                    continue;
                }
                if (!$wantsFall && !$hasNextSemester && !$hasPreviousSemester) {
                    array_push($semestersIds, $this->nextSemester->id_semester);
                    $this->info($message . $this->nextSemester);
                    continue;
                }
            } else {
                // Current semester is Spring
                if ($wantsFall && !$hasPreviousSemester && !$hasNextSemester) {
                    array_push($semestersIds, $this->nextSemester->id_semester);
                    $this->info($message . $this->nextSemester);
                    continue;
                }
                if (!$wantsFall && !$hasCurrentSemester) {
                    array_push($semestersIds, $this->currentSemester->id_semester);
                    $this->info($message . $this->currentSemester);
                    continue;
                }
            }
        }
        if (!empty($semestersIds)) {
            $exchangeStudent->semesters()->syncWithoutDetaching($semestersIds);
        }
    }

    public function line($string, $style = null, $verbosity = null)
    {
        parent::line($string, $style, $verbosity);
        if (isset($style)) {
            $string = $style . ': ' . $string;
        }
        $this->logger->addLine($string);
    }

}
