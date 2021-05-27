<?php

use DanielGriffiths\CSV;
use PHPUnit\Framework\TestCase;

class CSVTest extends TestCase
{
    /**
     * @var array
     */
    public $testData = [
        [
            'animal' => 'Dog',
            'name' => 'Patch'
        ]
    ];

    public function testFromFile()
    {
        $csv = CSV::toArray(__DIR__ . '/test.csv');

        $this->assertEquals($this->testData,  $csv);
    }

    public function testFromArrayToString()
    {
        $file = CSV::fromArray($this->testData)->toString();

        $this->assertIsString($file);
    }

    /**
     * @runInSeparateProcess
     */
    public function testFromArrayToDownload()
    {
        CSV::fromArray($this->testData)->download('file.csv');

        $this->expectOutputString(
            "animal,name" . PHP_EOL .
            "Dog,Patch" . PHP_EOL
        );
    }

    public function testToFile()
    {
        $filePath = __DIR__.'/to-file-test.csv';

        CSV::fromArray($this->testData)->toFile($filePath);

        $this->assertFileExists($filePath);

        unlink($filePath);
    }    
}
