<?php namespace NHL\Scoreboard;

use Illuminate\Support\ServiceProvider;
use NHL\Scoreboard\JSON\ScoreboardMapper;

//use NHL\Scoreboard\JSON\ScoreboardImporter;

class ScoreboardServiceProvider extends ServiceProvider {

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
        $this->app->bind('NHL\Scoreboard\ScoreboardImporter', function($app)
        {
            $importer = $app->make('NHL\Scoreboard\JSON\ScoreboardImporter');
            $mapper = new ScoreboardMapper($importer);

            return new ScoreboardDBImporter($mapper, $app->make('NHL\Storage\Match\MatchRepository'), $app->make('NHL\Storage\Score\ScoreRepository'));
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['NHL\Scoreboard\ScoreboardImporter'];
    }
}