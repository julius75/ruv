<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Jobs\SendPushNotification;
use App\Models\Option;
use App\Models\OrangeAirtimeTransaction;
use App\Models\PhoneNumber;
use App\Models\Provider;
use App\Models\Transaction;
use App\Models\User;
use App\Notifications\BundlePurchaseNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

/**
 * @group Bundle Purchase
 * @authenticated
 * APIs for managing User Bundle Purchases
 */
class BundlesController extends Controller
{
    /**
     * Initiate a Bundle purchase
     *
     * @bodyParam payment_method string required Method of Payment, either moov or orange.
     * @bodyParam provider_id integer required Phone's Number Provider Id.
     * @bodyParam phone_number string required Orange Recipient Phone Number.
     * @bodyParam amount string required Airtime Amount.
     * @bodyParam moov_cash_phone_number string required Number Used to Pay
     *
     * @authenticated
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     */
    public function initiatePaymentBundles(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'payment_method'=>'required|in:moov,orange',
                'phone_number' => 'required',
                'amount' => 'required|integer|min:10|max:10000',
                'provider_id' => 'required|exists:providers,id',
                'moov_cash_phone_number' => 'required',
            ]);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()], Response::HTTP_BAD_REQUEST);
        }
        if ($request->payment_method == 'moov'){
            return (new MoovMoneyController)->initiateMoovPaymentBundle($request);
        }elseif ($request->payment_method == 'orange')
        {
            return (new OrangeAirtimeController)->initiateOrangeMoneyBundle($request);
        }else{
            return response()->json(['message' => 'Invalid Payment Method'], Response::HTTP_BAD_REQUEST);
        }
    }
    /**
     * Get bundles code
     *
     * @bodyParam provider_id integer required Phone's Number Provider Id.
     *
     * @authenticated
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     */
    public function bundles(Request $request){
        $validator = Validator::make($request->all(),
            [
                'provider_id' => 'required|exists:providers,id',
            ]);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()], Response::HTTP_BAD_REQUEST);
        }
        if ($request->provider_id == 1){
            $details = DB::table('bundles_details')
                ->where('provider_id', '=', 1)
                ->get();
            return response()->json(['message'=>$details], Response::HTTP_OK);
        }
        elseif ($request->provider_id == 3){
            $details = DB::table('bundles_details')
                ->where('provider_id', '=', 3)
                ->get();
            return response()->json(['message'=>$details], Response::HTTP_OK);
        }
        else{
            return response()->json(['message'=>'Something Went Wrong on our side, try again later'], Response::HTTP_INTERNAL_SERVER_ERROR);

        }
    }
}
