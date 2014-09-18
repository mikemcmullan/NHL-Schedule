<?php

namespace NHL\Storage\Match;

use NHL\Exceptions\NonExistentTeamException;

class EloquentMatchRepository implements MatchRepository {

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
        $matches = Match::where('team_id', '=', $teamID)->get();

        if ($matches->isEmpty())
        {
            throw new NonExistentTeamException;
        }

        return $matches;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all()
    {
        return Match::all();
    }

}