@extends('admin.auth.layout')

@section('content')
    <div class="login-form login-signin">
        <!--begin::Form-->
        <form class="form" novalidate="novalidate" method="POST" action="{{ route('admin.auth.login') }}">
        @csrf
        <!--begin::Title-->
            <div class="pb-13 pt-lg-0 pt-5">
                <h3 class="font-weight-bolder text-dark font-size-h4 font-size-h1-lg">RUV Admin Login</h3>
                <span class="text-muted font-weight-bold font-size-h4">New Here?
				<a href="javascript:;" id="kt_login_signup" class="text-primary font-weight-bolder">Create an Account</a></span>
            </div>
        <!--begin::Title-->
            <!--begin::Form group-->
            <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                <label class="font-size-h6 font-weight-bolder text-dark" :value="__('Email')">Email</label>
                <input class="form-control form-control-solid h-auto py-6 px-6 rounded-lg" type="email" id="email" :value="old('email')" required autofocus name="email" autocomplete="off" />
                @if ($errors->has('email'))
                    <span class="help-block" style="margin-left: 55px;color: red;">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                @endif
            </div>
            <!--end::Form group-->
            <!--begin::Form group-->
            <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                <div class="d-flex justify-content-between mt-n5">
                    <label class="font-size-h6 font-weight-bolder text-dark pt-5" :value="__('Password')">Password</label>
                    @if (Route::has('admin.auth.password.request'))
                        <a  class="text-primary font-size-h6 font-weight-bolder text-hover-primary pt-5" href="{{ route('admin.auth.password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif
                </div>
                <input class="form-control form-control-solid h-auto py-6 px-6 rounded-lg" type="password" id="password" name="password" required autocomplete="current-password"  autocomplete="off" />

            </div>
            <!--end::Form group-->
            <!--begin::Action-->
            <div class="pb-lg-0 pb-5">
                <button  type="submit" class="btn btn-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-3">Sign In</button>
            </div>
            <!--end::Action-->
        </form>
        <!--end::Form-->
    </div>
@endsection
