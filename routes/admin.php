<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\VendorController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;

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
    return \Illuminate\Support\Facades\Redirect::to('admin/dashboard');
});
//homepage
Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
//app-users
Route::resource('app-users', UserController::class);
//app-admins
Route::resource('app-admins', AdminController::class);
//vendors
Route::resource('vendors', VendorController::class);

Route::get('teleco-providers', [HomeController::class, 'viewProviders'])->name('providers.index');


//profile update
Route::resource('profile', ProfileController::class);
//transaction
Route::resource('transactions', TransactionController::class);

//default list
Route::get('/default', [UserController::class, 'default'])->name('default');


//datatable routes
Route::prefix('datatables')->group(function () {
    Route::get('get-app-users', [UserController::class, 'getUsers'])->name('get-app-users');
    Route::get('get-app-admins', [AdminController::class, 'getAdmins'])->name('get-app-admins');
    Route::get('get-app-transactions', [TransactionController::class, 'getTransactions'])->name('get-app-admins');
    Route::get('get-vendors', [VendorController::class, 'getVendors'])->name('get-vendors');
    Route::get('get-providers', [HomeController::class, 'getProviders'])->name('get-providers');
    Route::get('get-transactions/{id}', [TransactionController::class, 'getUsersTransactions'])->name('get-transactions');
    Route::get('get-transactions_vendor/{id}', [VendorController::class, 'getVendorsTransactions'])->name('get-transactions_vendor');


});
//charts routes
Route::prefix('charts')->group(function () {
//for charts
    Route::get('/transaction-chart-analytics/{month}/{year}', [HomeController::class, 'getMonthlyTransactionsData'])->name('discussions-analytics');
//area chart for transaction
    Route::get('/analytics-area/{month?}/{year?}', [HomeController::class, 'getMonthlyPostDataWeekly'])->name('discussions-analytics');

});
Route::get('vendors/transaction-chart-vendors/{month}/{year}/{id}', [VendorController::class, 'getMonthlyTransactionsVendors']);

//test
Route::get('/test', [HomeController::class, 'getAllMonthsUsers'])->name('test');

require __DIR__.'/admin_auth.php';
