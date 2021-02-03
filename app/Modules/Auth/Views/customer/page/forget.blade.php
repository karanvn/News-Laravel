@extends('home.main')
@section('title') Tạo mật khẩu mới @endsection

@section('content')
<div class="banner-wrapper">
    
    <div class="banner-wrapper-inner">
        <h1 class="">Tạo mật khẩu mới</h1>
      
    </div>
</div>
		<div class="col-md-6 col-12 mx-auto py-5 shadow pt-5 text-center">
            <div class="mb-10">
                @if (Session::has('message'))
                <p class="opacity-100 error" style="color:red">{{ Session::get('message') }}</p>
            @endif
        </div>
        <form class="form" id="frmResetPassword" onsubmit="kt_login_signin_submit.disabled=true; return true;" method="POST" action="{{ route('ResetPassword') }}">
            @csrf
            <input type="hidden" value="on" name="customer">
            <input type="hidden" name="token" value="{{ @$token }}" />
            <div class="form-group">
                <input id="email" class="form-control form-control-solid h-auto text-primary bg-white-o-5s rounded border-1 text-left" type="email" placeholder="{{ trans('Auth::auth.password.email') }}" name="email"  autocomplete="off" />
            </div>
            <div class="form-group">
                <input id="password" class="form-control form-control-solid h-auto text-primary bg-white-o-5s rounded border-1 border-1 text-left" type="password" placeholder="{{ trans('Auth::auth.password.password') }}" name="password" autocomplete="off" />
            </div>
            <div class="form-group">
                <input id="re_password" class="form-control form-control-solid h-auto text-primary bg-white-o-5s rounded border-1 border-1 text-left" type="password" placeholder="{{ trans('Auth::auth.password.re_password') }}" name="re_password" autocomplete="off" />
            </div>
            <a class="text-primary" href="/login">{{ trans('Auth::auth.login.msg_login') }}</a>
            <div class="form-group text-center mt-5">
                <button type="submit" id="kt_login_signin_submit" name="kt_login_signin_submit" class="btn  opacity-80 border-1">{{ trans('Auth::auth.password.submit') }}</button>
            </div>
        </form>
			<!--end::Login-->
        </div>
        
        @endsection
	