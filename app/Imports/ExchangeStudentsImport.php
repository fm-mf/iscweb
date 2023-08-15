<?php

namespace App\Imports;

use App\Models\Accommodation;
use App\Models\Country;
use App\Models\ExchangeStudent;
use App\Models\Faculty;
use App\Models\Person;
use App\Models\Role;
use App\Models\Semester;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\MessageBag;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class ExchangeStudentsImport implements
    ToCollection,
    WithChunkReading,
    WithHeadingRow
{
    use Importable;

    const DEFAULT_HEADING_ROW_NUMBER = 2;

    const READ_CHUNK_SIZE = 10;

    const FIRST_NAME_KEY = 'jmeno';
    const LAST_NAME_KEY = 'prijmeni';
    const NATIONALITY_KEY = 'narodnost';
    const SEX_KEY = 'zm';
    const SCHOOL_KEY = 'skola';
    const FACULTY_KEY = 'fakulta';
    const SEMESTER_KEY = 'sem';
    const DATE_OF_BIRTH_KEY = 'dat_narozeni';
    const BIRTH_NUMBER_KEY = 'rodny_kod';
    const EMAIL_KEY = 'e_mail';
    const PROGRAMME_KEY = 'program';
    const NOTE_KEY = 'pozn';

    const SPRING_SEMESTER = 'L';
    const AUTUMN_SEMESTER = 'Z';
    const AUTUMN_SPRING_SEMESTERS = 'ZL';

    const CANCELLATION_NOTES = [
        'nepřijede',
        'zrušil',
        'zrušila',
        'neprijede',
        'zrusil',
        'zrusila',
        'Z',
    ];

    const SEX_MAPPING = [
        'M' => 'M',
        'Z' => 'F',
    ];

    const MSG_NOT_COMING = '%u – Skipping (%s, %s) – not coming';
    const MSG_IMPORTED = '%u – Importing (%s, %s; %s)';
    const MSG_EXISTS = '%u – User already exists (%s, %s; %s)';
    const MSG_EX_ST = 'User was an Exchange student in semesters: %s';
    const MSG_BUDDY_DELETED = 'User was a buddy, but has been deleted, because did not have any Exchange students';
    const MSG_BUDDY_NOT_DELETED = 'User is a buddy and was NOT deleted, because has Exchange students';
    const MSG_ADD_SEMESTERS = 'Adding semesters: %s';
    const MSG_LABEL_AS_FULL_TIME = 'Label the student as full-time';

    const MSG_SEPARATOR = '////////////////////////////////////////////////////////////////////////////////';

    public $messages;

    public $countNotComing = 0;
    public $countAlreadyExistExSt = 0;
    public $countAlreadyExistBuddy = 0;
    public $countImported = 0;

    private $headingRowNumber;

    private $currentSemester;
    private $previousSemester;
    private $nextSemester;

    private $semesterMapping;

    private $fullTime = false;

    private $currentRowNumber = 0;

    private $countries;
    private $faculties;
    private $lastUserIdBeforeImport;

    public function __construct()
    {
        $this->messages = new MessageBag();

        $this->headingRowNumber = self::DEFAULT_HEADING_ROW_NUMBER;

        $this->setImportSemester(Semester::getCurrentSemester());

        $this->countries = Country::all(['id_country', 'two_letters']);
        $this->faculties = Faculty::all(['id_faculty', 'abbreviation']);
        $this->lastUserIdBeforeImport = User::latest()->first()->id_user;
    }

    public function setImportSemester(Semester $semester): self
    {
        $this->currentSemester = $semester;
        $this->previousSemester = $semester->previousSemester();
        $this->nextSemester = $semester->nextSemester();

        $this->semesterMapping = [
            self::AUTUMN_SEMESTER => $this->currentSemester->isAutumnSemester() ? $this->currentSemester : $this->previousSemester,
            self::SPRING_SEMESTER => $this->currentSemester->isSpringSemester() ? $this->currentSemester : $this->nextSemester,
        ];

        return $this;
    }

    public function setHeadingRowNumber(int $headingRowNumber): self
    {
        $this->headingRowNumber = $headingRowNumber;

        return $this;
    }

    public function setFullTime(bool $fullTime): self
    {
        $this->fullTime = $fullTime;

        return $this;
    }

    public function collection(Collection $collection)
    {
        $collection->each(function (Collection $row, int $key) {
            $this->currentRowNumber++;
            if ($this->isNotComing($row)) {
                $this->countNotComing++;
                $this->comment(
                    sprintf(self::MSG_NOT_COMING, $this->currentRowNumber, strtoupper($row[self::LAST_NAME_KEY]), $row[self::FIRST_NAME_KEY])
                );
                $this->separator();
                return;
            }

            $user = $this->createUser($row);
            $person = $this->createPerson($row, $user);
            $exchangeStudent = $this->createExchangeStudent($row, $person);
            $this->separator();
        });
    }

    public function headingRow(): int
    {
        return $this->headingRowNumber;
    }

    public function chunkSize(): int
    {
        return self::READ_CHUNK_SIZE;
    }

    public function total(): int
    {
        return $this->currentRowNumber;
    }

    public function writeLog(string $fileName, string $semester)
    {
        Storage::put(
            'import/log/import_' . now()->toDateTimeString() . "_{$fileName}_{$semester}.json",
            json_encode($this->messages->toArray(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
        );
    }

    private function createUser(Collection $item): User
    {
        try {
            $user = User::create([
                'email' => $item[self::EMAIL_KEY],
            ]);
            $this->countImported++;
            $this->comment(
                sprintf(self::MSG_IMPORTED, $this->currentRowNumber, strtoupper($item[self::LAST_NAME_KEY]), $item[self::FIRST_NAME_KEY], $item[self::EMAIL_KEY])
            );
        } catch (QueryException $exception) {
            $user = User::where('email', '=', $item[self::EMAIL_KEY])->first();
            $this->comment(
                sprintf(self::MSG_EXISTS, $this->currentRowNumber, strtoupper($item[self::LAST_NAME_KEY]), $item[self::FIRST_NAME_KEY], $item[self::EMAIL_KEY])
            );

            $this->handleExistAsBuddy($user);
        }

        return $user;
    }

    private function createPerson(Collection $item, User $user): Person
    {
        if ($user->id_user <= $this->lastUserIdBeforeImport && $user->person()->exists()) {
            return $user->person;
        }

        $person = $user->person()->create([
            'first_name' => $item[self::FIRST_NAME_KEY],
            'last_name' => $item[self::LAST_NAME_KEY],
            'age' => Carbon::instance(Date::excelToDateTimeObject($item[self::DATE_OF_BIRTH_KEY]))->year,
            'sex' => self::SEX_MAPPING[$item[self::SEX_KEY]],
        ]);

        return $person;
    }

    private function createExchangeStudent(Collection $item, Person $person): ExchangeStudent
    {
        if ($person->id_user <= $this->lastUserIdBeforeImport && $person->exchangeStudent()->exists()) {
            $exchangeStudent = $person->exchangeStudent;
            $this->comment(
                sprintf(self::MSG_EX_ST, $exchangeStudent->semesters->implode('semester', ', '))
            );
            $this->countAlreadyExistExSt++;
        } else {
            $exchangeStudent = $person->exchangeStudent()->create([
                'school' => $item[self::SCHOOL_KEY],
                'id_country' => $this->countries->where('two_letters', '=', $item[self::NATIONALITY_KEY])->first()->id_country,
                'id_accommodation' => Accommodation::DEFAULT_ID,
                'id_faculty' => $this->faculties->where('abbreviation', '=', $item[self::FACULTY_KEY])->first()->id_faculty,
            ]);
        }

        if ($this->fullTime) {
            $exchangeStudent->markAsDegreeStudent();
            $this->comment(self::MSG_LABEL_AS_FULL_TIME);
        }

        $semesters = collect(mb_str_split($item[self::SEMESTER_KEY]))->map(function ($value) {
            return $this->semesterMapping[$value];
        });

        $syncResult = $exchangeStudent->semesters()->syncWithoutDetaching($semesters->pluck('id_semester')->all());
        $addedSemesters = $semesters->whereIn('id_semester', $syncResult['attached']);
        $this->comment(
            sprintf(self::MSG_ADD_SEMESTERS, $addedSemesters->implode('semester', ', '))
        );

        return $exchangeStudent;
    }

    private function isNotComing(Collection $row): bool
    {
        return empty($row[self::EMAIL_KEY]) || in_array($row[self::NOTE_KEY], self::CANCELLATION_NOTES);
    }

    private function handleExistAsBuddy(User $user)
    {
        if ($user->buddy()->doesntExist()) {
            return;
        }

        $this->countAlreadyExistBuddy++;

        if ($user->buddy->exchangeStudents()->count() > 0) {
            $this->comment(self::MSG_BUDDY_NOT_DELETED);
            return;
        }

        $user->buddy()->delete();
        $this->comment(self::MSG_BUDDY_DELETED);
    }

    private function comment(string $message)
    {
        if (app()->runningInConsole()) {
            $this->getConsoleOutput()->text($message);
        }

        $this->messages->add($this->currentRowNumber, $message);
    }

    private function separator()
    {
        if (!app()->runningInConsole()) {
            return;
        }

        $this->getConsoleOutput()->text(self::MSG_SEPARATOR);
    }
}
