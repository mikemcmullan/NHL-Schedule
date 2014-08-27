<?php

Route::get('/', ['as' => 'home_path', function() 
{
    $devisions = Config::get('nhl.devisions');

    return View::make('home')->withDevisions($devisions);
}]);

Route::get('/team/{id}', [
    'as'    => 'team_path',
    'uses'  => 'TeamController@team'
]);

Route::get('/team/{id}/schedule', [
    'as'    => 'team_schedule_path',
    'uses'  => 'TeamController@schedule'
]);
