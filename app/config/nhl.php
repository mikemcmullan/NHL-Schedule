<?php

use Carbon\Carbon;

return [

    /*
    |--------------------------------------------------------------------------
    | Schedule Cache Length
    |--------------------------------------------------------------------------
    |
    | How long in minutes should the schedule stay in the cache. An instance
    | of carbon may also be used.
    |
    */
    'scheduleCacheLength' => Carbon::now()->addDay(),

    /*
    |--------------------------------------------------------------------------
    | Current Date & Time
    |--------------------------------------------------------------------------
    |
    | Since we use the current date & time in a few places; to make testing
    | easier set it here. An instance of Carbon must be used.
    |
    */
    'currentDateTime' => Carbon::now(),

    /*
    |--------------------------------------------------------------------------
    | HTML Season Schedule Url
    |--------------------------------------------------------------------------
    |
    | The location of the HTML schedule for a team; %s is the placeholder for 
    | a teams name (ex. TOR => Toronto Maple Leafs). 
    |
    */
    'htmlSeasonScheduleUrl' => 'http://www.nhl.com/ice/schedulebyseason.htm?season=20142015&gameType=2&team=%s&network=&venue=',

    /*
    |--------------------------------------------------------------------------
    | List of NHL Teams
    |--------------------------------------------------------------------------
    */
    'teams' => [
        'ANA' => 'Anaheim Ducks',
        'ARI' => 'Arizona Coyotes',
        'BOS' => 'Boston Bruins',
        'BUF' => 'Buffalo Sabres',
        'CGY' => 'Calgary Flames',
        'CAR' => 'Carolina Hurricanes',
        'CHI' => 'Chicago Blackhawks',
        'COL' => 'Colorado Avalanche',
        'CBJ' => 'Columbus Blue Jackets',
        'DAL' => 'Dallas Stars',
        'DET' => 'Detroit Red Wings',
        'EDM' => 'Edmonton Oilers',
        'FLA' => 'Florida Panthers',
        'LAK' => 'Los Angeles Kings',
        'MIN' => 'Minnesota Wild',
        'MTL' => 'Montréal Canadiens',
        'NSH' => 'Nashville Predators',
        'NJD' => 'New Jersey Devils',
        'NYI' => 'New York Islanders',
        'NYR' => 'New York Rangers',
        'OTT' => 'Ottawa Senators',
        'PHI' => 'Philadelphia Flyers',
        'PIT' => 'Pittsburgh Penguins',
        'SJS' => 'San Jose Sharks',
        'STL' => 'St. Louis Blues',
        'TBL' => 'Tampa Bay Lightning',
        'TOR' => 'Toronto Maple Leafs',
        'VAN' => 'Vancouver Canucks',
        'WSH' => 'Washington Capitals',
        'WPG' => 'Winnipeg Jets'
    ]

];