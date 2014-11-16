<?php

namespace NHL\Team;

use NHL\Schedule\ScheduleSorter;
use NHL\Storage\Match\MatchRepository;

class Schedule {

    /**
     * @var MatchRepository
     */
    private $matchRepo;

    /**
     * @var ScheduleSorter
     */
    private $scheduleSorter;

    /**
     * @var Team
     */
    private $team;

    /**
     * @param MatchRepository $matchRepo
     * @param ScheduleSorter $scheduleSorter
     */
    public function __construct(MatchRepository $matchRepo, ScheduleSorter $scheduleSorter)
    {
        $this->matchRepo = $matchRepo;
        $this->scheduleSorter = $scheduleSorter;
    }

    /**
     * @param $team
     * @return $this
     */
    public function setTeam(Team $team)
    {
        $this->team = $team;

        return $this;
    }

    /**
     * @param bool $sorted
     * @return array
     */
    public function get($sorted = false)
    {
        if ($sorted)
        {
            return $this->sorted();
        }

        return $this->notSorted();
    }

    /**
     * @return mixed
     */
    private function notSorted()
    {
        return $this->matchRepo->byTeam($this->team->getTeamId());
    }

    /**
     * @return array
     */
    private function sorted()
    {
        $schedule = $this->matchRepo->byTeam($this->team->getTeamId());

        return $this->scheduleSorter->sort($schedule);
    }

}