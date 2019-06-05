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
    return view('welcome');
});

Auth::routes();

Route::get('login', 'Authentication\LoginController@view_login')->name('view_login');
Route::post('login', 'Authentication\LoginController@attempt_login')->name('attempt_login');

Route::get('projects', 'Web\ProjectsController@projects')->name('projects');

Route::get('/home', 'HomeController@index')->name('home');
