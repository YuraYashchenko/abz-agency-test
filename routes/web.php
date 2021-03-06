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
    $employees = \App\Employee::all()->threaded();

    return view('welcome', compact('employees'));
});

Route::resource('employee', 'EmployeesController');

Route::post('/sort', 'SortController@sortBy');
Route::post('/search', 'SearchController@searchByQuery');

Auth::routes();