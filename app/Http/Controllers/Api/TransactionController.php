<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

/**
 * @group  User-Transactions
 * @authenticated
 * APIs for managing User Transactions
 */
class TransactionController extends Controller
{
    /**
     * Initiate a Payment (Customer Facing)
     *
     * @bodyParam payment_method string required Method of Payment, either moov or orange.
     * @bodyParam provider_id integer required Phone's Number Provider Id.
     * @bodyParam phone_number string required Orange Recipient Phone Number.
     * @bodyParam amount string required Airtime Amount.
     *
     * @authenticated
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     */
    public function initiatePayment(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'payment_method'=>'required|in:moov,orange',
                'phone_number' => 'required',
                'amount' => 'required|integer|min:10|max:10000',
                'provider_id' => 'required|exists:providers,id',
            ]);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()], Response::HTTP_BAD_REQUEST);
        }
        if ($request->payment_method == 'moov'){
            return (new MoovMoneyController)->initiateMoovPayment($request);
        }elseif ($request->payment_method == 'orange')
            {
            return (new OrangeAirtimeController)->initiateOrangeMoney($request);
        }else{
            return response()->json(['message' => 'Invalid Payment Method'], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Fetch user transactions
     * @authenticated
     */
    public function index(){
        $transactions = Auth::user()->transactions()->latest()->get();
        $transactions->map(function ($transaction){
           $transaction->transaction_data = $transaction->transactionable;
        });

        return response()->json(['message'=>compact('transactions'), Response::HTTP_OK]);
    }
}
