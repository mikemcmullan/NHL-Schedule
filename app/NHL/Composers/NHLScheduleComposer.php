<?php

namespace NHL\Composers;

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

        $matches = ! $date ? $this->matchRepo->today() : $this->matchRepo->byDate($date);

        $view->with('schedule', ! $matches->isEmpty() ? $matches : []);
    }
} 