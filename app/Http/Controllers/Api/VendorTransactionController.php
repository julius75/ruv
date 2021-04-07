<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\VendorTransaction;
use App\Jobs\SendPushNotification;
use App\Models\MoovMoneyTransaction;
use App\Models\Option;
use App\Models\OrangeAirtimeTransaction;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

/**
 * @group Vendor Transactions
 * * @authenticated
 * APIs for getting vendor transactions
 */
class VendorTransactionController extends Controller
{
    /**
     * Fetch All Vendor transactions
     *@authenticated
     *
     */
    public function list_transactions(){
        $vendor =  Auth::user();
        if($vendor->hasRole('vendor-user')){
            $transactions  = Transaction::with('transactionable')
                            ->where('vendor_id', '=', $vendor->id)
                            ->where('approved', '=', true)
                            ->orderBy('created_at','desc')
                            ->get();
          return VendorTransaction::collection($transactions);
        }
        else{
            return response()->json(['message'=>'Your not authorized to perform such actions']);
        }

    }

    /**
     * Send Airtime to User
     *
     * @bodyParam transaction_id integer required Transaction ID.
     *
     * @authenticated
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     */
    public function send_airtime(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'transaction_id' => 'required|exists:transactions,id',
            ]);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()], Response::HTTP_BAD_REQUEST);
        }
        $transaction = Transaction::find($request->transaction_id);
        if ($transaction->status == true and $transaction->transactionable->issued == true){
            return response()->json(['message' => 'Airtime has already been issued'], Response::HTTP_BAD_REQUEST);
        }

        if ($transaction->transactionable_type == OrangeAirtimeTransaction::class){
            $ussd = Option::where('key','=','send_orange_airtime_to_user_ussd')->first()->value;
            $ussd = sprintf($ussd, substr($transaction->transactionable->customer_msisdn,-8),  $transaction->amount); //' *433*1* %s * %s * Vendor  PIN Code#

            return response()->json(['message'=>'Credit Transfer Initiated', 'ussd'=>$ussd], Response::HTTP_OK);

        } elseif ($transaction->transactionable_type == MoovMoneyTransaction::class) {
            return response()->json(['message'=>'Incomplete'], Response::HTTP_OK);

        }else{
            return response()->json(['message'=>'Invalid Request'], Response::HTTP_BAD_REQUEST);
        }

    }

    /**
     * Update Transaction Status
     *
     * Depending on the vendor's ussd interaction, on successfully sending airtime set complete as true, else false
     *
     * @bodyParam transaction_id integer required Transaction ID.
     * @bodyParam complete boolean required Mark Transaction as Complete or Incomplete.
     *
     * @authenticated
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     */
    public function update_transaction_status(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'transaction_id' => 'required|exists:transactions,id',
                'complete' => 'required|boolean',
            ]);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()], Response::HTTP_BAD_REQUEST);
        }
        $transaction = Transaction::find($request->transaction_id);

       $update_status =  DB::transaction(function () use ($request, $transaction) {
            $transaction->update([
                'status'=>$request->complete,
                'updated_at'=>Carbon::now(),
            ]);
            $transaction->transactionable->update([
                'issued'=>$request->complete,
                'updated_at'=>Carbon::now(),
            ]);
            return true;
        },3);

        if ($update_status == true){
            return response()->json(['message' => 'Transaction Status Updated Successfully'], Response::HTTP_OK);
        }else{
            return response()->json(['message' => 'Transaction Not Updated'], Response::HTTP_BAD_REQUEST);
        }
    }
}
