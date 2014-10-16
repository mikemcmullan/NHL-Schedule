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
            No Games Scheduled For Today
        </div>

    </div>

    @endforelse

</div>