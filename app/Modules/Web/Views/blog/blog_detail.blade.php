@extends('home.main')
@section('title')
  {{ $blog->title_short }}
@endsection
@section('head')

@endsection

@section('content')

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
        <div class="col-md-8 col-sm-8">
          <div class="blog-item"> 
                            <img src="/storage/editor/blog/{{ @$blog->image }}" class="img-responsive"
                                alt="img">
                                <div class="blog-content">
                                    <h3>{{@$blog->title}}</h3>
                                    <ul class="blog-author">
                                        <li><a><i class="fa fa-user"></i>By Admin</a></li>
                                        <li><a><i class="fa fa-comment-o"></i>{{@$blog->comments->count()}} bình luận</a></li>
                                        <li><a><i class="fa fa-clock-o"></i>{{ date_format(@$blog->created_at,'d-m-Y') }}</a></li>
                                      </ul>
                                      <br>
                        {!! @$blog->content !!}
                        <div class="lynessa-share-socials">
                            <iframe src="https://www.facebook.com/plugins/share_button.php?href={{(isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"}}%2F&layout=button&size=small&width=76&height=20&appId" width="76" height="20" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
                        </div>
                    </div>
                    <div class="post-tag clearfix"> 
                        <ul class="tag-cloud pull-left">
                          <li> <a href="{{route('optimize_slug', ['alias1' => @$blog->category->parent->slug, 'alias2' => @$blog->category->slug. '.html'])}}">{{ @$blog->category->title_short }}</a></li>
                        </ul>
                        {{-- <ul class="social-link pull-right">
                          <li><a href="#." class="text-center"><i class="fa fa-facebook"></i><span></span></a></li>
                          <li><a href="#." class="text-center"><i class="fa fa-twitter"></i><span></span></a></li>
                          <li><a href="#." class="text-center"><i class="fa fa-dribbble"></i><span></span></a></li>
                          <li><a href="#." class="text-center"><i class="fa fa-flickr"></i><span></span></a></li>
                        </ul> --}}
                      </div>

                   
               
            <div  id="respond" class="post-comment ">
               
                {{-- END:BLOG-REF --}}                    
                <div id="comments" class="comments-area">
                    <div id="respond" class="comment-respond row">
                        <h3 id="reply-title" class="comment-reply-title" style="padding:15px">Bình luận của bạn</h3>
                        <form class="comment-form form-inline" name="commentblog" id="commentblog">
                            @csrf
                            <input type="hidden" name="blog_id" value="{{ $blog->id }}" class="text-left"/>
                          
                            <p class="col-md-6 col-sm-12 form-group">
                                <input name="name" id="name" class="form-control" placeholder="Nhập tên của bạn*" type="text" required>
                            </p>
                            <p class="col-md-6 col-sm-12 form-group">
                                <input name="email" id="email" class="form-control" placeholder="Nhập Email*" type="email" required>
                            </p>
                            <p class="col-md-12 col-sm-12 form-group comment-form-comment"><textarea class="form-control" id="comment" name="comment" cols="45" rows="6" aria-required="true" placeholder="Bình luận..."></textarea>
                            </p>
                            <p class="form-submit col-12"  style="padding:15px">
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
            <aside class="col-md-4 col-sm-4">
              <div class="widget search_box"> 
                {{-- <form>
                  <input type="search" placeholder="Search">
                  <i class="fa fa-search"></i>
                </form>
              </div>--}}
             @if(count($blogsCare)>0)
              <div class="widget"> 
                <h4>Bài viết liên quan</h4>
                <ul class="category">
                    @foreach($blogsCare as $blogCare)
                    @php
                        $slug   = $blogCare->category;
                        $slug_1 = @$slug->slug;
                    @endphp
                     @if(@$blogCare->category->position == 'BLOG')
                  <li><a href="{{route('optimize_slug', ['alias1' => @$slug->parent->slug, 'alias2' => @$slug_1, 'alias3' => $blogCare->slug])}}">{{@$blogCare->title}}<span class="date">{{ date_format(@$blogCare->created_at,'d-m-Y') }}</span></a></li>
                  @endif
                  @endforeach
                </ul>
              </div>
              @endif
              <div class="widget"> 
                <h4>Danh mục</h4>
                <ul class="category">
                    @foreach($blogCategories->where('position','BLOG') as $category)
                  <li><a href="{{ route('optimize_slug',['alias1'=>$category->slug.'.html']) }}">{{@$category->title}}</a></li>
                  @endforeach
                </ul>
              </div>
              {{-- <div class="widget"> 
                <h4>tags</h4>
                <ul class="tag-cloud">
                  <li><a href="#.">ANALYSIS</a></li>
                  <li><a href="#.">BOARD</a></li>
                  <li><a href="#.">CAREERS</a></li>
                  <li><a href="#.">DIVIDEND</a></li>
                  <li><a href="#.">EMPLOYMENT</a></li>
                  <li><a href="#.">FINANCE</a></li>
                  <li><a href="#.">news</a></li>
                  <li><a href="#.">office</a></li>
                  <li><a href="#.">ANALYSIS</a></li>
                  <li><a href="#.">BOARD</a></li>
                  <li><a href="#.">CAREERS</a></li>
                  <li><a href="#.">DIVIDEND</a></li>
                  <li><a href="#.">EMPLOYMENT</a></li>
                  <li><a href="#.">FINANCE</a></li>
                </ul>
              </div>
            </aside>
          </div> --}}
        </div>
      </section>
@endsection

@section('script')
<script>
    $("#submit").on("click", function(){
        $('.animationloadpage').show();
    });
    $(window).on("load",function() {
        var count_toc_blog = $("#toc-blog li").length;
        if(count_toc_blog<=1)
        {
            $("#toc-content").remove();
        }else{
    var urlPath = window.location.pathname;
            var str  = $('#toc-blog').html();
           var  strNew = str.replaceAll('href="', 'href="' + urlPath);
            $('#toc-blog').html(strNew);
        }
    }); 
</script>
<script src="js/jquery.toc/jquery.toc.js"></script>
<script src="js/jquery.toc/jquery.toc.min.js"></script>
@endsection