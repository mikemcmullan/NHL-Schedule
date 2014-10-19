<?php

namespace NHL\Schedule;

use NHL\Storage\Match\MatchRepository;

class ScheduleDBImporter implements ScheduleImporter {

    /**
     * @var ScheduleImporter
     */
    private $scheduleImporter;

    /**
     * @var MatchRepository
     */
    private $matchRepo;

    /**
     * @param ScheduleImporter $scheduleImporter
     * @param MatchRepository $matchRepo
     */
    public function __construct(ScheduleImporter $scheduleImporter, MatchRepository $matchRepo)
    {
        $this->scheduleImporter = $scheduleImporter;
        $this->matchRepo = $matchRepo;
    }

    /**
     * @param $match
     * @param $key
     * @param $teamId
     * @return mixed
     */
    private function insertIntoDB($match, $key, $teamId)
    {
        $m = [
            'date'          => $match['date'],
            'home_team'     => $match['home'],
            'away_team'     => $match['away']
        ];

        $match['tv_info'] && $m['tv_info'] = $match['tv_info'];
        $match['results'] && $m['results'] = $match['results'];

        if ($match = $this->matchRepo->get($teamId, $match['date'])->first())
        {
            return $match->update($m);
        }
        else
        {
            return $this->matchRepo->create($m);
        }
    }

    /**
     * Import the entire season schedule for a particular team.
     *
     * @param $teamId
     * @return array
     */
    public function bySeason($teamId)
    {
        $schedule = $this->scheduleImporter->bySeason($teamId);

        array_walk($schedule, [$this, 'insertIntoDB'], $teamId);
    }
}