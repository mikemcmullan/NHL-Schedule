<?php

namespace NHL\Storage\Match;

use Illuminate\Config\Repository as ConfigRepository;
use NHL\Exceptions\NonExistentTeamException;

class EloquentMatchRepository implements MatchRepository {

    /**
     * @var Repository
     */
    private $config;

    /**
     * @var Match
     */
    private $model;

    /**
     * @param ConfigRepository|Repository $config
     * @param Match $model
     */
    public function __construct(ConfigRepository $config, Match $model)
    {
        $this->config = $config;
        $this->model = $model;
    }

    /**
     * @param $input
     * @return static
     */
    public function create($input)
    {
        return Match::create($input);
    }

    /**
     * @param $uid
     * @return mixed
     */
    public function byUID($uid)
    {
        return Match::where('uid', '=', $uid)->first();
    }

    /**
     * @param $uid
     * @param $input
     * @return mixed
     */
    public function updateByUID($uid, $input)
    {
        return Match::where('uid', '=', $uid)->update($input);
    }

    /**
     * @param $teamID
     * @return mixed
     * @throws NonExistentTeamException
     */
    public function byTeam($teamID)
    {
        $matches = $this->model->where('team_id', '=', $teamID)->get();

        if ($matches->isEmpty())
        {
            throw new NonExistentTeamException;
        }

        return $matches;
    }

    public function today()
    {
        $date = $this->config->get('nhl.currentDateTime');

        if ($date->hour < 2)
        {
            $date = $date->subDay();
        }

        $mysqlFormat = $date->toDateString();

        return $this->model->whereRaw("DATE(date) = '{$mysqlFormat}'")->get();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all()
    {
        return $this->model->all();
    }

}