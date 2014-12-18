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
    'scheduleCacheLength' => false,

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
            'colours' => [
                '#000000',
                '#91764B',
                '#EF5225'
            ]
        ],
        'ARI' => [
            'long' => 'Arizona Coyotes',
            'short' => 'Arizona',
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
            'colours' => [
                '#000000',
                '#FFC422',
                '#FFFFFF'
            ]
        ],
        'BUF' => [
            'long' => 'Buffalo Sabres',
            'short' => 'Buffalo',
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
            'colours' => [
                '#E3263A',
                '#000000',
                '#FFFFFF'
            ]
        ],
        'COL' => [
            'long' => 'Colorado Avalanche',
            'short' => 'Colorado',
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
            'colours' => [
                '#EC1F26',
                '#FFFFFF'
            ]
        ],
        'EDM' => [
            'long' => 'Edmonton Oilers',
            'short' => 'Edmonton',
            'colours' => [
                '#003777',
                '#E66A20',
                '#FFFFFF'
            ]
        ],
        'FLA' => [
            'long' => 'Florida Panthers',
            'short' => 'Florida',
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
            'colours' => [
                '#000000',
                '#FFFFFF',
                '#AFB7BA'
            ]
        ],
        'MIN' => [
            'long' => 'Minnesota Wild',
            'short' => 'Minnesota',
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
            'colours' => [
                '#BF2F38',
                '#FFFFFF',
                '#213770'
            ]
        ],
        'NSH' => [
            'long' => 'Nashville Predators',
            'short' => 'Nashville',
            'colours' => [
                '#FDBB2F',
                '#002E62',
                '#FFFFFF'
            ]
        ],
        'NJD' => [
            'long' => 'New Jersey Devils',
            'short' => 'New Jersey',
            'colours' => [
                '#E03A3E',
                '#000000',
                '#FFFFFF'
            ]
        ],
        'NYI' => [
            'long' => 'New York Islanders',
            'short' => 'NY Islanders',
            'colours' => [
                '#00529B',
                '#F57D31',
                '#FFFFFF'
            ]
        ],
        'NYR' => [
            'long' => 'New York Rangers',
            'short' => 'NY Rangers',
            'colours' => [
                '#0161AB',
                '#E6393F',
                '#FFFFFF'
            ]
        ],
        'OTT' => [
            'long' => 'Ottawa Senators',
            'short' => 'Ottawa',
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
            'colours' => [
                '#F47940',
                '#000000',
                '#FFFFFF'
            ]
        ],
        'PIT' => [
            'long' => 'Pittsburgh Penguins',
            'short' => 'Pittsburgh',
            'colours' => [
                '#000000',
                '#D1BD80',
                '#FFFFFF'
            ]
        ],
        'SJS' => [
            'long' => 'San Jose Sharks',
            'short' => 'San Jose',
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
            'colours' => [
                '#003777',
                '#FFFFFF'
            ]
        ],
        'VAN' => [
            'long' => 'Vancouver Canucks',
            'short' => 'Vancouver',
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