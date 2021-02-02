<?php

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
//profile
Route::get('/profile', [HomeController::class, 'profile'])->name('profile');
//app-users
Route::resource('app-users', UserController::class);

Route::get('/', function () {
    return view('welcome');
});


//datatable routes
Route::prefix('datatables')->group(function () {
    Route::get('get-app-users', [UserController::class, 'getUsers'])->name('get-app-users');




});

require __DIR__.'/admin_auth.php';
