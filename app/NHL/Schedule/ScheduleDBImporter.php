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
            'away_team'     => $match['away'],
            'description'   => $match['description']
        ];

        if ($this->matchRepo->byUID($match['uid']) === null)
        {
            return $this->matchRepo->create($m);
        }
        else
        {
            return $this->matchRepo->updateByUID($match['uid'], $m);
        }
    }

    public function run($teamID)
    {
        $schedule = $this->scheduleImporter->run($teamID);

        array_walk($schedule, [$this, 'insertIntoDB'], $teamID);
    }
}