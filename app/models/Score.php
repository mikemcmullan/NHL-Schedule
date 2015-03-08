<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class Score extends Eloquent {

    /**
     * @var array
     */
    protected $fillable = [
        'match_id',
        'home_team',
        'away_team',
        'home_score',
        'home_sog',
        'away_score',
        'away_sog',
        'overtime',
        'shootout',
        'game_status',
        'game_time'
    ];

    public function match()
    {
        return $this->hasOne('Match');
    }

    public function getHomeScore()
    {
        return $this->home_score;
    }

    public function getHomeSog()
    {
        return $this->home_sog;
    }

    public function getAwayScore()
    {
        return $this->away_score;
    }

    public function getAwaySog()
    {
        return $this->away_sog;
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

    public function getGameTime()
    {
        return $this->game_time;
    }

}