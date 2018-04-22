<?php

namespace Infinity;

require_once "ParserInterface.php";

class CSVParser implements ParserInterface
{
    /**
     * Parses the CSV and produces an associative array where each key matches the column of the CSV.
     * It allows the CSV creator to have any column order they like.
     *
     * @param $file
     *
     * @return array
     */
    public function parse($file)
    {
        $csv = array_map('str_getcsv', file($file));
        
        array_walk($csv, function(&$a) use ($csv) {
            $a = array_combine($csv[0], $a);
        });

        // delete the first row as it does not contain real data
        array_shift($csv);
        
        return $csv;
    }
}