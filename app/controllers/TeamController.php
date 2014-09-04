<?php

use NHL\Exceptions\NonExistentTeamException;
use NHL\Storage\Match\MatchRepository;
use NHL\Schedule\ScheduleSorter;

class TeamController extends BaseController {

    private $matchRepository;
    /**
     * @var \NHL\Schedule\ScheduleSorter
     */
    private $scheduleSorter;

    public function __construct(MatchRepository $matchRepository, ScheduleSorter $scheduleSorter)
    {
        $this->matchRepository = $matchRepository;
        $this->scheduleSorter = $scheduleSorter;
    }

    public function team($id = 'TOR')
    {   
        return Redirect::route('team_schedule_path', [$id]);
    }

    public function schedule($teamID = 'TOR')
    {
        try
        {
            $sortedSchedule = $this->scheduleSorter->sort($this->matchRepository->byTeam($teamID));
        } 
        catch (NonExistentTeamException $e) 
        {
            App::abort(404);
        }

        return View::make('schedule.schedule')
            ->with('schedule', $sortedSchedule)
            ->with('teamName', getTeamName($teamID));
    }

}
