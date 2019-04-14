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

Route::get('/projects', 'ProjectsController@index')->name('projects.index')->middleware('auth');
Route::get('/projects/create', 'ProjectsController@create')->name('projects.create')->middleware('auth');
Route::get('/projects/{project}', 'ProjectsController@show')->name('projects.show')->middleware('auth');
Route::post('/projects', 'ProjectsController@store')->name('projects.store')->middleware('auth');
Route::post('/projects/{project}/tasks', 'TasksController@store')->name('tasks.store')->middleware('auth');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
