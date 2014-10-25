@extends('layouts.master')

@section('pageTitle')
Select Your Team &#8250; 2014 - 2015 NHL Schedule Viewer
@stop

@section('content')
<header class="page-header">
    <h1>2014 - 2015 NHL Schedule Viewer</h1>
    <h2>Matches for {{ $date or 'Today' }}</h2>
</header>

@include('schedule.partials.schedule-table')

<div class="page-sub-header">
    <h2>Or Select Your Team</h2>
</div>

@foreach ($divisions as $conference => $division)

<div class="{{ $conference }}-conference conference-container">

    {{ HTML::image("assets/img/NHL_{$conference}_Conference.svg", "{$conference} Conference Logo", [
        'width' => '250px', 
        'height' => '179px', 
        'class' => 'conference-logo']) }}

    @foreach ($division as $name => $teams)

    <article class="divisions-container">

        <header class="division-header">
            <h3>{{ ucfirst($name) }}</h3>
        </header>

        @foreach ($teams as $teamID)
            <div class="team">{{ link_to_route('team_schedule_path', getTeamName($teamID), [$teamID]) }}</div>
        @endforeach

    </article>

    @endforeach

    <div style="clear: both;"></div>

</div>

@endforeach
@stop