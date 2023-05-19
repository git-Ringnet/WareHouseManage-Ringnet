<?php
use App\Http\Controllers\AddProductController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\GuestsController;
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

Route::prefix('admin')->name('admin.')->middleware('permission:admin')->group(function () {
    Route::get('userlist', [UsersController::class, 'show'])->name('userslist');
    Route::get('adduser', [UsersController::class, 'add'])->name('add');
    Route::post('adduser', [UsersController::class, 'addUser'])->name('adduser');
    Route::get('edituser', [UsersController::class, 'edit'])->name('edit');
    Route::post('update', [UsersController::class, 'editUser'])->name('edituser');
    Route::get('delete', [UsersController::class, 'deleteUser'])->name('delete');
    Route::get('updatestatus', [UsersController::class, 'updateStatus'])->name('update');
});


//nha cung cap
Route::resource('provides', provideController::class)->middleware('permission:Manager');
Route::get('/update-status', [provideController::class, 'updateStatus'])->name('update');

//khach hang
Route::resource('guests', GuestsController::class);
Route::get('/updatestatus', [GuestsController::class, 'updateStatus'])->name('updateKH');

//xuat hang
Route::resource('exports', ExportController::class);
Route::get('/searchExport', [ExportController::class, 'searchExport'])->name('searchExport');
//cap nhat thong tin khach hang
Route::get('/customers', [ExportController::class, 'updateCustomer'])->name('updateCustomer');
//them thong tin khach hang
Route::get('addguest', [ExportController::class, 'addCustomer'])->name('addCustomer');
//lấy thông tin sản phẩm từ mã sản phẩm cha
Route::get('nameProducts', [ExportController::class, 'nameProduct'])->name('nameProduct');
//lấy thông tin sản phẩm từ tên sản phẩm
Route::get('getProduct', [ExportController::class, 'getProduct'])->name('getProduct');

//
Route::resource('data',ProductsController::class);
Route::get('/insertProducts',[ProductsController::class,'insertProducts'])->name('insertProducts');
Route::POST('/storeProducts',[ProductsController::class,'storeProducts'])->name('storeProducts');
Route::get('/data_edit',[ProductsController::class,'edit_ajax'])->name('ajax');
Route::get('/data_show',[ProductsController::class,'show_ajax'])->name('show_ajax');
Route::get('/show_provide',[AddProductController::class,'show_provide'])->name('show_provide');
Route::get('/update_provide',[AddProductController::class,'update_provide'])->name('update_provide');
Route::resource('insertProduct',AddProductController::class);
Route::POST('/addBillEdit',[AddProductController::class,'addBillEdit'])->name('addBillEdit');
Route::post('/insertProductP',[AddProductController::class,'addBill'])->name('addBill');
Route::put('/deleteBill/{id?}',[AddProductController::class,'deleteBill'])->name('deleteBill');
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
