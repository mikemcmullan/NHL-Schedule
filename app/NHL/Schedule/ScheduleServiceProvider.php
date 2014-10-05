<?php namespace NHL\Schedule;

use Illuminate\Support\ServiceProvider;
use NHL\Schedule\HTML\ScheduleFilter;
use NHL\Schedule\HTML\ScheduleSorter;

class ScheduleServiceProvider extends ServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

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

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['NHL\Schedule\ScheduleImporter'];
    }
}