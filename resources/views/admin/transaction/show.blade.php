@extends('admin.layout.master')
@section('styles')
@endsection
@section('sub-header')
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{$page_description}}</h5>
                <!--end::Page Title-->
                <!--begin::Actions-->
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <a href="#" class="btn btn-light-warning font-weight-bolder btn-sm">Reference Number: {{$page_title}}</a>
                @if($transaction->status == true)
                    <a href="#" class="ml-3 btn btn-light-success font-weight-bolder btn-sm">Transaction Status: Complete</a>
                @else
                        <a href="#" class="ml-3 btn btn-light-warning font-weight-bolder btn-sm">Transaction Status: Pending Vendor Assignment</a>
                @endif
                <!--end::Actions-->
            </div>
        </div>
    </div>
    <!--end::Subheader-->
@endsection
@section('content')


    <div class="row">
        <div class="col-md-4">
            <div class="card card-custom gutter-b">
                <!--begin::Header-->
                <div class="card-header border-0 py-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label font-weight-bolder text-dark">User Details</span>
                    </h3>
                </div>
                <!--end::Header-->
                <div class="card-body">
                    <!--begin::Top-->
                    <div class="d-flex">
                        <!--begin::Pic-->
                        <div class="flex-shrink-0 mr-7">
                            <div class="symbol symbol-50 symbol-lg-120 symbol-light-danger">
                                <span class="font-size-h3 symbol-label font-weight-boldest">{{ucfirst(substr($transaction->user->first_name, 0, 1)).' '.ucfirst(substr($transaction->user->last_name, 0, 1))}}</span>
                            </div>
                        </div>
                        <!--end::Pic-->
                        <!--begin: Info-->
                        <div class="flex-grow-1">
                            <!--begin::Title-->
                            <div class="d-flex align-items-center justify-content-between flex-wrap mt-2">
                                <!--begin::User-->
                                <div class="mr-3">
                                    <input type="hidden" id="user_id" value="{{$transaction->user->id}}" style="display: none">
                                    <!--begin::Name-->
                                    <a href="#" class="d-flex align-items-center text-dark text-hover-primary font-size-h5 font-weight-bold mr-3">{{$transaction->user->first_name.' '.$transaction->user->last_name}}
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
															</span>{{$transaction->user->email}}</a>
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
                                    </span>{{$transaction->transactionable->customer_msisdn}}</span>
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
                </div>
            </div>
        </div>

        <div class="col-md-8">
        <!--begin::Advance Table Widget 4-->
        <div class="card card-custom card-stretch gutter-b">
            <!--begin::Header-->
            <div class="card-header border-0 py-5">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label font-weight-bolder text-dark">Assign to Vendor</span>
                </h3>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body pt-0 pb-3">
                <div class="tab-content">
                    <!--begin::Table-->
                    <div class="table-responsive">
                        <table class="table table-head-custom table-head-bg table-borderless table-vertical-center">
                            <thead>
                            <tr class="text-left text-uppercase">
                                <th style="min-width: 250px" class="pl-7">
                                    <span class="text-dark-75">vendor name</span>
                                </th>
                                <th style="min-width: 100px">transactions(today)</th>
                                <th style="min-width: 100px">phone numbers</th>
                                <th style="min-width: 80px"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($vendors as $vendor)
                            <tr>
                                <td class="pl-0 py-8">
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-50 symbol-light-info mr-4">
                                            <span class="font-size-h3 symbol-label font-weight-boldest">
                                                {{ucfirst(substr($vendor->first_name, 0, 1)).ucfirst(substr($vendor->last_name, 0, 1))}}</span>
                                        </div>
                                        <div>
                                            <a href="{{route('admin.vendors.show', \Illuminate\Support\Facades\Crypt::encrypt($vendor->id))}}" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{$vendor->first_name.' '.$vendor->last_name}}</a>
                                            <span class="text-muted font-weight-bold d-block">{{$vendor->email}}</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="text-dark-75 font-weight-bolder d-block font-size-lg">CFA Franc. {{$vendor->vendor_transactions()->where(['status'=>true, 'created_at'=>now()])->sum('amount')}}</span>
                                    <span class="text-muted font-weight-bold">count: {{$vendor->vendor_transactions()->where(['status'=>true, 'created_at'=>now()])->count()}}</span>
                                </td>
                                @foreach($vendor->phone_numbers as $phone_number)
                                <td>
                                    <span class="text-dark-75 font-weight-bolder d-block font-size-lg">{{$phone_number->phone_number}}</span>

                                    <span class="text-muted font-weight-bold d-block font-size-sm"><img src="{{$phone_number->provider()->first()->logo}}" alt="image" style="width: 20px" />{{$phone_number->provider()->first()->name}}</span>
                                </td>
                                @endforeach
                                <td class="pr-0 text-right">
                                    @if($transaction->status == true)
                                         <a href="#" disabled="" class="btn btn-light-warning font-weight-bolder font-size-sm">Complete</a>
                                    @else
                                        <a href="#" disabled="" class="btn btn-light-success font-weight-bolder font-size-sm">Assign</a>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td class="pl-0 py-0">
                                    <b>No active vendors found</b>
                                </td>
                            </tr>
                            @endforelse
                        {{--{{ $vendors->links() }}--}}
                            </tbody>


                        </table>
                    </div>
                    <!--end::Table-->
                </div>
            </div>
            <!--end::Body-->
        </div>
        <!--end::Advance Table Widget 4-->
    </div>
    </div>
    <!--end::Row-->
@endsection
@section('scripts')

@endsection

