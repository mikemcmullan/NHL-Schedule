@extends('layouts.master')

@section('pageTitle')
Select Your Team - NHL Schedule Viewer
@stop

@section('content')
<header>
    <h1>NHL Schedule Viewer</h1>
    <h2>Select Your Team</h2>
</header>

<ul class="team-select">
@foreach ($teams as $id => $team)
    <li>{{ link_to_route('team_schedule_path', $team, [$id]) }}</li>
@endforeach
</ul>
@stop