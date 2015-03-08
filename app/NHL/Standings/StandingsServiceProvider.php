<?php

namespace NHL\Standings;

use Illuminate\Support\ServiceProvider;
use NHL\Standings\HTML\Mapper;

class StandingsServiceProvider extends ServiceProvider {

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
        $this->app->bind('NHL\Standings\Importer', function($app)
        {
            $importer = $app->make('NHL\Standings\HTML\Importer');
            $parser = new HTML\Parser($importer);

            return $parser; //new DBImporter($filter, $app->make('NHL\Storage\Match\MatchRepository'));
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['NHL\Standings\Importer'];
    }
}