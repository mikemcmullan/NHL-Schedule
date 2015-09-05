<?php

use NHL\Exceptions\NonExistentTeamException;

class TeamController extends BaseController {

    /**
     * @var \NHL\Team\Factory
     */
    private $team;

    public function __construct(NHL\Team\Factory $team)
    {
        $this->team = $team;
    }

    public function team($id = 'TOR')
    {   
        return Redirect::route('team_schedule_path', [$id]);
    }

    public function schedule($teamID = 'TOR')
    {
        try
        {
            $team = Team::make($teamID, 2015);

            $sortedSchedule = $team->schedule(true);
            $colours = $team->colours();
        } 
        catch (NonExistentTeamException $e) 
        {
            App::abort(404);
        }

        return View::make('schedule.schedule')
            ->with('schedule', $sortedSchedule)
            ->with('teamName', getTeamName($teamID))
            ->with('colours', $colours);
    }

}