<?php

namespace NHL\Team;

use NHL\Storage\Match\MatchRepository;

class Stats {

    /**
     * @var Team
     */
    private $team;

    /**
     * @var
     */
    private $matchRepo;

    public function __construct(MatchRepository $matchRepo)
    {
        $this->matchRepo = $matchRepo;
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

    public function ratio()
    {
        $matches = $this->matchRepo->byTeam($this->team->getTeamId());

        $wins = 0;
        $losses = 0;

        foreach ($matches as $match)
        {
            if ( ! $team = $match->getWinningTeam())
            {
                continue;
            }

            $team->getTeamId() === $this->team->getTeamId() ? $wins++ : $losses++;
        }

        return [
            'wins' => $wins,
            'losses' => $losses
        ];
    }

}