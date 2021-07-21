<?php

namespace App\Exports\Concerns;

use Maatwebsite\Excel\Sheet;

class WithStylesHandler
{
    private $worksheet;

    public function __invoke(WithStyles $sheetExport, Sheet $sheet)
    {
        $this->worksheet = $sheet->getDelegate();

        $styles = $sheetExport->styles($this->worksheet);
        if (is_array($styles)) {
            foreach ($styles as $coordinate => $coordinateStyles) {
                if (is_numeric($coordinate)) {
                    $coordinate = 'A' . $coordinate . ':' . $this->worksheet->getHighestColumn($coordinate) . $coordinate;
                }

                $this->worksheet->getStyle($coordinate)->applyFromArray($coordinateStyles);
            }
        }
    }
}