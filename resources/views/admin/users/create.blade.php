@extends('admin.layout.master')
@section('content')
    <!--begin::Card-->
    <div class="card card-custom card-transparent">
        <div class="card-body p-0">
            <!--begin::Wizard-->
            <div class="wizard wizard-4" id="kt_wizard" data-wizard-state="step-first" data-wizard-clickable="true">
                <!--begin::Card-->
                <div class="card card-custom card-shadowless rounded-top-0">
                    <!--begin::Body-->
                    <div class="card-body p-0">
                        <div class="row justify-content-center py-8 px-8 py-lg-15 px-lg-10">
                            <div class="col-xl-12 col-xxl-10">
                                <!--begin::Wizard Form-->
                                <form class="form" id="kt_form" method="POST" action="{{route('admin.app-users.store')}}">
                                    {{csrf_field()}}
                                    <div class="row justify-content-center">
                                        <div class="col-xl-9">
                                            <!--begin::Wizard Step 1-->
                                            <div class="my-5 step" data-wizard-type="step-content" data-wizard-state="current">
                                                <h5 class="text-dark font-weight-bold">Add User's Details:</h5>
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">First Name</label>
                                                    <div class="col-lg-9 col-xl-9">
                                                        <input class="form-control form-control-solid form-control-lg @error('first_name') is-invalid @enderror" value="{{ old('first_name') }}" id="first_name" name="first_name" type="text" required autocomplete="off"/>
                                                        @error('first_name')
                                                        <span class="invalid-feedback" role="alert">
                                                     <strong>{{ $message }}</strong>
                                                          </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!--end::Group-->
                                                <!--begin::Group-->
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Last Name</label>
                                                    <div class="col-lg-9 col-xl-9">
                                                        <input class="form-control form-control-solid form-control-lg @error('last_name') is-invalid @enderror" value="{{ old('last_name') }}" name="last_name" id="last_name" type="text" required autocomplete="off"/>
                                                        @error('last_name')
                                                        <span class="invalid-feedback" role="alert">
                                                     <strong>{{ $message }}</strong>
                                                          </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <!--end::Group-->
                                                <!--begin::Group-->
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Email Address</label>
                                                    <div class="col-lg-9 col-xl-9">
                                                        <div class="input-group input-group-solid input-group-lg">
                                                            <div class="input-group-prepend">
																<span class="input-group-text">
																<i class="la la-at"></i>
																</span>
                                                            </div>
                                                            <input type="email" class="form-control form-control-solid form-control-lg is-invalid  @error('email') is-invalid @enderror" value="{{ old('email') }}"
                                                                    name="email"  id="email" required autofocus/>
                                                            @error('email')
                                                            <span class="invalid-feedback" role="alert">
                                                     <strong>{{ $message }}</strong>
                                                          </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--end::Group-->
                                                <!--begin::Group-->
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Contact Phone</label>
                                                    <div class="col-lg-9 col-xl-9">
                                                        <div class="input-group input-group-solid input-group-lg">
                                                            <div class="input-group-prepend">
																<span class="input-group-text">
																	<i class="la la-phone"></i>
																</span>
                                                            </div>
                                                            <input type="text" class="form-control form-control-solid form-control-lg  @error('phone_number') is-invalid @enderror" value="{{ old('phone_number') }}"
                                                                   id="phone_number" name="phone_number" placeholder="Phone" required autocomplete="off"/>
                                                            @error('phone_number')
                                                            <span class="invalid-feedback" role="alert">
                                                     <strong>{{ $message }}</strong>
                                                          </span>
                                                            @enderror
                                                        </div>
                                                        <span class="form-text text-muted">Enter valid phone number(076789674).</span>
                                                    </div>
                                                </div>
                                                <!--end::Group-->
                                                <div class="form-group row">
                                                    <label class="col-xl-3 col-lg-3 col-form-label">Password</label>
                                                    <div class="col-lg-9 col-xl-9">
                                                        <div class="input-group input-group-solid input-group-lg">
                                                            <input  class="form-control form-control-solid form-control-lg" name="password" type="text" id="myText" placeholder="Password" readonly autocomplete="off"/>
                                                            <button onclick="myFunction()" class="btn btn btn-success random"style="margin-left: 4%;">Generate Code</button>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!--begin::Group-->

                                                <!--end::Group-->
                                                <!--begin::Group-->
                                                <div class="form-group row">
                                                    <label class="col-form-label col-xl-3 col-lg-3">Status</label>
                                                    <div class="col-xl-9 col-lg-9">
                                                        <select class="form-control form-control-lg form-control-solid" name="is_active">
                                                            <option  value="true">Active</option>
                                                            <option  value="false">InActive</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <!--end::Group-->
                                                <!--begin::Group-->
                                                <!--end::Group-->
                                            </div>
                                            <!--end::Wizard Step 1-->
                                            <!--begin::Wizard Actions-->

                                                    <input class="btn btn-success font-weight-bolder border-top px-9 py-4" type="submit" value="Submit"/>
                                            <a href="{{route('admin.app-users.index')}}" class="btn btn-success font-weight-bolder border-top px-9 py-4">Back</a>

                                            <!--end::Wizard Actions-->
                                        </div>
                                    </div>
                                </form>
                                <!--end::Wizard Form-->
                            </div>
                        </div>
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Card-->
            </div>
            <!--end::Wizard-->
        </div>
    </div>
    <!--end::Card-->
@endsection
@section('scripts')
    <script src="{{asset('assets/js/pages/custom/user/add-user.js')}}"></script>
    <script>
        function myFunction() {
            var rnd = Math.floor(Math.random() * 100000);
            document.getElementById("myText").value = "RUV".concat(rnd.toString());
        }
    </script>
@endsection

