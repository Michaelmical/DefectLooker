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
Route::get('/',                  'AuthController@index')->middleware('check.login.page')->name('login');
Route::post('/postLogin',        'AuthController@postLogin')->name('login.postLogin');
Route::get('/registration',      'AuthController@registration');
Route::post('post-registration', 'AuthController@postRegistration');
Route::get('/logout',            'AuthController@logout')->name('logout');

Route::get('/dashboard',         'DashboardController@index')->name('dashboard');

Route::get('/tasks',               'TaskController@index')->middleware('check.exist.session')->name('tasks');
Route::get('/tasks/create',        'TaskController@create')->name('tasks-create');
Route::post('/tasks',              'TaskController@store')->name('tasks-store');
Route::get('/tasks/{taskid}/edit', 'TaskController@edit')->name('tasks-edit');
Route::put('/tasks/{taskid}',      'TaskController@update')->name('tasks-update');
Route::delete('/tasks/{taskid}',   'TaskController@destroy')->name('tasks->delete');

Route::get('employee', 'EmployeeController@index')->name('employee');
Route::post('employee', 'EmployeeController@store')->name('employee.store');
Route::get('employee/create', 'EmployeeController@create')->name('employee-create');

Route::get('build', 'BuildController@index')->name('build');
Route::get('build/create', 'BuildController@create')->name('build-create');
Route::get('build/{id}', 'BuildController@show')->name('build-show');
Route::get('build/{id}/edit', 'BuildController@edit')->name('build-edit');
Route::post('build', 'BuildController@store')->name('build.store');
Route::put('build/{id}',      'BuildController@update')->name('build.update');
Route::delete('build/{id}',   'BuildController@destroy')->name('build.delete');

Route::get('project', 'ProjectController@index')->name('project');
Route::get('project/create', 'ProjectController@create')->name('project-create');
Route::get('project/{id}', 'ProjectController@show')->name('project-show');
Route::get('project/{id}/edit', 'ProjectController@edit')->name('project-edit');
Route::post('project', 'ProjectController@store')->name('project.store');
Route::put('project/{id}',      'ProjectController@update')->name('project.update');
Route::delete('project/{id}',   'ProjectController@destroy')->name('project.delete');

Route::get('functionpoints',                'FunctionPointsController@index')->name('functionpoints');
Route::get('functionpoints/create',         'FunctionPointsController@create')->name('functionpoints-create');
Route::post('functionpoints',               'FunctionPointsController@store')->name('functionpoints-store');
Route::post('functionpoints/{taskid}/edit', 'FunctionPointsController@edit')->name('functionpoints-edit');

Route::get('areatype/{id}',      'AreaTypeController@show')->name('areatype-show');


Route::get('complex/{id}',      'ComplexController@show')->name('complex-show');


Route::get('defects', 'DefectsController@index')->name('defects');
Route::get('defects/create', 'DefectsController@create')->name('defects-create');
Route::get('defects/{id}/build', 'DefectsController@build')->name('defects.build');
Route::get('defects/{id}/original', 'DefectsController@original')->name('defects.original');
Route::post('defects', 'DefectsController@store')->name('defects.store');

Route::get('session', function () {
    return response()->json(session()->all());
//    session()->flush();
});

//Route::get('/resourceName',                 'ControllerName@index');
//Route::get('/resourceName/{resource}',      'ControllerName@show');
//Route::get('/resourceName/create',          'ControllerName@create');
//Route::get('/resourceName/{resource}/edit', 'ControllerName@edit');
//Route::post('/resourceName',                'ControllerName@store');
//Route::put('/resourceName/{resource}',      'ControllerName@update');
//Route::delete('/resourceName/{resource}',   'ControllerName@destroy');
