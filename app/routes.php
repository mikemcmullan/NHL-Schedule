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

Route::pattern('date', '[\d]{4}-[\d]{2}-[\d]{2}');

Route::bind('date', function($value, $route)
{
    try { return \Carbon\Carbon::parse($value); }
    catch(Exception $e) { App::abort(404); }
});

Route::get('{date}', [
    'as' => 'schedule_date_path',
    'uses' => function(\Carbon\Carbon $date)
    {
        $divisions = Config::get('nhl.conferences');

        return View::make('home')
            ->withDivisions($divisions)
            ->withDate($date->format('l F jS Y'));
    }
]);


