<div class="schedule-wrap">

    <header class="schedule-header schedule-row">
        @if (array_search('date', $columns) !== false)
            <div class="date"><span>Date</span></div>
        @endif

        @if (array_search('visitor', $columns) !== false)
            <div class="visitor"><span>Visitor</span></div>
        @endif

        @if (array_search('home', $columns) !== false)
            <div class="home"><span>Home</span></div>
        @endif

        @if (array_search('time', $columns) !== false)
            <div class="time"><span>Time</span></div>
        @endif

        @if (array_search('results', $columns) !== false)
            <div class="results"><span>TV Networks / Results</span></div>
        @endif
    </header>

    @forelse($schedule as $match)

        @include('schedule.partials.schedule-row', compact('match', 'columns'))

    @empty

    <div class="schedule-row">

        <div class="no-games">
            No Games Scheduled.
        </div>

    </div>

    @endforelse

    @if (isset($date))
    <footer class="schedule-footer schedule-row">
        <div class="previous-day"><span>{{ link_to_route('schedule_date_path', 'Previous Day', [$prevDate]) }}</span></div>
        <div class="next-day"><span>{{ link_to_route('schedule_date_path', 'Next Day', [$nextDate]) }}</span></div>
    </footer>
    @endif

</div>