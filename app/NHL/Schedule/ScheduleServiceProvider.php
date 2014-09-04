<?php namespace NHL\Schedule;

use Illuminate\Support\ServiceProvider;
use NHL\Schedule\HTML\ScheduleFilter;
use NHL\Schedule\HTML\ScheduleSorter;

class ScheduleServiceProvider extends ServiceProvider {

    /**
     * Register binding in IoC container
     */
    public function register()
    {
        $this->app->bind('NHL\Schedule\ScheduleImporter', function($app) 
        {
            $importer = $app->make('NHL\Schedule\HTML\ScheduleImporter');
            $filter = new ScheduleFilter($importer);

            return new ScheduleDBImporter($filter, $app->make('NHL\Storage\Match\MatchRepository'));
        });
    }

}