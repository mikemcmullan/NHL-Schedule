<?php

namespace NHL\Schedule\HTML;

use NHL\Schedule\ScheduleImporter as ScheduleImporterInterface;
use NHL\Schedule\ScheduleDownloader;
use NHL\Exceptions\NonExistentTeamException;
use PHPHtmlParser\Dom;
use Sunra\PhpSimple\HtmlDomParser;
use Illuminate\Config\Repository as ConfigRepository;

class ScheduleImporter implements ScheduleImporterInterface {

    /**
     * @var Dom
     */
    private $dom;

    /**
     * @var ScheduleDownloader
     */
    private $scheduleDownloader;

    /**
     * @var ConfigRepository
     */
    private $config;

    /**
     * @param Dom                $dom
     * @param ScheduleDownloader $scheduleDownloader
     * @param ConfigRepository   $config
     */
    public function __construct(Dom $dom, ScheduleDownloader $scheduleDownloader, ConfigRepository $config)
    {
        $this->dom = $dom;
        $this->scheduleDownloader = $scheduleDownloader;
        $this->config = $config;
    }

    /**
     * Run the import.
     */
    public function run($team = 'TOR')
    {
        // Make sure the team exists.
        if ( ! $this->config->has("nhl.teams.{$team}"))
        {
            throw new NonExistentTeamException;
        }

        // Download the schedule and return it as a string.
        $htmlString = $this->scheduleDownloader->get(sprintf($this->config->get('nhl.htmlSeasonScheduleUrl'), $team));

        // Parse the html.
        $dom = HtmlDomParser::str_get_html($htmlString);

        // Find the schedule table.
        $matchesTable = $dom->find('.schedTbl tbody tr');

        // Remove the table header.
        array_shift($matchesTable);

        return $matchesTable;
    }
}