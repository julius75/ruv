<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use DateInterval;
use DatePeriod;
use DateTime;
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

    /**
     * Fetch user six months transactions
     * @authenticated
     */
    public function getMonthlyTransactionsData() {
        $user = Auth::user();
        if ($user) {
            $start = new DateTime('first day of this month - 5 months');
            $end   = new DateTime('this month');
            $interval  = new DateInterval('P1M');
            $date_period = new DatePeriod($start, $interval, $end);
            $months = array();
            $months_name = array();

            $month_name_array_dates = array();
            $month_name_array_dates_format = array();

            foreach($date_period as $dates) {
                array_push($months, $dates->format('m'));
                array_push($months_name, $dates->format('F').' '.$dates->format('Y'));
            }
            if ( ! empty( $months ) ) {
                foreach ( $months_name as $month  ) {
                    $day_mon_array = $this->getAllMonthsDays($month,$user);
                    array_push( $month_name_array_dates, $day_mon_array );
                }
                foreach ( $months_name as $month  ) {
                    array_push( $month_name_array_dates_format, $month );
                }
            }
            return response()->json(['message' => $month_name_array_dates], \Symfony\Component\HttpFoundation\Response::HTTP_OK);
        }
        else {
            return response()->json(['message' => false, 'comment' => 'Invalid user'], Response::HTTP_BAD_REQUEST);
        }


    }
    function getAllMonthsDays($month,$user){
        $month_no =  Carbon::parse($month)->format('m') ;
        $year = Carbon::now()->year;
        $days_array = Transaction::whereMonth( 'created_at',$month_no )
            ->whereYear('created_at', $year)
            ->where('status', true)
            ->where('user_id', $user->id)
            ->count();

        $days_array = array(
            'transactions' => $days_array,
            'month' => $month,
        );
        return $days_array;
    }
}
