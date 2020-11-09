<?php

namespace App\Traits;

use Illuminate\Support\Collection;

trait ImportSeederCsv
{
    protected function getCsv($filename): Collection
    {
        if (!file_exists($filename)) {
            return collect();
        }

        $csvData = collect();
        $columnNames = null;

        $file = fopen($filename, 'rb');
        while (($line = fgetcsv($file)) !== false) {
            $row = collect();
            if (!$columnNames) {
                $columnNames = collect($line);
            } else {
                $i = 0;
                $columnNames->each(static function ($column) use ($line, &$i, &$row) {
                    $row->put($column, $line[$i]);
                    $i++;
                });
            }
            if ($row->isNotEmpty()) {
                $csvData->push($row);
            }
        }

        fclose($file);

        return $csvData;
    }
}
