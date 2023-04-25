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
Route::get('/data', function () {
    return view('tables.data');
});
Route::get('/simple', function () {
    return view('tables.simple');
});
Route::get('/jsgrid', function () {
    return view('tables.jsgrid');
});
//chuyen trang
Route::get('/{name?}', function ($name = "index") {
    return view($name);
});
