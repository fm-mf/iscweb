<?php

namespace App\Exports;

use App\Exports\Concerns\WithStyles;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class QuarantinedStudentsExport implements
    FromView,
    Responsable,
    ShouldAutoSize,
    WithColumnFormatting,
    WithStyles,
    WithTitle
{
    use Exportable;

    const FILE_NAME = 'quarantined-students_%s.xlsx';
    const SHEET_TITLE = 'Quarantined students';

    protected $exchangeStudents;
    protected $fileName;

    public function __construct(Collection $exchangeStudents)
    {
        $this->exchangeStudents = $exchangeStudents;
        $this->fileName = sprintf(self::FILE_NAME, now()->toDateString());
    }

    public function view(): View
    {
        return view('partak.users.quarantined.excel', [
            'exchangeStudents' => $this->exchangeStudents,
        ]);
    }

    public function columnFormats(): array
    {
        return [
            'A' => NumberFormat::FORMAT_TEXT,
            'B' => NumberFormat::FORMAT_TEXT,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->freezePane('A2');

        return [
            1 => [
                'font' => [
                    'bold' => true,
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                ],
            ],
            'C' => [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_RIGHT,
                ],
            ],
        ];
    }

    public function title(): string
    {
        return self::SHEET_TITLE;
    }
}
