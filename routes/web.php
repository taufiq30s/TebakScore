<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'member'], function() {
    Route::get('profile', 'ProfileController@index')->name('profile');

    Route::get('tebak', 'TebakController@index')->name('tebak');
});

Route::group(['prefix' => 'admin', 'middleware' => 'App\Http\Middleware\IsAdmin'], function () {
    
    Route::match(['get', 'post'], '/', 'HomeController@admin');

    // Team Area
    Route::get('team', 'TeamController@index')->name('teamArea');
    Route::get('team/add', 'TeamController@create');
    Route::post('team', 'TeamController@register');
    Route::get('team/{idTeam}/edit','TeamController@edit');
    Route::post('team/{idTeam}', 'TeamController@update');
    Route::delete('team/{idTeam}', 'TeamController@destroy');

    // Match Area
    Route::get('match', 'MatchController@index')->name('matchArea');
    Route::get('match/add', 'MatchController@create');
    Route::post('match', 'MatchController@register');
    Route::get('match/{idMatch}/edit','MatchController@edit');
    Route::post('match/{idMatch}', 'MatchController@update');
    Route::get('match/{idMatch}/score','MatchController@score');
    Route::post('match/score/{idMatch}', 'MatchController@updateScore');
    Route::delete('match/{idMatch}', 'MatchController@destroy');
});
