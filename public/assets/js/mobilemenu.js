!function(d){function c(){var a=jQuery("body").innerWidth();991<(a+=function(){var k=jQuery('<div style="width:100%;height:200px;">test</div>'),j=jQuery('<div style="width:200px;height:150px;position:absolute;top:0;left:0;visibility:hidden;overflow:hidden;"></div>').append(k),h=k[0],m=j[0];jQuery("body").append(m);var i=h.offsetWidth;j.css("overflow","scroll");var g=m.clientWidth;return j.remove(),i-g}())&&d(".lynessa-menu-wapper").each(function(){if(0<d(this).length){var g=d(this);if("undefined"!=g){var e,h=g.offset();e=g.innerWidth(),setTimeout(function(){d(".main-menu .item-megamenu").each(function(z,y){d(y).children(".megamenu").css({"max-width":e+"px"});var n=d(y).children(".megamenu").outerWidth(),q=d(y).outerWidth(),m=h.left,j=m+e,w=d(y).offset().left,v=w-m<n/2,k=j<n/2+w;if(d(y).children(".megamenu").css({left:"-"+(n/2-q/2)+"px"}),v){var x=w-m;d(y).children(".megamenu").css({left:-x+"px"})}k&&!v&&(x=w-m,x-=e-n,d(y).children(".megamenu").css({left:-x+"px"}))})},100)}}})}function b(){var a=parseInt(d(".container").innerWidth())-30;d(".lynessa-menu-wapper.vertical.support-mega-menu").each(function(){var e=parseInt(d(this).actual("width")),g=a-e;0<g&&d(this).find(".megamenu").each(function(){var h=d(this).attr("style");h=(h=null==h?"":h)+" max-width:"+g+"px;",d(this).attr("style",h)})})}function f(g,a){return a+g}d(document).ready(function(){c(),b(),d(document).on("click",".menu-toggle",function(){return d(".lynessa-menu-clone-wrap").addClass("open"),!1}),d(document).on("click",".lynessa-menu-clone-wrap .lynessa-menu-close-panels",function(){return d(".lynessa-menu-clone-wrap").removeClass("open"),!1}),d(document).on("click",function(a){a.offsetX>d(".lynessa-menu-clone-wrap").width()&&d(".lynessa-menu-clone-wrap").removeClass("open")}),d(document).on("click",".lynessa-menu-next-panel",function(k){var g=d(this),p=g.closest(".menu-item"),j=g.closest(".lynessa-menu-panel"),e=g.attr("href");if(d(e).length){j.addClass("lynessa-menu-sub-opened"),d(e).addClass("lynessa-menu-panel-opened").removeClass("lynessa-menu-hidden").attr("data-parent-panel",j.attr("id"));var h=p.find(".lynessa-menu-item-title").attr("title"),m="";0<d(".lynessa-menu-panels-actions-wrap .lynessa-menu-current-panel-title").length&&(m=d(".lynessa-menu-panels-actions-wrap .lynessa-menu-current-panel-title").html()),void 0!==h&&0!=typeof h?(d(".lynessa-menu-panels-actions-wrap .lynessa-menu-current-panel-title").length||d(".lynessa-menu-panels-actions-wrap").prepend('<span class="lynessa-menu-current-panel-title"></span>'),d(".lynessa-menu-panels-actions-wrap .lynessa-menu-current-panel-title").html(h)):d(".lynessa-menu-panels-actions-wrap .lynessa-menu-current-panel-title").remove(),d(".lynessa-menu-panels-actions-wrap .lynessa-menu-prev-panel").remove(),d(".lynessa-menu-panels-actions-wrap").prepend('<a data-prenttitle="'+m+'" class="lynessa-menu-prev-panel" href="#'+j.attr("id")+'" data-cur-panel="'+e+'" data-target="#'+j.attr("id")+'"></a>')}k.preventDefault()}),d(document).on("click",".lynessa-menu-prev-panel",function(k){var g=d(this),m=g.attr("data-cur-panel"),j=g.attr("href");d(m).removeClass("lynessa-menu-panel-opened").addClass("lynessa-menu-hidden"),d(j).addClass("lynessa-menu-panel-opened").removeClass("lynessa-menu-sub-opened");var e=d(j).attr("data-parent-panel");if(void 0===e||0==typeof e){d(".lynessa-menu-panels-actions-wrap .lynessa-menu-prev-panel").remove(),d(".lynessa-menu-panels-actions-wrap .lynessa-menu-current-panel-title").remove()}else{d(".lynessa-menu-panels-actions-wrap .lynessa-menu-prev-panel").attr("href","#"+e).attr("data-cur-panel",j).attr("data-target","#"+e);var h=d("#"+e).find('.lynessa-menu-next-panel[data-target="'+j+'"]').closest(".menu-item").find(".lynessa-menu-item-title").attr("data-title");void 0!==(h=d(this).data("prenttitle"))&&0!=typeof h?(d(".lynessa-menu-panels-actions-wrap .lynessa-menu-current-panel-title").length||d(".lynessa-menu-panels-actions-wrap").prepend('<span class="lynessa-menu-current-panel-title"></span>'),d(".lynessa-menu-panels-actions-wrap .lynessa-menu-current-panel-title").html(h)):d(".lynessa-menu-panels-actions-wrap .lynessa-menu-current-panel-title").remove()}k.preventDefault()})}),d(window).on("resize",function(){c(),b()})}(jQuery),jQuery(function(a){a("body").on("init",".lynessa-tabs-wrapper, .lynessa-tabs",function(){a(".lynessa-tab, .lynessa-tabs .panel:not(.panel .panel)").hide();var c=window.location.hash,b=(window.location.href,a(this).find(".lynessa-tabs, ul.tabs").first());"#reviews"===c||"#tab-reviews"===c?b.find("li.reviews_tab a").click():"#tab-additional_information"===c?b.find("li.additional_information_tab a").click():b.find("li:first a").click()}).on("click",".lynessa-tabs li a, ul.tabs li a",function(c){c.preventDefault();var b=a(this),d=b.closest(".lynessa-tabs-wrapper, .lynessa-tabs");d.find(".lynessa-tabs, ul.tabs").find("li").removeClass("active"),d.find(".lynessa-tab, .panel:not(.panel .panel)").hide(),b.closest("li").addClass("active"),d.find(b.attr("href")).show()}).on("click","a.lynessa-review-link",function(){return a(".reviews_tab a").click(),!0}),a(".lynessa-tabs-wrapper, .lynessa-tabs").trigger("init"),0<a(".flex-control-nav, .lynessa-product-gallery__wrapper").length&&(a(".lynessa-product-gallery__wrapper").slick({slidesToShow:1,slidesToScroll:1,arrows:!1,draggable:!1,fade:!0,asNavFor:".flex-control-nav"}),a(".flex-control-nav").slick({vertical:!0,slidesToShow:3,slidesToScroll:1,asNavFor:".lynessa-product-gallery__wrapper",dots:!1,arrows:!0,prevArrow:'<span class="fa fa-angle-up prev"></span>',nextArrow:'<span class="fa fa-angle-down next"></span>',focusOnSelect:!0,slidesMargin:14,responsive:[{breakpoint:991,settings:{vertical:!1,slidesToShow:3,prevArrow:'<span class="fa fa-angle-left prev"></span>',nextArrow:'<span class="fa fa-angle-right next"></span>'}}]})),a(document).ready(function(){a(document).on("click",".comment-form-rating p.stars a",function(){var c=a(this),b=a(this).closest("#star-rating").find("#rating"),d=a(this).closest(".stars");return b.val(c.text()),c.siblings("a").removeClass("active"),c.addClass("active"),d.addClass("selected"),!1}),a(".lynessa-product-gallery .lynessa-product-gallery__image").zoom()}),$(".price_slider").each(function(){var g=$(this).data("min"),f=$(this).data("max"),c=$(this).data("unit"),h=$(this).data("value-min"),d=$(this).data("value-max"),b=$(this);$(this).slider({range:!0,min:g,max:f,values:[h,d],slide:function(j,i){var k='<button type="submit" class="button">Filter</button><div class="price_label">Price: <span class="from">'+c+i.values[0]+' </span> — <span class="to">'+c+i.values[1]+"</span></div>";b.closest(".price_slider_wrapper").find(".price_slider_amount").html(k)}})}),$(document).on("click",function(d){var c=$(d.target).closest(".lynessa-dropdown"),b=$(".lynessa-dropdown");0<c.length?(b.not(c).removeClass("open"),($(d.target).is('[data-lynessa="lynessa-dropdown"]')||0<$(d.target).closest('[data-lynessa="lynessa-dropdown"]').length)&&(c.toggleClass("open"),d.preventDefault())):$(".lynessa-dropdown").removeClass("open")}),$(document).on("click",".lynessa-tabs .tab-link a, .lynessa-accordion .panel-heading a",function(h){h.preventDefault();var g=$(this),c=g.data("id"),k=g.attr("href"),f=g.data("ajax"),b=g.data("section"),d=g.data("animate"),j=g.closest(".tab-link,.lynessa-accordion").find("a.loaded").attr("href");1!=f||g.hasClass("loaded")?(g.parent().addClass("active").siblings().removeClass("active"),$(k).addClass("active").siblings().removeClass("active"),g.closest(".panel-default").addClass("active").siblings().removeClass("active"),g.closest(".lynessa-accordion").find(k).slideDown(400),g.closest(".lynessa-accordion").find(".panel-collapse").not(k).slideUp(400),lynessa_animation_tabs($(k),d)):($(k).closest(".tab-container,.lynessa-accordion").addClass("loading"),g.parent().addClass("active").siblings().removeClass("active"),$.ajax({type:"POST",url:lynessa_ajax_frontend.ajaxurl,data:{action:"lynessa_ajax_tabs",security:lynessa_ajax_frontend.security,id:c,section_id:b},success:function(i){"ok"==i.success?($(k).html($(i.html).find(".az_tta-panel-body").html()),$(k).closest(".tab-container,.lynessa-accordion").removeClass("loading"),$('[href="'+j+'"]').removeClass("loaded"),lynessa_countdown($(k).find(".lynessa-countdown")),lynessa_init_carousel($(k).find(".owl-slick")),0<$(".owl-slick .product-item").length&&lynessa_hover_product_item($(k).find(".owl-slick .row-item,.owl-slick .product-item.style-1,.owl-slick .product-item.style-2,.owl-slick .product-item.style-3,.owl-slick .product-item.style-4")),0<$(k).find(".variations_form").length&&$(k).find(".variations_form").each(function(){$(this).wc_variation_form()}),$(k).trigger("lynessa_ajax_tabs_complete"),g.addClass("loaded"),$(j).html("")):($(k).closest(".tab-container,.lynessa-accordion").removeClass("loading"),$(k).html("<strong>Error: Can not Load Data ...</strong>")),g.closest(".panel-default").addClass("active").siblings().removeClass("active"),g.closest(".lynessa-accordion").find(k).slideDown(400),g.closest(".lynessa-accordion").find(".panel-collapse").not(k).slideUp(400)},complete:function(){$(k).addClass("active").siblings().removeClass("active"),setTimeout(function(i){lynessa_animation_tabs($(k),d)},10)}}))}),$(document).on("click","a.backtotop",function(b){$("html, body").animate({scrollTop:0},800),b.preventDefault()}),$(document).on("scroll",function(){200<$(window).scrollTop()?$(".backtotop").addClass("active"):$(".backtotop").removeClass("active")}),$(document).on("click",".quantity .quantity-plus",function(d){var c=$(this).closest(".quantity").find("input.qty"),b=parseInt(c.val()),f=parseInt(c.attr("max"));b+=parseInt(c.data("step")),f&&f<b&&(b=f),c.val(b),c.trigger("change"),d.preventDefault()}),$(document).on("change",function(){$(".quantity").each(function(){var c=$(this).find("input.qty"),b=c.val();parseInt(c.attr("max"))<b?$(this).find(".quantity-plus").css("pointer-events","none"):$(this).find(".quantity-plus").css("pointer-events","auto")})}),$(document).on("click",".quantity .quantity-minus",function(d){var c=$(this).closest(".quantity").find("input.qty"),b=parseInt(c.val()),f=parseInt(c.attr("min"));b-=parseInt(c.data("step")),f&&b<f&&(b=f),!f&&b<0&&(b=0),c.val(b),c.trigger("change"),d.preventDefault()})}),jQuery(function(a){window.addEventListener("load",function(e){var c,f,d,b;c=a(".lynessa-mapper"),f=a(".lynessa-pin"),d=c.data("width"),b=c.data("height"),f.each(function(){var h=a(this).data("top"),g=a(this).data("left");h.substr&&"%"!=h.substr(-1)&&(h=h/b*100+"px"),g.substr&&"%"!=g.substr(-1)&&(g=g/d*100+"px"),a(this).css({top:h,left:g})}),function(){var h=a(".lynessa-pin .action-pin");h.on("click",function(){var E=a(this),B=E.siblings(".lynessa-popup");if(B.length){var v=E.closest(".lynessa-pin");if(v.hasClass("actived")){return v.removeClass("actived"),void setTimeout(function(){B.removeAttr("style")},300)}var D=v.data("position");B.css({transition:"none",width:"",left:""}),setTimeout(function(){B.css({transition:""})}),B.removeClass("remove-redirect right left top bottom"),B.addClass(D);var x=E[0].getBoundingClientRect(),y=(B[0].getBoundingClientRect(),B.width()),q=B.height(),j=a(window).width(),A=!1;if(j<y){B.removeClass("right left top").addClass("bottom"),B.width(j),A=!0}else{switch(D){case"right":j-(x.right+y+8)<0&&(y>x.right?(B.removeClass("right").addClass("bottom"),A=!1):B.removeClass("right").addClass("left"));break;case"left":x.left-y+8<0&&(y>x.right?(B.removeClass("left").addClass("bottom"),A=!1):B.removeClass("left").addClass("right"));break;case"top":parseInt(v.css("top"))<q&&B.removeClass("top").addClass("bottom");break;case"bottom":parseInt(v.css("bottom"))<q&&B.removeClass("bottom").addClass("top")}}if(B.hasClass("top")||B.hasClass("bottom")){B.css("left",0);var z=B.offset();if(z.left<=0){B.css({left:-z.left}),B.addClass("remove-redirect")}else{if(A){var k=z.left+j}else{k=z.left+y}if(j<k){var C=j-k;B.css({left:C}),B.addClass("remove-redirect")}else{B.css("left","")}}}if(a(".content-text").css({"max-height":y-80+"px",overflow:"auto"}),a(".lynessa-mapper .lynessa-pin .lynessa-popup-header h2").css("max-width",y-10),B.hasClass("lynessa-image")){var w=B.find(".lynessa-popup-header").outerHeight(!0);B.find(".lynessa-popup-main").css("height",q-w)}setTimeout(function(){a(".lynessa-mapper .lynessa-pin.actived").removeClass("actived"),v.addClass("actived")},300)}}),a(".lynessa-pin .close-modal").on("click",function(){var k=a(this).closest(".lynessa-pin"),j=k.find(".lynessa-popup");k.removeClass("actived"),setTimeout(function(){j.removeAttr("style")},300)});var g="blur(2px)",i="grayscale(100%)";h.hover(function(){var j=a(this);j.closest(".blur").children("img").css("filter",g).css("webkitFilter",g).css("mozFilter",g).css("oFilter",g).css("msFilter",g),j.closest(".gray").children("img").css("filter",i).css("webkitFilter",i).css("mozFilter",i).css("oFilter",i).css("msFilter",i),j.closest(".mask").children(".mask").css("opacity",1)},function(){var j=a(this);j.closest(".lynessa-mapper").children("img").removeAttr("style"),j.closest(".mask").children(".mask").removeAttr("style")})}()},!1)});