<?php

namespace NHL\Storage\Match;

use NHL\Exceptions\NonExistentTeamException;

class EloquentMatchRepository implements MatchRepository {

    public function create($input)
    {
        return Match::create($input);
    }

    public function doesMatchExist($uid)
    {
        return Match::where('uid', '=', $uid)->first();
    }

    public function byTeam($teamID)
    {
        $matches = Match::where('team_id', '=', $teamID)->get();

        if ($matches->isEmpty())
        {
            throw new NonExistentTeamException;
        }

        return $matches;
    }

    public function all()
    {
        return Match::all();
    }

}