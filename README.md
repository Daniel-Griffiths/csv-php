# CSV

A quick utility library for working with CSV's in PHP

## Installation

```
composer require daniel-griffiths/csv dev-master
```

## Usage

```PHP
<?php

require __DIR__.'/../vendor/autoload.php';

use DanielGriffiths\CSV;

// Convert a CSV file to a array
$csv = CSV::fromFile('file.csv');

// Convert an array to a CSV
$file = CSV::fromArray([
    [
        'animal' => 'Dog',
        'name' => 'Patch',
    ]
]);

// Optionally download the CSV
header('Content-Disposition: attachment; filename="filename.csv";');
echo $file;

```

## Tests

`./vendor/bin/phpunit`
