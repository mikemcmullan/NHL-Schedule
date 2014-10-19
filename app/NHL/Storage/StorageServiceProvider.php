<?php

namespace NHL\Storage;

use Illuminate\Support\ServiceProvider;

class StorageServiceProvider extends ServiceProvider {

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'NHL\Storage\Match\MatchRepository',
            'NHL\Storage\Match\EloquentMatchRepository'
        );

        $this->app->bind(
            'NHL\Storage\Score\ScoreRepository',
            'NHL\Storage\Score\EloquentScoreRepository'
        );
    }
}