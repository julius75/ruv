<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PasswordResetController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\OrangeAirtimeController;
use App\Http\Controllers\Api\TransactionController;
use App\Http\Controllers\Api\ProviderController;
use App\Http\Controllers\Api\UserDeviceController;
use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\Api\SafaricomAirtimeController;
use App\Http\Controllers\Api\VendorTransactionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
Route::prefix('v1')->group(function (){
    //user
    Route::prefix('user')->group(function (){
        //registration
        Route::prefix('register')->group(function (){
            Route::post('/', [AuthController::class, 'register']);
            Route::post('email-unique', [AuthController::class, 'emailUnique']);
            Route::post('phone-unique', [AuthController::class, 'phoneUnique']);
            Route::post('verify-passcode', [AuthController::class, 'verifyPasscode'])->middleware('auth:api');
        });
        //login, forgot and update passwords
        Route::prefix('login')->group(function (){
            Route::post('/', [AuthController::class, 'login']);
            Route::prefix('password')->group(function () {
                Route::post('forgot', [PasswordResetController::class, 'forgotPassword']);
                Route::post('update', [PasswordResetController::class, 'updatePassword']);
            });
        });
        //logout
        Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:api');

        //manage user profile
        Route::prefix('profile')->middleware('auth:api')->group(function () {
            Route::post('', [ProfileController::class, 'index']);
            Route::post('edit', [ProfileController::class, 'editProfile']);
            Route::post('delete-account', [ProfileController::class, 'deleteAccount']);
            Route::post('add-phone_number', [ProfileController::class, 'addPhoneNumber']);
            Route::post('delete-phone_number', [ProfileController::class, 'deletePhoneNumber']);
            Route::post('validate-phone_number', [ProfileController::class, 'validateAddedPhoneNumber']);
            Route::post('set-default-phone_number', [ProfileController::class, 'setDefaultPhoneNumber']);
        });

        //transactions
        Route::prefix('transactions')->middleware('auth:api')->group(function () {
            Route::post('', [TransactionController::class, 'index']);
        });

        //device
        Route::post('device', [UserDeviceController::class, 'create']);

        //notifications
        Route::get('testing-notifications', [NotificationController::class, 'test']);

    });
    //providers
    Route::post('providers', [ProviderController::class, 'index']);

    Route::prefix('vendor')->middleware('auth:api')->group(function (){
        Route::post('providers', [VendorTransactionController::class, 'list_transactions']);
    });

    Route::prefix('airtime-purchase')->middleware('auth:api')->group(function (){
        Route::post('orange', [OrangeAirtimeController::class, 'initiatePayment']);
        Route::post('kenya', [SafaricomAirtimeController::class, 'initiate_sending_airtime']);
    });
});
