<?php

namespace App\Exports;

use App\Exports\Sheets\TripParticipantsSheet;
use App\Exports\Sheets\TripReservationsSheet;
use App\Models\Trip;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class TripParticipantsExport implements
    Responsable,
    WithMultipleSheets
{
    use Exportable;

    protected $trip;
    protected $fileName;

    public function __construct(Trip $trip)
    {
        $this->trip = $trip;
        $this->fileName = "{$trip->event->nameWithoutSpaces()}_participants.xlsx";
    }

    public function sheets(): array
    {
        $participants = $this->trip->participants()->orderBySurname()->get();
        $sheets = [
            new TripParticipantsSheet($this->trip, $participants),
        ];

        if ($this->trip->reservations_enabled) {
            $reservations = $this->trip->reservations()->orderBySurname()->get();
            $sheets[] = new TripReservationsSheet($this->trip, $reservations);
        }

        return $sheets;
    }
}
