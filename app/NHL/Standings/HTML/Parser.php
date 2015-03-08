<?php

namespace NHL\Standings\HTML;

use NHL\Standings\Importer as ImporterInterface;
use Carbon\Carbon;
use InvalidArgumentException;

class Parser implements ImporterInterface {

    /**
     * Regex for Non Visible Characters
     */
    const REGEX_NON_PRINTABLE_CHARACTERS = '/^\p{Z}+|\p{Z}+$/u';

    /**
     * @var ScheduleImporter
     */
    private $importer;

    /**
     * @param Importer $importer
     */
    public function __construct(Importer $importer)
    {
        $this->importer = $importer;
    }

    /**
     * Remove anything that is not text.
     *
     * @param $string
     * @return string
     */
    private function getText($string)
    {
        return preg_replace(self::REGEX_NON_PRINTABLE_CHARACTERS, '', strip_tags($string));
    }

    /**
     * Parse the table header; return the column names.
     *
     * @param \simple_html_dom_node $row
     * @return array
     */
    private function parseTableHeader(\simple_html_dom_node $row)
    {
        $columns = $row->getElementsByTagName('th');

        // Remove position column. It is not needed.
        array_shift($columns);

        $i = 0;
        return array_map(function($col) use(&$i)
        {
            // Set the first column name to TEAM.
            if ($i++ === 0) return 'TEAM';

            $name = $this->getText($col->innertext);
            return $name ? $name : 'TEAM';

        }, $columns);
    }

    /**
     * Parse a table row; return column values;
     *
     * @param \simple_html_dom_node $row
     * @return array
     */
    private function parseTableRow(\simple_html_dom_node $row)
    {
        $columns = $row->getElementsByTagName('td');

        // Remove position column. It is not needed.
        array_shift($columns);

        return array_map(function($col) { return $this->getText($col->innertext); }, $columns);
    }

    /**
     * Parse a standings table.
     * 
     * @param  \simple_html_dom_node $table
     * @return array
     */
    private function parseTable(\simple_html_dom_node $table)
    {
        $tableRows = $table->getElementsByTagName('tr');

        $headers = $this->parseTableHeader(array_shift($tableRows));

        $rows = array_map([$this, 'parseTableRow'], $tableRows);

        return [
            'headers' => $headers,
            'data' => array_filter($rows)
        ];
    }

    /**
     * Import standings.
     *
     * @param $type
     * @return array
     * @throws \Exception
     */
    public function all($type)
    {
        if ( ! in_array($type, $types = ['WC', 'DIV', 'LEA']))
        {
            throw new InvalidArgumentException(sprintf('Valid types are %s.', implode(', ', $types)));
        }

        $standings = $this->importer->all($type);

        if (empty($standings))
        {
            throw new \Exception('Unable to parse standings.');
        }

        switch ($type)
        {
            case 'WC':
                $standingsTables = [
                    'eastern' => [
                        'atlantic' => $this->parseTable($standings[0]),
                        'metropolitan' => $this->parseTable($standings[1]),
                        'wildcard' => $this->parseTable($standings[2])
                    ],
                    'western' => [
                        'central' => $this->parseTable($standings[3]),
                        'pacific' => $this->parseTable($standings[4]),
                        'wildcard' => $this->parseTable($standings[5])
                    ]
                ];
                break;

            case 'DIV':
                $standingsTables = [
                    'eastern' => [
                        'atlantic' => $this->parseTable($standings[0]),
                        'metropolitan' => $this->parseTable($standings[1]),
                    ],
                    'western' => [
                        'central' => $this->parseTable($standings[2]),
                        'pacific' => $this->parseTable($standings[3]),
                    ]
                ];
                break;

            case 'LEA':
                $standingsTables = [
                    'league' => $this->parseTable($standings[0])
                ];
                break;
        }

        return $standingsTables;
    }
}