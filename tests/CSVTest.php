<?php

use DanielGriffiths\CSV;
use PHPUnit\Framework\TestCase;

class CSVTest extends TestCase
{
    public function testFromArray()
    {
        $file = CSV::fromArray([
            [
                'animal' => 'Dog',
                'name' => 'Patch',
            ]
        ]);

        $this->assertIsString($file);
    }

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
}
