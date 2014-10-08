<?php

namespace NHL\Schedule;

use Carbon\Carbon;

interface ScheduleImporter {

    /**
     * Import the entire season schedule for a particular team.
     *
     * @param $teamID
     * @return array
     */
    public function bySeason($teamID);

}