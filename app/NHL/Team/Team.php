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
     * @var array
     */
    private $colours;

    /**
     * @var int
     */
    private $season;

    /**
     * @param $teamId
     * @param $season
     * @param $teamLongName
     * @param $teamShortName
     * @param array $colours
     */
    public function __construct($teamId, $season, $teamLongName, $teamShortName, array $colours)
    {
        $this->teamId = $teamId;
        $this->teamLongName = $teamLongName;
        $this->teamShortName = $teamShortName;
        $this->colours = $colours;
        $this->season = $season;
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
     * @return array
     */
    public function getTeamColours()
    {
        return $this->colours;
    }

    /**
     * @return int
     */
    public function getSeason()
    {
        return $this->season;
    }

    /**
     *
     */
    public function colours()
    {
        return new Colours($this->colours);
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
        return $this->container->make(__NAMESPACE__ . '\Schedule')
            ->setTeam($this)
            ->setSeason($this->season)
            ->get($sorted);
    }

}