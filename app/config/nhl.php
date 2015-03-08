<?php

use Carbon\Carbon;

$config = [

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
    'scheduleCacheLength' => Carbon::now()->addDay(), //false,

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
    | HTML Standings Url
    |--------------------------------------------------------------------------
    |
    */
    'htmlStandingsUrl' => 'http://www.nhl.com/ice/standings.htm?season=20142015&type=%s',

    /*
    |--------------------------------------------------------------------------
    | JSON Scoreboard For Day Url
    |--------------------------------------------------------------------------
    |
    | The URL of the scoreboard in JSONP format for a particular day; %s is
    | the place holder for the date in YYYY-MM-DD format.
    |
    */
    'jsonDayScoreboardUrl' => 'http://live.nhle.com/GameData/GCScoreboard/%s.jsonp',

    /*
    |--------------------------------------------------------------------------
    | List of NHL Teams
    |--------------------------------------------------------------------------
    */
    'teams' => [
        'ANA' => [
            'long' => 'Anaheim Ducks',
            'short' => 'Anaheim',
            'logo' => 'http://cdn.nhle.com/nhl/images/logos/teams/ducks_logo.svgz?v=8.19',
            'colours' => [
                '#000000',
                '#91764B',
                '#EF5225'
            ]
        ],
        'ARI' => [
            'long' => 'Arizona Coyotes',
            'short' => 'Arizona',
            'logo' => 'http://cdn.nhle.com/nhl/images/logos/teams/coyotes_logo.svgz?v=8.19',
            'colours' => [
                '#841F27',
                '#000000',
                '#EFE1C6',
                '#FFFFFF'
            ]
        ],
        'PHX' => [
            'long' => 'Phoenix Coyotes',
            'short' => 'Phoenix',
            'logo' => 'http://cdn.nhle.com/nhl/images/logos/teams/coyotes_logo.svgz?v=8.19',
            'colours' => [
                '#841F27',
                '#000000',
                '#EFE1C6',
                '#FFFFFF'
            ]
        ],
        'BOS' => [
            'long' => 'Boston Bruins',
            'short' => 'Boston',
            'logo' => 'http://cdn.nhle.com/nhl/images/logos/teams/bruins_logo.svgz?v=8.19',
            'colours' => [
                '#000000',
                '#FFC422',
                '#FFFFFF'
            ]
        ],
        'BUF' => [
            'long' => 'Buffalo Sabres',
            'short' => 'Buffalo',
            'logo' => 'http://cdn.nhle.com/nhl/images/logos/teams/sabres_logo.svgz?v=8.19',
            'colours' => [
                '#002E62',
                '#FDBB2F',
                '#AEB6B9',
                '#FFFFFF'
            ]
        ],
        'CGY' => [
            'long' => 'Calgary Flames',
            'short' => 'Calgary',
            'logo' => 'http://cdn.nhle.com/nhl/images/logos/teams/flames_dark_logo.svgz?v=8.19',
            'colours' => [
                '#E03A3E',
                '#FFC758',
                '#000000',
                '#FFFFFF'
            ]
        ],
        'CAR' => [
            'long' => 'Carolina Hurricanes',
            'short' => 'Carolina',
            'logo' => 'http://cdn.nhle.com/nhl/images/logos/teams/hurricanes_logo.svgz?v=8.19',
            'colours' => [
                '#E03A3E',
                '#000000',
                '#8E8E90',
                '#FFFFFF'
            ]
        ],
        'CHI' => [
            'long' => 'Chicago Blackhawks',
            'short' => 'Chicago',
            'logo' => 'http://cdn.nhle.com/nhl/images/logos/teams/blackhawks_logo.svgz?v=8.19',
            'colours' => [
                '#E3263A',
                '#000000',
                '#FFFFFF'
            ]
        ],
        'COL' => [
            'long' => 'Colorado Avalanche',
            'short' => 'Colorado',
            'logo' => 'http://cdn.nhle.com/nhl/images/logos/teams/avalanche_logo.svgz?v=8.19',
            'colours' => [
                '#8B2942',
                '#01548A',
                '#000000',
                '#A9B0B8',
                '#FFFFFF'
            ]
        ],
        'CBJ' => [
            'long' => 'Columbus Blue Jackets',
            'short' => 'Columbus',
            'logo' => 'http://cdn.nhle.com/nhl/images/logos/teams/bluejackets_logo.svgz?v=8.19',
            'colours' => [
                '#00285C',
                '#E03A3E',
                '#A9B0B8',
                '#FFFFFF'
            ]
        ],
        'DAL' => [
            'long' => 'Dallas Stars',
            'short' => 'Dallas',
            'logo' => 'http://cdn.nhle.com/nhl/images/logos/teams/stars_logo.svgz?v=8.19',
            'colours' => [
                '#006A4E',
                '#000000',
                '#FFFFFF',
                '#C0C0C0'
            ]
        ],
        'DET' => [
            'long' => 'Detroit Red Wings',
            'short' => 'Detroit',
            'logo' => 'http://cdn.nhle.com/nhl/images/logos/teams/redwings_logo.svgz?v=8.19',
            'colours' => [
                '#EC1F26',
                '#FFFFFF'
            ]
        ],
        'EDM' => [
            'long' => 'Edmonton Oilers',
            'short' => 'Edmonton',
            'logo' => 'http://cdn.nhle.com/nhl/images/logos/teams/oilers_logo.svgz?v=8.19',
            'colours' => [
                '#003777',
                '#E66A20',
                '#FFFFFF'
            ]
        ],
        'FLA' => [
            'long' => 'Florida Panthers',
            'short' => 'Florida',
            'logo' => 'http://cdn.nhle.com/nhl/images/logos/teams/panthers_logo.svgz?v=8.19',
            'colours' => [
                '#C8213F',
                '#002E5F',
                '#D59C05',
                '#FFFFFF'
            ]
        ],
        'LAK' => [
            'long' => 'Los Angeles Kings',
            'short' => 'Los Angeles',
            'logo' => 'http://cdn.nhle.com/nhl/images/logos/teams/kings_dark_logo.svgz?v=8.19',
            'colours' => [
                '#000000',
                '#FFFFFF',
                '#AFB7BA'
            ]
        ],
        'MIN' => [
            'long' => 'Minnesota Wild',
            'short' => 'Minnesota',
            'logo' => 'http://cdn.nhle.com/nhl/images/logos/teams/wild_logo.svgz?v=8.19',
            'colours' => [
                '#025736',
                '#BF2B37',
                '#EFB410',
                '#EEE3C7',
                '#FFFFFF'
            ]
        ],
        'MTL' => [
            'long' => 'Montréal Canadiens',
            'short' => 'Montréal',
            'logo' => 'http://cdn.nhle.com/nhl/images/logos/teams/canadiens_logo.svgz?v=8.19',
            'colours' => [
                '#BF2F38',
                '#FFFFFF',
                '#213770'
            ]
        ],
        'NSH' => [
            'long' => 'Nashville Predators',
            'short' => 'Nashville',
            'logo' => 'http://cdn.nhle.com/nhl/images/logos/teams/predators_logo.svgz?v=8.19',
            'colours' => [
                '#FDBB2F',
                '#002E62',
                '#FFFFFF'
            ]
        ],
        'NJD' => [
            'long' => 'New Jersey Devils',
            'short' => 'New Jersey',
            'logo' => 'http://cdn.nhle.com/nhl/images/logos/teams/devils_logo.svgz?v=8.19',
            'colours' => [
                '#E03A3E',
                '#000000',
                '#FFFFFF'
            ]
        ],
        'NYI' => [
            'long' => 'New York Islanders',
            'short' => 'NY Islanders',
            'logo' => 'http://cdn.nhle.com/nhl/images/logos/teams/islanders_logo.svgz?v=8.19',
            'colours' => [
                '#00529B',
                '#F57D31',
                '#FFFFFF'
            ]
        ],
        'NYR' => [
            'long' => 'New York Rangers',
            'short' => 'NY Rangers',
            'logo' => 'http://cdn.nhle.com/nhl/images/logos/teams/rangers_logo.svgz?v=8.19',
            'colours' => [
                '#0161AB',
                '#E6393F',
                '#FFFFFF'
            ]
        ],
        'OTT' => [
            'long' => 'Ottawa Senators',
            'short' => 'Ottawa',
            'logo' => 'http://cdn.nhle.com/nhl/images/logos/teams/senators_logo.svgz?v=8.19',
            'colours' => [
                '#E4173E',
                '#000000',
                '#D69F0F',
                '#FFFFFF'
            ]
        ],
        'PHI' => [
            'long' => 'Philadelphia Flyers',
            'short' => 'Philadelphia',
            'logo' => 'http://cdn.nhle.com/nhl/images/logos/teams/flyers_dark_logo.svgz?v=8.19',
            'colours' => [
                '#F47940',
                '#000000',
                '#FFFFFF'
            ]
        ],
        'PIT' => [
            'long' => 'Pittsburgh Penguins',
            'short' => 'Pittsburgh',
            'logo' => 'http://cdn.nhle.com/nhl/images/logos/teams/penguins_logo.svgz?v=8.19',
            'colours' => [
                '#000000',
                '#D1BD80',
                '#FFFFFF'
            ]
        ],
        'SJS' => [
            'long' => 'San Jose Sharks',
            'short' => 'San Jose',
            'logo' => 'http://cdn.nhle.com/nhl/images/logos/teams/sharks_logo.svgz?v=8.19',
            'colours' => [
                '#05535D',
                '#F38F20',
                '#000000',
                '#FFFFFF'
            ]
        ],
        'STL' => [
            'long' => 'St. Louis Blues',
            'short' => 'St. Louis',
            'logo' => 'http://cdn.nhle.com/nhl/images/logos/teams/blues_dark_logo.svgz?v=8.19',
            'colours' => [
                '#0546A0',
                '#FFC325',
                '#101F48',
                '#FFFFFF'
            ]
        ],
        'TBL' => [
            'long' => 'Tampa Bay Lightning',
            'short' => 'Tampa Bay',
            'logo' => 'http://cdn.nhle.com/nhl/images/logos/teams/lightning_dark_logo.svgz?v=8.19',
            'colours' => [
                '#013E7D',
                '#FFFFFF',
                '#000000',
                '#C0C0C0'
            ]
        ],
        'TOR' => [
            'long' => 'Toronto Maple Leafs',
            'short' => 'Toronto',
            'logo' => 'http://cdn.nhle.com/nhl/images/logos/teams/mapleleafs_dark_logo.svgz?v=8.19',
            'colours' => [
                '#003777',
                '#FFFFFF'
            ]
        ],
        'VAN' => [
            'long' => 'Vancouver Canucks',
            'short' => 'Vancouver',
            'logo' => 'http://cdn.nhle.com/nhl/images/logos/teams/canucks_dark_logo.svgz?v=8.19',
            'colours' => [
                '#07346F',
                '#047A4A',
                '#A8A9AD',
                '#FFFFFF'
            ]
        ],
        'WSH' => [
            'long' => 'Washington Capitals',
            'short' => 'Washington',
            'logo' => 'http://cdn.nhle.com/nhl/images/logos/teams/capitals_dark_logo.svgz?v=8.19',
            'colours' => [
                '#CF132B',
                '#00214E',
                '#FFFFFF',
                '#000000'
            ]
        ],
        'WPG' => [
            'long' => 'Winnipeg Jets',
            'short' => 'Winnipeg',
            'logo' => 'http://cdn.nhle.com/nhl/images/logos/teams/jets_logo.svgz?v=8.19',
            'colours' => [
                '#002E62',
                '#FFFFFF',
                '#0168AB',
                '#A8A9AD'
            ]
        ]
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

/*
|--------------------------------------------------------------------------
| Current Date & Time
|--------------------------------------------------------------------------
|
| Since we use the current date & time in a few places; to make testing
| easier set it here. An instance of Carbon must be used.
|
| Didn't know where else to put this logic; pretend it's yesterday if the
| current hour is 2 am or less.
|
*/
if (Carbon::now()->hour < 2)
{
    $yesterday = Carbon::now()->subDay();

    $config['currentDateTime'] = Carbon::create($yesterday->year, $yesterday->month, $yesterday->day, 23, 59);
}
else
{
    $config['currentDateTime'] = Carbon::now();
}

return $config;