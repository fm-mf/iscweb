<?php

namespace App\Exports;

use App\Exports\Concerns\WithStyles;
use App\Models\Semester;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class CECandidatesExport implements
    FromView,
    Responsable,
    ShouldAutoSize,
    WithColumnFormatting,
    WithStyles
{
    use Exportable;

    protected $students;
    protected $semester;
    protected $fileName;

    public function __construct(Collection $students, Semester $semester)
    {
        $this->students = $students;
        $this->semester = $semester;
        $this->fileName = "ce_candidates_{$semester->semester}.xlsx";
    }

    public function view(): View
    {
        return view('partak.stats.ceExport')->with([
            'students' => $this->students,
        ]);
    }

    public function columnFormats(): array
    {
        return [
            'A' => NumberFormat::FORMAT_TEXT,
            'B' => NumberFormat::FORMAT_TEXT,
            'C' => NumberFormat::FORMAT_TEXT,
            'D' => NumberFormat::FORMAT_TEXT,
            'E' => NumberFormat::FORMAT_TEXT,
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
                ]
            ],
        ];
    }
}
