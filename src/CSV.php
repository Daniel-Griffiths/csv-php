<?php

namespace DanielGriffiths;

/**
 * @package CSV
 * @author Daniel Griffiths (daniel-griffiths)
 */
class CSV
{
    /**
     * Create a CSV string from an array of objects
     *
     * @param array $rows
     * @return string
     */
    public static function fromArray(array $rows): string
    {
        $outputBuffer = fopen('php://temp/maxmemory:1048576', 'w');

        $isFirstIteration = true;

        foreach ($rows as $row) {
            if ($isFirstIteration) {
                fputcsv($outputBuffer, array_keys($row));
            }

            $isFirstIteration = false;

            fputcsv($outputBuffer, (array) $row);
        }

        rewind($outputBuffer);

        $csv = stream_get_contents($outputBuffer);

        fclose($outputBuffer);

        return $csv;
    }

    /**
     * Convert a CSV to an array
     *
     * @param string filename
     * @return array
     */
    public static function toArray(string $filename): array
    {
        $rows = array_map('str_getcsv', file($filename));
        $header = array_shift($rows);

        return array_map(function ($row) use ($header) {
            return array_combine($header, $row);
        }, $rows);
    }
}
