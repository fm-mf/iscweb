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

class TripParticipantsSheet implements
    FromView,
    ShouldAutoSize,
    WithColumnFormatting,
    WithStyles,
    WithTitle
{
    const SHEET_TITLE = 'Participants';

    protected $trip;
    protected $participants;

    public function __construct(Trip $trip, Collection $participants)
    {
        $this->trip = $trip;
        $this->participants = $participants;
    }

    public function view(): View
    {
        return view('partak.trips.excel-participants')->with([
            'trip' => $this->trip,
            'participants' => $this->participants,
        ]);
    }

    public function columnFormats(): array
    {
        return [
            'H' => NumberFormat::FORMAT_TEXT,
            'I' => NumberFormat::FORMAT_TEXT,
            'M' => '# ##0 [$Kč-405];-# ##0 [$Kč-405]',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->freezePane('A3');
        $sheet->mergeCells('A1:O1');
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