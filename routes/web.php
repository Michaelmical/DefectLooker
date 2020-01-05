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

Route::get('/login', 'AuthController@index')->name('login');
Route::get('/sessionhere', 'AuthController@sessionhere');
Route::post('/postLogin', 'AuthController@postLogin')->name('login.postLogin');
Route::get('/registration', 'AuthController@registration');
Route::post('post-registration', 'AuthController@postRegistration');
Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
Route::get('/logout', 'AuthController@logout');

Route::get('/tasks',               'TaskController@index')->name('tasks'); // view of list
Route::get('/tasks/create',        'TaskController@create')->name('tasks-create'); // view
Route::post('/tasks',              'TaskController@store')->name('tasks-store'); // func
Route::get('/tasks/{taskid}/edit', 'TaskController@edit')->name('tasks-edit'); // view & data retrieve
Route::put('/tasks/{taskid}',      'TaskController@update'); // func

Route::get('/points', 'PointsController@index')->name('points');

Route::get('employee', 'EmployeeController@index')->name('employee');
Route::post('employee', 'EmployeeController@store')->name('employee.store');
Route::get('employee/create', 'EmployeeController@create')->name('employee-create');

Route::get('build', 'BuildController@index')->name('build');
Route::get('build/create', 'BuildController@create')->name('build-create');
Route::post('build', 'BuildController@store')->name('build.store');


//Route::get('/resourceName',                 'ControllerName@index');
//Route::get('/resourceName/{resource}',      'ControllerName@show');
//Route::get('/resourceName/create',          'ControllerName@create');
//Route::get('/resourceName/{resource}/edit', 'ControllerName@edit');
//Route::post('/resourceName',                'ControllerName@store');
//Route::put('/resourceName/{resource}',      'ControllerName@update');
//Route::delete('/resourceName/{resource}',   'ControllerName@destroy');
