<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
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
        return view('admin.transaction.index', compact('page_title', 'page_description'));
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
            ->addColumn('transaction_status', function ($transactions){
                if ($transactions->status == true) {
                    return '<span class="label label-lg font-weight-bold label-light-success label-inline">Complete</span>';
                }else {
                    return '<span class="label label-lg font-weight-bold label-light-warning label-inline">Pending</span>';
                }
            })
            ->addColumn('action', function ($transactions) {
                return '<div class="dropdown dropdown-inline">
								<a href="" class="btn btn-sm btn-clean btn-icon" data-toggle="dropdown">
	                                <i class="la la-cog"></i>
	                            </a>
							  	<div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
									<ul class="nav nav-hoverable flex-column">
							    		<li class="nav-item"><a class="nav-link" href="'.route('admin.app-admins.edit',Crypt::encrypt($transactions->id)).'"><i class="nav-icon la la-edit"></i><span class="nav-text">Edit Details</span></a></li>
							    		<li class="nav-item"><a class="nav-link" href="'.route('admin.app-admins.show',Crypt::encrypt($transactions->id)).'"><i class="nav-icon la la-print"></i><span class="nav-text">Show Details</span></a></li>
									</ul>
							  	</div>
							</div>

						';
            })->rawColumns(['customer_details', 'vendor_details', 'action', 'transaction_status'])
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
}
