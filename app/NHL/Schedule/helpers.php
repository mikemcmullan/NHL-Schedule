<?php

use Carbon\Carbon;

function isCollapsed($match)
{
    $currentDateTime = Config::get('nhl.currentDateTime');

    return $currentDateTime->timestamp > Carbon::create($match['date']->year, $match['date']->month, $match['date']->daysInMonth)->timestamp;
}