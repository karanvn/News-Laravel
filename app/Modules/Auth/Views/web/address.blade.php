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
                            <div class="u-columns lynessa-Addresses col2-set addresses">
                                <div class="u-column1 col-1 lynessa-Address">
                                    @if(session('message'))
                                    <div class="alert alert-success">
                                        {{ session('message') }}
                                    </div>
                                    @endif
                                    <header class="lynessa-Address-title title">
                                        <h6>TỔNG ĐỊA CHỈ GIAO HÀNG: {{ count($shippings) }}</h6>
                                    </header>
                                    <p>
                                        <a href="{{ route('add-address-customer') }}">[Thêm địa chỉ]</a>
                                    </p>
                                    @foreach ($shippings as $shipping)
                                    <header class="lynessa-Address-title title  border-top">
                                        <a href="{{ route('edit-address-customer',$shipping->id) }}" class="edit">Chỉnh sửa</a>
                                    </header>
                                    <address class="py-0 my-0">
                                        <span class="title-bolder"><b>Người nhận</b></span>: {{ @$shipping->name }}<br>
                                        <span class="title-bolder"><b>Điện thoại</b></span>: {{ @$shipping->phone }}<br>
                                        <span class="title-bolder"><b>Địa chỉ</b></span>: {{ @$shipping->address }},{{ @$shipping->ward->name }}, {{ @$shipping->district->name }}, {{ @$shipping->state->name }}<br>
                                        <span class="title-bolder"><b>Ngày tạo</b></span>: {{ @$shipping->created_at }}<br>
                                        <span class="title-bolder"><b>Trạng thái</b></span>: <span class="text-primary">{{ trans('Auth::customer.statuses.'.@$shipping->status) }}</span>
                                    </address>
                                    @endforeach
                                   
                                </div>
                            </div>
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