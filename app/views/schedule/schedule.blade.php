@extends('layouts.master')

@section('pageTitle')
NHL {{ $teamName }} Schedule &#8250; 2014 - 2015 NHL Schedule Viewer
@stop

@section('content')
<header class="page-header">
    <h1>{{ link_to_route('home_path', "{$teamName} 2014 - 2015 Schedule") }}</h1>
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

    <header class="schedule-month-header" data-month="{{ $matchGroup->first()['date']->format('Y-m') }}">
        <h2>{{ $month }}</h2>
    </header>

        @foreach ($matchGroup as $match)

            @include('schedule.partials.schedule-row', ['match' => $match, 'yearMonth' => $matchGroup->first()['date']->format('Y-m')])

        @endforeach

    @endforeach

</div>
@stop