<?php

namespace NHL\Schedule\HTML;

use NHL\Schedule\ScheduleImporter as ScheduleImporterInterface;
use PHPHtmlParser\Dom\HTMLNode;
use Carbon\Carbon;

class ScheduleFilter implements ScheduleImporterInterface {

    /**
     * @var ScheduleImporter
     */
    private $scheduleImporter;

    /**
     * @param ScheduleImporter $scheduleImporter
     */
    public function __construct(ScheduleImporter $scheduleImporter)
    {
        $this->scheduleImporter = $scheduleImporter;
    }

    /**
     * Creates a proper date object from a date & time.
     * 
     * @param  string $date
     * @param  string $time
     * @return object
     */
    private function createDate($date, $time)
    {
        return Carbon::parse($date . ' ' . $time);
    }

    /**
     * Creates a unique identifier based on the date & time.
     * 
     * @param  string $date
     * @param  string $time
     * @return object
     */
    private function createUid($date, $time)
    {
        $dateTime = $this->createDate($date, $time);

        return preg_replace('/[^0-9]/', '', $dateTime->toDateTimeString());
    }

    /**
     * Return desired keys & values based on provided data.
     * 
     * @param  array $match
     * @return array
     */
    private function mapMatches(\simple_html_dom_node $match)
    {
        if (count($match->find('td')) < 6)
        {
            return;
        }

        $date = head($match->find('.date .skedStartDateLocal'))->innertext;
        $time = head($match->find('.time .skedStartTimeEST'))->innertext;
        $time = str_replace(' ET', '', $time);

        return [
            'uid'         => $this->createUid($date, $time),
            'date'        => $this->createDate($date, $time),
            'home'        => array_get($match->find('.team .teamName a'), 1)->innertext,
            'away'        => array_get($match->find('.team .teamName a'), 0)->innertext,
            'description' => head($match->find('.tvInfo'))->innertext 
        ];
    }

    /**
     * Run the filter.
     * 
     * @return array
     */
    public function run($team = 'TOR')
    {
        $schedule = $this->scheduleImporter->run($team);

        // return $schedule->toArray();
        // return array_filter(array_map([$this, 'mapMatches'], $schedule->toArray()));
        return array_filter(array_map([$this, 'mapMatches'], $schedule));
    }

}