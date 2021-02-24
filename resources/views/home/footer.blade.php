<footer class=" wow fadeInUp" data-wow-duration="500ms" data-wow-delay="300ms"> 
 <div class="container">
  <div class="col">
    <h3 class="ct-wg-title " style="color:#ffffff">
      <span>Liên hệ</span>
      <i></i></h3>
    <p><strong>Địa chỉ:</strong> {{@$generals['SHOP']['address']}}</p>
		  <p><strong>Số điện thoại:</strong> {{@$generals['SHOP']['phone']}}</p>
		  <p><strong>Email:</strong> <a>{{@$generals['SHOP']['email']}}</a></p>
      <p style="margin-top:20px" class="p-new">
     <b> Giờ làm việc</b>
      </p>
      <p>
        Thứ 2 – Thứ 6: 08:00 – 18:00, <br>
        Thứ 7: 08:00 – 12:30 <br>
        Chủ nhật: Nghỉ <br>
      </p>
  </div>
  <div class="col menu-footer">
    <h3 class="ct-wg-title " style="color:#ffffff">
      <span>Menu nhanh</span>
      <i></i></h3>
   <ul>
    @foreach($blogCategories->where('showHome','A')->where('position','SERVICE') as $menufooter)
    <li>
      <i class="fa fa-chevron-right" aria-hidden="true"></i> <a href="/{{@$menufooter->slug}}">{{@$menufooter->title}}</a>
    </li>
@endforeach
   </ul>
  </div>
  <div class="col lienheFooter">
    <h3 class="ct-wg-title" style="color:#ffffff">
      <span>Theo dỏi chúng tôi</span>
      <i></i></h3>
      <li><a href="{{@$generals['SOCIAL']['facebook']}}">Facebook</a></li>
			<li><a href="{{@$generals['SOCIAL']['twitter']}}">Twitter</a></li>
  </div>
  <div class="col-12 bottom">
    CTRL MEDIA  <br>
   244 Bàu Cát phường 11 quận Tân Bình Thành phố Hồ Chí Minh!<br>
  </div>
 </div>
</footer>
<div class="end">
  2015 – 2021 © All rights reserved by Ctrl Media 
</div>
<div class="alert-ctrl">
  <span class="content"></span>
  <button id="close-alert-ctrl">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
   <a href="#." class="go-top text-center"><i class="fa fa-angle-double-up"></i></a>
   <script src="/template/js/jquery-2.1.4.js"></script> 
   <script src="/template/js/bootstrap.min.js"></script>
   <script src="/template/js/jquery.themepunch.tools.min.js"></script>
   <script src="/template/js/jquery.themepunch.revolution.min.js"></script>
   <script src="/template/js/jquery.easing.min.js"></script>
   <script src="/template/js/owl.carousel.min.js"></script> 
   <script src="/template/js/jquery-countTo.js"></script> 
   <script src="/template/js/jquery.appear.js"></script> 
   <script src="/template/js/jquery.circliful.js"></script>
   <script src="/template/js/jquery.mixitup.min.js"></script>
   <script src="/template/js/wow.min.js"></script>
   <script src="/template/js/jquery.parallax-1.1.3.js"></script>
   <script src="/template/js/jquery.fancybox.js"></script>
   <script src="/template/js/jquery.fancybox-thumbs.js"></script>
   <script src="/template/js/jquery.fancybox-media.js"></script>
   <script src="/template/js/jPushMenu.js"></script>
   <script src="/template/js/functions.js"></script>
   <script src="/js/newpage/lazysize.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
   <script>
    new WOW().init();
</script>

   <script>
$('.lazyload').removeAttr("src");

     $('#btn_submit_feedback').on('click', function(){
      var name = $('#name_feedback').val();
      var email = $('#email_feedback').val();
      var content = $('#content_feedback').val();
      $('#err_fb').html('');
      $('#ok_fb').html('');
      $('#btn_submit_feedback').attr("disabled", "true");
      $.ajax("/addfeedBack?name="+name + "&email="+email+"&content="+content, {
		method: "GET",
		dataType: "json",
		contentType: !1,
		cache: !1,
		processData: !1,
		success: function (a) {
      $('#btn_submit_feedback').removeAttr('disabled');
      if(a.success){
        $('#ok_fb').html(a.errors);
        $('#name_feedback').val('');
       $('#email_feedback').val('');
       $('#content_feedback').val('');
      }else{
        $('#err_fb').html(a.errors);
      }
    }
  })
     })

     $('#btn_submit_feedback').on('click', function(){
      var name = $('#name_feedback').val();
      var email = $('#email_feedback').val();
      var content = $('#content_feedback').val();
      $('#err_fb').html('');
      $('#ok_fb').html('');
      $('#btn_submit_feedback').attr("disabled", "true");
      $.ajax("/addfeedBack?name="+name + "&email="+email+"&content="+content, {
		method: "GET",
		dataType: "json",
		contentType: !1,
		cache: !1,
		processData: !1,
		success: function (a) {
      $('#btn_submit_feedback').removeAttr('disabled');
      if(a.success){
        $('#ok_fb').html(a.errors);
        $('#name_feedback').val('');
       $('#email_feedback').val('');
       $('#content_feedback').val('');
      }else{
        $('#err_fb').html(a.errors);
      }
    }
  })
     })
     

     $("#commentblog").submit(function () {
        event.preventDefault(),
        $('#err_fb').html('');
      $('#ok_fb').html('');
            $("#submit_comment_blog").prop("disabled", !0),
            $.ajax("/commentblogNew", {
                method: "POST",
                data: new FormData(this),
                dataType: "JSON",
                contentType: !1,
                cache: !1,
                processData: !1,
                success: function (t) {
                  $("#submit_comment_blog").prop("disabled", !1);
                  if(t.success){
        $('#ok_fb').html(t.toastr);
        $('#name_feedback').val('');
       $('#email_feedback').val('');
       $('#content_feedback').val('');
      }else{
        $('#err_fb').html(t.toastr);
      }
                 },
            });
    })

    $('.i_menu').on('click', function(){
      var id = $(this).attr("id");
      id = (id = id.split("_"))[1];
      $('.menu_'+id).slideToggle('slow');
      var transform = $(this).css('transform');
      // $('.nav-ctrl ul li i').css('transform','rotate(0)');
      if(transform != 'matrix(6.12323e-17, 1, -1, 6.12323e-17, 0, 0)'){
        $(this).css('transform','rotate(90deg)');
      }else{
        $(this).css('transform','rotate(0)');
      }
    })
    $('#volpriceshowModal').on('input', function(){
      var d = $(this).val();
      d = d.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.')
      $('.priceshowModal').html(d + ' đ');

    })

    $("#priceshowModalFrm").submit(function () {
	event.preventDefault(),
	$("#quotePrice").prop("disabled", !0),
	$.ajax("/priceshowModalFrm", {
		method: "POST",
		data: new FormData(this),
		dataType: "JSON",
		contentType: !1,
		cache: !1,
		processData: !1,
		success: function (t) {
		console.log(t);
    if(t.passes){
      $('.alert-ctrl .content').html('Đã gửi thành công');
    }else{
      $('.alert-ctrl .content').html('Xin điền đầy đủ thông tin');
    }
    $('.alert-ctrl').show();
	$("#quotePrice").prop("disabled", 0);
		}
	})
})
$('.alert-ctrl button').on('click', function(){
  $('.alert-ctrl').hide();
})

   </script>
    @if(session()->has('success'))
    <input type="hidden" value="{{ session('success') }}" id="content_success">
   <script>
    
     $('.alert-ctrl .content').html( $('#content_success').val());
     $('.alert-ctrl').show();

   </script>
    @endif
  
  </body>
  </html>
  