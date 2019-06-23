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
                Route::get('/show/{id}', 'Admin\FeatureController@show')->name('show-feature');

                Route::get('/create', 'Admin\FeatureController@create')->name('create-feature');
                Route::get('/edit/{id}/{parameter?}', 'Admin\FeatureController@edit')->name('edit-feature');

                Route::post('/store/{sub_model?}', 'Admin\FeatureController@store')->name('store-feature');
                Route::post('/update/{id}/{sub_model?}', 'Admin\FeatureController@update')->name('update-feature');

                Route::get('/destroy/{id?}', 'Admin\FeatureController@destroy')->name('destroy-feature');
                Route::get('/restore/{id?}', 'Admin\FeatureController@restore')->name('restore-feature');
            });

            Route::prefix('category')->group(function ()
            {
                Route::get('/', 'Admin\CategoryController@index')->name('index-category');
                Route::get('/recycle', 'Admin\CategoryController@recycle')->name('recycle-category');
                Route::get('/show/{id}', 'Admin\CategoryController@show')->name('show-category');

                Route::get('/create', 'Admin\CategoryController@create')->name('create-category');
                Route::get('/edit/{id}/{parameter?}', 'Admin\CategoryController@edit')->name('edit-category');

                Route::post('/store/{sub_model?}', 'Admin\CategoryController@store')->name('store-category');
                Route::post('/update/{id}/{sub_model?}', 'Admin\CategoryController@update')->name('update-category');

                Route::get('/destroy/{id?}', 'Admin\CategoryController@destroy')->name('destroy-category');
                Route::get('/restore/{id?}', 'Admin\CategoryController@restore')->name('restore-category');
            });
        });
    });
});

Route::get('language_required', 'ErrorController@language_required')->name('welcome');


