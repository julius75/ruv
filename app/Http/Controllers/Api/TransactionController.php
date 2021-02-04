<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

/**
 * @group  User Transactions
 * @authenticated
 * APIs for listing User Transactions
 */
class TransactionController extends Controller
{
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
