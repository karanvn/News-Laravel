$(document).ready(function(){$(".raitingHome .carousel").slick({slidesToShow:3,dots:!0,autoplay:!0,centerMode:!1,prevArrow:$(".prev"),nextArrow:$(".next"),responsive:[{breakpoint:768,settings:{slidesToShow:1,slidesToScroll:1}}]}),$(".bannerHome .carousel").slick({slidesToShow:1,dots:!1,autoplay:!0,variableWidth:!0,arrows:!1,centerMode:!0,autoplaySpeed: 3500}),$(".titleHighlights li").on("click",function(){$(".titleHighlights li").removeClass("active"),$(this).addClass("active");var e=$(this).attr("id");e=(e=e.split("_"))[1],$(".ContentHighlights .item").removeClass("active"),$("#content_"+e).addClass("active")})});