<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PhoneNumber;
use App\Models\Provider;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

       return view('admin.vendors.index');
    }

    /**
     * Get Users DataTable
     *
     * @return \Illuminate\Http\Response
     */
    public function getVendors()
    {
        $users = User::role('vendor')->get();
        return Datatables::of($users)
            ->addColumn('default_phone_number', function ($users){
                return $users->phone_numbers()->where('user_default','=', true)->first()->phone_number ?? '-';
            })
            ->addColumn('phone_numbers', function ($users){
                $numbers = $users->phone_numbers()->with('provider')->get();
                $numbers_with_icons = [];
                foreach ($numbers as $number){
                    $no = '<img src="'.$number->provider->logo.'" style="width:30px; height:30px;"/>'.' '.$number->phone_number;
                    array_push($numbers_with_icons, $no);
                }
                return implode('<br>', $numbers_with_icons);
            })
            ->addColumn('transaction_count', function ($users){
                return $users->vendor_transactions()->count();
            })
            ->addColumn('action', function ($users) {
                return '<div class="dropdown dropdown-inline">
								<a href="" class="btn btn-sm btn-clean btn-icon" data-toggle="dropdown">
	                                <i class="la la-cog"></i>
	                            </a>
							  	<div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
									<ul class="nav nav-hoverable flex-column">
							    		<li class="nav-item"><a class="nav-link" href="'.route('admin.vendors.show',Crypt::encrypt($users->id)).'"><i class="nav-icon la la-user"></i><span class="nav-text">View Vendor Transactions</span></a></li>
							    		<li class="nav-item"><a class="nav-link" href="'.route('admin.vendors.edit',Crypt::encrypt($users->id)).'"><i class="nav-icon la la-edit"></i><span class="nav-text">Edit Details</span></a></li>
							    		<li class="nav-item"><a class="nav-link" href="#"><i class="nav-icon la la-stop-circle"></i><span class="nav-text">Suspend Vendor</span></a></li>
							    	</ul>
							  	</div>
							</div>

						';
            })
            ->rawColumns(['phone_numbers', 'action'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $providers = Provider::all();
        return view('admin.vendors.create', compact('providers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' =>  'required|regex:/^[a-zA-Z]+$/u|min:4|max:12',
            'last_name' =>  'required|regex:/^[a-zA-Z]+$/u|min:4|max:12',
            'email' => 'required|email|unique:users',
            'phone_number'=> 'required|regex:/[0-9]/|not_regex:/[a-z]/|min:9|max:15',
            'password' => 'required',
            'provider_id' => 'required|exists:providers,id',
        ]);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }
        $input = $request->only(
            'first_name', 'last_name', 'email', 'password', 'provider_id'
        );
        $input['password'] = Hash::make($input['password']);
        // remove non digits including spaces, - and +
        $phone_number = preg_replace("/[^0-9]/", "", $request->get('phone_number'));
        try {
            $vendor = User::create([
                'first_name' => $input['first_name'],
                'last_name' => $input['last_name'],
                'email' => $input['email'],
                'password' => $input['password'],
                'is_active' => true,
                'passcode' => mt_rand(1000,9999)
            ]);
            $vendor->assignRole('vendor');
            $vendor->phone_numbers()->create([
                'provider_id'=>$input['provider_id'],
                'phone_number' => $phone_number,
                'user_default' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
            return Redirect::route('admin.vendors.index')->with('flash_success', 'Vendor created successfully');
        } catch (\Exception $exception) {
            return Redirect::route('admin.vendors.create')->with('error', 'Something went wrong')->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $id = Crypt::decrypt($id);
            $user = User::findOrFail($id);
            $phones = $user->phone_numbers()->where('user_id','=', $id)->get();
            $totalTransaction = $this->getUserTotalTransaction($user->id);
            $transactionCount = $this->transactionCount($user->id);
            return view('admin.vendors.show',compact('user','phones','totalTransaction','transactionCount'));
        }
        catch (ModelNotFoundException $e) {
            return $e;
        }
    }
    //chart
    public function getMonthlyTransactionsVendors($month, $year, $vendor_id) {
        $monthly_post_count_array = array();
        $monthly_transaction = array();
        $day_mon_array = $this->getAllMonthsDays($month,$year,$vendor_id);
        $days_array = $day_mon_array['days_array'];
        $month = $day_mon_array['month'];
        $days_array_dates = $day_mon_array['days_array_dates'];
        $month_name_array = array();
        $month_name_array_dates = array();

        if ( ! empty( $days_array ) ) {
            foreach ( $days_array as $day_no => $day_name ){
                $monthly_post_count = $this->getMonthlyAmountCounts( $day_no ,$month,$year,$vendor_id);
                $monthly_count = $this->getDailyAmountCounts( $day_no ,$month,$year,$vendor_id);
                array_push( $monthly_post_count_array, $monthly_post_count );
                array_push( $monthly_transaction, $monthly_count );
                array_push( $month_name_array, $day_name );
            }
            foreach ( $days_array_dates as $day_no => $day_namee ){
                array_push( $month_name_array_dates, $day_namee );
            }
        }
        if (!empty($monthly_post_count_array)){
            $max_no = max( $monthly_post_count_array );
            $max = round(( $max_no + 10/2 ) / 10 ) * 10;
        }else{
            $max_no = $max = 0;
        }
        if (!empty($monthly_transaction)){
            $max_no_daily = max( $monthly_transaction );
            $max_daily = round(( $max_no_daily + 10/2 ) / 10 ) * 10;
        }else{
            $max_no_daily = $max_daily = 0;
        }

        return array(
            'months' => $month_name_array,
            'labels' => $month_name_array_dates,
            'comments' => $monthly_post_count_array,
            'ubuntus' => $monthly_post_count_array,
            'max_Y_axis' => $max,
            'max_daily' => $max_daily,
            'daily_count' => $monthly_transaction,
        );
    }

    function getAllMonthsDays($month,$yr,$vendor_id){
        if (!$yr){
            $year = Carbon::now()->year;
        }
        if ($yr){
            $year=$yr;
        }
        $days_array = array();
        $days_array_dates = array();
        $posts_dates = Transaction::whereMonth( 'created_at',$month )
            ->whereYear('created_at', $year)
            ->where('vendor_id', $vendor_id)
            ->orderBy('created_at','asc')
            ->pluck( 'created_at');
        $posts_dates = json_decode( $posts_dates );
        if ( ! empty( $posts_dates ) ) {
            foreach ( $posts_dates as $unformatted_date ) {
                try {
                    $date = new \DateTime($unformatted_date);
                } catch (\Exception $e) {
                }
                $day_dates = Carbon::parse($date)->isoFormat('MMM Do');
                $day_no = $date->format( 'd' );
                $day_name = $date->format( 'D' );
                $days_array[ $day_no ] = $day_name;
                $days_array_dates[ $day_dates ] = $day_dates;
            }
        }
        $days_array = array(
            'days_array' => $days_array,
            'month' => $month,
            'days_array_dates' => $days_array_dates,
        );
        return $days_array;
    }
    function getMonthlyAmountCounts($day,$month,$yr,$vendor_id) {
        if (!$yr){
            $year = Carbon::now()->year;
        }
        if ($yr){
            $year=$yr;
        }
        return Transaction::whereDay( 'created_at', $day)
            ->whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->where('vendor_id', $vendor_id)
            ->get()
            ->sum('amount');
    }
    function getDailyAmountCounts($day,$month,$yr,$vendor_id) {
        if (!$yr){
            $year = Carbon::now()->year;
        }
        if ($yr){
            $year=$yr;
        }
        return Transaction::whereDay( 'created_at', $day)
            ->whereMonth('created_at', $month)
            ->where('vendor_id', $vendor_id)
            ->whereYear('created_at', $year)
            ->count();
    }

    function getUserTotalTransaction($id) {
        $transaction = Transaction ::where( 'vendor_id', $id)
            ->get();
        return $transaction->sum('amount');
    }
    function transactionCount($id) {
        return Transaction ::where( 'vendor_id', $id)
            ->count();
    }
    public function getVendorsTransactions($id)
    {
        $transactions = Transaction::where('vendor_id',$id)->get();
        return Datatables::of($transactions)
            ->addColumn('phone_number', function ($transactions){
                return $transactions->transactionable->customer_msisdn;
            })
            ->addColumn('transaction', function ($transactions){
                return $transactions->reference_number;
            })
            ->addColumn('amount', function ($transactions){
                return $transactions->amount;
            })
            ->addColumn('date', function ($transactions){
                return $transactions->created_at->format('d M Y');
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $id = Crypt::decrypt($id);
          $provider = User::findOrFail($id);
            $phones = $provider->phone_numbers()->where('user_id','=', $id)->get();
            //return  $phones;
            return view('admin.vendors.edit',compact('provider','phones'));
        }
        catch (ModelNotFoundException $e) {
            return $e;
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'phone_number'=> 'required',
        ]);

        if ($validator->fails()) {
            return back()->with('flash_error', 'Error updating the vendor');
         // return redirect()->route('admin.vendors.edit')->withErrors($validator)->withInput();
        }
        try {
            $user = User::findOrFail($id);
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->save();

            PhoneNumber::where('user_id', $id)->update(['phone_number' => $request->phone_number]);
            return redirect()->route('admin.vendors.index')->with('flash_success', 'Vendor Updated successfully');
        }
        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Vendor Not Found');
        }
    }

    /**
     * Suspend Vendor.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
