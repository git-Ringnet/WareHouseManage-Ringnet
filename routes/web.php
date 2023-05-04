<?php

use App\Http\Controllers\AjaxController;
use App\Http\Controllers\InsertProductController;
use App\Http\Controllers\ProductsController;
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
    Route::get('userlist', [UsersController::class, 'show'])->name('userslist');
    Route::get('adduser', [UsersController::class, 'add'])->name('add');
    Route::post('adduser', [UsersController::class, 'addUser'])->name('adduser');
    Route::get('edituser', [UsersController::class, 'edit'])->name('edit');
    Route::post('update', [UsersController::class, 'editUser'])->name('edituser');
    Route::get('delete', [UsersController::class, 'deleteUser'])->name('delete');
    Route::get('updatestatus', [UsersController::class, 'updateStatus'])->name('update');
});


//nha cung cap
Route::resource('provides', provideController::class);
Route::get('/update-status', [provideController::class, 'updateStatus'])->name('update');

Route::get('/data', function () {
    return view('tables.data');
});
Route::resource('data',ProductsController::class);
Route::get('/insertProducts',[ProductsController::class,'insertProducts'])->name('insertProducts');
Route::POST('/storeProducts',[ProductsController::class,'storeProducts'])->name('storeProducts');
Route::get('/data_edit',[ProductsController::class,'edit_ajax'])->name('ajax');
Route::get('/data_show',[ProductsController::class,'show_ajax'])->name('show_ajax');
Route::get('/simple', function () {
    return view('tables.simple');
});

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
