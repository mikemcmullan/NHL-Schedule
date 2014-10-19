<?php

namespace NHL\Scoreboard;

use Carbon\Carbon;

interface ScoreboardImporter {

    public function byDay(Carbon $date);

} 