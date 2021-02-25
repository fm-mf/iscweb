<?php

namespace App\Exports\Sheets;

use App\Exports\Concerns\WithStyles;
use App\Models\Trip;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TripReservationsSheet implements
    FromView,
    ShouldAutoSize,
    WithColumnFormatting,
    WithStyles,
    WithTitle
{
    const SHEET_TITLE = 'Reservations';

    protected $trip;
    protected $reservations;

    public function __construct(Trip $trip, Collection $reservations)
    {
        $this->trip = $trip;
        $this->reservations = $reservations;
    }

    public function view(): View
    {
        return view('partak.trips.excel-reservations')->with([
            'trip' => $this->trip,
            'reservations' => $this->reservations,
        ]);
    }

    public function columnFormats(): array
    {
        return [
            'H' => NumberFormat::FORMAT_TEXT,
            'I' => NumberFormat::FORMAT_TEXT,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->freezePane('A3');
        $sheet->mergeCells('A1:M1');
        $sheet->getRowDimension(1)->setRowHeight(32);

        return [
            'A1' => [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                ],
            ],
            2 => [
                'font' => [
                    'bold' => true,
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                ]
            ],
        ];
    }

    public function title(): string
    {
        return self::SHEET_TITLE;
    }
}