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
        if ($this->matchRepo->doesMatchExist($match['uid']) === null)
        {
            $m = [
                'uid'           => $match['uid'],
                'team_id'       => $teamID,
                'date'          => $match['date'],
                'home_team'     => $match['home'],
                'away_team'     => $match['away'],
                'description'   => $match['description']
            ];

            return $this->matchRepo->create($m);
        }
    }

    public function run($teamID)
    {
        $schedule = $this->scheduleImporter->run($teamID);

        array_walk($schedule, [$this, 'insertIntoDB'], $teamID);
    }
}