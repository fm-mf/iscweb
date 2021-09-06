<?php

namespace App\Imports;

use App\Models\Country;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class EsnCardLabelsImport implements
    WithHeadingRow
{
    const GIVEN_NAMES_KEY = 'jmeno';
    const SURNAME_KEY = 'prijmeni';
    const NATIONALITY_KEY = 'narodnost';
    const DATE_OF_BIRTH_KEY = 'dat_narozeni';
    const EMAIL_KEY = 'e_mail';
    const NOTE_KEY = 'pozn';

    const CANCELLATION_NOTES = [
        'nepřijede',
        'zrušil',
        'zrušila',
        'neprijede',
        'zrusil',
        'zrusila',
        'Z',
    ];

    private $headingRowNumber;

    public function headingRow(): int
    {
        return $this->headingRowNumber;
    }

    public function setHeadingRowNumber(int $headingRowNumber): self
    {
        $this->headingRowNumber = $headingRowNumber;

        return $this;
    }

    public function prepareData(Collection $data): Collection
    {
        $countries = Country::all()
            ->mapWithKeys(function (Country $country) {
                return [$country->two_letters => $country->full_name];
            });

        return $data->filter(function ($student) {
            return !empty($student[self::EMAIL_KEY])
                && !in_array(
                    $student[self::NOTE_KEY],
                    self::CANCELLATION_NOTES
                );
        })->map(function (Collection $student) use ($countries) {
            return collect([
                'givenNames' => $student[self::GIVEN_NAMES_KEY],
                'surname' => $student[self::SURNAME_KEY],
                'dateOfBirth' => Carbon::parse(Date::excelToDateTimeObject($student[self::DATE_OF_BIRTH_KEY])),
                'nationality' => $countries[$student[self::NATIONALITY_KEY]],
            ]);
        })->sort(function ($a, $b) {
            return strcoll(mb_strtoupper($a['surname']), mb_strtoupper($b['surname']))
                ?: strcoll(mb_strtoupper($a['givenNames']), mb_strtoupper($b['givenNames']));
        });
    }
}
