var tempScrollTop, currentScrollTop = 0;
jQuery(document).ready( function(){
  var zip_bar = jQuery("#zip-bar");
  var scroll_limit = 465;

  //jQuery("#pepe-2").html("Zip bar position:" + zip_bar.css("top"));
  jQuery(window).scroll(function(){
    doc_scroll = jQuery(document).scrollTop()
    // Scroll up
    if (tempScrollTop > doc_scroll ) {
      if (doc_scroll < (scroll_limit + 61) ){
        var up = scroll_limit - doc_scroll + 61;
        zip_bar.css( {"top" : up+"px", "position" : "fixed", "width":"100%"} );
      }
    }
    // Scroll down
    else if (tempScrollTop < doc_scroll ){
      if (doc_scroll > (scroll_limit + 55) ){
        zip_bar.css( {"top" : "0", "position" : "fixed", "width":"100%"} );
      }else{
        var up = -120; // Set to zip bar's initial position
        zip_bar.css( {"top" : up+"px", "position" : "relative", "width":"100%"} );
      }
    }
  tempScrollTop = doc_scroll;

  var cell = jQuery("#first-basket-cell").css("height");
  jQuery(".resizable").css("height", cell);

  /* For testing zip bar scrolling when height changes */
  //var spec = jQuery('<span id="pepe-1"></span></br><span id="pepe-2"></span>');
  //jQuery("#header-fill").append(spec);
  //jQuery("#pepe-1").html("Document scroll:" + doc_scroll);
  //jQuery("#pepe-2").html("Zip bar position:" + zip_bar.css("top"));
  /* //For testing zip bar scrolling when height changes */

  });

});
