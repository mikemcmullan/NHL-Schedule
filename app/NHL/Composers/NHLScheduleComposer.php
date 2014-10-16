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
        $matches = $this->matchRepo->today();

        $view->with('schedule', ! $matches->isEmpty() ? $matches : []);
    }
} 