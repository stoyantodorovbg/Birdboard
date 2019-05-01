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

Route::resource('projects', 'ProjectsController')->middleware('auth');
Route::patch('/projects/{project}/notes', 'ProjectsController@updateNotes')->name('projects.update-notes')->middleware('auth');
Route::post('/projects', 'ProjectsController@store')->name('projects.store')->middleware('auth');
Route::post('/projects/{project}/tasks', 'TasksController@store')->name('tasks.store')->middleware('auth');
Route::patch('/projects/{project}/tasks/{task}', 'TasksController@update')->name('tasks.update')->middleware('auth');
Route::post('/projects/{project}/invite', 'ProjectInvitationsController@store')->name('projects.invite')->middleware('auth');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
