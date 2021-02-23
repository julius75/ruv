<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Provider;
use App\Models\User;
use Carbon\Carbon;
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
							    		<li class="nav-item"><a class="nav-link" href="#"><i class="nav-icon la la-user"></i><span class="nav-text">View Vendor Transactions</span></a></li>
							    		<li class="nav-item"><a class="nav-link" href="#"><i class="nav-icon la la-edit"></i><span class="nav-text">Edit Details</span></a></li>
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
