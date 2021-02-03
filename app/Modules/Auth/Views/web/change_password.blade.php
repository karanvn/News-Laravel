@extends('home.main')
@section('title')
{{ trans('Auth::customer.breadcrumb.'.\Route::current()->getName()) }}
@endsection
@section('content')
{{--  start-Breadcrumb  --}}
@include('Auth::web.pages.breadcrumb')
{{--  end-Breadcrumb  --}}
<main class="site-main  main-container no-sidebar">
    <div class="container">
        <div class="row">
            <div class="main-content col-md-12">
                <div class="page-main-content">
                    <div class="lynessa">
                        {{--  start-Navigation  --}}
                        @include('Auth::web.pages.navigation')
                        {{--  end-Navigation  --}}
                        <div class="lynessa-MyAccount-content">
                            <div class="lynessa-notices-wrapper"></div>
                            <!-- start Form Edit Info -->
                            @if(session('message'))
                            <div class="alert alert-success">
                                {{ session('message') }}
                            </div>
                            @endif
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form class="lynessa-EditAccountForm edit-account" action="{{ route('post-change-password') }}" method="post">
                                @csrf

                                <fieldset>
                                    <!-- title Change Password -->
                                   
                                    <!-- input Password New -->
                                    <p class="lynessa-form-row lynessa-form-row--wide form-row form-row-wide">
                                        <label for="password_2">{{ trans('Auth::customer.add.form.password_new') }}&nbsp;<span
                                            class="required">*</span></label></label>
                                        <input type="password"
                                               class="lynessa-Input lynessa-Input--password input-text password text-left"
                                               name="password" id="password" autocomplete="off" placeholder="{{ trans('Auth::customer.add.form.placeholder_password') }}">
                                    </p>
                                    <!-- input Re-assword -->
                                    <p class="lynessa-form-row lynessa-form-row--wide form-row form-row-wide">
                                        <label for="password_2">{{ trans('Auth::customer.add.form.re_password') }}&nbsp;<span
                                            class="required">*</span></label></label>
                                        <input type="password"
                                               class="lynessa-Input lynessa-Input--password input-text password text-left"
                                               name="re_password" id="password" autocomplete="off" placeholder="{{ trans('Auth::customer.add.form.placeholder_password') }}">
                                    </p>
                                </fieldset>
                                <div class="clear"></div>
                                <p>
                                    <input type="hidden" id="save-account-details-nonce"
                                           name="save-account-details-nonce" value="">
                                    <input type="hidden" name="_wp_http_referer" value="">
                                    <button type="submit" class="lynessa-Button button" name="save_account_details"
                                            value="Save changes">{{ trans('Auth::customer.edit.header_btn_save') }}
                                    </button>
                                    <input type="hidden" name="action" value="save_account_details">
                                </p>
                            </form>
                            <!-- end Form Edit Info -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection