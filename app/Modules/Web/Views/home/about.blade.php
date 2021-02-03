@extends('home.main')
@section('title')
E-Laravel - {{ @$footerPage->title_short }}
@endsection
@section('content')
<style>
    h2.title {
	color: red;
	color: #857979;
	letter-spacing: 4px;
}

.title_stady{
    font-weight: 800;
}

/* ul#menu-primary-menu li a{
    color: white;
}

#wpml-menu li a{
    color: white;
}

.wcml-dropdown a.wcml-cs-item-toggle {
    color: #fff;
} */
header#header{
    border-bottom: 1px solid #ffffff4a;
}

.aboutUsPage-banner-1K3 {
	position: relative;
	width: 100%;
	display: flex;
	justify-content: center;
	align-items: center;
	height: 420px;
	background-repeat: no-repeat;
	background-position: center;
	background-size: cover;
}

.aboutUsPage-bannerText-HAA {
	color: #fff;
	white-space: pre-line;
	text-align: center;
}

.typography-largeTitle-3vL {
	font-family: var(--curnon-font);
	font-style: normal;
	font-weight: 500;
	font-size: 38px;
	line-height: 46px;
	letter-spacing: 0.05em;
}

@media (min-width: 1024px) {
	.aboutUsPage-banner-1K3 {
		height: 770px;
	}
}

.aboutUsPage-banner2-3eZ {
	position: relative;
	width: 100%;
	height: 500px;
	background-repeat: no-repeat;
	background-position: center;
	background-size: auto auto;
	display: flex;
	align-items: center;
	justify-content: center;
}

.aboutUsPage-banner2Content-1tG {
	margin: 0 24px;
}

.aboutUsPage-banner2title-3Hf {
	/* color: #fff; */
	margin-bottom: 25px;
	text-align: center;
}

@media (min-width: 768px) {
	.typography-title-PVi {
		font-weight: 300;
		font-size: 30px;
		line-height: 37px;
		letter-spacing: 0.05em;
	}
}

.typography-title-PVi {
	font-family: Montserrat;
	font-style: normal;
	font-weight: 300;
	font-size: 20px;
	line-height: 24px;
	letter-spacing: 0.05em;
}

@media (min-width: 1024px) {
	.aboutUsPage-banner2text-3EL {
		width: 520px;
	}
}

.aboutUsPage-link-2np {
	width: 272px;
	height: 50px;
	display: flex;
	justify-content: center;
	align-items: center;
	/* color: #fff; */
	border: 1px solid #000;
	margin: 0 auto;
}

@media (min-width: 1024px) {
	.aboutUsPage-coreValues-2fz {
		padding: 140px 0 0 0;
		max-width: var(--curnon-max-width);
		width: 100%;
		margin: 0 auto;
		display: grid;
		gap: 40px 30px;
		grid-template-columns: repeat(3, 1fr);
	}
}

@media (min-width: 1024px) {
	.aboutUsPage-coreValues-2fz>div:not(:last-of-type) {
		margin-bottom: unset;
	}
}

.aboutUsPage-coreValuesTitle-2qa {
	text-align: center;
	grid-column: 1 / -1;
}

.typography-title-PVi {
    font-family: time news roman;
    font-style: normal;
    font-size: 30px;
}

.aboutUsPage-coreValue-15D {
	display: flex;
	flex-direction: column;
	justify-content: flex-start;
	align-items: center;
}

.aboutUsPage-coreValueImage-2KG {
	height: 106px;
	object-fit: contain;
	margin-bottom: 25px;
}

.aboutUsPage-valueTitle-1io {
	text-align: center;
}

@media (min-width: 768px) {
	.typography-bodyBold-2Ua {
		font-weight: 500;
	}
}

@media (min-width: 768px) {
	.typography-body-1BC {
		font-family: var(--curnon-font);
		font-style: normal;
		font-weight: normal;
		font-size: 14px;
		line-height: 21px;
		letter-spacing: 0.02em;
	}
}

.typography-subTitle-3Ge {
    font-family: var(--curnon-font);
    font-style: normal;
    font-weight: 300;
    font-family: time news roman;
    font-size: 27px;
    line-height: 35px;
    letter-spacing: 0.04em;
}
@media (min-width: 768px)
{
.community-community-2l7 {
    background: none;
    height: unset;
}}
.community-image-2io {
    flex: 0 0 auto;
    justify-content: center;
    position: relative;
    display: inline-flex;
}
.image-container-_fN {
    position: relative;
}
.image-image-2gD {
    max-width: 100%;
}
@media (min-width: 768px)
{.community-slides-1F_ {
    display: flex;
}
}
.image-loaded-SHk {
    /* position: absolute; */
    top: 0;
    left: 0;
    visibility: visible;
}
.community-gallery-xCC {
    padding: 30px 0;
    position: relative;
    overflow: hidden;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
}
</style>

<div class="flex-row-auto offcanvas-mobile w-300px w-xl-350px" id="kt_profile_aside">
    <section class="aboutUsPage-banner-1K3" style="background-image: url('{{asset('assets/images/banner_about.png')}}');">
    <p class="aboutUsPage-bannerText-HAA typography-largeTitle-3vL">Chào bạn, chúng tôi là CURNON!
        /cơ - nần/!
    </p>
    </section>
    <div class="wrapper container" style="padding-top: 120px">
        <div class="mod-content row">
            <div class="row">
                <div class="col-md-6">
                    <img src="{{asset('assets/images/about_1.jpg')}}" alt="">
                </div>
                <div class="col-md-6 mt-3">
                    <div class="row">
                    <div class="col-md-11 mx-auto">
                        <h2 class="title">TẠI SAO KHÔNG?</h2>
                        <p style="color: rgba(0, 0, 0, 0.6); letter-spacing: 0.02em; line-height: 28px; font-family: 'Segoe UI light', Tahoma, Geneva, Verdana, sans-serif; font-size: 18px">Đó là câu hỏi của chúng tôi khi bắt đầu. Và Curnon lựa chọn Đồng hồ - một sản phẩm phụ kiện không thể thiếu, một người bạn đồng hành để luôn sát cánh và là nguồn cảm hứng cho những người trẻ Việt trên hành trình chạm đến của giấc mơ của bản thân. Sau thành công ở Shark Tank mùa 2, cho đến giờ, chúng tôi tự hào vì sản phẩm của Curnon đã đồng hành cùng hàng chục ngàn bạn trẻ Việt Nam.</p>
                    </div>
                    </div>
                    {{-- 
                    <div class="row">
                    <div class="col-md-10">
                        <div class="col-md-5 mx-auto">
                            <img src="{{asset('assets/images/icon_about_1.png')}}" alt="">
                            <p>700% tốc độ tăng trưởng</p>
                        </div>
                        <div class="col-md-5">
                            <img src="{{asset('assets/images/icon_about_2.png')}}" alt="">
                            <p>20.000 khách hàng thân thiết</p>
                        </div>
                    </div>
                    </div>
                    --}}
                </div>
            </div>
            <div class="row">
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-12 text-center">
                <h2 class="title">SỨ MỆNH</h2>
            </div>
            <div class="col-md-10 mx-auto" style="color: rgba(0, 0, 0, 0.6); letter-spacing: 0.02em;">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Vero ab assumenda nesciunt numquam odio voluptatum in mollitia, aspernatur quas, cupiditate accusantium quidem architecto, beatae dolores aut ducimus earum totam sapiente!Lorem ipsum dolor, sit amet consectetur adipisicing elit. Vero ab assumenda nesciunt numquam odio voluptatum in mollitia, aspernatur quas, cupiditate accusantium quidem architecto, beatae dolores aut ducimus earum totam sapiente!Lorem ipsum dolor, sit amet consectetur adipisicing elit. Vero ab assumenda nesciunt numquam odio voluptatum in mollitia, aspernatur quas, cupiditate accusantium quidem architecto, beatae dolores aut ducimus earum totam sapiente!Lorem ipsum dolor, sit amet consectetur adipisicing elit. Vero ab assumenda nesciunt numquam odio voluptatum in mollitia, aspernatur quas, cupiditate accusantium quidem architecto, beatae dolores aut ducimus earum totam sapiente!</div>
        </div>
    </div>
    <div style="padding-top: 110px">
        <section class="aboutUsPage-banner2-3eZ" style="background-image: url('{{asset('assets/images/banner_about2.jpg')}}');">
            <div class="aboutUsPage-banner2Content-1tG">
                <p class="aboutUsPage-banner2title-3Hf typography-title-PVi">SẢN PHẨM</p>
                <p class="aboutUsPage-banner2text-3EL typography-body-1BC">Với phương châm “Bắt đầu bằng khách hàng, kết thúc bằng khách hàng”, mỗi sản phẩm của Curnon được nghiên cứu dựa trên nhu cầu mà khách hàng mong muốn, được thiết kế bằng trái tim đầy nhiệt huyết, khát khao và khối óc đầy sáng tạo của đội ngũ những người trẻ Việt Nam. Curnon khẳng định rằng chúng ta có khả năng phát triển những sản phẩm vươn ra tầm thế giới.
                    Tại sao không?
                </p>
                <a class="aboutUsPage-link-2np typography-bodyBold-2Ua typography-body-1BC typography-body-1BC" href="/">KHÁM PHÁ NGAY</a>
            </div>
        </section>
    </div>
    <div class="container">
        <section class="aboutUsPage-coreValues-2fz">
            <div class="aboutUsPage-coreValuesTitle-2qa">
                <p class="aboutUsPage-titleText-y0w typography-subTitle-3Ge">GIÁ TRỊ CỐT LÕI</p>
                <p class="aboutUsPage-titleDescription-1kp typography-body-1BC">Chúng tôi tin rằng cách tốt nhất để truyền tải được thông điệp “Tại sao không?” trước hết phải bắt đầu từ chính tập thể của Curnon</p>
            </div>
            <div class="aboutUsPage-coreValue-15D">
                <img class="aboutUsPage-coreValueImage-2KG" alt="" src="{{asset('assets/images/icon_about_3.png')}}">
                <p class="title_stady">Bắt đầu và kết thúc bằng khách hàng</p>
                <p class="aboutUsPage-valueDescription-1fJ typography-subHead-3Eu">Với tinh thần của những chiến binh, chúng tôi luôn chiến đấu với chính bản thân mình mỗi ngày để đem lại những trải nghiệm “WOW” nhất cho người trẻ Việt Nam.</p>
            </div>
            <div class="aboutUsPage-coreValue-15D">
                <img class="aboutUsPage-coreValueImage-2KG" alt="" src="{{asset('assets/images/icon_about_4.png')}}">
                <p class="title_stady">Dám nghĩ, dám làm</p>
                <p class="aboutUsPage-valueDescription-1fJ typography-subHead-3Eu">Với khát khao trở thành người đồng hành của các bạn, chúng tôi tin rằng chính mình phải có đủ can đảm để vượt qua thách thức, dám nghĩ, dám dẫn đầu và khác biệt.</p>
            </div>
            <div class="aboutUsPage-coreValue-15D">
                <img class="aboutUsPage-coreValueImage-2KG" alt="" src="{{asset('assets/images/icon_about_5.png')}}">
                <p class="title_stady">Truyền cảm hứng</p>
                <p class="aboutUsPage-valueDescription-1fJ typography-subHead-3Eu">Tương lai với chúng tôi là những sản phẩm vươn tầm thế giới, là thế hệ trẻ Việt Nam đầy tự tin để theo đuổi đam mê của mình, là "Why not?" trở thành triết lí của tất cả mọi người.</p>
            </div>
        </section>
    </div>
    
</div>

<script src="{{asset('js/newpage/product/category.js')}}"></script>
@endsection