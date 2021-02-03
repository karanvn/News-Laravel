@extends('home.main')
@section('title')
{{ trans('Auth::auth.login.title') }}
@endsection
<style>
    .lynessa-Button:hover {
        background-color: #cf9163;
    }
</style>
@section('content')
<!-- start of product-detail -->
<div class="banner-wrapper">
    {{-- <img src="assets/images/banner-for-all2.jpg" class="img-responsive attachment-1920x447 size-1920x447" alt="img"> --}}
    <div class="banner-wrapper-inner">
        <h1 class="page-title">{{ trans('Auth::auth.login.title') }}</h1>
    </div>
</div>

<div class="col-md-4 col-12 mx-auto  px-5 py-5 mt-5 shadow">
    <form method="POST" id="form_login">
        @csrf
        @if($errors->has('cantlogin'))
        <span class="text-danger">{{ $errors->first('cantlogin') }}</span>
        @endif
        <p>{{ trans('Auth::auth.password.email') }}</p>
        <p> <input type="email" class="form-control text-left" placeholder="Nhập email..." name="email" value="{{ old('email') }}"></p>
        <p>{{trans("Auth::auth.validator.password")}}</p>
        <p> <input type="password" class="form-control text-left" placeholder="Nhập mật khẩu..." name="password"></p>
        <p>
        <p>
            <input type="checkbox"> {{trans("Auth::auth.login.remember")}}
        </p>
        {{-- <button class="form-control btn-dark">{{ trans('Auth::auth.login.title') }}</button> --}}
        <div class="form-group text-center">
            <button type="submit" class="lynessa-Button button">{{ trans('Auth::auth.login.title') }}</button>
        </div>
        </p>
    </form>
   <p>
    <a class="" href="{{ route('resetCustomer') }}">{{ trans('Auth::auth.reset.forget_password') }} ?</a>
   </p>
</div>

<script>
    $(document).ready(function() {
        $("#form_login").validate({
            rules: {
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true,
                }
            },
            messages: {
                email: {
                    required: "Vui lòng nhập email!",
                    email: "Vui lòng nhập email hợp lệ!"
                },
                password: {
                    required: "Vui lòng nhập mật khẩu!"
                }
            }
        });
    });
</script>

@endsection