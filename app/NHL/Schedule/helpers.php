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

    if ($currentDateTime->timestamp >
        Carbon::create($match['date']->year, $match['date']->month, $match['date']->daysInMonth)->timestamp)
    {
        return ' collapsed';
    }
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
        if (stripos($team['short'], $teamName) !== false || stripos($team['long'], $teamName) !== false)
        {
            return $id;
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

    return array_get($teams, $teamID)['long'];
}

/**
 * Get a teams short name from it's ID.
 * @param $teamID
 * @return string
 */
function getTeamShortName($teamID)
{
    $teams = Config::get('nhl.teams');

    return array_get($teams, $teamID)['short'];
}

/**
 * Format a match score into a string.
 * @param $match
 * @return string
 */
function presentScores($match)
{
    $template = '%s %s (%d) - %s (%s) %s';

    $team1 = $match['scores']->first();
    $team2 = $match['scores']->last();
    $status = $team1->game_status === 'final' ? 'FINAL:' : '';
    $extra = '';

    if ($team1->shootout)
    {
        $extra = 'SO';
    }
    elseif ($team1->overtime)
    {
        $extra = 'OT';
    }

    return sprintf($template, $status, $team1->team_id, $team1->score, $team2->team_id, $team2->score, $extra);
}