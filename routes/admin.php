<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProfileController;
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

Route::get('/', function () {
    return view('welcome');
});


//datatable routes
Route::prefix('datatables')->group(function () {
    Route::get('get-app-users', [UserController::class, 'getUsers'])->name('get-app-users');
    Route::get('get-app-admins', [AdminController::class, 'getAdmins'])->name('get-app-admins');


});

require __DIR__.'/admin_auth.php';
