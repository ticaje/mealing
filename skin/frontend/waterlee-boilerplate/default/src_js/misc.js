var tempScrollTop, currentScrollTop = 0;
jQuery(document).ready( function(){
  var zip_bar = jQuery("#zip-bar");
  var scroll_limit = 465;

  jQuery(window).scroll(function(){
    doc_scroll = jQuery(document).scrollTop()
    // Scroll up
    if (tempScrollTop > doc_scroll ) {
      if (doc_scroll < (scroll_limit + 45) ){
        var up = scroll_limit - doc_scroll + 45;
        zip_bar.css( {"top" : up+"px", "position" : "fixed", "width":"100%"} );
      }
    }
    // Scroll down
    else if (tempScrollTop < doc_scroll ){
      if (doc_scroll > (scroll_limit + 35) ){
        zip_bar.css( {"top" : "0", "position" : "fixed", "width":"100%"} );
      }else{
        var up = scroll_limit;
        zip_bar.css( {"top" : up+"px", "position" : "relative", "width":"100%"} );
      }
    }
  tempScrollTop = doc_scroll;
  });
});
