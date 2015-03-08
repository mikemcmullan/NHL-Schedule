<?php

namespace NHL\Standings\HTML;

use NHL\Standings\Importer as ImporterInterface;
use NHL\Common\FileDownloader;
use PHPHtmlParser\Dom;
use Sunra\PhpSimple\HtmlDomParser;
use Illuminate\Config\Repository as ConfigRepository;

class Importer implements ImporterInterface {

    /**
     * @var Dom
     */
    private $dom;

    /**
     * @var ScheduleDownloader
     */
    private $fileDownloader;

    /**
     * @var ConfigRepository
     */
    private $config;

    /**
     * @param Dom                $dom
     * @param FileDownloader $fileDownloader
     * @param ConfigRepository   $config
     */
    public function __construct(Dom $dom, FileDownloader $fileDownloader, ConfigRepository $config)
    {
        $this->dom = $dom;
        $this->fileDownloader = $fileDownloader;
        $this->config = $config;
    }

    /**
     * Import the current standings.
     *
     * @param $type
     * @return array
     */
    public function all($type)
    {
        // Download the schedule and return it as a string.
        $htmlString = $this->fileDownloader->get(sprintf($this->config->get('nhl.htmlStandingsUrl'), $type));

        return $this->parse($htmlString);
    }

    /**
     * Parse the html. Each table row will them become an
     *
     * @param $htmlString
     * @return array
     */
    private function parse($htmlString)
    {
        // Parse the html.
        $dom = HtmlDomParser::str_get_html($htmlString);

        // Find the schedule table.
        $standingsTable = $dom->find('table.standings');

        return $standingsTable;
    }
}