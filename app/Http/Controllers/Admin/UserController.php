<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\SendSms;
use App\Mail\Passcode;
use App\Models\Admin;
use App\Models\PhoneNumber;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
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
        return view('admin.users.index', compact('page_title', 'page_description'));
    }

    /**
     * Get Users DataTable
     *
     * @return \Illuminate\Http\Response
     */
    public function getUsers()
    {
        $users = User::role('user')->get();
        return Datatables::of($users)
            ->addColumn('default_phone_number', function ($users){
                return $users->phone_numbers()->where('user_default','=', true)->first()->phone_number ?? '-';
            })
            ->addColumn('action', function ($users) {
                return '<div class="dropdown dropdown-inline">
								<a href="" class="btn btn-sm btn-clean btn-icon" data-toggle="dropdown">
	                                <i class="la la-cog"></i>
	                            </a>
							  	<div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
									<ul class="nav nav-hoverable flex-column">
							    		<li class="nav-item"><a class="nav-link" href="'.route('admin.app-users.show',Crypt::encrypt($users->id)).'"><i class="nav-icon la la-user"></i><span class="nav-text">View User Details</span></a></li>
							    		<li class="nav-item"><a class="nav-link" href="'.route('admin.app-users.edit',Crypt::encrypt($users->id)).'"><i class="nav-icon la la-edit"></i><span class="nav-text">Edit Details</span></a></li>
							    		<li class="nav-item"><a class="nav-link" href="update/'.$users->id.'"><i class="nav-icon la la-leaf"></i><span class="nav-text">Update Status</span></a></li>
							    		<li class="nav-item"><a class="nav-link" href="#"><i class="nav-icon la la-stop-circle"></i><span class="nav-text">Block User</span></a></li>
							    	</ul>
							  	</div>
							</div>

						';
            })
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' =>  'required|regex:/^[a-zA-Z]+$/u|min:4|max:12',
            'last_name' =>  'required|regex:/^[a-zA-Z]+$/u|min:4|max:12',
            'email' => 'required|email|unique:users',
            'is_active' => 'required',
            'phone_number'=> 'required|regex:/[0-9]/|not_regex:/[a-z]/|min:9|max:15',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $input = $request->only(
            'first_name', 'last_name', 'email', 'password'
        );

        $input['password'] = Hash::make($input['password']);
        // remove non digits including spaces, - and +
        $phone_number = preg_replace("/[^0-9]/", "", $request->get('phone_number'));
        try {
            //$passcode = $this->passcode();
            $user = User::create([
                'first_name' => $input['first_name'],
                'last_name' => $input['last_name'],
                'email' => $input['email'],
                'password' => $input['password'],
                'is_active' => true,
                'online' => true,
                'passcode' => mt_rand(1000,9999)
            ]);

            $user->assignRole('user');

            $user->phone_numbers()->create([
                'phone_number' => $phone_number,
                'user_default' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
            return redirect()->route('admin.app-users.index')->with('flash_success', 'User created successfully');
        } catch (\Exception $exception) {
            return redirect()->route('admin.app-users.create')->with('error', 'Something went wrong');
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
            return view('admin.users.show',compact('user','phones','totalTransaction','transactionCount'));
        } catch (ModelNotFoundException $e) {
            return $e;
        }

    }
    function getUserTotalTransaction($id) {
        $transaction = Transaction ::where( 'user_id', $id)
            ->get();
        return $transaction->sum('amount');
    }
    function transactionCount($id) {
        return Transaction ::where( 'user_id', $id)
            ->count();
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
            $user = User::findOrFail($id);
            $phones = $user->phone_numbers()->where('user_id','=', $id)->get();
            return view('admin.users.edit',compact('user','phones'));
        } catch (ModelNotFoundException $e) {
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
            return back()->with('flash_error', 'User Not Found');
//            return redirect()->route('admin.app-users.edit')->withErrors($validator)->withInput();
        }

        try {
            $user = User::findOrFail($id);
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->save();

            PhoneNumber::where('user_id', $id)
                ->update(['phone_number' => $request->phone_number]);
            return redirect()->route('admin.app-users.index')->with('flash_success', 'User Updated successfully');
        }
        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'User Not Found');
        }
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
