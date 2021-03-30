<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\VendorTransaction;
use App\Models\OrangeAirtimeTransaction;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
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
            $transactions  = Transaction::with('transactionable')->where('vendor_id', '=', $vendor->id)
                          ->where('approved', '=', true)->orderBy('created_at','desc')
                           ->get();
          return VendorTransaction::collection($transactions);
        }
        else{
            return response()->json(['message'=>'Your not authorized to perform such actions']);
        }

    }

}
