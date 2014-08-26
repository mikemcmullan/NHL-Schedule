<?php

namespace NHL\Schedule\CSV;

use NHL\Schedule\ScheduleImporter as ScheduleImporterInterface;
use NHL\Schedule\ScheduleDownloader;
use Goodby\CSV\Import\Standard\Lexer;
use Goodby\CSV\Import\Standard\Interpreter;

class ScheduleImporter implements ScheduleImporterInterface {

    /**
     * @var Lexer
     */
    private $lexer;

    /**
     * @var Interpreter
     */
    private $interpreter;

    /**
     * @var ScheduleDownloader
     */
    private $scheduleDownloader;

    /**
     * @var array
     */
    public $columnNames = [];

    /**
     * @var array
     */
    public $matches = [];

    /**
     * @var int
     */
    private $rowNumber = 0;

    /**
     * @var Lexer           $lexer
     * @var interpreter     $interpreter
     */
    public function __construct(Lexer $lexer, Interpreter $interpreter, ScheduleDownloader $scheduleDownloader)
    {
        $this->lexer = $lexer;

        $this->interpreter = $interpreter;

        $this->scheduleDownloader = $scheduleDownloader;
    }

    /**
     * @var array   $row    CSV Row
     */
    public function handleHeader(array $row)
    {
        // Marge already existing column names with the ones from the csv.
        $this->columnNames = array_merge($this->columnNames, $row);
    }

    /**
     * @var array   $row    CSV Row
     */
    public function handleRow(array $row)
    {
        // Add the row to the array of matches.
        $this->matches[] = array_combine($this->columnNames, $row);
    }

    /**
     * Every time a row is observed handle it.
     *
     * @var array   $row    CSV Row
     */
    public function observer(array $row)
    {
        $this->rowNumber++;

        // If this is the first row treat it as column headers.
        // If now this is a regular row.
        if ($this->rowNumber === 1) 
        {
            $this->handleHeader($row);
        }
        else
        {
            $this->handleRow($row);
        }
    }

    /**
     * Run the import.
     */
    public function run($team)
    {
        // Download the schedule and return it as a string.
        $csvString = $this->scheduleDownloader->get('http://mapleleafs.nhl.com/schedule/full.csv');

        $this->interpreter->addObserver([$this, 'observer']);

        $this->lexer->parse('data://text/plain;base64,' . base64_encode($csvString), $this->interpreter);

        return $this->matches;
    }

}