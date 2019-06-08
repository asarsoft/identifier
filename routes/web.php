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
Route::group(['middleware' => 'language_required'], function ()
{
    Route::get('/', function ()
    {
        return view('welcome');
    })->name('welcome');

//Auth::routes();

    Route::get('login', 'Authentication\LoginController@view_login')->name('view_login');
    Route::post('login', 'Authentication\LoginController@attempt_login')->name('attempt_login');

//Route::get('/home', 'HomeController@index')->name('home');
    Route::get('projects', 'Web\ProjectsController@projects')->name('projects');

    Route::group(['middleware' => 'admin_interface'], function ()
    {
        Route::prefix('admin')->group(function ()
        {
            Route::get('logout', 'Authentication\LogoutController@logout')->name('logout-admin');

            Route::get('/dashboard', 'Admin\DashboardController@dashboard')->name('dashboard-admin');

            Route::prefix('feature')->group(function ()
            {
                Route::get('/', 'Admin\FeatureController@index')->name('index-feature');
                Route::get('/recycle', 'Admin\FeatureController@recycle')->name('recycle-feature');

                Route::get('/create', 'Admin\FeatureController@create')->name('create-feature');
                Route::get('/edit', 'Admin\FeatureController@edit')->name('edit-feature');

                Route::post('/store', 'Admin\FeatureController@store')->name('store-feature');
                Route::post('/update', 'Admin\FeatureController@update')->name('update-feature');

                Route::get('/destroy/{id?}', 'Admin\FeatureController@destroy')->name('destroy-feature');
                Route::get('/restore/{id?}', 'Admin\FeatureController@restore')->name('restore-feature');
            });
        });
    });
});

Route::get('language_required', 'ErrorController@language_required')->name('welcome');


