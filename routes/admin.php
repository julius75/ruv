<?php

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
Route::get('/dashboard', [HomeController::class, 'index'])
    ->name('dashboard');

Route::get('/dashboards', [HomeController::class, 'indexs'])
    ->name('dashboards');

// Demo routes
Route::get('/datatables', 'HomeController@datatables');
Route::get('/ktdatatables', 'HomeController@ktDatatables');
Route::get('/select2', 'HomeController@select2');
Route::get('/jquerymask', 'HomeController@jQueryMask');
Route::get('/icons/custom-icons', 'HomeController@customIcons');
Route::get('/icons/flaticon', 'HomeController@flaticon');
Route::get('/icons/fontawesome', 'HomeController@fontawesome');
Route::get('/icons/lineawesome', 'HomeController@lineawesome');
Route::get('/icons/socicons', 'HomeController@socicons');
Route::get('/icons/svg', 'HomeController@svg');

// Quick search dummy route to display html elements in search dropdown (header search)
Route::get('/quick-search', 'HomeController@quickSearch')->name('quick-search');

Route::get('/', function () {
    return view('welcome');
});

require __DIR__.'/admin_auth.php';
