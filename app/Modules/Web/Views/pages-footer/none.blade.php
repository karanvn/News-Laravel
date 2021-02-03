@extends('home.main')
@section('title')
E-Laravel - {{ @$footerPage->title_short }}
@endsection
@section('content')
@php
@endphp
<br><br><br><br><br><br>
<div class="flex-row-auto offcanvas-mobile w-300px w-xl-350px" id="kt_profile_aside"">
    <div class="wrapper container">
        <h1 align="center">{{ @$footerPage->title_short }}</h1>
        {!! @$footerPage->content !!}
    </div>
</div>
    <!--=== END: CONTENT ===-->
<script src="{{asset('js/newpage/product/category.js')}}"></script>
@endsection