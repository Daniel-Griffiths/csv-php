<?php

namespace DanielGriffiths;

/**
 * @package CSV
 * @author Daniel Griffiths (daniel-griffiths)
 */
class CSV
{
    /**
     * @var string
     */
    public static $csv = "";

    /**
     * Create a CSV string from an array of objects
     *
     * @param array $rows
     * @return self
     */
    public static function fromArray(array $rows): self
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

        self::$csv = stream_get_contents($outputBuffer);

        fclose($outputBuffer);

        return new static;
    }

    /**
     * Downloads the CSV as a file
     *
     * @param string $filename
     * @return void
     */
    public static function download(string $filename): void
    {
        header("Content-Disposition: attachment; filename=\"{$filename}\";");
        echo self::$csv;
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

    /**
     * Returns the CSV as a string
     *
     * @return string
     */
    public static function toString(): string
    {
        return self::$csv;
    }

    /**
     * Writes the CSV data to a file
     *
     * @return void
     */
    public static function toFile(string $filename): void
    {
        file_put_contents($filename, self::$csv);
    }    
}
