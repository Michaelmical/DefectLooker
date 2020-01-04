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

Route::get('/login', 'AuthController@index');
Route::get('/sessionhere', 'AuthController@sessionhere');
Route::post('/postLogin', 'AuthController@postLogin')->name('login.postLogin');
Route::get('/registration', 'AuthController@registration');
Route::post('post-registration', 'AuthController@postRegistration');
Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
Route::get('/logout', 'AuthController@logout');

Route::get('/tasks', 'TaskController@index')->name('tasks');
Route::get('/tasks/create', 'TaskController@create')->name('tasks-create');
Route::get('/points', 'PointsController@index')->name('points');

Route::get('/employee', 'EmployeeController@index')->name('employee');
Route::post('/employee', 'EmployeeController@store')->name('employee.store');
Route::get('/employee/create', 'EmployeeController@create')->name('employee-create');


