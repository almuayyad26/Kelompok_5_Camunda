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

Route::get('/', 'Controller@index');
Route::post('/submit', 'Controller@submit');

Route::get('/task2', 'Controller@task2');
Route::get('/review/{id}', 'Controller@review');
Route::post('/approve', 'Controller@approve');

Route::get('/receive', 'Controller@receive');
Route::get('/sendReceive/{id}', 'Controller@sendReceive');

Route::get('/reject', 'Controller@reject');
Route::get('/sendReject/{id}', 'Controller@sendReject');
