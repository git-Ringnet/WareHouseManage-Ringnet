<?php

use App\Http\Controllers\AddProductController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\BackUpController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DebtController;
use App\Http\Controllers\DebtImportController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\GuestsController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\InsertProductController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ProvideController;
use App\Http\Controllers\ReportController;
use App\Models\DebtImport;

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
Route::prefix('admin')->name('admin.')->middleware('permission:admin')->group(function () {
    Route::get('userlist', [UsersController::class, 'show'])->name('userslist');
    Route::get('adduser', [UsersController::class, 'add'])->name('add');
    Route::post('adduser', [UsersController::class, 'addUser'])->name('adduser');
    Route::get('edituser', [UsersController::class, 'edit'])->name('edit');
    Route::post('update', [UsersController::class, 'editUser'])->name('edituser');
    Route::get('delete', [UsersController::class, 'deleteUser'])->name('delete');
    Route::get('updatestatus', [UsersController::class, 'updateStatus'])->name('update');
    Route::get('/deleteListUser', [UsersController::class, 'deleteListUser'])->name('deleteListUser');
    Route::get('/activeStatusUser', [UsersController::class, 'activeStatusUser'])->name('activeStatusUser');
    Route::get('/disableStatusUser', [UsersController::class, 'disableStatusUser'])->name('disableStatusUser');
});
Route::get('addNoteFormSale', [UsersController::class, 'addNoteFormSale'])->name('addNoteFormSale');

//nha cung cap
Route::resource('provides', provideController::class)->middleware('permission:admin,manager');
Route::get('/deleteListProvides', [provideController::class, 'deleteListProvides'])->name('deleteListProvides');
Route::get('/activeStatusProvide', [provideController::class, 'activeStatusProvide'])->name('activeStatusProvide');
Route::get('/disableStatusProvide', [provideController::class, 'disableStatusProvide'])->name('disableStatusProvide');
Route::get('/update-status', [provideController::class, 'updateStatus'])->name('update');

//khach hang
Route::resource('guests', GuestsController::class)->middleware('permission:admin,sale');
Route::get('/deleteListGuest', [GuestsController::class, 'deleteListGuest'])->name('deleteListGuest');
Route::get('/activeStatusGuest', [GuestsController::class, 'activeStatusGuest'])->name('activeStatusGuest');
Route::get('/disableStatusGuest', [GuestsController::class, 'disableStatusGuest'])->name('disableStatusGuest');
Route::get('/updatestatus', [GuestsController::class, 'updateStatus'])->name('updateKH');

Route::resource('backupdata', BackUpController::class);
Route::get('/download/{file?}', [BackUpController::class, 'downloadBackup'])->name('downloadBackup');
Route::delete('/deleteBackup/{file}', [BackupController::class, 'deleteBackup'])->name('deleteBackup');

//xuat hang
Route::resource('exports', ExportController::class)->middleware('permission:admin,sale');
Route::get('/searchExport', [ExportController::class, 'searchExport'])->name('searchExport');
//cap nhat thong tin khach hang
Route::get('/customers', [ExportController::class, 'updateCustomer'])->name('updateCustomer');
//them thong tin khach hang
Route::get('addguest', [ExportController::class, 'addCustomer'])->name('addCustomer');
//lấy thông tin sản phẩm từ mã sản phẩm cha
Route::get('nameProducts', [ExportController::class, 'nameProduct'])->name('nameProduct');
//lấy thông tin sản phẩm từ tên sản phẩm
Route::get('getProduct', [ExportController::class, 'getProduct'])->name('getProduct');
//giới hạn số lượng thêm mới
Route::get('limit_qty', [ExportController::class, 'limit_qty'])->name('limit_qty');
//lấy thông tin SN của sản phẩm con
Route::get('getSN', [ExportController::class, 'getSN'])->name('getSN');
Route::get('getSN1', [ExportController::class, 'getSN1'])->name('getSN1');
Route::get('getSN2', [ExportController::class, 'getSN2'])->name('getSN2');
Route::get('getSN3', [ExportController::class, 'getSN3'])->name('getSN3');
Route::get('/deleteExports', [ExportController::class, 'deleteExports'])->name('deleteExports');
Route::get('/cancelBillExport', [ExportController::class, 'cancelBillExport'])->name('cancelBillExport');
//Công nợ
Route::resource('debt', DebtController::class);
Route::get('/paymentdebt', [DebtController::class, 'paymentdebt'])->name('paymentdebt');

//Công nợ nhập hàng
Route::resource('debt_import', DebtImportController::class);
Route::get('/paymentdebtimport', [DebtImportController::class, 'paymentdebtimport'])->name('paymentdebtimport');
// Lịch sử giao dịch
Route::resource('history', HistoryController::class);
//chỉnh sửa đơn xuất hàng
Route::get('/editEx/{id}', [ExportController::class, 'editEx'])->name('editEx');

//Báo cáo
Route::get('/indexExport', [ReportController::class, 'indexExport'])->name('indexExport');
Route::get('/indexImport', [ReportController::class, 'indexImport'])->name('indexImport');
Route::get('/timeImport',[ReportController::class, 'timeImport'])->name('timeImport');
Route::get('/timeExport',[ReportController::class, 'timeExport'])->name('timeExport');



// Export DATABASE
Route::get('/export_database',[ReportController::class, 'exportDatabase'])->name('exportDatabase');
Route::POST('/importDatabase',[ReportController::class, 'importDatabase'])->name('importDatabase');


//kiểm tra số lượng trong xuất hàng
Route::get('checkqty', [ExportController::class, 'checkqty'])->name('checkqty');

Route::resource('data', ProductController::class);
Route::get('/insertProducts', [ProductsController::class, 'insertProducts'])->name('insertProducts');
Route::POST('/storeProducts', [ProductsController::class, 'storeProducts'])->name('storeProducts');
Route::get('/data_edit', [ProductsController::class, 'edit_ajax'])->name('ajax');
Route::get('/data_show', [ProductsController::class, 'show_ajax'])->name('show_ajax');
Route::get('/deleteProducts', [ProductsController::class, 'deleteProducts'])->name('deleteProducts');
Route::PUT('/editProduct/{id}', [ProductsController::class, 'editProduct'])->name('editProduct');
Route::get('/export_products', [ProductsController::class, 'export_products'])->name('export_products');

Route::delete('/delete_product/{id}', [ProductsController::class, 'delete_product'])->name('delete_product');
Route::post('/import_products', [ProductsController::class, 'import_products'])->name('import_products');

Route::get('/checkProducts_code', [ProductsController::class, 'checkProducts_code'])->name('checkProducts_code');
Route::PUT('/updateProduct/{id}', [ProductsController::class, 'updateProduct'])->name('updateProduct');

// EXPORT
Route::get('/export_product', [ProductController::class, 'export'])->name('export');
Route::get('/export_order', [AddProductController::class, 'export_order'])->name('export_order');
Route::get('/export_import',[DebtImportController::class,'export_import'])->name('export_import');
Route::get('/exportDebt',[DebtController::class, 'exportDebt'])->name('exportDebt');
Route::get('/exportHistory',[HistoryController::class, 'exportHistory'])->name('exportHistory');

Route::get('/show_provide', [AddProductController::class, 'show_provide'])->name('show_provide');
Route::get('/update_provide', [AddProductController::class, 'update_provide'])->name('update_provide');
Route::resource('insertProduct', AddProductController::class)->middleware('permission:admin,manager');
Route::POST('/addBillEdit', [AddProductController::class, 'addBillEdit'])->name('addBillEdit');
Route::POST('/updateBill', [AddProductController::class, 'updateBill'])->name('updateBill');
Route::POST('/updateBillEdit', [AddProductController::class, 'updateBillEdit'])->name('updateBillEdit');
Route::post('/insertProductP', [AddProductController::class, 'addBill'])->name('addBill');
Route::put('/deleteBill/{id?}', [AddProductController::class, 'deleteBill'])->name('deleteBill');
Route::get('/deleteOrder', [AddProductController::class, 'deleteOrder'])->name('deleteOrder');
Route::get('/cancelBill', [AddProductController::class, 'cancelBill'])->name('cancelBill');
Route::get('/accessBills', [AddProductController::class, 'accessBills'])->name('accessBills');
Route::get('/showProduct', [AddProductController::class, 'showProduct'])->name('showProduct');
Route::get('/add_newProvide', [AddProductController::class, 'add_newProvide'])->name('add_newProvide');

// Xóa đơn đã hủy
Route::get('/delBillCancel',[AddProductController::class,'delBillCancel'])->name('delBillCancel');

// Kiểm tra serial number tồn tại chưa
Route::get('/checkSN', [AddProductController::class, 'checkSN'])->name('checkSN');

//Kiểm tra tình trạng đơn xuất
Route::get('/checkStatusEx', [ExportController::class, 'checkStatusEx'])->name('checkStatusEx');

//xuất excel bảng export
Route::get('/export_excel', [ExportController::class, 'export_excel'])->name('export_excel');

//Chốt đơn checkbox
Route::get('/chotDonCheckBox', [ExportController::class, 'chotDonCheckBox'])->name('chotDonCheckBox');

Route::get('/simple', function () {
    return view('tables.simple');
});
Route::get('index', [DashboardController::class, 'index']);
Route::get('/count',[DashboardController::class, 'count'])->name('count');
Route::get('/countExport',[DashboardController::class, 'countExport'])->name('countExport');
Route::get('/countInventory',[DashboardController::class, 'countInventory'])->name('countInventory');
Route::get('/countDebt',[DashboardController::class, 'countDebt'])->name('countDebt');
Route::get('/countProfit',[DashboardController::class, 'countProfit'])->name('countProfit');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
});
//chuyen trang
Route::get('/{name?}', function ($name = "index") {
    return view($name);
});
