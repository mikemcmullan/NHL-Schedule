<?php

namespace NHL\Scoreboard\JSON;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use NHL\Common\FileDownloader;
use Illuminate\Config\Repository as ConfigRepository;
use GuzzleHttp\json_decode;
use NHL\Scoreboard\ScoreboardImporter as ScoreboardImporterInterface;

class ScoreboardImporter implements ScoreboardImporterInterface {

    /**
     * @var FileDownloader
     */
    private $fileDownloader;

    /**
     * @var ConfigRepository
     */
    private $config;

    /**
     * @param FileDownloader $fileDownloader
     * @param ConfigRepository $config
     */
    public function __construct(FileDownloader $fileDownloader, ConfigRepository $config)
    {
        $this->fileDownloader = $fileDownloader;
        $this->config = $config;
    }

    /**
     * @param Carbon $date
     * @return json_decode
     */
    public function byDay(Carbon $date)
    {
        // Download the schedule and return it as a string.
        $jsonpString = $this->fileDownloader->get(sprintf($this->config->get('nhl.jsonDayScoreboardUrl'), $date->toDateString()));

        return $this->parse($jsonpString);
    }

    /**
     * @param $jsonpString
     * @return json_decode
     */
    private function parse($jsonpString)
    {
        $jsonString = $this->removePadding($jsonpString);

        return new Collection(array_get(json_decode($jsonString, true), 'games'));
    }

    /**
     * @param $jsonpString
     * @return mixed
     */
    private function removePadding($jsonpString)
    {
        return preg_replace('/\w+\((.*)\)/', '$1', $jsonpString);
    }

} 