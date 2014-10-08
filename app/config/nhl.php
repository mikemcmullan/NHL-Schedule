<?php

use Carbon\Carbon;

return [

    /*
    |--------------------------------------------------------------------------
    | Schedule Cache Length
    |--------------------------------------------------------------------------
    |
    | While importing a schedule we can choose to cache it locally. You can
    | provide either a time in minutes, an instance of carbon or false if
    | you do not want to use the cache.
    |
    */
    'scheduleCacheLength' => false,

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
    | HTML Team Season Schedule Url
    |--------------------------------------------------------------------------
    |
    | The url of the HTML schedule for a team; %s is the placeholder for
    | a teams id (ex. TOR => Toronto Maple Leafs).
    |
    */
    'htmlTeamSeasonScheduleUrl' => 'http://www.nhl.com/ice/schedulebyseason.htm?season=20142015&gameType=2&team=%s&network=&venue=',

    /*
    |--------------------------------------------------------------------------
    | List of NHL Teams
    |--------------------------------------------------------------------------
    */
    'teams' => [
        'ANA' => ['Anaheim Ducks', 'Anaheim'],
        'ARI' => ['Arizona Coyotes', 'Arizona'],
        'BOS' => ['Boston Bruins', 'Boston'],
        'BUF' => ['Buffalo Sabres', 'Buffalo'],
        'CGY' => ['Calgary Flames', 'Calgary'],
        'CAR' => ['Carolina Hurricanes', 'Carolina'],
        'CHI' => ['Chicago Blackhawks', 'Chicago'],
        'COL' => ['Colorado Avalanche', 'Colorado'],
        'CBJ' => ['Columbus Blue Jackets', 'Columbus'],
        'DAL' => ['Dallas Stars', 'Dallas'],
        'DET' => ['Detroit Red Wings', 'Detroit'],
        'EDM' => ['Edmonton Oilers', 'Edmonton'],
        'FLA' => ['Florida Panthers', 'Florida'],
        'LAK' => ['Los Angeles Kings', 'Los Angeles'],
        'MIN' => ['Minnesota Wild', 'Minnesota'],
        'MTL' => ['Montréal Canadiens', 'Montréal'],
        'NSH' => ['Nashville Predators', 'Nashville'],
        'NJD' => ['New Jersey Devils', 'New Jersey'],
        'NYI' => ['New York Islanders', 'NY Islanders'],
        'NYR' => ['New York Rangers', 'NY Rangers'],
        'OTT' => ['Ottawa Senators', 'Ottawa'],
        'PHI' => ['Philadelphia Flyers', 'Philadelphia'],
        'PIT' => ['Pittsburgh Penguins', 'Pittsburgh'],
        'SJS' => ['San Jose Sharks', 'San Jose'],
        'STL' => ['St. Louis Blues', 'St. Louis'],
        'TBL' => ['Tampa Bay Lightning', 'Tampa Bay'],
        'TOR' => ['Toronto Maple Leafs', 'Toronto'],
        'VAN' => ['Vancouver Canucks', 'Vancouver'],
        'WSH' => ['Washington Capitals', 'Washington'],
        'WPG' => ['Winnipeg Jets', 'Winnipeg']
    ],

    /*
    |--------------------------------------------------------------------------
    | List of Conferences / Divisions & Which Teams Belong to Each Division.
    |--------------------------------------------------------------------------
    */
    'conferences' => [
        'eastern' => [
            'metropolitan' => ['CAR', 'CBJ', 'NJD', 'NYI', 'NYR', 'PHI', 'PIT', 'WSH'],
            'atlantic' => ['BOS', 'BUF', 'DET', 'FLA', 'MTL', 'OTT', 'TBL', 'TOR']
        ],
        'western' => [
            'pacific' => ['ANA', 'CGY', 'EDM', 'LAK', 'ARI', 'SJS', 'VAN'],
            'central' => ['CHI', 'COL', 'DAL', 'MIN', 'NSH', 'STL', 'WPG']
        ]
    ]

];