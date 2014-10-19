<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class Score extends Eloquent {

    /**
     * @var array
     */
    protected $fillable = ['match_id', 'team_id', 'score', 'overtime', 'shootout', 'game_status'];

    public function match()
    {
        return $this->hasOne('Match');
    }

    public function getTeamId()
    {
        return $this->team_id;
    }

    public function getScore()
    {
        return $this->score;
    }

    public function getShootout()
    {
        return $this->shootout;
    }

    public function getOvertime()
    {
        return $this->overtime;
    }

    public function getGameStatus()
    {
        return $this->game_status;
    }

}