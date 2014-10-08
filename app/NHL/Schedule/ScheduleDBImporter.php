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

    private function insertIntoDB($match, $key, $teamID)
    {
        $m = [
            'uid'           => $match['uid'],
            'team_id'       => $teamID,
            'date'          => $match['date'],
            'home_team'     => $match['home'],
            'away_team'     => $match['away']
        ];

        $match['tv_info'] && $m['tv_info'] = $match['tv_info'];
        $match['results'] && $m['results'] = $match['results'];

        if ($this->matchRepo->byUID($match['uid']) === null)
        {
            return $this->matchRepo->create($m);
        }
        else
        {
            return $this->matchRepo->updateByUID($match['uid'], $m);
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