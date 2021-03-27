<?php

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

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
Route::get('/moov', function () {
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://196.28.245.227/tlcfzc_gw/api/gateway/3pp/transaction/process',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>'{
            "username":"DANON",
            "password":"6M2cj2ZSSWwc2R6R"
            }',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
        ),
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    dd($response);
});
Route::get('/', function () {
    return \Illuminate\Support\Facades\Redirect::to('admin/login');
//    return view('welcome');
});
//vendor chat
//Route::get('transaction-chart-vendors/{month}/{year}', [HomeController::class, 'getMonthlyTransactionsData'])->name('transaction-chart-vendor');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
