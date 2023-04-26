<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\provideController;

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
    return view('index');
});

Route::get('/data', function () {
    return view('tables.data');
});
Route::get('/simple', function () {
    return view('tables.simple');
});
//nha cung cap
Route::resource('provides', provideController::class);
Route::get('/update-status', [provideController::class, 'updateStatus'])->name('update');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

//chuyen trang
Route::get('/{name?}', function ($name = "index") {
    return view($name);
});