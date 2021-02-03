var t=0;$(".menu-mobile-new-content li i").on("click",function(){var b=$(this).attr("id");if(typeof b==="undefined"){return}t=b.split("_")[1];var a=$("#list-menu-breackRum").html();if(b.split("_")[2]=="blog"){if(a.indexOf('onclick="breackRumMenu('+t+',1)">'+$("#name_"+t).text())!=-1){return}var c=$("#child_"+t+"_blog");if(c.length){$("#child_"+t+"_blog").css("left",0);$("#list-menu-breackRum").append('<span id="home_'+t+'" onclick="breackRumMenu('+t+',1)">'+$("#name_"+t+"_blog").text()+"</span>")}}else{if(a.indexOf('onclick="breackRumMenu('+t+',0)">'+$("#name_"+t).text())!=-1){return}var c=$("#child_"+t);if(c.length){$("#child_"+t).css("left",0);$("#list-menu-breackRum").append('<span id="home_'+t+'" onclick="breackRumMenu('+t+',0)">'+$("#name_"+t).text()+"</span>")}}});function breackRumMenu(d,e){$(".menu-mobile-new-content ul ul").css("left","-100%");if(d!=0){if(e!=0){$("#child_"+d+"_blog").css("left",0)}else{$("#child_"+d).css("left",0)}}var c=$("#list-menu-breackRum").html();var g=c.indexOf("breackRumMenu("+d);var b=c.substr(0,g);var a=c.substr(g);var f=a.indexOf("<span");if(f!=-1){var a=a.substr(0,f)}$("#list-menu-breackRum").html(b+a)}$(".breackRum-menu .x").on("click",function(){$(".menu-mobile-new").removeClass("menu-mobile-open");$(".menu-mobile-new ul").css("left","-100%");$("#list-menu-breackRum").html('<span id="home_0" onclick="breackRumMenu(0)">Menu</span>')});$(".block-menu-bar").on("click",function(){$(".menu-mobile-new").addClass("menu-mobile-open");$(".menu-mobile-new ul").css("left","0");$(".menu-mobile-new-content ul ul").css("left","-100%")});

$(document).click(function(event) { 
    $target = $(event.target);
    if($target.closest('.header-mobile_shadow').length){
        $(".menu-mobile-new").removeClass("menu-mobile-open");
        $(".menu-mobile-new ul").css("left","-100%");
        $("#list-menu-breackRum").html('<span id="home_0" onclick="breackRumMenu(0)">Menu</span>');
    }      
  });
  $('.mobile-note-clone').on('click', function(){
    $(".menu-mobile-new").removeClass("menu-mobile-open");
    $(".menu-mobile-new ul").css("left","-100%");
    $("#list-menu-breackRum").html('<span id="home_0" onclick="breackRumMenu(0)">Menu</span>');
  })