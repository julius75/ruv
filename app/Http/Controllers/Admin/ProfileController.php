<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Transaction;
use Carbon\Carbon;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
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
        $user = Auth::user();
        return view('admin.custom.profile',compact('user'));
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'username' => 'required|max:255',
            'phone_number' => 'required|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|confirmed|min:8',

        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.profile.index')
                ->withErrors($validator)
                ->withInput();
        }

        try {

            $admin = Admin::findOrFail($request->id);
            $admin->name = $request->name;
            $admin->username = $request->username;
            $admin->email = $request->email;
            $admin->phone_number = $request->name;
            $admin->password = Hash::make($request->password);
            $admin->updated_at = Carbon::now();

            $admin->save();
            return redirect()->route('dashboard')->with('flash_success', 'Admin Details Updated successfully');
        }
        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Admin Record Not Updated...try again');
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
