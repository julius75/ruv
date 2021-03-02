@extends('admin.layout.master')
@section('sub-header')
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Dashboard</h5>
                <!--end::Page Title-->
                <!--begin::Actions-->
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <span class="text-muted font-weight-bold mr-4">#XRS-45670</span>
                <a href="#" class="btn btn-light-warning font-weight-bolder btn-sm">Add New</a>
                <!--end::Actions-->
            </div>
            <!--end::Info-->
            <!--begin::Toolbar-->
            <div class="d-flex align-items-center">
                <!--begin::Actions-->
                <a href="#" class="btn btn-clean btn-sm font-weight-bold font-size-base mr-1" id="weekly-graphs">Weekly</a>
                <a href="#" class="btn btn-clean btn-sm font-weight-bold font-size-base mr-1" id="monthly-graphs">Month</a>
                <a href="#" class="btn btn-clean btn-sm font-weight-bold font-size-base mr-1" id="yearly-graphs">Year</a>
                <!--end::Actions-->
                <!--begin::Daterange-->
                <a href="#" class="btn btn-sm btn-light font-weight-bold mr-2" id="kt_dashboard_daterangepicker" data-toggle="tooltip" title="Select dashboard daterange" data-placement="left">
                    <span class="text-muted font-size-base font-weight-bold mr-2" id="kt_dashboard_daterangepicker_title">Today</span>
                    <span class="text-primary font-size-base font-weight-bolder" id="kt_dashboard_daterangepicker_date">Aug 16</span>
                </a>
                <!--end::Daterange-->
                <!--begin::Dropdowns-->
                <div class="dropdown dropdown-inline" data-toggle="tooltip" title="Quick actions" data-placement="left">
                    <a href="#" class="btn btn-sm btn-clean btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											<span class="svg-icon svg-icon-success svg-icon-lg">
												<!--begin::Svg Icon | path:assets/media/svg/icons/Files/File-plus.svg-->
												<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
													<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
														<polygon points="0 0 24 0 24 24 0 24" />
														<path d="M5.85714286,2 L13.7364114,2 C14.0910962,2 14.4343066,2.12568431 14.7051108,2.35473959 L19.4686994,6.3839416 C19.8056532,6.66894833 20,7.08787823 20,7.52920201 L20,20.0833333 C20,21.8738751 19.9795521,22 18.1428571,22 L5.85714286,22 C4.02044787,22 4,21.8738751 4,20.0833333 L4,3.91666667 C4,2.12612489 4.02044787,2 5.85714286,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
														<path d="M11,14 L9,14 C8.44771525,14 8,13.5522847 8,13 C8,12.4477153 8.44771525,12 9,12 L11,12 L11,10 C11,9.44771525 11.4477153,9 12,9 C12.5522847,9 13,9.44771525 13,10 L13,12 L15,12 C15.5522847,12 16,12.4477153 16,13 C16,13.5522847 15.5522847,14 15,14 L13,14 L13,16 C13,16.5522847 12.5522847,17 12,17 C11.4477153,17 11,16.5522847 11,16 L11,14 Z" fill="#000000" />
													</g>
												</svg>
                                                <!--end::Svg Icon-->
											</span>
                    </a>
                    <div class="dropdown-menu p-0 m-0 dropdown-menu-md dropdown-menu-right py-3">
                        <!--begin::Navigation-->
                        <ul class="navi navi-hover py-5">
                            <li class="navi-item">
                                <a href="#" class="navi-link">
														<span class="navi-icon">
															<i class="flaticon2-drop"></i>
														</span>
                                    <span class="navi-text">New Group</span>
                                </a>
                            </li>
                            <li class="navi-item">
                                <a href="#" class="navi-link">
														<span class="navi-icon">
															<i class="flaticon2-list-3"></i>
														</span>
                                    <span class="navi-text">Contacts</span>
                                </a>
                            </li>
                            <li class="navi-item">
                                <a href="#" class="navi-link">
														<span class="navi-icon">
															<i class="flaticon2-rocket-1"></i>
														</span>
                                    <span class="navi-text">Groups</span>
                                    <span class="navi-link-badge">
															<span class="label label-light-primary label-inline font-weight-bold">new</span>
														</span>
                                </a>
                            </li>
                            <li class="navi-item">
                                <a href="#" class="navi-link">
														<span class="navi-icon">
															<i class="flaticon2-bell-2"></i>
														</span>
                                    <span class="navi-text">Calls</span>
                                </a>
                            </li>
                            <li class="navi-item">
                                <a href="#" class="navi-link">
														<span class="navi-icon">
															<i class="flaticon2-gear"></i>
														</span>
                                    <span class="navi-text">Settings</span>
                                </a>
                            </li>
                            <li class="navi-separator my-3"></li>
                            <li class="navi-item">
                                <a href="#" class="navi-link">
														<span class="navi-icon">
															<i class="flaticon2-magnifier-tool"></i>
														</span>
                                    <span class="navi-text">Help</span>
                                </a>
                            </li>
                            <li class="navi-item">
                                <a href="#" class="navi-link">
														<span class="navi-icon">
															<i class="flaticon2-bell-2"></i>
														</span>
                                    <span class="navi-text">Privacy</span>
                                    <span class="navi-link-badge">
															<span class="label label-light-danger label-rounded font-weight-bold">5</span>
														</span>
                                </a>
                            </li>
                        </ul>
                        <!--end::Navigation-->
                    </div>
                </div>
                <!--end::Dropdowns-->
            </div>
            <!--end::Toolbar-->
        </div>
    </div>
    <!--end::Subheader-->
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-xxl-6">
                <!--begin::Mixed Widget 1-->
                <div class="card card-custom card-stretch card-stretch-half gutter-b">
                    <!--begin::Body-->
                    <div class="card-body p-0">
                        <div class="d-flex align-items-center justify-content-between card-spacer flex-grow-1">
													<span class="symbol symbol-50 symbol-light-success mr-2">
														<span class="symbol-label">
															<span class="svg-icon svg-icon-xl svg-icon-success">
																<!--begin::Svg Icon | path:assets/media/svg/icons/Layout/Layout-4-blocks.svg-->
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																	<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																		<rect x="0" y="0" width="24" height="24"></rect>
																		<rect fill="#000000" opacity="0.3" x="13" y="4" width="3" height="16" rx="1.5"></rect>
																		<rect fill="#000000" x="8" y="9" width="3" height="11" rx="1.5"></rect>
																		<rect fill="#000000" x="18" y="11" width="3" height="9" rx="1.5"></rect>
																		<rect fill="#000000" x="3" y="13" width="3" height="7" rx="1.5"></rect>
																	</g>
																</svg>                                                                <!--end::Svg Icon-->
															</span>
														</span>
													</span>
                            <div class="d-flex flex-column text-right">
                                <span class="text-dark-75 font-weight-bolder font-size-h3 " id="week-total"><h1></h1></span>
                                <span class="text-muted font-weight-bold mt-2">Amount Transacted CFA Franc.</span>
                            </div>
                        </div>
                        <div class="card-rounded-bottom" data-color="success" style="height: 150px;background-color: #ffffff;">
                            <canvas id="chart-transaction" ></canvas>
                        </div>
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Mixed Widget 1-->
            </div>
            <div class="col-lg-6 col-xxl-6">
                <div class="card card-custom card-stretch card-stretch-half gutter-b">
                    <!--begin::Body-->
                    <div class="card-body p-0">
                        <div class="d-flex align-items-center justify-content-between card-spacer flex-grow-1">
													<span class="symbol symbol-50 symbol-light-primary mr-2">
														<span class="symbol-label">
															<span class="svg-icon svg-icon-xl svg-icon-primary">
																<!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Group.svg-->
																<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																	<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																		<polygon points="0 0 24 0 24 24 0 24" />
																		<path d="M18,14 C16.3431458,14 15,12.6568542 15,11 C15,9.34314575 16.3431458,8 18,8 C19.6568542,8 21,9.34314575 21,11 C21,12.6568542 19.6568542,14 18,14 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
																		<path d="M17.6011961,15.0006174 C21.0077043,15.0378534 23.7891749,16.7601418 23.9984937,20.4 C24.0069246,20.5466056 23.9984937,21 23.4559499,21 L19.6,21 C19.6,18.7490654 18.8562935,16.6718327 17.6011961,15.0006174 Z M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
																	</g>
																</svg>
                                                                <!--end::Svg Icon-->
															</span>
														</span>
													</span>
                            <div class="d-flex flex-column text-right">
                                <span class="text-dark-75 font-weight-bolder font-size-h3" id="week-total_users"></span>
                                <span class="text-muted font-weight-bold mt-2">New Registered Users</span>
                            </div>
                        </div>
                        <div class="card-rounded-bottom" data-color="success" style="height: 150px;background-color: #ffffff;">
                            <canvas id="chart-users"></canvas>
                        </div>
{{--                        <canvas   class="card-rounded-bottom" data-color="primary" height="180" ></canvas>--}}
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Stats Widget 12-->
            </div>

        </div>

        <div class="row">
            <div class="col-lg-12 order-1 order-xxl-2">
                <!--begin::List Widget 8-->
                <div class="card card-custom card-stretch gutter-b">
                    <div class="card-header">
                        <div class="card-title">
                            Airtime Purchases
                        </div>
                        <div class="card-toolbar">
                            <div class="col" style="min-width: 80px">
                                <?php
                                $currentYear = date('Y');
                                ?>
                                <select class="form-control transaction-year">
                                    @for ($year = $currentYear; $year > $currentYear-5; $year--)
                                        <option> {{$year}}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col">
                                <select class="form-control transaction-month">
                                    <?php
                                    $currentDate = date ('Y-m-d');
                                    $effectiveDate = date('Y-01-d', strtotime($currentDate));
                                    $december = date('Y-12-d', strtotime($currentDate));
                                    $currentMonth = date ('m');
                                    while($effectiveDate <= $december){
                                        $month = date('m', strtotime($effectiveDate));
                                        $monthInWords = date('M', strtotime($effectiveDate));
                                        $selected = $currentMonth == $month ? 'selected = "selected"' : null;
                                        echo '<option '.$selected.' value="'.$month.'">'.$monthInWords.'</option>';
                                        $effectiveDate = date('Y-m-d', strtotime("+1 months", strtotime($effectiveDate)));
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col">
                                <button class="btn btn-sm btn-success font-weight-bold" id="filter-transaction"> Filter <i class="fa fa-sm fa-sliders-h"></i></button>
                            </div>
                        </div>

                    </div>
                   <div class="card">
                        <div class="card-header py-3">
                            <div class="row d-flex justify-content-around">
                            </div>
                        </div>
                       <div class="card-body transaction-graph-card">
                            <div class="chart-bar"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                                <canvas id="transactionsChart" width="668" height="320" class="chartjs-render-monitor" style="display: block; width: 668px; height: 320px;"></canvas>
                            </div>
                        </div>
                   </div>
                </div>
                <!--end: Card-->
                <!--end::List Widget 8-->
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('assets/js/pages/chart.js')}}"></script>

    <script src="{{asset('assets/js/pages/create-bars.js')}}"></script>
    <script src="{{asset('assets/js/pages/create-chart-js-area-test-users.js')}}"></script>
    <script src="{{asset('assets/js/pages/create-chart-js-area-test-transaction.js')}}"></script>

    <script src="{{asset('assets/js/pages/crud/forms/widgets/bootstrap-datepicker.js')}}"></script>
    <script>
        Chart.defaults.global.defaultFontFamily = 'Poppins';
        /**
         * Transactions Graph and users weekly
         **/
        const spinners =
            `<div class="d-flex justify-content-around loading-spinner">
        <div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>`;

      //  let weekly = $(".weekly").val();
        $('.card-rounded-bottom').prepend(spinners);
        $.get('charts/analytics-area/', function(data) {
            $('#week-total').html(data.total_weekly_amount);
            $('#week-total_users').html(data.total_new_users);
            $('.card-rounded-bottom .loading-spinner').remove();
            drawEngagementGraphAreaUsers(data);
            drawEngagementGraphAreaTransactions(data);
        });
//filter
        $("#weekly-graphs").on("click", function() {
            $('.card-rounded-bottom .chart-bar').hide();
            $('.card-rounded-bottom').prepend(spinner);
            $.get('charts/analytics-area/', function(data) {
                $('.card-rounded-bottom .chart-bar').show(500);
                $('.card-rounded-bottom .loading-spinner').remove();
                $('#week-total').html(data.total_weekly_amount);
                $('#week-total_users').html(data.total_new_users);
                drawEngagementGraphAreaUsers(data);
                drawEngagementGraphAreaTransactions(data);

            });
        });
        $("#monthly-graphs").on("click", function() {
            $('.card-rounded-bottom .chart-bar').hide();
            $('.card-rounded-bottom').prepend(spinner);
            let monthly = 2;
            $.get('charts/analytics-area/' + monthly, function(data) {
                $('.card-rounded-bottom .chart-bar').show(500);
                $('.card-rounded-bottom .loading-spinner').remove();
                $('#week-total').html(data.total_weekly_amount);
                $('#week-total_users').html(data.total_new_users);
                drawEngagementGraphAreaUsers(data);
                drawEngagementGraphAreaTransactions(data);

            });
        });
        $("#yearly-graphs").on("click", function() {
            $('.card-rounded-bottom .chart-bar').hide();
            $('.card-rounded-bottom').prepend(spinner);
            let yr = 2021;
            $.get('charts/analytics-area/' + yr, function(data) {
                $('.card-rounded-bottom .chart-bar').show(500);
                $('.card-rounded-bottom .loading-spinner').remove();
                $('#week-total').html(data.total_weekly_amount);
                $('#week-total_users').html(data.total_new_users);
                drawEngagementGraphAreaUsers(data);
                drawEngagementGraphAreaTransactions(data);

            });
        });
    </script>

    <script>
        Chart.defaults.global.defaultFontFamily = 'Poppins';
        /**
         * Transactions Graph
         **/
        const spinner =
            `<div class="d-flex justify-content-around loading-spinner">
        <div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>`;

        // draw graph Discussion Engagement on page load
        let yearTransaction = $(".transaction-year").val();
        let monthTransaction = $(".transaction-month").val();
        $('.transaction-graph-card').prepend(spinner);
        $.get('charts/transaction-chart-analytics/' + monthTransaction + '/' + yearTransaction, function(data) {
            $('.transaction-graph-card .loading-spinner').remove();
            transactionsDrawGraph(data);
        });
        // on clicking filter
        $("#filter-transaction").on("click", function() {
            $('.transaction-graph-card .chart-bar').hide();
            $('.transaction-graph-card').prepend(spinner);

            let year = $(".transaction-year").val();
            let month = $(".transaction-month").val();

            $.get('charts/transaction-chart-analytics/' + month + '/' + year, function(data) {
                $('.transaction-graph-card .chart-bar').show(500);
                $('.transaction-graph-card .loading-spinner').remove();
                transactionsDrawGraph(data);
            });

        });

        function transactionsDrawGraph(data){
            var elementId="transactionsChart"
            var chartType="bar"
            var labels = data.labels
            var datasets = [
                {
                    label: "Number of Transactions",
                    type: 'line',
                    yAxisID: 'B',
                    lineTension: 0.3,
                    backgroundColor: "rgb(250,45,51, 0.6)",
                    borderColor: "#f9141b",
                    pointBorderColor: "#fff",
                    pointBackgroundColor: "#f9141b",
                    pointRadius: 5,
                    pointHoverRadius: 5,
                    pointHoverBackgroundColor: "#f9141b",
                    pointHitRadius: 20,
                    pointBorderWidth: 2,
                    data: data.daily_count,
                },
                {
                    label: 'Amount (CFA Franc.)',
                    type: 'bar',
                    yAxisID: 'A',
                    backgroundColor: "#214594",
                    borderColor: "#2B5DCB",
                    pointRadius: 5,
                    pointBackgroundColor: "#214594",
                    pointBorderColor: "#214594",
                    pointHoverRadius: 5,
                    pointHoverBackgroundColor: "#214594",
                    pointHitRadius: 20,
                    pointBorderWidth: 2,
                    data: data.comments,
                },
               ]
            var unit ="month"
            var maxTicksLimitX = 7
            var maxTicksLimitY = 10
            // var maxY = 3500
            var maxY = data.max_Y_axis
            var maxYCount = data.max_daily

            drawEngagementGraph(elementId, chartType, labels, datasets, unit, maxTicksLimitX, maxTicksLimitY, maxY,maxYCount);
        }
    </script>
@endsection
