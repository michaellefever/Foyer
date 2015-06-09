<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => [ 'localeSessionRedirect','localizationRedirect']
    ],
    function()
{
    Route::group(['middleware' => 'App\Http\Middleware\RedirectIfNotAdmin'], function(){
    /** ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP **/
    Route::get('/', 'WelcomeController@index');
    Route::get('/contact', 'WelcomeController@contact');

    Route::get('/participations/{userid}/{year}/edit', 'ParticipationsController@edit');
    Route::patch('/participations/{userid}/{year}', 'ParticipationsController@update');

    Route::get('/participations/race/{raceid}/', 'ParticipationsController@race');
    Route::get('/participations/user/{userid}/', 'ParticipationsController@user');
    Route::get('/participations/{id}/show', 'ParticipationsController@show');
    Route::post('/participations/filter', 'ParticipationsController@filter');
    Route::post('/participations/race/{raceid}/filter', 'ParticipationsController@filter');

    Route::post('/participations/time', 'ParticipationsController@registertime');
    Route::get('/timeregistration', 'ParticipationsController@time');
    Route::get('/participations', 'ParticipationsController@index');
    Route::post('races/start', 'RacesController@start');
    Route::post('races/stop', 'RacesController@stop');


        //Route::get('/results/{id}/show', 'ResultsController@show');
    //Route::get('results', 'ResultsController@index');

    Route::post('users/filter', 'UsersController@filter');
    Route::resource('users', 'UsersController');
    Route::resource('races', 'RacesController');
    Route::get('users/search/autocomplete', 'SearchController@autocomplete');

    Route::get('csv/import', 'CsvController@index');
    Route::post('csv/import', 'CsvController@import');
    Route::get('csv/export/results/{id}', 'CsvController@exportResults');
    Route::get('csv/export/participations/{id}', 'CsvController@exportParticipations');
    Route::get('csv/export/{table}', 'CsvController@export');
    Route::get('csv/export/', 'CsvController@exportAll');
    Route::get('csv/exportcontestants/','CsvController@exportContestant');
    Route::post('users/email', 'UsersController@email');

    });
});

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);

