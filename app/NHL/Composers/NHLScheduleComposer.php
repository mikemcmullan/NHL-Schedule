<?php

namespace NHL\Composers;

use Carbon\Carbon;
use Illuminate\Config\Repository as ConfigRepository;
use NHL\Storage\Match\MatchRepository;

class NHLScheduleComposer {

    /**
     * @var MatchRepository
     */
    private $matchRepo;

    /**
     * @var ConfigRepository
     */
    private $config;

    /**
     * @param MatchRepository $matchRepo
     * @param ConfigRepository $config
     */
    public function __construct(MatchRepository $matchRepo, ConfigRepository $config)
    {
        $this->matchRepo = $matchRepo;
        $this->config = $config;
    }

    public function compose($view)
    {
        $date = \Route::input('date');

        if ( ! $date)
        {
            $matches = $this->matchRepo->today();
            $date = $this->config->get('nhl.currentDateTime');
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