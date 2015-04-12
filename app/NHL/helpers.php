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
 * Get a teams logo from it's ID.
 * @param $teamID
 * @return string
 */
function getTeamLogo($teamID)
{
    $teams = Config::get('nhl.teams');

    return array_get($teams, $teamID)['logo'];
}

/**
 * Format a match score into a string.
 * @param $match
 * @return string
 */
function presentScores(Match $match)
{
    $template = '%s (%d) - %s (%s)';

    return sprintf($template, $match['home_team'], $match['scores']['home_score'], $match['away_team'], $match['scores']['away_score']);
}

/**
 * @param Match $match
 * @return string
 */
function presentTime(Match $match)
{
    if ($match['date']->toTimeString() === '23:59:00')
    {
        return 'TBD *';
    }

    if ( ! hasMatchStarted($match['date']) ||  ! $match['scores'])
    {
        return $match['date']->format('g:i A');
    }

    $score = $match['scores'];

    if ($score->game_status === 'progress')
    {
        return strtoupper($score->game_time);
    }

    $output = $score->game_status;

    if ($score->overtime == 1)
    {
        $output .= ' OT';
    }
    else if($score->shootout == 1)
    {
        $output .= ' SO';
    }

    return strtoupper($output);
}

/**
 * Has a match started.
 *
 * @param Carbon $date
 * @return bool
 */
function hasMatchStarted(Carbon $date)
{
    return $date->diffInMinutes(Config::get('nhl.currentDateTime'), false) >= 0;
}

/**
 * Removed HTML comments from a string.
 *
 * @param $string
 * @return string
 */
function stripHTMLComments($string)
{
    return trim(preg_replace('/<!--(.|\s)*?-->/', '', $string));
}
