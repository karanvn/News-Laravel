@extends('home.main')
@section('title')
  {{ @$blog->title }}
@endsection
@section('head')

@endsection

@section('content')
<style>
  #menu_ol_blog{
    background: #eef;
    padding:10px 0;
  }
  #menu_ol_blog h3{
    padding:10px;
  }
 
  #menu_ol_blog li{
    margin: 0 10px 10px 30px;
  }
  .listtoc ul{
    list-style: decimal;
    margin-top:10px;
  }
  .listtoc{
   display: none;
  }

</style>
<section class="innerpage-banner">
    <div class="container">
      <div class="row">
        <div class="col-md-12 text-right">
          <h2>Blog</h2>
          <p class="tagline">{{@$blog->title}}</p>
        </div>
      </div>
    </div>
    
<!-- Blog Starts Here -->
<section id="area-main" class="padding" style="margin-top:150px">
    <div class="container">
      <div class="row">
        <div class="col-md-8 col-sm-8" style="position: relative;left: 50%;transform: translate(-50%, 0);">
          <div class="blog-item"> 
                            <img src="/storage/editor/blog/{{ @$blog->image }}" class="img-responsive"
                                alt="img" style="width: 100%;">
                                <div class="blog-content">
                                    <h3>{{@$blog->title}}</h3>
                                    <ul class="blog-author">
                                        <li><a><i class="fa fa-user"></i>By Admin</a></li>
                                        <li><a><i class="fa fa-comment-o"></i>{{@$blog->comments->count()}} bình luận</a></li>
                                        <li><a><i class="fa fa-clock-o"></i>{{ !empty($blog->created_at) ? date_format(@$blog->created_at,'d-m-Y') : ''}}</a></li>
                                        <li><a href="{{route('optimize_slug', ['alias1' => @$blog->category->parent->slug, 'alias2' => @$blog->category->slug. '.html'])}}"><i class="fa fa-file-o" aria-hidden="true"></i> {{ @$blog->category->title_short }}</a></li>
                                      </ul>

                                      <div id="menu_ol_blog">
                                        <h3 onclick="shomenu()" style="cursor: pointer"><i class="fa fa-bars" aria-hidden="true"></i> Nội dung bài viết</h3>
                                        <ul data-toc="div.content_blog_del" data-toc-headings="h2,h3" class="listtoc" style="list-style: decimal!important;"></ul>
                                      </div>
                                                        <div class="content_blog_del">{!! @$blog->content !!}</div>
                        <div class="lynessa-share-socials">
                          <script src="https://sp.zalo.me/plugins/sdk.js"></script>
                            <iframe src="https://www.facebook.com/plugins/share_button.php?href={{(isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"}}%2F&layout=button&size=small&width=76&height=20&appId" width="76" height="20" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
                            <div class="zalo-share-button" data-href="" data-oaid="579745863508352884" data-layout="1" data-color="blue" data-customize=false></div>
                          </div>

                          @if(count($blogsCare)>0)
                          <div class="widget" style="margin-top:20px; background:#eef;padding:10px"> 
                            <h4>Bài viết liên quan</h4>
                            <ul class="category">
                                @foreach($blogsCare as $blogCare)
                                @php
                                    $slug   = $blogCare->category;
                                    $slug_1 = @$slug->slug;
                                @endphp
                                 @if(@$blogCare->category->position == 'BLOG')
                              <li><a href="{{route('optimize_slug', ['alias1' => @$slug->parent->slug, 'alias2' => @$slug_1, 'alias3' => $blogCare->slug])}}">{{@$blogCare->title}}</a></li>
                              @endif
                              @endforeach
                            </ul>
                          </div>
                          @endif
                    </div>
                 

                   
               
            <div  id="respond" class="post-comment ">
               
                {{-- END:BLOG-REF --}}                    
                <div id="comments" class="comments-area">
                    <div id="respond" class="comment-respond">
                        <h3 id="reply-title" class="comment-reply-title">Bình luận của bạn</h3>
                        <form class="comment-form form-inline row" name="commentblog" id="commentblog">
                            @csrf
                            <input type="hidden" name="blog_id" value="{{ $blog->id }}" class="text-left"/>
                          
                            
                            <p class="col-md-12 col-sm-12 form-group comment-form-comment"><textarea class="form-control" id="comment" name="comment" aria-required="true" placeholder="Bình luận..." style="height: 150px;max-height:150px"></textarea>
                            </p>
                            <p class="col-md-6 col-sm-12 form-group">
                              <input name="name" id="name" class="form-control" placeholder="Nhập tên của bạn*" type="text" required style="display: none">
                          </p>
                          <p class="col-md-6 col-sm-12 form-group">
                              <input name="email" id="email" class="form-control" placeholder="Nhập Email*" type="email" required style="display: none">
                          </p>
                            <p class="form-submit col-12"  style="padding:15px; margin-top:10px">
                                <input name="submit" id="submit_comment_blog" class="col-12" value="Gửi bình luận" type="submit">
                            </p>
                            <div class="animationloadpage" style="display: none;">
                                <div class="img"><img src="css/load.gif" alt=""></div>
                            </div>
                        </form>
                        <p class="text-danger" id="err_fb" style="color:red"></p>
					              <p class="text-success" id="ok_fb" style="color:blue"></p>
                    </div><!-- #respond -->
                </div>
                <!-- #respond -->
            </div><!-- #comments -->
                {{-- BEGIN::COMMENT --}}
                <div class="grid-comment">
                    @if(count($comments)>0)
                    <label><h1>Bình luận</h1></label>
                    <hr>
                    @endif
                    <!--start node-->
                    @foreach ($comments as $comment)
                    @if(!$comment->parent_id)
                    <div class="node-commnet">
                        <div class="avatar">
                            <span class="yotpo-user-letter">{{ $comment->name['0'] }}</span>
                            <span class="yotpo-icon yotpo-icon-circle-checkmark yotpo-action-hover" data-type="toggleFade" data-target="yotpo-tool-tip" data-target-container="yotpo-header"></span>
                        </div>
                        <div class="info-comment">
                            <div class="info-preson">
                                <span class="name"><b>{{ $comment->name }}</b></span>
                            </div>
                            <div class="comment">
                                {{ $comment->comment }}
                                @foreach($comments as $reply)
                                @if($reply->parent_id==$comment->id)
                                <div style="text-indent:50px">
                                    <div class="info_answer"><b class="qtv">Quản trị viên</b>Trả lời : </div>
                                    <div><p>{{ $reply->comment }}</p></div>
                                </div>
                                @endif
                                @endforeach
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <br>
                    @endif
                    @endforeach
                    <!--end node-->
                </div>
            </div>
        </div>
          
        </div>
      </section>
@endsection

@section('script')

<script src="js/jquery.toc/jquery.toc.min.js"></script>
<script>
   
    function shomenu(){
      $('.listtoc').slideToggle();
    }

    $("#submit").on("click", function(){
        $('.animationloadpage').show();
    });
    $(window).on("load",function() {
        var count_toc_blog = $("#menu_ol_blog li").length;
        if(count_toc_blog<=1)
        {
            $("#menu_ol_blog").remove();
        }else{
    var urlPath = window.location.pathname;
            var str  = $('#menu_ol_blog').html();
           var  strNew = str.replaceAll('href="', 'href="' + urlPath);
            $('#menu_ol_blog').html(strNew);
        }
    // var urlPath = window.location.pathname;
    //  var str  = $('#menu_ol_blog').html();
    //  var  strNew = str.replaceAll('href="', 'href="' + urlPath);
    //  $('#menu_ol_blog').html(strNew);
    }); 

    $('#submit_comment_blog').on('click', function(){
      $('#name').show();
      $('#email').show();
    })
  
</script>


@endsection