@extends('home.main')
@section('title'){{ trans('Auth::auth.reset.forget_password') }} @endsection
@section('head')
<meta name="keywords" content="{{@$shopInfo['seo_keyword']}}">
<meta name="description" content="{{@$shopInfo['seo_description']}}">
{{-- SCHEMA HERE --}}
@php
echo '<script type="application/ld+json">';
	@endphp {!! @$schema->value !!} @php
echo '</script>';
@endphp
{{-- SCHEMA HERE --}}
@endsection
<style>
    .page-title{
        text-transform: uppercase;
    }
    .banner-wrapper-inner {
        padding-bottom: 20px;
    }
</style>
@section('content')

<div class="banner-wrapper">
    {{-- <img src="{{asset('assets/images/banner-for-all2.jpg')}}" class="img-responsive attachment-1920x447 size-1920x447" alt="img"> --}}
    <div class="banner-wrapper-inner">
        <h1 class="page-title">{{ trans('Auth::auth.reset.forget_password') }}</h1>
    </div>
</div>

    <form class="form col-md-5 col-12 mx-auto shadow py-5" id="frmReset" method="POST" action="{{ route('Reset') }}">

        @if (Session::has('message'))
        <p class="opacity-100 error" style="color:red">{{ Session::get('message') }}</p>
        @endif
        @csrf
        <div class="form-group">
            <input type="hidden" name="customer" value="on">
            <input id="email" class="form-control border text-left" type="email" placeholder="{{ trans('Auth::auth.login.placeholder_email') }}" name="email" value="{{ old('email') }}" autocomplete="off" />
        </div>
      
        <div class="form-group text-center">
            <button type="submit" class="btnallNew col-3">{{ trans('Auth::auth.reset.submit') }}</button>
        </div>
        <p class="text-left">
            <a class="" href="{{ route('loginmember') }}">{{ trans('Auth::auth.login.msg_login') }}</a>
         </p>
    </form>
</div>

@endsection