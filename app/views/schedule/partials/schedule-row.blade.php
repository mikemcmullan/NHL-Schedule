<div class="schedule-row{{ isset($match['nextGame']) ? ' next-game' : '' }}{{ isset($yearMonth) ? isCollapsed($match) : '' }}"{{ isset($yearMonth) ? ' data-month="' . $yearMonth . '"' : ''  }}>

    @if (array_search('date', $columns) !== false)
        <div class="date"><span>{{ link_to_route('schedule_date_path', $match['date']->format('D\, M jS\, Y'), $match['date']->toDateString())  }}</span></div>
    @endif

    @if (array_search('visitor', $columns) !== false)
        <div class="visitor">
            <a href="{{ route('team_schedule_path', [$match['away_team']]) }}" class="team-logo">
                <img src="{{ getTeamLogo($match['away_team']) }}" alt="{{ getTeamShortName($match['away_team']) }} Logo">
            </a>

            <span class="full-team-name">
                {{ link_to_route('team_schedule_path', getTeamShortName($match['away_team']), [$match['away_team']]) }}
            </span>
        </div>
    @endif

    @if (array_search('home', $columns) !== false)
        <div class="home">
            <a href="{{ route('team_schedule_path', [$match['home_team']]) }}" class="team-logo">
                <img src="{{ getTeamLogo($match['home_team']) }}" alt="{{ getTeamShortName($match['home_team']) }} Logo">
            </a>

            <span class="full-team-name">
                {{ link_to_route('team_schedule_path', getTeamShortName($match['home_team']), [$match['home_team']]) }}
            </span>
        </div>
    @endif

    @if (array_search('time', $columns) !== false)
        <div class="time"><span>{{ presentTime($match) }}</span></div>
    @endif

    @if (array_search('results', $columns) !== false)
        @if ( ! $match['scores']->isEmpty() && hasMatchStarted($match['date']))
        <div class="results"><span>{{ presentScores($match) }}</span></div>
        @else
        <div class="results"><span>{{ $match['tv_info'] }}</span></div>
        @endif
    @endif

</div>