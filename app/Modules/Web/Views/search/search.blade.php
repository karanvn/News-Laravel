@extends('home.main')
@section('head')
	<style>
		.gach_duoi{
			border: 2px solid #ea853a;
			width: 100px;
		}
		.text_search{
			padding: 200px 100px 0 100px; 
			text-align: center;
		}
        .input_search{
            text-align: left !important;
            margin-right: -4px !important;
            margin-top: 30px;
            width: 740px !important; 
            height: 60px !important;
        }
        .btn_submit{
            width: 54px; 
            height: 60px; 
            cursor: pointer
        }
        .form_search{
            padding: 30px 100px 100px 100px; 
            width: 1000px; 
            margin: 0 auto;
        }
	</style>
@endsection
@section('content')
<h1 class="text_search">Tìm kiếm</h1>
<div class="gach_duoi mx-auto"></div>
<form action="{{route('search')}}" method="get" class="form_search">
    <input autocomplete="off" type="search" name="q" id="q" class="input_search" placeholder="Nhập từ khóa tìm kiếm...">
    <button type="submit" class="btn_submit">
        <span class="pe-7s-search"></span>
    </button>
</form>
@endsection