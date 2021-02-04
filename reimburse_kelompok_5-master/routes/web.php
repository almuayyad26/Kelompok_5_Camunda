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
Route::get('/login', 'Controller@login');

Route::get('/task1', 'Controller@task1');
Route::post('/submit', 'Controller@submit');

Route::get('/task2', 'Controller@task2');
Route::get('/detail/{id}', 'Controller@detail');
Route::post('/approve', 'Controller@approve');

Route::get('/bukti/{id}', 'Controller@bukti');
Route::post('/sendBukti', 'Controller@sendBukti');

Route::get('/sendReceive/{id}', 'Controller@sendReceive');

Route::get('/sendReject/{id}', 'Controller@sendReject');
