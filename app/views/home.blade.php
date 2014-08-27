@extends('layouts.master')

@section('pageTitle')
Select Your Team - NHL Schedule Viewer
@stop

@section('content')
<header>
    <h1>NHL Schedule Viewer</h1>
    <h2>Select Your Team</h2>
</header>

<div class="team-select">
@foreach ($teams as $teamGroup)
    <div class="team-group">
        @foreach ($teamGroup as $id => $team)
        <div class="team">{{ link_to_route('team_schedule_path', $team, [$id]) }}</div>
        @endforeach
    </div>
@endforeach
</div>
@stop