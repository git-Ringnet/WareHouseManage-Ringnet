<?php

use App\Http\Controllers\GuestsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
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

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('userlist',[UsersController::class,'show'])->name('userslist');
    Route::get('adduser',[UsersController::class,'add'])->name('add');
    Route::post('adduser',[UsersController::class,'addUser'])->name('adduser');
    Route::get('edituser',[UsersController::class,'edit'])->name('edit');
    Route::post('update',[UsersController::class,'editUser'])->name('edituser');
    Route::get('delete',[UsersController::class,'deleteUser'])->name('delete');
});

//nha cung cap
Route::resource('provides', ProvideController::class);
Route::get('/update-status', [ProvideController::class, 'updateStatus'])->name('update');

Route::get('/data', function () {
    return view('tables.data');
});
Route::get('/simple', function () {
    return view('tables.simple');
});
//khach hang
Route::resource('guests', GuestsController::class);
Route::get('/updatestatus', [GuestsController::class, 'updateStatus'])->name('updateKH');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/', function () {
        return view('index');
    })->name('dashboard');
});
//chuyen trang
Route::get('/{name?}', function ($name = "index") {
    return view($name);
});
