<?php

use Carbon\Carbon;

function isCollapsed($match)
{
    $currentDateTime = Config::get('nhl.currentDateTime');

    return $currentDateTime->timestamp > Carbon::create($match['date']->year, $match['date']->month, $match['date']->daysInMonth)->timestamp;
}

function getTeamID($teamString)
{
    $teams = Config::get('nhl.teams');

    if ($teamString === 'NY Rangers')
        return 'NYR';

    if ($teamString === 'NY Islanders')
        return 'NYI';

    foreach ($teams as $id => $team) 
    {
        if (stripos($team, $teamString) !== false)
        {
            return $id;
        }
    }
}