<?php

namespace NHL\Storage\Match;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Carbon\Carbon;

class Match extends Eloquent {

    protected $fillable = ['uid', 'team_id', 'date', 'home_team', 'away_team', 'description'];

    public function getDateAttribute($value)
    {
        return Carbon::parse($value);
    }

} 