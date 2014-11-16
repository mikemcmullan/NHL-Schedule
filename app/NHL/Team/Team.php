<?php

namespace NHL\Team;

use Illuminate\Container\Container;

class Team
{
    /**
     * @var
     */
    private $container;

    /**
     * @var
     */
    private $teamId;

    /**
     * @var
     */
    private $teamLongName;

    /**
     * @var
     */
    private $teamShortName;

    /**
     * @param $teamId
     * @param $teamLongName
     * @param $teamShortName
     */
    public function __construct($teamId, $teamLongName, $teamShortName)
    {
        $this->teamId = $teamId;
        $this->teamLongName = $teamLongName;
        $this->teamShortName = $teamShortName;
    }

    /**
     * @param Container $container
     */
    public function setContainer(Container $container)
    {
        $this->container = $container;
    }

    /**
     * @return string
     */
    public function getTeamId()
    {
        return $this->teamId;
    }

    /**
     * @return string
     */
    public function getTeamLongName()
    {
        return $this->teamLongName;
    }

    /**
     * @return string
     */
    public function getTeamShortName()
    {
        return $this->teamShortName;
    }

    /**
     * @return mixed
     */
    public function stats()
    {
        return $this->container->make(__NAMESPACE__ . '\Stats')->setTeam($this);
    }

    /**
     * @param bool $sorted
     * @return mixed
     */
    public function schedule($sorted = false)
    {
        return $this->container->make(__NAMESPACE__ . '\Schedule')->setTeam($this)->get($sorted);
    }

}