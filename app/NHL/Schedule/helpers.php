<?php

use Carbon\Carbon;

/**
 * Determine whether a month has passed.
 *
 * @param $match
 * @return bool
 */
function isCollapsed($match)
{
    $currentDateTime = Config::get('nhl.currentDateTime');

    return $currentDateTime->timestamp > Carbon::create($match['date']->year, $match['date']->month, $match['date']->daysInMonth)->timestamp;
}

/**
 * Get a teams id from its full name.
 *
 * @param $teamName
 * @return string
 */
function getTeamID($teamName)
{
    $teams = Config::get('nhl.teams');

    foreach ($teams as $id => $team) 
    {
        foreach($team as $teamN)
        {
            if (stripos($teamN, $teamName) !== false)
            {
                return $id;
            }
        }
    }
}

/**
 * Get a teams full name from it's ID.
 * @param $teamID
 * @return string
 */
function getTeamName($teamID)
{
    $teams = Config::get('nhl.teams');

    return head(array_get($teams, $teamID));
}

/**
 * Get a teams short name from it's ID.
 * @param $teamID
 * @return string
 */
function getTeamShortName($teamID)
{
    $teams = Config::get('nhl.teams');

    return last(array_get($teams, $teamID));
}