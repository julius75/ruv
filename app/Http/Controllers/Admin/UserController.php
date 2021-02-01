<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

    public function getUserss()
    {
       // $users = User::select('*');
        $records = User::get();
        foreach($records as $record){
            $id = $record->id;
            $first_name = $record->first_name;
            $last_name = $record->last_name;
            $email = $record->email;
            $is_active = $record->is_active;

            $data_arr[] = array(
                "id" => $id,
                "first_name" => $first_name,
                "last_name" => $last_name,
                "email" => $email,
                "Status" => 4,
                "Actions"=> null
            );
        }

        $response = array(
            "data" => $data_arr
        );

        echo json_encode($response);
        exit;
    }
    public function getBelongsToMany(Request $request)
    {
        if ($request->ajax()) {
            $query = User::with('phone_numbers')->select('users.*');

            return $this->dataTable
                ->eloquent($query)
                ->addColumn('title', function (User $user) {
                    return $user->phone_numbers->map(function($post) {
                        return str_limit($post->phone_number, 30, '...');
                    })->implode('<br>');
                })
                ->make(true);
        }
    }

    public function getUsers()
    {
        //$posts = App\Post::with('author')->get();
        $users = User::with('phone_numbers')->get();
       // $users =  User::get();
        return Datatables::of($users)
            ->addColumn('action', function ($user) {
               // return '<a href="#edit-'.$user->id.'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
                return '<div class="dropdown dropdown-inline">
								<a href="" class="btn btn-sm btn-clean btn-icon" data-toggle="dropdown">
	                                <i class="la la-cog"></i>
	                            </a>
							  	<div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
									<ul class="nav nav-hoverable flex-column">
							    		<li class="nav-item"><a class="nav-link" href="edit/'.$user->id.'"><i class="nav-icon la la-edit"></i><span class="nav-text">Edit Details</span></a></li>
							    		<li class="nav-item"><a class="nav-link" href="update/'.$user->id.'"><i class="nav-icon la la-leaf"></i><span class="nav-text">Update Status</span></a></li>
							    		<li class="nav-item"><a class="nav-link" href="print'.$user->id.'"><i class="nav-icon la la-print"></i><span class="nav-text">Print</span></a></li>
									</ul>
							  	</div>
							</div>
							<a href="#edit-'.$user->id.'" class="btn btn-sm btn-clean btn-icon" title="Edit details">
								<i class="la la-edit"></i>
							</a>
							<a href="#edit-'.$user->id.'" class="btn btn-sm btn-clean btn-icon" title="Delete">
								<i class="la la-trash"></i>
							</a>
						';
            })

            ->make(true);
        //return Datatables::of($users)->make();
    }

    public function getEmployees(Request $request){
        // Fetch records
        $records = User::get();
        dd($records);
        $data_arr = array();

        foreach($records as $record){
            $id = $record->id;
            $username = $record->username;
            $name = $record->name;
            $email = $record->email;

            $data_arr[] = array(
                "id" => $id,
                "username" => $username,
                "name" => $name,
                "email" => $email
            );
        }

        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr
        );

        echo json_encode($response);
        exit;
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
