<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Provider;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $first_letter = ucfirst(substr($user->username, 0, 1));
        $page_title = 'Dashboard';
        $page_description = 'Some description for the page';
        return view('admin.dashboard', compact('page_title', 'page_description','user','first_letter'));
    }

    function getMonthlyPostData() {
        $month = Carbon::now()->format('m');
        $monthly_post_count_array = array();
        $monthly_transaction = array();
        $day_mon_array = $this->getAllMonthsDays($month);
        $days_array = $day_mon_array['days_array'];
        $month = $day_mon_array['month'];
        $days_array_dates = $day_mon_array['days_array_dates'];
        $month_name_array = array();
        $month_name_array_dates = array();

        if ( ! empty( $days_array ) ) {
            foreach ( $days_array as $day_no => $day_name ){
                $monthly_post_count = $this->getMonthlyAmountCounts( $day_no ,$month);
                $monthly_count = $this->getDailyAmountCounts( $day_no ,$month);
                array_push( $monthly_post_count_array, $monthly_post_count );
                array_push( $monthly_transaction, $monthly_count );

                array_push( $month_name_array, $day_name );
            }
            foreach ( $days_array_dates as $day_no => $day_namee ){
                array_push( $month_name_array_dates, $day_namee );
            }
        }
        $max_no = max( $monthly_post_count_array );
        $max = round(( $max_no + 10/2 ) / 10 ) * 10;

        $max_no_daily = max( $monthly_transaction );
        $max_daily = round(( $max_no_daily + 10/2 ) / 10 ) * 10;
        $daily_post_data_array = array(
            'months' => $month_name_array,
            'month' => $month_name_array_dates,
            'post_count_data' => $monthly_post_count_array,
            'max' => $max,
            'max_daily' => $max_daily,
            'daily_count' => $monthly_transaction,
        );
        return $daily_post_data_array;
    }

    /*
    * Dashboard's Transactions Chart Data
    */
    public function getMonthlyTransactionsData($month, $year) {
        $monthly_post_count_array = array();
        $monthly_transaction = array();
        $day_mon_array = $this->getAllMonthsDays($month,$year);
        $days_array = $day_mon_array['days_array'];
        $month = $day_mon_array['month'];
        $days_array_dates = $day_mon_array['days_array_dates'];
        $month_name_array = array();
        $month_name_array_dates = array();

        if ( ! empty( $days_array ) ) {
            foreach ( $days_array as $day_no => $day_name ){
                $monthly_post_count = $this->getMonthlyAmountCounts( $day_no ,$month,$year);
                $monthly_count = $this->getDailyAmountCounts( $day_no ,$month,$year);
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

    function getAllMonthsDays($month,$year){
        $days_array = array();
        $days_array_dates = array();
        $posts_dates = Transaction::whereMonth( 'created_at',$month )
            ->whereYear('created_at', $year)
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

    function getMonthlyAmountCounts($day,$month,$year) {
        return Transaction::whereDay( 'created_at', $day)
            ->whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->get()
            ->sum('amount');
    }

    function getDailyAmountCounts($day,$month,$year) {
        return Transaction::whereDay( 'created_at', $day)
            ->whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->count();
    }

    function getMonthlyAmountCountsEngagement($day,$month) {
        $monthly_post_count = Transaction::whereDay( 'created_at', $day)
            ->whereMonth('created_at', $month)
            ->get();
        return $monthly_post_count->sum('amount');
    }

    function getDailyAmountCountsEngagement($day,$month) {
        $monthly_count = Transaction::whereDay( 'created_at', $day)
            ->whereMonth('created_at', $month)
            ->count();
        return $monthly_count;
    }

    public function viewProviders()
    {
        return view('admin.providers.index');
    }
    //weekly filters
    function getMonthlyPostDataWeekly($month=null, $year=null) {
        //$month = Carbon::now()->format('m');

        $monthly_post_count_array = array();
        $monthly_transaction = array();
        $day_mon_array = $this->getAllMonthsDaysWeekly();
        $days_array = $day_mon_array['days_array'];
        $days_array_dates = $day_mon_array['days_array_dates'];
        //get users
        $users_days_array = $this->getAllWeeklyUsersDays();
        $days_array_users = $users_days_array['users_days_array'];
        $days_array_dates_users = $users_days_array['users_days_array_dates'];

        $total = $this->getTotalWeeklyAmount();
        $month_name_array = array();
        $month_name_array_dates = array();

        if ( ! empty( $days_array ) ) {
            foreach ( $days_array as $day_no => $day_name ){
                $monthly_post_count = $this->getMonthlyAmountCountsWeekly($day_no);
                $monthly_count = $this->getDailyAmountCounts( $day_no ,$month,$year);
                array_push( $monthly_post_count_array, $monthly_post_count );
                array_push( $monthly_transaction, $monthly_count );

                array_push( $month_name_array, $day_name );
            }
            foreach ( $days_array_dates as $day_no => $day_namee ){
                array_push( $month_name_array_dates, $day_namee );
            }
        }
        //for users
        $week_name_array_users = array();

        $weekly_post_count_array_users = array();
        $weekly_transaction_users = array();
        if ( ! empty( $days_array_users ) ) {
            foreach ( $days_array_users as $day_no_user => $day_name_user ){
                $week_post_count_users = $this->getUsersCountsWeekly($day_no_user);
                array_push( $weekly_post_count_array_users, $week_post_count_users );

                array_push( $week_name_array_users, $day_name_user );
            }
            foreach ( $days_array_dates_users as $day_no_user => $day_name_users ){
                array_push( $weekly_transaction_users, $day_name_users );
            }
        }
        $total_users = array_sum($weekly_post_count_array_users);
        $max_no = max( $monthly_post_count_array );

        $max = round(( $max_no + 10/2 ) / 10 ) * 10;
        //if(!empty($me)) $max = max($me);
        $max_no_daily = max( $monthly_transaction );
        $max_daily = round(( $max_no_daily + 10/2 ) / 10 ) * 10;

        //max users
        $max_no_daily_users = max( $weekly_post_count_array_users );
        $max_daily_users = round(( $max_no_daily_users + 10/2 ) / 10 ) * 10;

        $daily_post_data_array = array(
            'months' => $month_name_array,
            'labels' => $month_name_array_dates,
            'labels_users' => $weekly_transaction_users,
            'comments' => $monthly_post_count_array,
            'categories_users' => $weekly_post_count_array_users,
            'max_Y_axis' => $max,
            'total_new_users'=>$total_users,
            'max_users' => $max_daily_users,
            'max_daily' => $max_daily,
            'daily_count' => $monthly_transaction,
            'total_weekly_amount'=>$total,
        );
        return $daily_post_data_array;
    }

    function getAllMonthsDaysWeekly(){
        $days_array = array();
        $days_array_dates = array();
        $posts_dates = Transaction ::whereBetween('created_at', [Carbon::now()->startOfWeek(),Carbon::now()->endOfWeek()])
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
            'days_array_dates' => $days_array_dates,
        );
        return $days_array;
    }

    function getMonthlyAmountCountsWeekly($day) {
        $date = \Carbon\Carbon::today()->subDays(7);
        $days = Transaction ::whereBetween('created_at', [Carbon::now()->startOfWeek(),Carbon::now()->endOfWeek()])
            ->whereDay( 'created_at', $day)
            ->get();
        return $days->sum('amount');
    }

    function getTotalWeeklyAmount() {
        $weekly_count = Transaction ::whereBetween('created_at', [Carbon::now()->startOfWeek(),Carbon::now()->endOfWeek()])
            ->get();
        return $weekly_count->sum('amount');
    }

    function getTotalWeeklyUsers() {
        $weekly_count = User::whereBetween('created_at', [Carbon::now()->startOfWeek(),Carbon::now()->endOfWeek()])
            ->get();
        return $weekly_count->sum('id');
    }
    //all users
    function getAllWeeklyUsersDays(){
        $days_array = array();
        $days_array_dates = array();
        $posts_dates = User::whereBetween('created_at', [Carbon::now()->startOfWeek(),Carbon::now()->endOfWeek()])
            ->pluck( 'created_at');
        $days_array = array();
        $days_array_dates = array();

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
        $users_days_array = array(
            'users_days_array' => $days_array,
            'users_days_array_dates' => $days_array_dates,
        );
        return $users_days_array;
    }

    function getUsersCountsWeekly($day) {
        $days = User::whereBetween('created_at', [Carbon::now()->startOfWeek(),Carbon::now()->endOfWeek()])
            ->whereDay( 'created_at', $day)
            ->get();
        return $days->count('id');
    }

    /**
     * Get Teleco Providers DataTable
     *
     * @return \Illuminate\Http\Response
     */
    public function getProviders()
    {
        $providers = Provider::all();
        return Datatables::of($providers)
            ->addColumn('image', function ($providers){
                return '<img src="'.$providers->logo.'" style="width:90px; height:90px" alt="">';
            })
            ->editColumn('created_at', function ($providers){
                return Carbon::parse($providers->created_at)->format('Y-m-d h:i:s');
            })
            ->rawColumns(['image'])
            ->make(true);
    }
}
