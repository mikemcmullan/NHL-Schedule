<?php

namespace NHL\Composers;

use Carbon\Carbon;
use NHL\Storage\Match\MatchRepository;

class NHLScheduleComposer {

    /**
     * @var MatchRepository
     */
    private $matchRepo;

    /**
     * @param MatchRepository $matchRepo
     */
    public function __construct(MatchRepository $matchRepo)
    {
        $this->matchRepo = $matchRepo;
    }

    public function compose($view)
    {
        $date = \Route::input('date');

        if ( ! $date)
        {
            $matches = $this->matchRepo->today();
            $date = Carbon::now();
        }
        else
        {
            $matches = $this->matchRepo->byDate($date);
        }

        $view->with('date', $date);
        $view->with('nextDate', $date->copy()->addDay()->toDateString());
        $view->with('prevDate', $date->copy()->subDay()->toDateString());

        $view->with('schedule', ! $matches->isEmpty() ? $matches : []);
    }
} 