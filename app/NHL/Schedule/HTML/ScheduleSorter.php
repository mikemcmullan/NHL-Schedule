<?php

namespace NHL\Schedule\HTML;

use NHL\Schedule\ScheduleImporter as ScheduleImporterInterface;
use Illuminate\Config\Repository as ConfigRepository;
use Carbon\Carbon;

class ScheduleSorter implements ScheduleImporterInterface {

    /**
     * @var ScheduleImporter
     */
    private $scheduleFilter;

    /**
     * @var sortedSchedule
     */
    private $sortedSchedule = [];

    /**
     * @var nextGame
     */
    private $nextGame = false;

    /**
     * @var ConfigRepository
     */
    private $config;

    /**
     * @param ScheduleImporter $scheduleFilter
     */
    public function __construct(ScheduleFilter $scheduleFilter, ConfigRepository $config)
    {
        $this->scheduleFilter = $scheduleFilter;
        $this->config = $config;
    }

    /**
     * @param  array $match
     * @param  string $key
     * @return void
     */
    private function walkSchedule(&$match, $key)
    {
        $month = $match['date']->format('F');

        if ($match['date'] > $this->config->get('nhl.currentDateTime') && $this->nextGame === false)
        {
            $this->nextGame = true;
            $match['nextGame'] = true;
        }

        $this->sortedSchedule[$month][] = $match;
    }

    /**
     * @param  array $a
     * @param  array $b
     * @return boolean
     */
    private function sortMonths($a, $b)
    {
        $matchA = head($a)['date'];
        $matchB = head($b)['date'];

        $dateA = Carbon::create($matchA->year, $matchA->month, $matchA->daysInMonth);
        $dateB = Carbon::create($matchB->year, $matchB->month, $matchB->daysInMonth);

        return $dateA > $dateB;
    }

    /**
     * Sort the schedule.
     * 
     * @return array
     */
    public function run($teamId)
    {
        $schedule = $this->scheduleFilter->run($teamId);

        array_walk($schedule, [$this, 'walkSchedule']);

        uasort($this->sortedSchedule, [$this, 'sortMonths']);

        return $this->sortedSchedule;
    }

}