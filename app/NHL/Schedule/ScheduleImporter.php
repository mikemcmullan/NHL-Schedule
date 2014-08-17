<?php

namespace NHL\Schedule;

interface ScheduleImporter {

    public function run($team = 'TOR');

}