<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class AdminController extends Controller
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
        return view('admin.users.index-admin-user', compact('page_title', 'page_description'));
    }

    public function getAdmins()
    {
        $users = Admin::all();
        return Datatables::of($users)
            ->addColumn('action', function ($users) {
                return '<div class="dropdown dropdown-inline">
								<a href="" class="btn btn-sm btn-clean btn-icon" data-toggle="dropdown">
	                                <i class="la la-cog"></i>
	                            </a>
							  	<div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
									<ul class="nav nav-hoverable flex-column">
							    		<li class="nav-item"><a class="nav-link" href="'.route('admin.app-admins.edit',Crypt::encrypt($users->id)).'"><i class="nav-icon la la-edit"></i><span class="nav-text">Edit Details</span></a></li>
							    		<li class="nav-item"><a class="nav-link" href="'.route('admin.app-admins.show',Crypt::encrypt($users->id)).'"><i class="nav-icon la la-print"></i><span class="nav-text">Show Details</span></a></li>
							    		<li class="nav-item"><a class="nav-link" href="update/'.$users->id.'"><i class="nav-icon la la-leaf"></i><span class="nav-text">Update Status</span></a></li>
							    		<li class="nav-item"><a class="nav-link" href="print'.$users->id.'"><i class="nav-icon la la-print"></i><span class="nav-text">Mark As InActive</span></a></li>
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
        return view('admin.users.create-admin-user');
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
                'name' => 'required',
                'username' => 'required',
                'email' => 'required',
                'phone_number' => 'required',
                'password' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect()->route('admin.app-admins.create')
                    ->withErrors($validator)
                    ->withInput();
            }
            // remove non digits including spaces, - and +
            $phone_number = preg_replace("/[^0-9]/", "", $request->get('phone_number'));
            try {
                //$passcode = $this->passcode();
                $user = Admin::create([
                    'name' => $request->name,
                    'username' =>$request->username,
                    'email' => $request->email,
                    'phone_number' => $request->phone_number,
                    'password' => Hash::make($request->password),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
                $user->assignRole('admin');

                return redirect()->route('admin.app-admins.index')->with('flash_success', 'Admin created successfully');
            } catch (\Exception $exception) {

                return back()->with('flash_error', 'Error Saving the Record...try again');

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
        $user = Admin::findOrFail($id);
       return view('admin.users.show-admin',compact('user'));
            }
    catch (ModelNotFoundException $e) {
        return $e;
         }
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
            $user = Admin::findOrFail($id);
            return view('admin.users.edit-admin-user',compact('user'));
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
            'name' => 'required',
            'username' => 'required',
            'email' => 'required',
            'phone_number' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.app-admins.create')
                ->withErrors($validator)
                ->withInput();
        }

        try {

            $admin = Admin::findOrFail($id);

            $admin->name = $request->name;
            $admin->username = $request->username;
            $admin->email = $request->email;
            $admin->phone_number = $request->name;
            $admin->password = Hash::make($request->password);
           $admin->updated_at = Carbon::now();

            $admin->save();
            return redirect()->route('admin.app-admins.index')->with('flash_success', 'Admin Updated successfully');
        }
        catch (ModelNotFoundException $e) {
            return back()->with('flash_error', 'Admin Record Not Found');
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
