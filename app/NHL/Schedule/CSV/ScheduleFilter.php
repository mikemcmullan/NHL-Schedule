<?php

namespace NHL\Schedule\CSV;

use NHL\Schedule\ScheduleImporter as ScheduleImporterInterface;
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
        return preg_replace('/[^0-9]/', '', $date . $time);
    }

    /**
     * Parses a string & returns the home and away teams.
     * 
     * @param  string $string
     * @return array
     */
    private function parseTeams($subject)
    {
        preg_match('/([\w\s]+)\s+?(?:at|vs.)\s+?([\w\s]+)/', $subject, $teams);

        return [
            'home' => trim($teams[2]),
            'away' => trim($teams[1])
        ];
    }

    /**
     * Return desired keys & values based on provided data.
     * 
     * @param  array $match
     * @return array
     */
    private function mapMatches(array $match)
    {
        $teams = $this->parseTeams($match['SUBJECT']);

        return [
            'uid'         => $this->createUid($match['START_DATE'], $match['START_TIME_ET']),
            'date'        => $this->createDate($match['START_DATE'], $match['START_TIME_ET']),
            'home'        => $teams['home'],
            'away'        => $teams['away'],
            'location'    => $match['LOCATION'],
            'description' => $match['DESCRIPTION']
        ];
    }

    /**
     * Run the filter.
     * 
     * @return array
     */
    public function run($team = 'TOR')
    {
        $schedule = $this->scheduleImporter->run();

        return array_map([$this, 'mapMatches'], $schedule);
    }

}