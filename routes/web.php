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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/administrator', 'App\Http\Controllers\DashboardController@index');
Route::get('/administrator/user', 'App\Http\Controllers\UserController@index')->name('user.list');
Route::get('/administrator/user/add', 'App\Http\Controllers\UserController@add')->name('user.add');
Route::post('/administrator/user/add_process', 'App\Http\Controllers\UserController@addProcess')->name('user.add_process');
Route::get('/administrator/user/detail/{id}', 'App\Http\Controllers\UserController@edit')->name('user.edit');
Route::post('/administrator/user/edit_process', 'App\Http\Controllers\UserController@editProcess')->name('user.edit_process');
Route::post('/administrator/user/destroy/{id}', 'App\Http\Controllers\UserController@destroy');