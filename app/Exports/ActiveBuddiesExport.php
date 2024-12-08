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

class ActiveBuddiesExport implements
    FromView,
    Responsable,
    ShouldAutoSize,
    WithColumnFormatting,
    WithStyles,
    WithTitle
{
    use Exportable;

    const SHEET_TITLE = 'Active Buddies';
    const FILE_NAME_BASE = 'active_buddies';
    const FILE_EXTENSION = 'xlsx';

    protected $buddies;
    protected $fileName;

    public function __construct(Collection $buddies)
    {
        $this->buddies = $buddies;

        $this->fileName = self::FILE_NAME_BASE
            . "_" . now()->toDateString()
            . "." . self::FILE_EXTENSION;
    }

    /**
     * @param string $fileName desired file name without a file format extension
     */
    public function withFileNameSuffix(string $suffix): self
    {
        $this->fileName = self::FILE_NAME_BASE
            . "_" . $suffix
            . "_" . now()->toDateString()
            . "." . self::FILE_EXTENSION;

        return $this;
    }

    public function view(): View
    {
        return view('partak.stats.activeBuddiesExport')->with([
            'buddies' => $this->buddies,
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
                ]
            ],
        ];
    }

    public function title(): string
    {
        return self::SHEET_TITLE;
    }
}
