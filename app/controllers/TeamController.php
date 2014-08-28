<?php

use NHL\Schedule\ScheduleImporter;
use NHL\Exceptions\NonExistentTeamException;
use Carbon\Carbon;

class TeamController extends BaseController {

    private $scheduleImporter;

    public function __construct(ScheduleImporter $scheduleImporter)
    {
        $this->scheduleImporter = $scheduleImporter;
    }

    public function team($id = 'TOR')
    {   
        return Redirect::route('team_schedule_path', [$id]);
    }

    public function schedule($id = 'TOR')
    {
        try
        {
            $sortedSchedule = $this->scheduleImporter->run($id);
        } 
        catch (NonExistentTeamException $e) 
        {
            App::abort(404);
        }

        return View::make('schedule.schedule')
            ->with('schedule', $sortedSchedule)
            ->with('teamName', Config::get("nhl.teams.{$id}"));
    }

}
