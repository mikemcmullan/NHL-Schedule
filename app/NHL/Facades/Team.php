<?php

namespace NHL\Facades;

use Illuminate\Support\Facades\Facade;

class Team extends Facade {

    protected static function getFacadeAccessor()
    {
        return 'nhl.team';
    }

}