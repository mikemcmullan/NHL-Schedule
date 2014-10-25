<div class="schedule-wrap">

    <header class="schedule-header schedule-row">
        <div class="date"><span>Date</span></div>
        <div class="visitor"><span>Visitor</span></div>
        <div class="home"><span>Home</span></div>
        <div class="time"><span>Time</span></div>
        <div class="results"><span>TV Networks / Results</span></div>
    </header>

    @forelse($schedule as $match)

        @include('schedule.partials.schedule-row', compact('match'))

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