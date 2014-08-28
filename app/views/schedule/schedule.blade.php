@extends('layouts.master')

@section('pageTitle')
NHL {{ $teamName }} Schedule &#8250; 2014 - 2015 NHL Schedule Viewer
@stop

@section('content')
<header class="page-header">
    <h1>{{ $teamName }} 2014 - 2015 Schedule</h1>
</header>

<div class="schedule-wrap">

    <header class="schedule-header schedule-row">
        <div class="date"><span>Date</span></div>
        <div class="visitor"><span>Visitor</span></div>
        <div class="home"><span>Home</span></div>
        <div class="time"><span>Time</span></div>
        <div class="results"><span>TV Networks / Results</span></div>
    </header>

    @foreach ($schedule as $month => $matchGroup)

    <header class="schedule-month-header" data-month="{{ head($matchGroup)['date']->format('Y-m') }}">
        <h2>{{ $month }}</h2>
    </header>

        @foreach ($matchGroup as $match)

    <div class="schedule-row {{ isset($match['nextGame']) ? 'next-game ' : '' }}{{ isCollapsed($match) ? 'collapsed' : '' }}" data-month="{{ head($matchGroup)['date']->format('Y-m') }}">
        
        <div class="date"><span>{{ $match['date']->format('D\, M jS\, Y') }}</span></div>

        <div class="visitor">
            <span>
                <span class="full-team-name">{{ $match['away'] }}</span> 
                <span class="team-id">{{ getTeamID($match['away']) }}</span>
            </span>
        </div>

        <div class="home">
            <span>
                <span class="full-team-name">{{ $match['home'] }}</span> 
                <span class="team-id">{{ getTeamID($match['home']) }}</span>
            </span>
        </div>

        <div class="time"><span>{{ $match['date']->format('g:i A') }}</span></div>

        <div class="results"><span>{{ $match['description'] }}</span></div>

    </div>

        @endforeach

    @endforeach

</div>
@stop