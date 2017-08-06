<?php
/**
 * Created by PhpStorm.
 * User: speedy
 * Date: 6.8.17
 * Time: 12:50
 */

namespace App\Loggers;

class ImportLogger
{
    private $filePath;

    public function __construct(string $fileName)
    {
        $this->filePath = 'import/logs/' . $fileName;
    }

    public function addLine(string $line)
    {
        \Storage::append($this->filePath, $line);
    }
}