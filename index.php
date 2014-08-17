<?php

use Goodby\CSV\Import\Standard\Lexer;
use Goodby\CSV\Import\Standard\Interpreter;
use Goodby\CSV\Import\Standard\LexerConfig;

require 'vendor/autoload.php';

$matches = [];
$columnNames = ['UID'];

$lexer = new Lexer(new LexerConfig());
$interpreter = new Interpreter();
$index = 0;

$interpreter->addObserver(function(array $row) use (&$matches, &$columnNames, &$index) 
{
    $index++;

    if ($index === 1) {
        $columnNames = array_merge($columnNames, $row);
        return;
    }

    array_unshift($row, preg_replace('/[^0-9]/', '', $row[0] . $row[1]));

    $matches[] = array_combine($columnNames, $row);
});

$lexer->parse('full.csv', $interpreter);

print_r($matches);