<?php

namespace NHL\Storage\Match;

use Carbon\Carbon;
use Illuminate\Config\Repository as ConfigRepository;
use DB;
use Match;
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
        return $this->model->create($input);
    }

    /**
     * Get a match by it's team and date.
     *
     * @param $teamId
     * @param Carbon $matchDate
     * @return mixed
     */
    public function get($teamId, Carbon $matchDate)
    {
        return $this->model->where(function($query) use($teamId)
        {
            $query->where('home_team', '=', $teamId)
                ->orWhere('away_team', '=', $teamId);
        })->where(DB::raw('DATE(date)'), '=', $matchDate->toDateString())
            ->take(1)
            ->first();
    }

    /**
     * Get all matches for a team.
     *
     * @param $teamID
     * @return mixed
     * @throws NonExistentTeamException
     */
    public function byTeam($teamID)
    {
        $matches = $this->model->where('home_team', '=', $teamID)
            ->orWhere('away_team', '=', $teamID)
            ->orderBy('date')->get();

        if ($matches->isEmpty())
        {
            throw new NonExistentTeamException;
        }

        return $matches;
    }

    /**
     * Get all games that took place today. If the current time
     * is before 2 am count it as the previous day.
     *
     * @return mixed
     */
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