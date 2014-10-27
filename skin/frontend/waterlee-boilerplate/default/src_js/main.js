(function($) {
$(document).ready( function(){
  var tt = 0;
  // Home page scroll logic
  $(window).scroll(function(){
    var a = $("#header-container");
    var zb = $("#zip-bar");
    var sl = $(window).height() - 130; //a.css("height");
    ds = $(document).scrollTop();
    // Scroll up
    if (tt > ds ) {
      if (ds < (sl + 56) ){
        var u = sl - ds + 56;
        zb.css( {"top" : u+"px", "position" : "fixed", "width":"100%"} );
      }
    }
    // Scroll down
    else if (tt < ds ){
      if (ds > (sl + 55) ){
        zb.css( {"top" : "0", "position" : "fixed", "width":"100%"} );
      }else{
        var u = -120; // Set to zip bar's initial position
        zb.css( {"top" : u+"px", "position" : "relative", "width":"100%"} );
      }
    }
    tt = ds;

    var cell = $("#first-basket-cell").css("height");
    $(".resizable").css("height", cell);
    /* For testing zip bar scrolling when height changes */
    //var spec = $('<span id="pepe-1"></span></br><span id="pepe-2"></span>');
    //$("#header-fill").append(spec);
    //$("#pepe-1").html("Document scroll:" + doc_scroll);
    //$("#pepe-2").html("Zip bar position:" + zip_bar.css("top"));
    /* //For testing zip bar scrolling when height changes */

  });

  /* Calling triggers on init */
  $(document).on("ready", function(){
      fixHeight();
      initAccordion();
  });
  $(window).on("resize", function(){
      fixHeight();
      resizeAccordion();
  });

});

/* Home page header resizer function */

var initAccordion = function (){
  $("#accordion").accordion({
    icons : false,
    fillSpace: true,
    heightStyle: "fill"
  });
  resizeAccordion();
}
var resizeAccordion = function (){
  $(".acc-container.ui-accordion-content").css("height", ($(window).innerHeight() - 215)+"px");
}
var fixHeight = function() {
  var a = $("#home #header-container"), k = $(".orbit-bullets-container"),
      b = ($(window).width(), $(window).height());
  a.css({
    "min-height": b + "px",
    "height": b + "px"
  });

  var v = -140;
  if (b <= 600){
    v =  v + (600 - b);
  }
  k.css({
    "top": v + "px"
  });
  var c, d, e, f = $("#home #header-container .header-content"),
      g = $("#home #header-container .header-content");
  c = f.height(), d = a.height(), e = (d - c) / 2, f.css({
    "margin-top": e + "px"
  }), c = g.height(), d = a.height(), e = (d - c) / 2, g.css({
    "margin-top": e + "px"
  })
}

})(jQuery);
