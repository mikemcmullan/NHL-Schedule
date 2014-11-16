<?php

namespace NHL\Team;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

class TeamServiceProvider extends ServiceProvider {

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bindShared('nhl.team', function($app)
        {
            return new Factory($app['config'], $app);
        });
    }

    public function boot()
    {
        $loader = AliasLoader::getInstance();
        $loader->alias('Team', 'NHL\Facades\Team');
    }
}