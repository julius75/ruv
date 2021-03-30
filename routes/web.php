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
$post_data = json_encode([
    "request-id"=>"TESTACCOUNT-12340000",
    "destination"=> "22670839661",
    "amount"=> 100,
    "remarks"=> "TEST",
    "message"=> "TEST",
    "extended-data"=> []
]);
$hash = hash('sha256','DANON'.$post_data);
curl_setopt_array($curl, array(
    CURLOPT_URL => 'http://196.28.245.227/tlcfzc_gw/api/gateway/3pp/transaction/process',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_SSL_VERIFYPEER => false,
    CURLOPT_SSL_VERIFYHOST => false,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS =>$post_data,
    CURLOPT_HTTPHEADER => array(
        'command-id: mror-transaction-ussd',
        'hash: '.$hash,
        'Authorization: Basic REFOT046Nk0yY2oyWlNTV3djMlI2Ug==',
        'Content-Type: application/json'
    ),
));
$response = curl_exec($curl);
$errors = curl_error($curl);
$returnCode = (int)curl_getinfo($curl, CURLINFO_HTTP_CODE);
curl_close($curl);
dd(['error'=>$errors, 'http_code'=>$returnCode, 'response'=>$response]);

});
Route::get('/moov2', function () {
    $curl = curl_init();
    $post_data = json_encode([
        "request-id"=>"TESTACCOUNT-12340000",
        "destination"=> "22670839661",
        "amount"=> 100,
        "remarks"=> "TEST",
        "message"=> "TEST",
        "extended-data"=> []
    ]);
    $hash = hash('sha256','DANON'.$post_data);
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://196.28.245.227/tlcfzc_gw/api/gateway/3pp/transaction/process',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_SSL_VERIFYHOST => false,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>$post_data,
        CURLOPT_HTTPHEADER => array(
            'command-id: mror-transaction-ussd',
            'hash: '.$hash,
            'Authorization: Basic REFOT046Nk0yY2oyWlNTV3djMlI2Ug==',
            'Content-Type: application/json'
        ),
    ));
    $response = curl_exec($curl);
    $errors = curl_error($curl);
    $returnCode = (int)curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);
    dd(['error'=>$errors, 'http_code'=>$returnCode, 'response'=>$response]);

});
Route::get('/moov3', function () {
    $login = 'DANON';
    $password = '6M2cj2ZSSWwc2R6R';
    $url = 'https://196.28.245.227/tlcfzc_gw/api/gateway/3pp/transaction/process';
    $post_data = json_encode([
        "request-id"=>"TESTACCOUNT-12340000",
        "destination"=> "22670839661",
        "amount"=> 100,
        "remarks"=> "TEST",
        "message"=> "TEST",
        "extended-data"=> []
    ]);
    $hash = hash('sha256','DANON'.$post_data);
    $headers = array(
        'command-id: mror-transaction-ussd',
        'hash: '.$hash,
        'Content-Type: application/json'
    );
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($ch, CURLOPT_USERPWD, "$login:$password");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
    $response = curl_exec($ch);
    $errors = curl_error($ch);
    $returnCode = (int)curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    dd(['error'=>$errors, 'http_code'=>$returnCode, 'response'=>$response]);

});
Route::get('/moov4', function () {
    $login = 'DANON';
    $password = '6M2cj2ZSSWwc2R6R';
    $url = 'https://196.28.245.227/tlcfzc_gw/api/gateway/3pp/transaction/process';
    $post_data = json_encode([
        "request-id"=>"TESTACCOUNT-12340000",
        "destination"=> "22670839661",
        "amount"=> 100,
        "remarks"=> "TEST",
        "message"=> "TEST",
        "extended-data"=> []
    ]);
    $hash = hash('sha256','DANON'.$post_data);
    $headers = array(
        'Authorization: Basic '. base64_encode($login.':'.$password),
        'command-id: mror-transaction-ussd',
        'hash: '.$hash,
        'Content-Type: application/json'
    );
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
    $response = curl_exec($ch);
    $errors = curl_error($ch);
    $returnCode = (int)curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    dd(['error'=>$errors, 'http_code'=>$returnCode, 'response'=>$response]);
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
