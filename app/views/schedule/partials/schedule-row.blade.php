<div class="schedule-row{{ isset($match['nextGame']) ? ' next-game' : '' }}{{ isset($yearMonth) ? isCollapsed($match) : '' }}"{{ isset($yearMonth) ? ' data-month="' . $yearMonth . '"' : ''  }}>

    <div class="date"><span>{{ $match['date']->format('D\, M jS\, Y') }}</span></div>

    <div class="visitor">
        <span class="full-team-name">{{ link_to_route('team_schedule_path', getTeamShortName($match['away_team']), [$match['away_team']]) }}</span>
        <span class="team-id">{{ link_to_route('team_schedule_path', $match['away_team'], [$match['away_team']]) }}</span>
    </div>

    <div class="home">
        <span class="full-team-name">{{ link_to_route('team_schedule_path', getTeamShortName($match['home_team']), [$match['home_team']]) }}</span>
        <span class="team-id">{{ link_to_route('team_schedule_path', $match['home_team'], [$match['home_team']]) }}</span>
    </div>

    <div class="time"><span>{{ presentTime($match) }}</span></div>

    @if ( ! $match['scores']->isEmpty() && hasMatchStarted($match['date']))
    <div class="results"><span>{{ presentScores($match) }}</span></div>
    @else
    <div class="results"><span>{{ $match['tv_info'] }}</span></div>
    @endif

</div>