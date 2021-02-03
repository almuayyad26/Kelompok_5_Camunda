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
Route::get('/task2submit', 'Controller@task2submit');
Route::post('/approve', 'Controller@approve');
