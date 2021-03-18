<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Provider;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page_title = 'Dashboard';
        $page_description = 'Some description for the page';
        $transactions = Transaction::with('transactionable');
        $pendingApproval = $transactions->get()->filter(function ($transaction) {
            return $transaction->approved == false;
        });
        $completedTransactions = $transactions->get()->filter(function ($transaction) {
            return $transaction->status == true;
        });
        $pendingIssuing = $transactions->whereHas('transactionable', function ($q) {
            $q->where('issued', '=', false);
        })->get();
        $transactions = $transactions->get();
        return view('admin.transaction.index', compact('page_title', 'page_description',
            'transactions', 'pendingApproval', 'completedTransactions', 'pendingIssuing'));
    }

    public function getTransactions()
    {
        $transactions = Transaction::orderBy('created_at', 'desc')->get();
        return Datatables::of($transactions)
            ->addColumn('customer_details', function ($transactions){
                return $transactions->user()->first()->first_name.' '
                    .$transactions->user()->first()->last_name.'<br>'.
                    $transactions->user()->first()->email;
            })
            ->addColumn('vendor_details', function ($transactions){
                return $transactions->vendor()->first()->first_name.' '
                    .$transactions->vendor()->first()->last_name.'<br>'.
                    $transactions->transactionable->vendor_msisdn;
            })
            ->addColumn('phone_number', function ($transactions){
                return $transactions->transactionable->customer_msisdn;
            })
            ->addColumn('transaction_approved', function ($transactions){
                if ($transactions->approved == true) {
                    return '<span class="label label-lg font-weight-bold label-light-success label-inline">Approved</span>';
                }else {
                    return '<span class="label label-lg font-weight-bold label-light-danger label-inline">Pending</span>';
                }
            })
            ->addColumn('transaction_status', function ($transactions){
                if ($transactions->status == true) {
                    return '<span class="label label-lg font-weight-bold label-light-success label-inline">Complete</span>';
                }else {
                    return '<span class="label label-lg font-weight-bold label-light-warning label-inline">Pending</span>';
                }
            })
            ->addColumn('action', function ($transactions) {
                if ($transactions->approved == false){
                    return '<div class="dropdown dropdown-inline">
								<a href="" class="btn btn-sm btn-clean btn-icon" data-toggle="dropdown">
	                                <i class="la la-cog"></i>
	                            </a>
							  	<div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
									<ul class="nav nav-hoverable flex-column">
							    		<li class="nav-item"><a class="nav-link" href="'.route('admin.transactions.show',$transactions->reference_number).'"><i class="nav-icon la la-street-view"></i><span class="nav-text">Show Details</span></a></li>
									</ul>
							  	</div>
							</div>
							<a href="'.route('admin.approve.transaction', $transactions->reference_number).'" class="btn btn-sm btn-clean btn-icon" title="Approve">
								<i class="la la-flag text-warning"></i>
							</a>

						';
                }
                return '<div class="dropdown dropdown-inline">
								<a href="" class="btn btn-sm btn-clean btn-icon" data-toggle="dropdown">
	                                <i class="la la-cog"></i>
	                            </a>
							  	<div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
									<ul class="nav nav-hoverable flex-column">
							    		<li class="nav-item"><a class="nav-link" href="'.route('admin.transactions.show',$transactions->reference_number).'"><i class="nav-icon la la-street-view"></i><span class="nav-text">Show Details</span></a></li>
									</ul>
							  	</div>
							</div>
							<a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Approved">
								<i class="la la-flag text-success"></i>
							</a>

						';
            })
            ->rawColumns(['customer_details', 'vendor_details', 'action', 'transaction_status','transaction_approved'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function getUsersTransactions($id)
    {
        $transactions = Transaction::where('user_id',$id)->get();
        return Datatables::of($transactions)
            ->addColumn('phone_number', function ($transactions){
                return $transactions->transactionable->customer_msisdn;
            })
            ->addColumn('amount', function ($transactions){
                return $transactions->amount;
            })
            ->addColumn('date', function ($transactions){
                return $transactions->created_at->format('d M Y');
            })
            ->addColumn('transaction', function ($transactions){
                return $transactions->reference_number;
            })
            ->addColumn('transaction_status', function ($transactions){
                    return  $transactions->status;
            })
            ->addColumn('vendors', function ($transactions){
                return $transactions->vendor->first_name;
            })
            ->make(true);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $reference_number
     * @return \Illuminate\Http\Response
     */
    public function show(string $reference_number)
    {
        $page_title = $reference_number;
        $page_description = 'Transaction Details';
        $transaction = Transaction::with(['user', 'transactionable'])->where('reference_number', '=', $reference_number)->firstOrFail();
        $vendors = User::role('vendor')->with('phone_numbers')->where(['is_active'=>true, 'online'=>true])
            ->whereHas('phone_numbers',function ($q){
                $q->where('provider_id', '=', 1);
            })
            ->get();

        return view('admin.transaction.show', compact('page_title', 'page_description', 'transaction', 'vendors'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function approve($reference_number){
        $transaction = Transaction::where('reference_number', '=', $reference_number)->firstOrFail();
        $transaction->update(['approved'=>true]);

        return Redirect::back()->with('success', 'Transaction Approved');
    }
}
