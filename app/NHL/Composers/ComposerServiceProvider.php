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
        $this->app->bind('NHL\Composers\NHLScheduleComposer', 'NHL\Composers\NHLScheduleComposer');
    }

    public function boot()
    {
        $this->app['view']->composer('schedule.partials.schedule-table', 'NHL\Composers\NHLScheduleComposer');
    }
}
