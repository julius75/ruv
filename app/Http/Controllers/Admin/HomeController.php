<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    function getAllMonthsDays($month){
        $days_array = array();
        $days_array_dates = array();
        $posts_dates = Transaction::whereMonth( 'created_at',$month )->orderBy('created_at','asc')->pluck( 'created_at');
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
    function getMonthlyAmountCounts($day,$month) {
        $monthly_post_count = Transaction::whereDay( 'created_at', $day)
            ->whereMonth('created_at', $month)
            ->get();
        return $monthly_post_count->sum('amount');
    }
    function getDailyAmountCounts($day,$month) {
        $monthly_count = Transaction::whereDay( 'created_at', $day)
            ->whereMonth('created_at', $month)
            ->count();
        return $monthly_count;
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

    function getMonthlyPostDataEngagement($month, $year=null) {
        //$month = Carbon::now()->format('m');
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
     //if(!empty($me)) $max = max($me);
        $max_no_daily = max( $monthly_transaction );
        $max_daily = round(( $max_no_daily + 10/2 ) / 10 ) * 10;

        $daily_post_data_array = array(
            'months' => $month_name_array,
            'labels' => $month_name_array_dates,
            'comments' => $monthly_post_count_array,
            'ubuntus' => $monthly_post_count_array,
            'max_Y_axis' => $max,
            'max_daily' => $max_daily,
            'daily_count' => $monthly_transaction,
        );
        return $daily_post_data_array;
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


    /**
     * Demo methods below
     */

    // Datatables
    public function datatables()
    {
        $page_title = 'Datatables';
        $page_description = 'This is datatables test page';

        return view('admin.datatables', compact('page_title', 'page_description'));
    }

    // KTDatatables
    public function ktDatatables()
    {
        $page_title = 'KTDatatables';
        $page_description = 'This is KTdatatables test page';

        return view('admin.ktdatatables', compact('page_title', 'page_description'));
    }

    // Select2
    public function select2()
    {
        $page_title = 'Select 2';
        $page_description = 'This is Select2 test page';

        return view('admin.select2', compact('page_title', 'page_description'));
    }

    // jQuery-mask
    public function jQueryMask()
    {
        $page_title = 'jquery-mask';
        $page_description = 'This is jquery masks test page';

        return view('admin.jquery-mask', compact('page_title', 'page_description'));
    }

    // custom-icons
    public function customIcons()
    {
        $page_title = 'customIcons';
        $page_description = 'This is customIcons test page';

        return view('admin.icons.custom-icons', compact('page_title', 'page_description'));
    }

    // flaticon
    public function flaticon()
    {
        $page_title = 'flaticon';
        $page_description = 'This is flaticon test page';

        return view('admin.icons.flaticon', compact('page_title', 'page_description'));
    }

    // fontawesome
    public function fontawesome()
    {
        $page_title = 'fontawesome';
        $page_description = 'This is fontawesome test page';

        return view('admin.icons.fontawesome', compact('page_title', 'page_description'));
    }

    // lineawesome
    public function lineawesome()
    {
        $page_title = 'lineawesome';
        $page_description = 'This is lineawesome test page';

        return view('admin.icons.lineawesome', compact('page_title', 'page_description'));
    }

    // socicons
    public function socicons()
    {
        $page_title = 'socicons';
        $page_description = 'This is socicons test page';

        return view('admin.icons.socicons', compact('page_title', 'page_description'));
    }

    // svg
    public function svg()
    {
        $page_title = 'svg';
        $page_description = 'This is svg test page';

        return view('admin.icons.svg', compact('page_title', 'page_description'));
    }

    // Quicksearch Result
    public function quickSearch()
    {
        return view('admin.partials.extras._quick_search_result');
    }
}
