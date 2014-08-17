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
            return $sorter = new ScheduleSorter($filter, $app->make('Illuminate\Config\Repository'));

            // return new ScheduleCache(
            //     $filter, 
            //     $app->make('Illuminate\Cache\Repository'),
            //     $app->make('Illuminate\Config\Repository'));
        });
    }

}