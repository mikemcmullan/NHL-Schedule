<?php

Route::get('/', ['as' => 'home_path', function() 
{
    $teams = Config::get('nhl.teams');
    $teams = array_chunk($teams, 2, true);
    
    return View::make('home')->withTeams($teams);
}]);

Route::get('/team/{id}', [
    'as'    => 'team_path',
    'uses'  => 'TeamController@team'
]);

Route::get('/team/{id}/schedule', [
    'as'    => 'team_schedule_path',
    'uses'  => 'TeamController@schedule'
]);
