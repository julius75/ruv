@extends('admin.layout.master')
@section('sub-header')
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Vendor Details</h5>
                <!--end::Page Title-->
                <!--begin::Actions-->
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="#" class="btn btn-light-warning font-weight-bolder btn-sm">All View</a>
                <!--end::Actions-->
            </div>
        </div>
    </div>
    <!--end::Subheader-->
@endsection

@section('content')
    <!--begin::Card-->
        <div class="card card-custom gutter-b">
            <div class="card-body">
                <!--begin::Top-->
                <div class="d-flex">
                    <!--begin::Pic-->
                    <div class="flex-shrink-0 mr-7">
                        <div class="symbol symbol-50 symbol-lg-120 symbol-light-danger">
                            <span class="font-size-h3 symbol-label font-weight-boldest">MP</span>
                        </div>
                    </div>
                    <!--end::Pic-->
                    <!--begin: Info-->
                    <div class="flex-grow-1">
                        <!--begin::Title-->
                        <div class="d-flex align-items-center justify-content-between flex-wrap mt-2">
                            <!--begin::User-->
                            <div class="mr-3">
                                <input type="hidden" id="user_id" value="{{$user->id}}" style="display: none">
                                <!--begin::Name-->
                                <a href="#" class="d-flex align-items-center text-dark text-hover-primary font-size-h5 font-weight-bold mr-3">{{$user->first_name}}
                                    <i class="flaticon2-correct text-success icon-md ml-2"></i></a>
                                <!--end::Name-->
                                <!--begin::Contacts-->
                                <div class="d-flex flex-wrap my-2">
                                    <a href="#" class="text-muted text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
															<span class="svg-icon svg-icon-md svg-icon-gray-500 mr-1">
																<!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Mail-notification.svg-->
																<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																	<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																		<rect x="0" y="0" width="24" height="24" />
																		<path d="M21,12.0829584 C20.6747915,12.0283988 20.3407122,12 20,12 C16.6862915,12 14,14.6862915 14,18 C14,18.3407122 14.0283988,18.6747915 14.0829584,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,8 C3,6.8954305 3.8954305,6 5,6 L19,6 C20.1045695,6 21,6.8954305 21,8 L21,12.0829584 Z M18.1444251,7.83964668 L12,11.1481833 L5.85557487,7.83964668 C5.4908718,7.6432681 5.03602525,7.77972206 4.83964668,8.14442513 C4.6432681,8.5091282 4.77972206,8.96397475 5.14442513,9.16035332 L11.6444251,12.6603533 C11.8664074,12.7798822 12.1335926,12.7798822 12.3555749,12.6603533 L18.8555749,9.16035332 C19.2202779,8.96397475 19.3567319,8.5091282 19.1603533,8.14442513 C18.9639747,7.77972206 18.5091282,7.6432681 18.1444251,7.83964668 Z" fill="#000000" />
																		<circle fill="#000000" opacity="0.3" cx="19.5" cy="17.5" r="2.5" />
																	</g>
																</svg>
                                                                <!--end::Svg Icon-->
															</span>{{$user->email}}</a>
                                </div>
                                <!--end::Contacts-->
                            </div>
                            <!--begin::User-->
                            <!--begin::Actions-->
                            <div class="my-lg-0 my-1">
{{--                                <a href="#" class="btn btn-sm btn-light-primary font-weight-bolder text-uppercase mr-2">Ask</a>--}}
{{--                                <a href="#" class="btn btn-sm btn-primary font-weight-bolder text-uppercase">Hire</a>--}}
                            </div>
                            <!--end::Actions-->
                        </div>
                        <!--end::Title-->
                        <!--begin::Content-->
                        <div class="d-flex align-items-center flex-wrap justify-content-between">
                            <!--begin::Description-->
                            <div class="flex-grow-1 font-weight-bold text-dark-50 py-2 py-lg-2">
                                @foreach ($phones as $phone)
{{--                                    <i class="la la-phone">{{$phone->phone_number}}</i>--}}
                                    <span class="text-muted text-hover-primary font-weight-bold mr-lg-8 mb-lg-0 mb-2">
															<span class="svg-icon svg-icon-md svg-icon-gray-500 mr-1">
																<!--begin::Svg Icon | path:assets/media/svg/icons/General/Lock.svg-->
																<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																	<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																		<mask fill="white">
																			<use xlink:href="#path-1" />
																		</mask>
																		<g />
																		<path d="M7,10 L7,8 C7,5.23857625 9.23857625,3 12,3 C14.7614237,3 17,5.23857625 17,8 L17,10 L18,10 C19.1045695,10 20,10.8954305 20,12 L20,18 C20,19.1045695 19.1045695,20 18,20 L6,20 C4.8954305,20 4,19.1045695 4,18 L4,12 C4,10.8954305 4.8954305,10 6,10 L7,10 Z M12,5 C10.3431458,5 9,6.34314575 9,8 L9,10 L15,10 L15,8 C15,6.34314575 13.6568542,5 12,5 Z" fill="#000000" />
																	</g>
																</svg>
                                                                <!--end::Svg Icon-->
															</span>{{$phone->phone_number}}</span>
                                @endforeach
                            </div>
                            <!--end::Description-->
                        </div>
                        <!--end::Content-->
                    </div>
                    <!--end::Info-->
                </div>
                <!--end::Top-->
                <!--begin::Separator-->
                <div class="separator separator-solid my-7"></div>
                <!--end::Separator-->
                <!--begin::Bottom-->
                <div class="d-flex align-items-center flex-wrap">
                    <!--begin: Item-->
                    <div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
												<span class="mr-4">
													<i class="flaticon-confetti icon-2x text-muted font-weight-bold"></i>
												</span>
                        <div class="d-flex flex-column text-dark-75">
                            <span class="font-weight-bolder font-size-sm">Transactions</span>
                            <span class="font-weight-bolder font-size-h5">
													<span class="text-dark-50 font-weight-bold">{{$transactionCount}}
                        </div>
                    </div>
                    <!--end: Item-->
                    <!--begin: Item-->
                    <div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
												<span class="mr-4">
													<i class="flaticon-piggy-bank icon-2x text-muted font-weight-bold"></i>
												</span>
                        <div class="d-flex flex-column text-dark-75">
                            <span class="font-weight-bolder font-size-sm">Total Transactions</span>
                            <span class="font-weight-bolder font-size-h5">
													<span class="text-dark-50 font-weight-bold">$</span>{{$totalTransaction}}</span>
                        </div>
                    </div>
                    <!--end: Item-->
                    <!--begin: Item-->
                    <div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
												<span class="mr-4">
													<i class="flaticon-pie-chart icon-2x text-muted font-weight-bold"></i>
												</span>
                        <div class="d-flex flex-column text-dark-75">
                            <span class="font-weight-bolder font-size-sm">Net</span>
                            <span class="font-weight-bolder font-size-h5">
													<span class="text-dark-50 font-weight-bold">$</span>461,120</span>
                        </div>
                    </div>
                    <!--end: Item-->
                    <!--begin: Item-->
                    <div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
												<span class="mr-4">
													<i class="flaticon-file-2 icon-2x text-muted font-weight-bold"></i>
												</span>
                        <div class="d-flex flex-column flex-lg-fill">
                            <span class="text-dark-75 font-weight-bolder font-size-sm">45 Tasks</span>
                            <a href="#" class="text-primary font-weight-bolder">View</a>
                        </div>
                    </div>
                    <!--end: Item-->
                    <!--begin: Item-->
                    <div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
												<span class="mr-4">
													<i class="flaticon-chat-1 icon-2x text-muted font-weight-bold"></i>
												</span>
                        <div class="d-flex flex-column">
                            <span class="text-dark-75 font-weight-bolder font-size-sm">968 Comments</span>
                            <a href="#" class="text-primary font-weight-bolder">View</a>
                        </div>
                    </div>
                    <!--end: Item-->
                </div>
                <!--end::Bottom-->
            </div>
        </div>
    <div class="row">
        <div class="col-lg-12 order-1 order-xxl-2">
            <!--begin::List Widget 8-->
            <input type="hidden" id="user_id" value="{{$user->id}}" style="display: none">
            <div class="card card-custom card-stretch gutter-b">
                <div class="card-header">
                    <div class="card-title">
                       Vendor Transactions Charts
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
                            <canvas id="transactionsChartVendorUser" width="668" height="320" class="chartjs-render-monitor" style="display: block; width: 668px; height: 320px;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <!--end: Card-->
            <!--end::List Widget 8-->
        </div>
    </div>

    <div class="card card-custom  gutter-b">
            <div class="card-header flex-wrap border-0 pt-6 pb-0">
                <div class="card-title">
                    <h3 class="card-label">Vendor Transactions Table</h3>
                </div>
                <div class="card-toolbar">
                    <!--begin::Button-->
                    <span type="button" class="btn btn-primary font-weight-bolder">
                        <span class="svg-icon svg-icon-md">
                            <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24" />
                                    <circle fill="#000000" cx="9" cy="15" r="6" />
                                    <path d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z" fill="#000000" opacity="0.3" />
                                </g>
                            </svg>
                            <!--end::Svg Icon-->
                        </span>Transaction
                    </span>
                    <!--end::Button-->
                </div>
            </div>
            <div class="card-body">
                <!--begin: Datatable-->
                <table class="table table-bordered table-hover table-checkable mt-10" id="kt_datatable" style="margin-top: 13px !important">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Reference Number</th>
                        <th>Amount</th>
                        <th>Date Payed</th>
                        <th>Phone Numbers</th>
                        <th>Status</th>
                        <th>Vendor</th>
                    </tr>
                    </thead>
                </table>
                <!--end: Datatable-->
            </div>
        </div>
    <!--end::Education-->
@endsection
@section('scripts')
    <script src="{{asset('assets/js/pages/chart.js')}}"></script>

    <script src="{{asset('assets/js/pages/create-bars-vendor-users.js')}}"></script>
    <script>
        // $.get('charts/analytics-area/', function(data) {
        //     $('#week-total').html(data.total_weekly_amount);
        //     $('#week-total_users').html(data.total_new_users);
        //     $('.card-rounded-bottom .loading-spinner').remove();
        //     drawEngagementGraphAreaUsers(data);
        //     drawEngagementGraphAreaTransactions(data);
        // });
        'use strict';
        function userTransaction() {
            var initTable1 = function() {
                var table = $('#kt_datatable');
                // begin first table
                table.DataTable({
                    responsive: true,
                    ajax: {
                        url: '{{route('admin.get-transactions_vendor_user',$user->id)}}',
                        type: 'GET',
                        data: {
                            pagination: {
                                perpage: 1000,
                            },
                        },
                    },
                    columns: [
                        {data: 'id', name: 'id'},
                        {data: 'transaction', name: 'transaction'},
                        {data: 'amount', name: 'amount'},
                        {data: 'date', name: 'date'},
                        {data: 'phone_number', name: 'phone_number'},
                        {data: 'transaction_status', name: 'transaction_status'},
                        {data: 'vendors', name: 'vendors'},
                    ],
                    columnDefs: [
                        {
                            width: '75px',
                            targets: -2,
                            render: function(data, type, full, meta) {
                                var is_active = {
                                    false: {'title': 'Pending', 'state': 'danger'},
                                    true: {'title': 'Complete', 'state': 'primary'},
                                    3: {'title': 'Direct', 'state': 'success'},
                                };

                                if (typeof is_active[data] === 'undefined') {
                                    return data;
                                }
                                return '<span class="label label-' + is_active[data].state + ' label-dot mr-2"></span>' +
                                    '<span class="font-weight-bold text-' + is_active[data].state + '">' + is_active[data].title + '</span>';
                            },
                        },
                    ],
                });
            };
            return {
                //main function to initiate the module
                init: function() {
                    initTable1();
                },
            };
        }userTransaction();
        jQuery(document).ready(function() {
            // let user_id = $("#user_id").val();
            userTransaction().init();
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
        let vendor_id = $("#user_id").val();
        $('.transaction-graph-card').prepend(spinner);
        $.get('transaction-chart-vendors/' + monthTransaction + '/' + yearTransaction + '/' +vendor_id, function(data) {
            $('.transaction-graph-card .loading-spinner').remove();
            transactionsDrawGraph(data);
        });
        // on clicking filter
        $("#filter-transaction").on("click", function() {
            $('.transaction-graph-card .chart-bar').hide();
            $('.transaction-graph-card').prepend(spinner);

            let year = $(".transaction-year").val();
            let month = $(".transaction-month").val();
            let vendor_id = $("#user_id").val();

            $.get('transaction-chart-vendors/' + month + '/' + year+ '/' +vendor_id, function(data) {
                $('.transaction-graph-card .chart-bar').show(500);
                $('.transaction-graph-card .loading-spinner').remove();
                transactionsDrawGraph(data);
            });

        });

        function transactionsDrawGraph(data){
            var elementId="transactionsChartVendorUser"
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
{{--@section('scripts')--}}
{{--    <script src="{{asset('assets/js/pages/custom/education/student/profile.js')}}"></script>--}}
{{--@endsection--}}

