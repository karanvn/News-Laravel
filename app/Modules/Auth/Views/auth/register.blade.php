@extends('home.main')
@section('title'){{ trans('Auth::auth.register.title') }}@endsection
@section('content')
<style>
.lynessa-Button:hover {
    background-color: #cf9163;
}
</style>

<div class="banner-wrapper">
    {{-- <img src="{{ asset('assets/images/banner-for-all2.jpg') }}"
         class="img-responsive attachment-1920x447 size-1920x447" alt="img"> --}}
    <div class="banner-wrapper-inner">
        <h1 class="page-title">{{ trans('Auth::auth.register.title') }}</h1>
    </div>
</div>

<div class="col-md-4 col-12 mx-auto  px-5 py-5 mt-5 shadow">
    <form id="kt_login_signup_form" method="POST">
        @csrf
        <p class="lynessa-form-row lynessa-form-row--wide form-row form-row-wide">
            <label for="account_email">{{ trans('Auth::auth.validator.fullname') }}<span class="required">*</span></label>
            <input type="text" class="lynessa-Input lynessa-Input--email input-text text-left" placeholder="Nhập họ tên..." name="fullname" value="{{ old('fullname') }}" required>
            <div class="fv-plugins-message-container text-left">
                @if($errors->has('fullname'))
                <span class="text-danger">{{ $errors->first('fullname') }}</span>
                @endif
            </div>
        </p>

        <p class="lynessa-form-row lynessa-form-row--wide form-row form-row-wide">
            <label for="account_email">Email<span class="required">*</span></label>
            <input type="email" class="lynessa-Input lynessa-Input--email input-text text-left" placeholder="Nhập email..." name="email" value="{{ old('email') }}" required>
            <div class="fv-plugins-message-container text-left">
                @if($errors->has('email'))
                <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
            </div>
        </p>

        <p class="lynessa-form-row lynessa-form-row--wide form-row form-row-wide">
            <label for="account_email">{{ trans('Auth::auth.validator.phone') }}<span class="required">*</span></label>
            <input type="text" class="lynessa-Input lynessa-Input--email input-text text-left" placeholder="Nhập số điện thoại..." name="phone" value="{{ old('phone') }}" required>
            <div class="fv-plugins-message-container text-left">
                @if($errors->has('phone'))
                <span class="text-danger">{{ $errors->first('phone') }}</span>
                @endif
            </div>
        </p>
        
        <p class="lynessa-form-row lynessa-form-row--wide form-row form-row-wide">
            <label>{{ trans('Auth::auth.validator.birthday') }}</label>
                <input type="date" id="" class="lynessa-Input lynessa-Input--email input-text text-left" name="birthday" value="{{ old('birthday') }}">
            
            {{-- <div class="fv-plugins-message-container text-left">
                @if($errors->has('phone'))
                <span class="text-danger">{{ $errors->first('phone') }}</span>
                @endif
            </div> --}}
        </p>

        <p class="lynessa-form-row lynessa-form-row--wide form-row form-row-wide">
            <label for="account_email">{{ trans('Auth::auth.validator.password') }}<span class="required">*</span></label>
            <input type="password" class="lynessa-Input lynessa-Input--email input-text text-left" placeholder="Nhập mật khẩu..." name="password" id="mainpassword" value="{{ old('password') }}" required>
            <div class="fv-plugins-message-container text-left">
                @if($errors->has('password'))
                <span class="text-danger">{{ $errors->first('password') }}</span>
                @endif
            </div>
        </p>

        <p class="lynessa-form-row lynessa-form-row--wide form-row form-row-wide">
            <label for="account_email">{{ trans('Auth::auth.validator.cpassword') }}<span class="required">*</span></label>
            <input type="password" class="lynessa-Input lynessa-Input--email input-text text-left" placeholder="Nhập lại mật khẩu..." name="cpassword" value="{{ old('cpassword') }}" required>
            <div class="fv-plugins-message-container text-left">
                @if($errors->has('cpassword'))
                <span class="text-danger">{{ $errors->first('cpassword') }}</span>
                @endif
            </div>
        </p>

        <p class="text-left">
            <input type="checkbox" name="agree" required> Chấp nhận các <a href="/pages/dieu-khoan.html" class="text-success">điều khoản</a>
            @if($errors->has('agree'))
            <span class="text-danger">{{ $errors->first('agree') }}</span>
            @endif
        </p>

        <div class="form-group text-center">
            <button type="submit" class="lynessa-Button button">{{ trans('Auth::auth.register.btn_re') }}</button>
        </div>
        <div class="form-group text-center">
            <a href="/login" class="text-success">{{ trans('Auth::auth.login.title') }}</a>
        </div>
    </form>
</div>

<script>
    $(document).ready(function () {
        $("#kt_login_signup_form").validate({
            rules: { fullname: { required: !0 }, 
                    email: { required: !0, email: !0 }, 
                    phone: { required: !0, digits: !0, minlength: 10, maxlength: 11 }, 
                    password: { required: !0, minlength: 6 },
                    cpassword: { required: !0, equalTo: '#mainpassword'}, 
                    agree: { required: !0 }, 
                },
            messages: {
                fullname: { required: "Vui lòng nhập họ tên!" },
                email: { required: "Vui lòng nhập email!", email: "Nhập email chưa đúng định dạng!" },
                phone: { required: "Vui lòng nhập số điện thoại!", digits: "Vui lòng nhập số nhé!", minlength: "Chưa đủ số bạn ơi!", maxlength: "Vượt quá số điện thoại rồi!" },
                password: { required: "Vui lòng nhập mật khẩu!", minlength: "Mật khẩu ít nhất 6 ký tự!" },
                cpassword: { required: "Vui lòng nhập lại mật khẩu!", equalTo: "Mật khẩu không khớp" },
                agree: { required: "Vui lòng chấp nhận điều khoản!" },
            },
        });
    });

</script>

<script src="admin/assets/js/pages/crud/forms/widgets/bootstrap-datetimepicker.js?v=7.0.5"></script>


@endsection