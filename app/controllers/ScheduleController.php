<?php

use NHL\Schedule\ScheduleImporter;
use NHL\Exceptions\NonExistentTeamException;
use Carbon\Carbon;

class ScheduleController extends BaseController {

    private $scheduleImporter;

    public function __construct(ScheduleImporter $scheduleImporter)
    {
        $this->scheduleImporter = $scheduleImporter;
    }

    public function schedule($team = 'TOR')
    {   
        try
        {
            $sortedSchedule = $this->scheduleImporter->run($team);
        } 
        catch (NonExistentTeamException $e) 
        {
            App::abort(404);
        }

        return View::make('schedule.index')
            ->with('schedule', $sortedSchedule)
            ->with('nextGame', $this->scheduleImporter->getNextGame())
            ->with('teamName', Config::get("nhl.teams.{$team}"));
    }

}
