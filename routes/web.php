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

Route::get('/', function () {
    return view('home');
});

// Auth::routes();

Route::get('login', [
    'as' => 'login',
    'uses' => 'Auth\LoginController@showLoginForm'
  ]);
  Route::post('login', [
    'as' => '',
    'uses' => 'Auth\LoginController@login'
  ]);
  Route::post('logout', [
    'as' => 'logout',
    'uses' => 'Auth\LoginController@logout'
  ]);

Route::get('/home', 'HomeController@index')->name('home');
Route::get('register', 'Auth\RegisterController@RegisterForm')->name('register');

Route::group(['middleware' => 'App\Http\Middleware\isAdmin'], function()
{
    Route::match(['get', 'post'], '/admin', 'HomeController@adminHome')->name('admin.home');
});
