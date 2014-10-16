<?php

Route::get('/', ['as' => 'home_path', function() 
{
    $divisions = Config::get('nhl.conferences');

    return View::make('home')->withDivisions($divisions);
}]);

Route::get('/team/{id}', [
    'as'    => 'team_path',
    'uses'  => 'TeamController@team'
]);

Route::get('/team/{id}/schedule', [
    'as'    => 'team_schedule_path',
    'uses'  => 'TeamController@schedule'
]);
