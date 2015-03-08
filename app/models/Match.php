<?php

use Illuminate\Database\Eloquent\Model as Eloquent;
use Carbon\Carbon;

class Match extends Eloquent {

    /**
     * @var array
     */
    protected $fillable = ['team_id', 'date', 'home_team', 'away_team', 'tv_info', 'results'];

    public function scores()
    {
        return $this->hasOne('Score');
    }

    /**
     * @param $value
     * @return static
     */
    public function getDateAttribute($value)
    {
        return Carbon::parse($value);
    }

    public function getWinningTeam()
    {
        if ($this->scores->isEmpty())
        {
            return;
        }

        $scores = array_fetch($this->scores->toArray(), 'score');

        return $this->scores->get(array_search(max($scores), $scores));
    }

} 