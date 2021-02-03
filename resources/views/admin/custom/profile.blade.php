@extends('admin.layout.master')
@section('content')
        <!--begin::Profile Personal Information-->
        <div class="d-flex flex-row">
            <!--begin::Aside-->
            <!--end::Aside-->
            <!--begin::Content-->
            <div class="flex-row-fluid ml-lg-8">
                <!--begin::Card-->
                <div class="card card-custom card-stretch">
                    <!--begin::Header-->
                    <div class="card-header py-3">
                        <div class="card-title align-items-start flex-column">
                            <h3 class="card-label font-weight-bolder text-dark">Admin Information</h3>
                            <span class="text-muted font-weight-bold font-size-sm mt-1">Update your personal informaiton</span>
                        </div>
                    </div>
                    <!--end::Header-->
                    <!--begin::Form-->
                    <form class="form" action="{{route('admin.profile.store')}}" method="POST" enctype="multipart/form-data" >
                        <!--begin::Body-->
                        {{csrf_field()}}
                        <div class="card-body">
                            <div class="row">
                                <label class="col-xl-3"></label>
                                <div class="col-lg-9 col-xl-6">
                                    <h5 class="font-weight-bold mb-6">Admin Info</h5>
                                </div>
                            </div>
                            <input type="hidden" name="id" value="{{ $user->id}}">

                            <div class="form-group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">Avatar</label>
                                <div class="col-lg-9 col-xl-6">
                                    <div class="image-input image-input-outline" id="kt_profile_avatar" style="background-image: url({{asset('assets/media/svg/avatars/015-boy-6.svg')}})">
                                        <div class="image-input-wrapper" style="background-image: url({{asset('assets/media/svg/avatars/015-boy-6.svg')}})"></div>
                                        <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                                            <i class="fa fa-pen icon-sm text-muted"></i>
                                            <input type="file" name="profile_avatar" accept=".png, .jpg, .jpeg" />
                                            <input type="hidden" name="profile_avatar_remove" />
                                        </label>
                                        <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
																	<i class="ki ki-bold-close icon-xs text-muted"></i>
																</span>
                                        <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="Remove avatar">
																	<i class="ki ki-bold-close icon-xs text-muted"></i>
																</span>
                                    </div>
                                    <span class="form-text text-muted">Allowed file types: png, jpg, jpeg.</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">Name</label>
                                <div class="col-lg-9 col-xl-6">
                                    <input class="form-control form-control-lg form-control-solid" value="{{ $user->name }}"  name="name" type="text" required placeholder="Full Name"/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">Username</label>
                                <div class="col-lg-9 col-xl-6">
                                    <input class="form-control form-control-lg form-control-solid" value="{{ $user->username }}" name="username" type="text" required placeholder="Username" />
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-xl-3"></label>
                                <div class="col-lg-9 col-xl-6">
                                    <h5 class="font-weight-bold mt-10 mb-6">Contact Info</h5>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">Phone Number</label>
                                <div class="col-lg-9 col-xl-6">
                                    <div class="input-group input-group-lg input-group-solid">
                                        <div class="input-group-prepend">
																	<span class="input-group-text">
																		<i class="la la-phone"></i>
																	</span>
                                        </div>
                                        <input type="text" class="form-control form-control-lg form-control-solid" value="{{ $user->phone_number }}"  name="phone_number" placeholder="Phone" required />
                                    </div>
                                    <span class="form-text text-muted">We'll never share your email with anyone else.</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">Email Address</label>
                                <div class="col-lg-9 col-xl-6">
                                    <div class="input-group input-group-lg input-group-solid">
                                        <div class="input-group-prepend">
											<span class="input-group-text">
												<i class="la la-at"></i>
											</span>
                                        </div>
                                        <input type="text" class="form-control form-control-lg form-control-solid" value="{{ $user->email }}" name="email" required placeholder="Email" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-3"></label>
                                <div class="col-9">
                                    <h6 class="text-dark font-weight-bold mb-10">Change Or Recover Your Password:</h6>
                                </div>
                            </div>
                            <!--end::Row-->
{{--                            <!--begin::Group-->--}}
{{--                            <div class="form-group row">--}}
{{--                                <label class="col-xl-3 col-lg-3 col-form-label">Current Password</label>--}}
{{--                                <div class="col-lg-9 col-xl-6">--}}
{{--                                    <input class="form-control form-control-lg form-control-solid mb-1" name="current" type="password" />--}}
{{--                                    <a href="#" class="font-weight-bold font-size-sm">Forgot password ?</a>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <!--end::Group-->--}}
                            <!--begin::Group-->
                            <div class="form-group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">New Password</label>
                                <div class="col-lg-9 col-xl-6">
                                    <input class="form-control form-control-lg form-control-solid" type="password" name="password"
                                           required />
                                </div>
                            </div>
                            <!--end::Group-->
                            <!--begin::Group-->
                            <div class="form-group row">
                                <label class="col-xl-3 col-lg-3 col-form-label">Verify Password</label>
                                <div class="col-lg-9 col-xl-6">
                                    <input class="form-control form-control-lg form-control-solid" type="password"
                                           name="password_confirmation" />
                                </div>
                            </div>
                            <div class="card-toolbar">
                                <button type="submit" class="btn btn-success mr-2">Save Changes</button>
                                <a href="{{route('dashboard')}}" class="btn btn-success font-weight-bolder border-top px-9 py-4">Cancel</a>

                            </div>
                        </div>
                        <!--end::Body-->
                    </form>
                    <!--end::Form-->
                </div>
            </div>
            <!--end::Content-->
        </div>
        <!--end::Profile Personal Information-->
    @endsection
