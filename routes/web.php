<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::resource('accounts', 'AccountController');


Route::get('/accounts/{account}/tasks/create', 'TaskController@create')->name('tasks.create');
Route::post('/accounts/{account}/tasks', 'TaskController@store')->name('tasks.store');

Route::get('/users/edit', 'UserController@edit')->name('users.edit');
Route::patch('/users', 'UserController@update')->name('users.update');
Route::get('/images/s3/{folder}/{file}', 'StorageController@show');

Route::get('/accounts/{account}/tasks', 'TaskController@index')->name('tasks.index');
Route::delete('/accounts/{account}/tasks/{task}', 'TaskController@destroy')->name('tasks.destroy');
Route::get('/accounts/{account}/tasks/{task}/edit', 'TaskController@edit')->name('tasks.edit');
