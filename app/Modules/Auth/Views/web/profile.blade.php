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
                            <form class="lynessa-EditAccountForm edit-account" action="{{ route('edit-info') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="clear"></div>
                                <!-- input Name -->
                                <p class="lynessa-form-row lynessa-form-row--wide form-row form-row-wide">
                                    <label for="account_display_name">{{ trans('Auth::customer.add.form.name') }}<span class="required">*</span></label>
                                    <input type="text" class="lynessa-Input lynessa-Input--text input-text text-left"
                                           name="fullname" id="account_display_name" value=" {{ $user->name }}">
                                    <span><em>{{ trans('Auth::customer.add.form.name-title') }}</em></span>
                                </p>
                                <div class="clear"></div>
                                <!-- input Email -->
                                <p class="lynessa-form-row lynessa-form-row--wide form-row form-row-wide">
                                    <label for="account_email">{{ trans('Auth::customer.add.form.email') }}:&nbsp;<span
                                            class="required"><strong><i>{{ $user->email }}</i></strong></span></label>
                                       
                                </p>
                                <div class="clear"></div>
                                <!-- input Phone -->
                                <p class="lynessa-form-row lynessa-form-row--wide form-row form-row-wide">
                                    <label for="account_email">{{ trans('Auth::customer.add.form.phone') }}&nbsp;<span
                                            class="required">*</span></label>
                                    <input type="text" class="lynessa-Input lynessa-Input--phone input-text text-left"
                                           name="phone" id="account_phone" autocomplete="email"
                                           value="{{ $user->phone }}">
                                </p>
                                <p class="form-row form-row-wide address-field">
                                    <label>Giới tính</label>
                                    <span class="lynessa-input-wrapper">
                                        <select name="gender" class="country_to_state country_select" autocomplete="country" tabindex="-1"
                                            aria-hidden="true">
                                            <option value="M" {{ $user->gender=='M' ? 'selected':''}}>{{ trans('Auth::customer.genders.M') }}</option>
                                            <option value="F" {{ $user->gender=='F' ? 'selected':''}}>{{ trans('Auth::customer.genders.F') }}</option>
                                            <option value="O" {{ $user->gender=='O' ? 'selected':''}}>{{ trans('Auth::customer.genders.O') }}</option>
                                        </select>
                                    </span>
                                </p>
                                <p class="form-row form-row-wide address-field">
                                    <label>Ngày sinh</label>
                                    <span class="lynessa-input-wrapper">
                                        <input type="date" class="lynessa-Input lynessa-Input--date input-date text-left" name="bod" value="{{ $user->bod }}">
                                    </span>
                                </p>
                                <p class="form-row form-row-wide address-field" id="changerAvatarUser">
                                    <span class="lynessa-input-wrapper">
                                        <input type='file' name="image" id="imgInp" accept=".png, .jpg, .jpeg" class="d-none"/>
                                        @if(!empty($user->avatar))
                                        <img id="preview-img" src="{{ asset('storage/user/thumb/'.$user->avatar) }}"/>
                                        @else
                                        <img id="preview-img" src="/system/images/avatar.jpg"/>
                                        @endif
                                        <span class="form-text text-muted"><i>{{ trans('Blog::blog.add.form.header_avatar_allow') }} png, jpg, jpeg.</i></span>
                                        <span id="btnClickchangavatar"><i class="fa fa-camera" aria-hidden="true"></i> </span>
                                </p>
                                <fieldset>
                                    <!-- title Change Password -->    
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
@section('script')
<script>
    function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#preview-img').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]); // convert to base64 string
    }
    }

    $("#imgInp").change(function() {
    readURL(this);
    });

    $("#preview-img").on("error", function () {
    $(this).attr("src","/system/images/avatar.jpg");
})
$('#btnClickchangavatar').on('click', function(){
    $('#imgInp').click();
})
</script>

@endsection