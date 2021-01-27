@extends('admin.auth.layout')

@section('content')
        <!--begin::Form-->

        <form class="form" novalidate="novalidate" method="POST" action="{{ route('password.email') }}">
        @csrf
            <!--begin::Title-->
            <div class="pb-13 pt-lg-0 pt-5">
                <h3 class="font-weight-bolder text-dark font-size-h4 font-size-h1-lg">Forgotten Password ?</h3>
                <p class="text-muted font-weight-bold font-size-h4">Enter your email to reset your password</p>
            </div>
            <!--end::Title-->
            <!--begin::Form group-->
            <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                <input class="form-control form-control-solid h-auto py-6 px-6 rounded-lg font-size-h6" type="email" placeholder="Email" name="email" autocomplete="off" required/>
                @if ($errors->has('email'))
                    <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                @endif
            </div>
            <!--end::Form group-->
            <!--begin::Form group-->
            <div class="form-group d-flex flex-wrap pb-lg-0">
                <button type="submit" class="btn btn-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-4">Email Password Reset Link</button>
            </div>
            <!--end::Form group-->
        </form>
        <!--end::Form-->
@endsection
