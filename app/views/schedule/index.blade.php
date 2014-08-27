@extends('layouts.master')

@section('pageTitle')
NHL {{ $teamName }} Schedule &#8250; 2014 - 2015 NHL Schedule Viewer
@stop

@section('content')
<header>
    <h1>{{ $teamName }} 2014 - 2015 Schedule</h1>
</header>

<table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Visitor</th>
                <th>Home</th>
                <th>Time</th>
                <th>TV Networks \ Results</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($schedule as $month => $matchGroup)
            <tr>
                <td data-month="{{ head($matchGroup)['date']->format('Y-m') }}" colspan="5" class="month-sep">{{ $month }}</td>
            </tr>
                @foreach ($matchGroup as $match)
            <tr data-month="{{ $match['date']->format('Y-m') }}" class="{{ isset($match['nextGame']) ? 'next-game ' : '' }}{{ isCollapsed($match) ? 'collapsed' : '' }}">
                <td>{{ $match['date']->format('D\, M jS\, Y') }}</td>
                <td>{{ $match['away'] }}</td>
                <td>{{ $match['home'] }}</td>
                <td>{{ $match['date']->format('g:i A') }}</td>
                <td>{{ $match['description'] }}</td>
            </tr>
                @endforeach
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>Date</th>
                <th>Visitor</th>
                <th>Home</th>
                <th>Time</th>
                <th>TV Networks</th>
            </tr>
        </tfoot>
    </table>
@stop