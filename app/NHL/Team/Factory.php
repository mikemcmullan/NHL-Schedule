<?php

namespace NHL\Team;

use Illuminate\Config\Repository as ConfigRepository;
use Illuminate\Container\Container;
use NHL\Exceptions\NonExistentTeamException;

class Factory {

    /**
     * @var ConfigRepository
     */
    private $config;

    /**
     * @var Container
     */
    private $container;

    public function __construct(ConfigRepository $config, Container $container)
    {
        $this->config = $config;
        $this->container = $container;
    }

    public function make($teamId = null, $season)
    {
        if ( ! $team = $this->config->get("nhl.teams.{$teamId}"))
        {
            throw new NonExistentTeamException;
        }

        $team = new Team($teamId, $season, $team['long'], $team['short'], $team['colours']);
        $team->setContainer($this->container);

        return $team;
    }

}