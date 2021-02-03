@extends('home.main')
@section('title')
{{ @$footerPage->title_short }}
@endsection
<style>
 
</style>
@section('content')
<br><br><br><br><br><br>
<div class="flex-row-auto offcanvas-mobile w-300px w-xl-350px" id="kt_profile_aside"">
    <div class="wrapper container">
        <div class="mod-content row">
            <div class="lynessa-listitem style-01 col-md-3 col-xs-12 col-sm-4">
                <div class="block_left" style="border-right: 1px solid #eee; width: 80%; padding-right: 5px">
                    @foreach(@$categoryLefts as $categoryLeft)
                    <div class="listitem-inner" style="border-bottom: 1px solid #eee;">
                        <div class="title">
                            <h4>{{ @$categoryLeft->title_short }}</h4>
                        </div>
                        <div class="mc-content">
                            <ul class="listitem-list">
                                @foreach (@$categoryLeft->blogs->where('status','A')->where('position_show','top') as $catePages)                          
                                <li @if(@$catePages->slug==$slug)style="color: #cf9163"@endif><a href="{{(!empty($catePages->alternative_link)) ? $catePages->alternative_link : ('pages/'.$catePages->slug.'.html') }}"
                                        title="{{ @$catePages->title_short }}">{{ @$catePages->title_short }}</a></li>
                                @endforeach
                                @foreach (@$categoryLeft->blogs->where('status','A')->where('position_show','<>','top')->where('position_show','<>','bottom') as $catePages)                          
                                <li @if(@$catePages->slug==$slug)style="color: #cf9163"@endif><a href="{{(!empty($catePages->alternative_link)) ? $catePages->alternative_link : ('pages/'.$catePages->slug.'.html') }}"
                                        title="{{ @$catePages->title_short }}">{{ @$catePages->title_short }}</a></li>
                                @endforeach
                                @foreach (@$categoryLeft->blogs->where('status','A')->where('position_show','bottom') as $catePages)                          
                                <li @if(@$catePages->slug==$slug)style="color: #cf9163"@endif><a href="{{(!empty($catePages->alternative_link)) ? $catePages->alternative_link : ('pages/'.$catePages->slug.'.html') }}"
                                        title="{{ @$catePages->title_short }}">{{ @$catePages->title_short }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    @endforeach
                </div>
                <!--End menu cat-->
            </div>
            <!--end md3-->
            <div class="col-md-9 col-xs-12 col-sm-8">
                <!--===BEGIN: BOX MAIN===-->
                <div class="breadcrumb">
                    <div class="navation">
                        <ul>
                            <li><a href="/">Trang chủ</a></li>
                            <li class="breadcrumb_last">Câu hỏi thường gặp</li>
                        </ul>
                    </div>
                </div>
                            <!--===END: BREADCRUMB===-->
                            <div class="wap_question">
                                <h2>CÂU HỎI CHUYÊN MÔN</h2>
                                <button class="accordion">1. Tôi muốn mua hàng phải làm sao?</button>
                                <div class="panel">
                                    <strong>Answer :</strong>
                                    <p class="answer">Khi bạn muốn mua một mặt hàng tại evashopping, bạn có thể đến shop mua trực tiếp, gọi điện cho evashopping hoặc đặt hàng trên website</p>
                                </div>
                                <button class="accordion">2. Tôi ở xa có mua hàng được không? Shop có giao hàng không?</button>
                                <div class="panel">
                                    <strong>Answer :</strong>
                                    <p class="answer">evashopping giao hàng và thu tiền tận nơi trên toàn quốc, miễn phí giao hàng cho hóa đơn từ 01 triệu đồng trở lên, nên các bạn yên tâm thoải mái mua hàng nhé!</p>
                                </div>
                                <button class="accordion">3. Tôi không biết chọn size như thế nào?</button>
                                <div class="panel">
                                    <strong>Answer :</strong>
                                    <p class="answer">Nếu bạn băn khoăn không biết chọn size nào cho phù hợp với cân nặng và chiều cao của mình, hãy xem chi tiết tại link sau: https://evashopping.vn/huong-dan-chon-size.html</p>
                                </div>
                                <button class="accordion">4. Tôi muốn mua hàng phải làm sao?</button>
                                <div class="panel">
                                    <strong>Answer :</strong>
                                    <p class="answer">Khi bạn muốn mua một mặt hàng tại evashopping, bạn có thể đến shop mua trực tiếp, gọi điện cho evashopping hoặc đặt hàng trên website</p>
                                </div>
                                <button class="accordion">5. Tôi ở xa có mua hàng được không? Shop có giao hàng không?</button>
                                <div class="panel">
                                    <strong>Answer :</strong>
                                    <p class="answer">evashopping giao hàng và thu tiền tận nơi trên toàn quốc, miễn phí giao hàng cho hóa đơn từ 01 triệu đồng trở lên, nên các bạn yên tâm thoải mái mua hàng nhé!</p>
                                    </div>
                                    <button class="accordion">6. Tôi không biết chọn size như thế nào?</button>
                                    <div class="panel">
                                    <strong>Answer :</strong>
                                    <p class="answer">Nếu bạn băn khoăn không biết chọn size nào cho phù hợp với cân nặng và chiều cao của mình, hãy xem chi tiết tại link sau: https://evashopping.vn/huong-dan-chon-size.html</p>
                                </div>
                            </div>
                            <!--end wap_question-->
                            <div class="wap_question">
                                <h2>DÀNH CHO ĐỐI TÁC</h2>
                                <button class="accordion">Tôi muốn giới thiệu khách hàng cho evashopping?</button>
                                <div class="panel">
                                <strong>Answer :</strong>
                                <p class="answer">Chúng tôi rất hoanh nghênh cơ hội bạn mang đến cho Lộc Thiên Phúc. Bạn có thể liên hệ với Lộc Thiên Phúc để chia sẻ thông tin hữu ích này hoặc gửi địa chỉ website của Lộc Thiên Phúc cho người bạn định giới thiệu. Chúng tôi xin cảm ơn thiện chí của bạn và gửi tặng cho bạn phần "quà" theo định mức quy định mà Lộc Thiên Phúc dành cho đối tác giới thiệu khách hàng thành công."</p>
                                </div>
                                <button class="accordion">Tôi muốn cung cấp sản phẩm cho evashopping</button>
                                <div class="panel">
                                <strong>Answer :</strong>
                                <p class="answer">Hiện tại chúng tôi cần hợp tác với một số nhà thầu phụ. Nếu bạn quan tâm xin gửi email đề nghị hợp tác tới info@locthienphuc.com</p>
                                </div>
                                <button class="accordion">Tôi muốn làm việc tại evashopping?</button>
                                <div class="panel">
                                <strong>Answer :</strong>
                                <p class="answer">Bạn vui lòng xem trong mục Tuyển Dụng để có thông tin chi tiết về các vị trí mà chúng tôi đang tuyển dụng.</p>
                                </div>
                            </div>
                            <!--end wap_question-->
                            <div class="wap_question">
                                <h2>DỊCH VỤ KHÁCH HÀNG</h2>
                                <button class="accordion">Nếu tôi mua số lượng lớn thì có ưu đãi giá tốt hơn không?</button>
                                <div class="panel">
                                <strong>Answer :</strong>
                                <p class="answer">Chúng tôi rất vui mừng vì bạn hỏi câu này. Lộc Thiên Phúc luôn có mức ưu đãi tốt nhất đối với các khách hàng mua số lượng nhiều và khách hàng thân thiết. Chính vì thế trước khi chúng tôi báo giá bạn nên cung cấp chính xác số lượng sản phẩm cần mua để chúng tôi có thể dành cho bạn mức giá tốt nhất.</p>
                                </div>
                                <button class="accordion">Evashopping  từng làm việc với những khách hàng lớn nào?</button>
                                <div class="panel">
                                <strong>Answer :</strong>
                                <p class="answer">Qua hơn 06 năm hoạt động, Lộc Thiên Phúc phục vụ trên 1500+ khách hàng với nhiều lĩnh vực khác nhau từ: Resort, Khách sạn, khu căn hộ, Villa, quán cafe cao cấp, công ty thiết kế kiến trúc, kiến trúc sư, hộ gia đình riêng lẻ, các đối tác nước ngoài,… Trong đó có các tên tuổi như: Vingroup, Novaland, Đại Quang Minh, Thảo Điền Investerment, Tân Hoàng Minh, Hoà Bình, tập đoàn Thành Thành Công, City Garden,....</p>
                                </div>
                                <button class="accordion">Eváhopping thành lập khi nào? Có bao nhiêu nhân sự?</button>
                                <div class="panel">
                                <strong>Answer :</strong>
                                <p class="answer">Lộc Thiên Phúc được thành lập vào ngày 30/10/2014. Hiện tại Lộc Thiên Phúc có trụ sở tại TP. HCM. Số lượng nhân sự gần 96 người ( 18 khối văn phòng và 78 khối sản xuất</p>
                                </div>
                            </div>
                            <!--end wap_question-->
                        </div>
                    </div>
                    <!--===END: BOX MAIN===-->
                </div>
                <div class="clear"></div>
            </div>
            <!--end md9-->

        </div>
    </div>
    <!--=== END: CONTENT ===-->
<script src="{{asset('js/newpage/product/category.js')}}"></script>
<script>
$(document).ready(function() {
   
    $('.accordion ').click(function() {
        $('.accordion ').removeClass('on');
        
        $('.panel').slideUp('normal');
        if($(this).next().is(':hidden') == true) {
        
        $(this).addClass('on');
        $(this).next().slideDown('normal');
    } 
        
    });
      
    $('.accordion ').mouseover(function() {
        $(this).addClass('over');
    }).mouseout(function() {
        $(this).removeClass('over');                    
    });
    
    $('.panel').hide();
  
  });
  </script>
@endsection