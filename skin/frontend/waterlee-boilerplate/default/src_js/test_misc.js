var tempScrollTop, currentScrollTop = 0;
jQuery(document).ready( function(){
  var zip_bar = jQuery("#zip-bar");
  var scroll_limit = 500;
  var header_bar = jQuery("#header-section");
  //var pro = 0;
  var anti = 0;
  var pro = -50;
  var counter = 0;

  jQuery(window).scroll(function(){
    currentScrollTop = jQuery(this).scrollTop();
    jQuery("#pepe").html(header_bar.css("top"));
    //Scroll up
    if (tempScrollTop > currentScrollTop ) {
      if (pro < 0){
        if (pro < -50){ pro = -50; }
        pro = pro + 1;
        header_bar.css({ "top": pro+"px" });
        anti = pro;
      }

      if (jQuery(document).scrollTop() < (scroll_limit + 10) ){
        if ((header_bar.css("top") < -50) &&  (header_bar.css("top") >= 0)){
          var up = 50 + header_bar.css("top");
          zip_bar.css( {"top" : up+"px", "position" : "fixed", "width":"100%"} );
        }else{
        var up = scroll_limit - jQuery(document).scrollTop() + 10;
        zip_bar.css( {"top" : up+"px", "position" : "fixed", "width":"100%"} );
        //header_bar.css("visibility","initial");
        }
      }
    }
  // Scroll down
    else if (tempScrollTop < currentScrollTop ){
      anti = anti - 1;
      doc_scroll = jQuery(document).scrollTop();
      if (doc_scroll > 0 ){
        header_bar.css({ "top": anti+"px" });
        if (zip_bar.css("top") <= 50){
          zip_bar.css( {"top" : anti+"px", "position" : "fixed", "width":"100%"} );
        }
        pro = anti;
        if (pro < -50){ pro = -50; }
      }

      if (doc_scroll > (scroll_limit) ){
        zip_bar.css( {"top" : "0", "position" : "fixed", "width":"100%"} );
      }else{
        var up = scroll_limit + 10; //zip_bar.css("top");
        zip_bar.css( {"top" : up+"px", "position" : "relative", "width":"100%"} );
      }
    }
  tempScrollTop = currentScrollTop;
  jQuery("#header-fill").html(jQuery(document).scrollTop())
  //jQuery("#pepe").html(header_bar.css("top"));
  //console.log(header_bar.css("top"));
  //console.log(pro);
  });
});
