<?php

namespace NHL\Composers;

use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('NHL\Composers\NHLScheduleComposer', function($app)
        {
            return new NHLScheduleComposer($app->make('NHL\Storage\Match\MatchRepository'));
        });
    }

    public function boot()
    {
        $this->app['view']->composer('schedule.partials.schedule-table', 'NHL\Composers\NHLScheduleComposer');
    }
}
