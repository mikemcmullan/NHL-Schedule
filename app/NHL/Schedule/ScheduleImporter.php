<?php

namespace NHL\Schedule;

interface ScheduleImporter {

    /**
     * Import the entire season schedule for a particular team.
     *
     * @param $teamID
     * @return array
     */
    public function bySeason($teamID);

}