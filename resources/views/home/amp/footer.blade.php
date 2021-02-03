
<footer id="footer" class="footer style-06">
    <div class="section-036">
        <div class="container row mx-auto">
                <div class="col-md-4 col-12">
                    <div class="logo-footer">
                        <amp-img src="{{asset("/Logo/logo.png")}}" class="az_single_image-img attachment-full lazyload" alt="{{!empty($generals['SHOP']['shop_name']) ? $generals['SHOP']['shop_name'] : 'logo'}}" width="180" height="49"  style="margin-top:20px"></amp-img>
                    </div>
                    <div class="lynessa-listitem style-01">
                        <div class="listitem-inner">
                            <ul class="listitem-list">
                                <li>
                                    <span class="icon"><span class="flaticon-localization"></span></span>
                                    {{@$generals['SHOP']['address']}}
                                </li>
                                <li>
                                    <a href="mailto:{{@$generals['SHOP']['email']}}" target="_self">
                                        <span class="icon"><span class="flaticon-email"></span></span>
                                        {{@$generals['SHOP']['email']}}</a>
                                </li>
                                <li>
                                    <span class="icon"><span class="flaticon-telephone"></span></span>
                                    {{@$generals['SHOP']['phone']}}
                                </li>
                                <li>
                                    <span class="icon"><span class="flaticon-telephone"></span></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="lynessa-socials style-01">
                        <div class="content-socials">
                            <ul class="socials-list">
                                @if (!empty(@$generals['SOCIAL']['facebook']) && @$generals['SOCIAL']['status_facebook'] == 1)
                                <li>
                                    <a href="{{@$generals['SOCIAL']['facebook']}}" target="_blank">
                                        <i class="fa fa-facebook"></i>
                                    </a>
                                </li>
                                @endif
                                @if (!empty(@$generals['SOCIAL']['youtube']) && @$generals['SOCIAL']['status_youtube'] == 1)
                                <li>
                                    <a href="{{@$generals['SOCIAL']['youtube']}}" target="_blank">
                                        <i class="fa fa-youtube"></i>
                                    </a>
                                </li>
                                @endif
                                @if (!empty(@$generals['SOCIAL']['twitter']) && @$generals['SOCIAL']['status_twitter'] == 1)
                                <li>
                                    <a href="{{@$generals['SOCIAL']['twitter']}}" target="_blank">
                                        <i class="fa fa-twitter" aria-hidden="true"></i>
                                    </a>
                                </li>
                                @endif
                                @if (!empty(@$generals['SOCIAL']['linkedin']) && @$generals['SOCIAL']['status_linkedin'] == 1)
                                <li>
                                    <a href="{{@$generals['SOCIAL']['linkedin']}}" target="_blank">
                                        <i class="fa fa-linkedin" aria-hidden="true"></i>
                                    </a>
                                </li>
                                @endif
                                @if (!empty(@$generals['SOCIAL']['instagram']) && @$generals['SOCIAL']['status_instagram'] == 1)
                                <li>
                                    <a href="{{@$generals['SOCIAL']['instagram']}}" target="_blank">
                                        <i class="fa fa-instagram" aria-hidden="true"></i>
                                    </a>
                                </li>
                                @endif
                                @if (!empty(@$generals['SOCIAL']['zalo']) && @$generals['SOCIAL']['status_zalo'] == 1)
                                <li>
                                    <a href="{{@$generals['SOCIAL']['zalo']}}" target="_blank">
                                        <amp-img src="{{asset("/system/images/zalo.png")}}" class="lazyload" width="50" height="50"></amp-img>
                                    </a>
                                </li>
                                @endif
                                @if (!empty(@$generals['SOCIAL']['tiktok']) && @$generals['SOCIAL']['status_tiktok'] == 1)
                                <li>
                                    <a href="{{@$generals['SOCIAL']['tiktok']}}" target="_blank">
                                        <amp-img src="{{asset("/system/images/tiktok.png")}}" class="lazyload"  width="50" height="50">
                                    </a>
                                </li>
                                @endif
                               
                            </ul>
                        </div>
                    </div>
                </div>
                
                @if (@$blogCategories)
                    @foreach(@$blogCategories as $category)
                        @if($category->position=='FOOTER' || $category->position=='NONE')
                        @if($category->status=="A")
                        <div class="col-md-2 col-12">
                            <div class="lynessa-listitem style-01 footerLiAmp">
                                <div class="listitem-inner">
                                    <p class="title">
                                        <a >{{ $category->title_short }}</a><span><i class="fa fa-angle-right" aria-hidden="true"></i></span></p>
                                    <ul class="listitem-list">@foreach($category->blogs as $cateFooter)@if($cateFooter->status=="A")
                                        <li>
                                            <a href="{{(!empty($cateFooter->alternative_link)) ? $cateFooter->alternative_link : ('pages/'.$cateFooter->slug.'.html') }}">{{ $cateFooter->title_short }}</a></li>@endif @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @endif
                        @endif
                    @endforeach
                @endif
                {{-- @endforeach --}}
                <div class="col-md-4 col-12">
                    
                    <div class="lynessa-newsletter style-04">
                       
                        <div class="newsletter-inner">
                            <div class="newsletter-info">
                                <div class="newsletter-wrap">
                                    <p class="title">Newsletter<span></span></p>
                                    <p class="subtitle">Get Discount 30% Off</p>
                                    <p class="desc">Nam sed felis at eros blandit ultrices et quis quam. In sit amet molestie lectus.</p>
                                </div>
                            </div>
                            
                            <div class="newsletter-form-wrap">
                                <div class="newsletter-form-inner">
                                    <input class="email email-newsletter text-left" name="email"
                                        placeholder="Nhập email của bạn..." type="email">
                                    <a href="#" class="button btn-submit submit-newsletter px-5">
                                        <span class="text">Gửi ĐI</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
    <div class="section-016">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <p>{{@$generals['SHOP']['coppyright']}}</p>
                </div>
                <div class="col-md-6">
                    <div class="payment" style="text-align:center;padding-top:20px">
                        <amp-img src="{{asset('/assets/images/payment.png')}}" class="az_single_image-img attachment-full lazyload" alt="image_payment" width="300" height="40"></amp-img>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>



{{-- <script src="{{asset('assets/js/jquery-1.12.4.min.js')}}"></script> --}}
