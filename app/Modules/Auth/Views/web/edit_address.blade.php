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
                            <form id="frmShippingAdd" name="frmShippingAdd" action="{{ route('post-edit-address-customer') }}" method="POST" enctype="multipart/form-data">
                            @include('Auth::web.form.frm_add_address')
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@section('script')
    
@endsection