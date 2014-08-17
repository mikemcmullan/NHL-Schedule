@extends('layouts.master', ['teamName', $teamName])

@section('content')
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
            <tr data-month="{{ $match['date']->format('Y-m') }}" class="{{ $nextGame === $match['uid'] ? 'next-game ' : '' }}{{ isCollapsed($match) ? 'collapsed' : '' }}">
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
                <td>Date</td>
                <td>Visitor</td>
                <td>Home</td>
                <td>Time</td>
                <td>TV Networks</td>
            </tr>
        </tfoot>
    </table>
@stop