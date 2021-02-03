<footer class=" wow fadeInUp" data-wow-duration="500ms" data-wow-delay="300ms"> 

    <div class="container">
      <div class="row">
        <div class="col-md-12 text-center">
          <ul class="breadcrumb">
            <li><a href="#." class="page-scroll">Home</a></li>
            <li><a href="#about" class="page-scroll">About</a></li>
            <li><a href="#project" class="page-scroll">Portfolio</a></li>
            <li><a href="#publication" class="page-scroll">Blog</a></li>
            <li><a href="#thinkers" class="page-scroll">Team</a></li>
            <li><a href="#contact" class="page-scroll">Contact Us</a></li>
          </ul>
          <p>Copyright &copy; 2020 CtrlMedia. all rights reserved.</p>
        </div>
      </div>
    </div>
  </footer>
  
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

   </script>
  </body>
  </html>
  