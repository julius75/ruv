<?php

use App\Http\Controllers\Admin\AdminController;
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
//homepage
Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
//app-users
Route::resource('app-users', UserController::class);
//app-admins
Route::resource('app-admins', AdminController::class);
//profile update
Route::resource('profile', ProfileController::class);
//transaction
Route::resource('transaction', TransactionController::class);

Route::get('/', function () {
    return view('welcome');
});
//default list
Route::get('/default', [UserController::class, 'default'])->name('default');

//for charts
Route::get('/transaction-chart-analytics/{month}/{year}', [HomeController::class, 'getMonthlyTransactionsData'])->name('discussions-analytics');


//datatable routes
Route::prefix('datatables')->group(function () {
    Route::get('get-app-users', [UserController::class, 'getUsers'])->name('get-app-users');
    Route::get('get-app-admins', [AdminController::class, 'getAdmins'])->name('get-app-admins');
    Route::get('get-app-transactions', [TransactionController::class, 'getTransactions'])->name('get-app-admins');



});
//charts routes
Route::prefix('charts')->group(function () {
    Route::get('/discussions-analytics/{month}/{year}', [HomeController::class, 'discussionsEngagement'])->name('discussions-analytics');
   // Route::get('/discussions-analytics/{month}/{year}', 'HomeController@discussionsEngagement');
});

require __DIR__.'/admin_auth.php';
