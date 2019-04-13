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

Route::get('/projects', 'ProjectController@index')->name('projects.index')->middleware('auth');
Route::get('/projects/create', 'ProjectController@create')->name('projects.create')->middleware('auth');
Route::get('/projects/{project}', 'ProjectController@show')->name('projects.show')->middleware('auth');
Route::post('/projects', 'ProjectController@store')->name('projects.store')->middleware('auth');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');