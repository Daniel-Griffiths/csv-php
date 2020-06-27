<?php

use DanielGriffiths\CSV;
use PHPUnit\Framework\TestCase;

class CSVTest extends TestCase
{
    public function testFromFile()
    {
        $csv = CSV::toArray(__DIR__ . '/test.csv');

        $this->assertEquals([
            [
                'animal' => 'Dog',
                'name' => 'Patch'
            ]
        ],  $csv);
    }

    public function testFromArrayToString()
    {
        $file = CSV::fromArray([
            [
                'animal' => 'Dog',
                'name' => 'Patch',
            ]
        ])->toString();

        $this->assertIsString($file);
    }

    /**
     * @runInSeparateProcess
     */
    public function testFromArrayToDownload()
    {
        CSV::fromArray([
            [
                'animal' => 'Dog',
                'name' => 'Patch',
            ]
        ])->download('file.csv');

        $this->expectOutputString(
            "animal,name" . PHP_EOL .
                "Dog,Patch" . PHP_EOL
        );
    }
}
