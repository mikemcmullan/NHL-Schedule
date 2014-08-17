<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', [
    'as'    => 'home_path',
    'uses'  => 'ScheduleController@schedule'
]);

Route::get('/schedule/{team}', [
    'as'    => 'schedule_path',
    'uses'  => 'ScheduleController@schedule'
]);

// function()
// {
// 	$lexer = App::make('CSVLexer');
//     $interpreter = App::make('CSVInterpreter');

//     $interpreter->addObserver(function(array $row) //use (&$matches, &$columnNames, &$index) 
//     {
//         echo '<pre>';
//         print_r($row);
//         echo '</pre>';
//     });

//     $lexer->parse('/Users/mike/Hive/projects/leafs/full.csv', $interpreter);
// });
