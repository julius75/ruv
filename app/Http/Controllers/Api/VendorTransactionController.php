<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class VendorTransactionController extends Controller
{
    public function list_transactions(){
        $vendor = Auth::user();
        $transactions  = Transaction::with('transactionable')->where('vendor_id', '=', $vendor->id)->get();
        return response()->json(['message'=>compact('transactions'), Response::HTTP_OK]);

    }
}
