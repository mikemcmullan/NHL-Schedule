<?php

namespace NHL\Storage\Match;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Carbon\Carbon;

class Match extends Eloquent {

    /**
     * @var array
     */
    protected $fillable = ['uid', 'team_id', 'date', 'home_team', 'away_team', 'tv_info', 'results'];

    /**
     * @param $value
     * @return static
     */
    public function getDateAttribute($value)
    {
        return Carbon::parse($value);
    }

} 