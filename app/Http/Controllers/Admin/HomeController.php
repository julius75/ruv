<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Provider;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

    /**
     * Get Teleco Providers View
     *
     * @return \Illuminate\Http\Response
     */
    public function viewProviders()
    {
        return view('admin.providers.index');
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
            'month' => $month_name_array_dates,
            'post_count_data' => $monthly_post_count_array,
            'max' => $max,
            'max_daily' => $max_daily,
            'daily_count' => $monthly_transaction,
        );
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

    function getAllMonthsDays($month,$yr){
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
    function getAllMonthsTransaction(){
        $year = Carbon::now()->year;
        $posts_dates = Transaction::whereYear('created_at', $year)
            ->orderBy('created_at','asc')
            ->pluck( 'created_at');

        $posts_dates = json_decode( $posts_dates );
        if ( ! empty( $posts_dates ) ) {
            foreach ( $posts_dates as $unformatted_date ) {
                try {
                    $date = new \DateTime($unformatted_date);
                } catch (\Exception $e) {
                }
                $day_dates = $date->format( 'F' );
                $day_no = $date->format( 'm' );
                $day_name = $date->format( 'M' );
                $days_array[ $day_no ] = $day_name;
                $days_array_dates[ $day_dates ] = $day_dates;
            }
        }
        $days_array = array(
            'months_array' => $days_array,
            'months_arrays_names' => $days_array_dates,
        );
        return $days_array;
    }
    function getAllMonthsUsers(){
        $year = Carbon::now()->year;
        $posts_dates = User::whereYear('created_at', $year)
            ->orderBy('created_at','asc')
            ->pluck( 'created_at');

        $posts_dates = json_decode( $posts_dates );
        if ( ! empty( $posts_dates ) ) {
            foreach ( $posts_dates as $unformatted_date ) {
                try {
                    $date = new \DateTime($unformatted_date);
                } catch (\Exception $e) {
                }
                $day_dates = $date->format( 'F' );
                $day_no = $date->format( 'm' );
                $day_name = $date->format( 'M' );
                $days_array[ $day_no ] = $day_name;
                $days_array_dates[ $day_dates ] = $day_dates;
            }
        }
        $days_array = array(
            'months_array_users' => $days_array,
            'months_arrays_names_users' => $days_array_dates,
        );
        return $days_array;
    }

    function getMonthlyAmountCounts($day,$month,$yr) {
        if (!$yr){
            $year = Carbon::now()->year;
        }
        if ($yr){
            $year=$yr;
        }
        return Transaction::whereDay( 'created_at', $day)
            ->whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->get()
            ->sum('amount');
    }
    function getMonthsTransactionsTotal($month) {
            $year = Carbon::now()->year;
        return Transaction::whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->get()
            ->sum('amount');
    }
    function getMonthsUsersTotal($month) {
        $year = Carbon::now()->year;
        return User::whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->count();
    }

    function getDailyAmountCounts($day,$month,$yr) {
        if (!$yr){
            $year = Carbon::now()->year;
        }
        if ($yr){
            $year=$yr;
        }
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

    //weekly filters
    function getMonthlyPostDataWeekly($month, $year=null) {
       if ($month == 2){
           $monthly_post_count_array = array();
           $monthly_transaction = array();
           $day_mon_array = $this->getAllMonthsDays($month,$year);
           $days_array = $day_mon_array['days_array'];
           $month = $day_mon_array['month'];
           $days_array_dates = $day_mon_array['days_array_dates'];

           //get users
           $users_days_array = $this->getAllWeeklyUsersDaysMonthly();
           $days_array_users = $users_days_array['users_days_array'];
           $days_array_dates_users = $users_days_array['users_days_array_dates'];


           $month_name_array = array();
           $month_name_array_dates = array();
           $total = $this->getTotalMonthlyAmount();

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

           //for users
           $week_name_array_users = array();

           $weekly_post_count_array_users = array();
           $weekly_transaction_users = array();
           if ( ! empty( $days_array_users ) ) {
               foreach ( $days_array_users as $day_no_user => $day_name_user ){
                   $week_post_count_users = $this->getUsersCountsMonthly($day_no_user);
                   array_push( $weekly_post_count_array_users, $week_post_count_users );

                   array_push( $week_name_array_users, $day_name_user );
               }
               foreach ( $days_array_dates_users as $day_no_user => $day_name_users ){
                   array_push( $weekly_transaction_users, $day_name_users );
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
           if (!empty($weekly_post_count_array_users)){
               //max users
               $max_no_daily_users = max( $weekly_post_count_array_users );
               $max_daily_users = round(( $max_no_daily_users + 10/2 ) / 10 ) * 10;
           }else{
               $max_no_daily_users = $max_daily_users = 0;
           }

           $daily_post_data_array = array(
               'text'=>'Weekly Transaction',
               'months' => $month_name_array,
               'labels' => $month_name_array_dates,
               'labels_users' => $weekly_transaction_users,
               'comments' => $monthly_post_count_array,
               'categories_users' => $weekly_post_count_array_users,
               'max_Y_axis' => $max,
               'total_new_users'=>array_sum($weekly_post_count_array_users),
               'max_users' => $max_daily_users,
               'max_daily' => $max_daily,
               'daily_count' => $monthly_transaction,
               'total_weekly_amount'=>number_format($total),
           );
       }
        if ($month == 2021){
            $monthly_post_count_array = array();
            $monthly_transaction = array();
            $months_names = $this->getAllMonthsTransaction();
            $months_arrays_names = $months_names['months_arrays_names']; //x-axis-transcations
            $month_name = $months_names['months_array']; //months ie 2

            $monthly_transaction_count = array();
            $months_arrays_name_users = array();
            $months_arrays_name_transaction = array();

//here
            if ( ! empty( $month_name ) ) {
                foreach ( $month_name as $month_no => $day_name ){
                    $monthly_post_count = $this->getMonthsTransactionsTotal( $month_no);
                    array_push( $monthly_transaction_count, $monthly_post_count );
                }
                foreach ( $months_arrays_names as $months_arrays_name => $day_namee ){
                    array_push( $months_arrays_name_transaction, $day_namee );
                }

            }
            //users
            $monthly_users_count = array();

            $months_names_users = $this->getAllMonthsUsers();

            $months_arrays_users = $months_names_users['months_arrays_names_users']; //x-axis-users
            $month_users = $months_names_users['months_array_users']; //months ie 2

            if ( ! empty( $month_users ) ) {
                foreach ( $month_users as $month_user => $day_names ){
                    $monthly_count_users = $this->getMonthsUsersTotal($month_user);
                    array_push( $monthly_users_count, $monthly_count_users );
                }
                foreach ( $months_arrays_users as $months_arrays_name => $day_namee ){
                    array_push( $months_arrays_name_users, $day_namee );
                }
            }
            $total_transactions = array_sum($monthly_transaction_count);
            $total_users = array_sum($monthly_users_count);

            if (!empty($monthly_users_count)){
                $max_no = max( $monthly_users_count );
                $max = round(( $max_no + 10/2 ) / 10 ) * 10;
            }else{
                $max_no = $max = 0;
            }
            if (!empty($monthly_transaction_count)){
                $max_no = max( $monthly_transaction_count );
                $max = round(( $max_no + 10/2 ) / 10 ) * 10;
            }else{
                $max_no = $max = 0;
            }
            $daily_post_data_array = array(
                'months' => $months_arrays_name_users,
                'labels' => $months_arrays_name_transaction,
                'labels_users' => $months_arrays_name_users,
                'comments' => $monthly_transaction_count,
                'categories_users' => $monthly_users_count,
                'max_Y_axis' => $max,
                'total_new_users'=>$total_users,
                'max_users' => $max_no,
                'max_daily' => $max_no,
                'daily_count' => $monthly_transaction,
                'total_weekly_amount'=>$total_transactions,
            );
        }

        else{
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
           if (!empty($weekly_post_count_array_users)){
               //max users
               $max_no_daily_users = max( $weekly_post_count_array_users );
               $max_daily_users = round(( $max_no_daily_users + 10/2 ) / 10 ) * 10;
           }else{
               $max_no_daily_users = $max_daily_users = 0;
           }

           $daily_post_data_array = array(
               'text'=>'Weekly Transaction',
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
               'total_weekly_amount'=>number_format($total),
           );
       }
        return $daily_post_data_array;
    }

    function getAllMonthsDaysWeekly(){
        $days_array = array();
        $days_array_dates = array();
        $posts_dates = Transaction ::whereBetween('created_at', [Carbon::now()->startOfWeek(),Carbon::now()->endOfWeek()])
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

    function getTotalMonthlyAmount() {
        $weekly_count = Transaction ::whereBetween('created_at', [Carbon::now()->startOfMonth(),Carbon::now()->endOfMonth()])
            ->get();
        return $weekly_count->sum('amount');
    }

    function getTotalWeeklyUsers() {
        $weekly_count = User::whereBetween('created_at', [Carbon::now()->startOfWeek(),Carbon::now()->endOfWeek()])
            ->orderBy('created_at','asc')
            ->get();
        return $weekly_count->sum('id');
    }
    //all users
    function getAllWeeklyUsersDays(){
        $days_array = array();
        $days_array_dates = array();
        $posts_dates = User::whereBetween('created_at', [Carbon::now()->startOfWeek(),Carbon::now()->endOfWeek()])
            ->orderBy('created_at','asc')
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

    function getUsersCountsMonthly($day) {
        $days = User::whereBetween('created_at', [Carbon::now()->startOfMonth(),Carbon::now()->endOfMonth()])
            ->whereDay( 'created_at', $day)
            ->get();
        return $days->count('id');
    }
    //all users monthly
    function getAllWeeklyUsersDaysMonthly(){
        $days_array = array();
        $days_array_dates = array();
        $posts_dates = User::whereBetween('created_at', [Carbon::now()->startOfMonth(),Carbon::now()->endOfMonth()])
            ->orderBy('created_at','asc')
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
}
