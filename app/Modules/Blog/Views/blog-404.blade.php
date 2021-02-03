@extends('home.main')
@section('title')
404
@endsection
@section('content')
<div id="app-container" data-radium="true" style="display: block; min-height: 50px;"></div>
    <div
        style="display: flex; flex-direction: column; justify-content: center; align-items: center; width: 100%; max-width: 550px; padding: 50px 0px 70px; margin: 0px auto;">
        <img alt="" src="assets/images/404.png"
            style="display: block; width: 300px; height: auto; min-width: 100px; min-height: 100px; margin-bottom: 10px; pointer-events: none;">
        <div style="margin-bottom: 40px;">
            <div style="font-size: 24px; line-height: 32px; margin-bottom: 10px; font-weight: 700; text-align: center; color: rgb(151, 153, 154);">
                Có gì đó sai sai</div>
            <div style="font-size: 16px; color: rgb(151, 153, 154); text-align: center; width: 100%; margin: 0px auto;">
                Có vẻ như bạn đã vào địa chỉ không đúng</div>
            <div style="font-size: 16px; color: rgb(151, 153, 154); text-align: center; width: 100%; margin: 0px auto;">
                hoặc sản phẩm không còn bán trên Evashopping</div>
        </div>
        <div class="btn-cont">
            <a class="btn" id="xemthem" style="display: block;">
                Trang chủ
                <span class="line-1"></span>
                <span class="line-2"></span>
                <span class="line-3"></span>
                <span class="line-4"></span>
            </a>
        </div>
    </div>
</div>
@endsection