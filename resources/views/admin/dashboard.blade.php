@extends('admin.layout.master')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-xxl-6">
                <!--begin::Mixed Widget 1-->
                <div class="card card-custom bg-gray-100 card-stretch gutter-b">
                    <!--begin::Header-->
                    <div class="card-header border-0 bg-danger py-5">
                        <h3 class="card-title font-weight-bolder text-white">Sales Stat</h3>
                        <div class="card-toolbar">
                            <div class="dropdown dropdown-inline">
                                <a href="#" class="btn btn-transparent-white btn-sm font-weight-bolder dropdown-toggle px-5" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Export</a>
                                <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                    <!--begin::Navigation-->
                                    <ul class="navi navi-hover">
                                        <li class="navi-header pb-1">
                                            <span class="text-primary text-uppercase font-weight-bold font-size-sm">Add new:</span>
                                        </li>
                                        <li class="navi-item">
                                            <a href="#" class="navi-link">
																		<span class="navi-icon">
																			<i class="flaticon2-shopping-cart-1"></i>
																		</span>
                                                <span class="navi-text">Order</span>
                                            </a>
                                        </li>
                                        <li class="navi-item">
                                            <a href="#" class="navi-link">
																		<span class="navi-icon">
																			<i class="flaticon2-calendar-8"></i>
																		</span>
                                                <span class="navi-text">Event</span>
                                            </a>
                                        </li>
                                        <li class="navi-item">
                                            <a href="#" class="navi-link">
																		<span class="navi-icon">
																			<i class="flaticon2-graph-1"></i>
																		</span>
                                                <span class="navi-text">Report</span>
                                            </a>
                                        </li>
                                        <li class="navi-item">
                                            <a href="#" class="navi-link">
																		<span class="navi-icon">
																			<i class="flaticon2-rocket-1"></i>
																		</span>
                                                <span class="navi-text">Post</span>
                                            </a>
                                        </li>
                                        <li class="navi-item">
                                            <a href="#" class="navi-link">
																		<span class="navi-icon">
																			<i class="flaticon2-writing"></i>
																		</span>
                                                <span class="navi-text">File</span>
                                            </a>
                                        </li>
                                    </ul>
                                    <!--end::Navigation-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body p-0 position-relative overflow-hidden">
                        <!--begin::Chart-->
                        <div id="kt_mixed_widget_1_chart" class="card-rounded-bottom bg-danger" style="height: 200px"></div>
                        <!--end::Chart-->
                        <!--begin::Stats-->
                        <div class="card-spacer mt-n25">
                            <!--begin::Row-->
                            <div class="row m-0">
                                <div class="col bg-light-warning px-6 py-8 rounded-xl mr-7 mb-7">
															<span class="svg-icon svg-icon-3x svg-icon-warning d-block my-2">
																<!--begin::Svg Icon | path:assets/media/svg/icons/Media/Equalizer.svg-->
																<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																	<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																		<rect x="0" y="0" width="24" height="24" />
																		<rect fill="#000000" opacity="0.3" x="13" y="4" width="3" height="16" rx="1.5" />
																		<rect fill="#000000" x="8" y="9" width="3" height="11" rx="1.5" />
																		<rect fill="#000000" x="18" y="11" width="3" height="9" rx="1.5" />
																		<rect fill="#000000" x="3" y="13" width="3" height="7" rx="1.5" />
																	</g>
																</svg>
                                                                <!--end::Svg Icon-->
															</span>
                                    <a href="#" class="text-warning font-weight-bold font-size-h6">Weekly Sales</a>
                                </div>
                                <div class="col bg-light-primary px-6 py-8 rounded-xl mb-7">
															<span class="svg-icon svg-icon-3x svg-icon-primary d-block my-2">
																<!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Add-user.svg-->
																<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																	<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																		<polygon points="0 0 24 0 24 24 0 24" />
																		<path d="M18,8 L16,8 C15.4477153,8 15,7.55228475 15,7 C15,6.44771525 15.4477153,6 16,6 L18,6 L18,4 C18,3.44771525 18.4477153,3 19,3 C19.5522847,3 20,3.44771525 20,4 L20,6 L22,6 C22.5522847,6 23,6.44771525 23,7 C23,7.55228475 22.5522847,8 22,8 L20,8 L20,10 C20,10.5522847 19.5522847,11 19,11 C18.4477153,11 18,10.5522847 18,10 L18,8 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
																		<path d="M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
																	</g>
																</svg>
                                                                <!--end::Svg Icon-->
															</span>
                                    <a href="#" class="text-primary font-weight-bold font-size-h6 mt-2">New Users</a>
                                </div>
                            </div>
                            <!--end::Row-->
                            <!--begin::Row-->
                            <!--end::Row-->
                        </div>
                        <!--end::Stats-->
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Mixed Widget 1-->
            </div>
            <div class="col-lg-6 col-xxl-6">
                <!--begin::Stats Widget 11-->
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
																		<rect x="0" y="0" width="24" height="24" />
																		<rect fill="#000000" x="4" y="4" width="7" height="7" rx="1.5" />
																		<path d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z" fill="#000000" opacity="0.3" />
																	</g>
																</svg>
                                                                <!--end::Svg Icon-->
															</span>
														</span>
													</span>
                            <div class="d-flex flex-column text-right">
                                <span class="text-dark-75 font-weight-bolder font-size-h3">750$</span>
                                <span class="text-muted font-weight-bold mt-2">Weekly Income</span>
                            </div>
                        </div>
                        <div id="kt_stats_widget_11_chart" class="card-rounded-bottom" data-color="success" style="height: 150px"></div>
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Stats Widget 11-->
                <!--begin::Stats Widget 12-->
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
                                <span class="text-dark-75 font-weight-bolder font-size-h3">+6,5K</span>
                                <span class="text-muted font-weight-bold mt-2">New Users</span>
                            </div>
                        </div>
                        <div id="kt_stats_widget_12_chart" class="card-rounded-bottom" data-color="primary" style="height: 150px"></div>
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
    <script src="{{asset('assets/js/pages/crud/forms/widgets/bootstrap-datepicker.js')}}"></script>
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
        $.get('transaction-chart-analytics/' + monthTransaction + '/' + yearTransaction, function(data) {
            $('.transaction-graph-card .loading-spinner').remove();
            transactionsDrawGraph(data);
        });
        // on clicking filter
        $("#filter-transaction").on("click", function() {
            $('.transaction-graph-card .chart-bar').hide();
            $('.transaction-graph-card').prepend(spinner);

            let year = $(".transaction-year").val();
            let month = $(".transaction-month").val();

            $.get('transaction-chart-analytics/' + month + '/' + year, function(data) {
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
