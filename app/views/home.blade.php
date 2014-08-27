@extends('layouts.master')

@section('pageTitle')
Select Your Team - NHL Schedule Viewer
@stop

@section('content')
<header>
    <h1>NHL Schedule Viewer</h1>
    <h2>Select Your Team</h2>
</header>

@foreach ($devisions as $conference => $devision)

<div class="{{ $conference }}-conference conference-container">

    {{ HTML::image("assets/img/NHL_{$conference}_Conference.svg", "{$conference} Conference Logo", [
        'width' => '250px', 
        'height' => '179px', 
        'class' => 'conference-logo']) }}

    @foreach ($devision as $name => $teams)

    <article class="devisions-container">

        <header class="devision-header">
            <h3>{{ ucfirst($name) }}</h3>
        </header>

        @foreach ($teams as $team)
            <div class="team">{{ link_to_route('team_schedule_path', Config::get("nhl.teams.{$team}"), [$team]) }}</div>
        @endforeach

    </article>

    @endforeach

    <div style="clear: both;"></div>

</div>

@endforeach
@stop