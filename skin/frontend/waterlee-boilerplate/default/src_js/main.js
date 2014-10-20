var tt = 0;
jQuery(document).ready( function(){

  // Home page scroll logic
  jQuery(window).scroll(function(){
    var a = jQuery("#header-container");
    var zb = jQuery("#zip-bar");
    var sl = jQuery(window).height() - 130; //a.css("height");
    ds = jQuery(document).scrollTop();
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

    var cell = jQuery("#first-basket-cell").css("height");
    jQuery(".resizable").css("height", cell);
    /* For testing zip bar scrolling when height changes */
    //var spec = jQuery('<span id="pepe-1"></span></br><span id="pepe-2"></span>');
    //jQuery("#header-fill").append(spec);
    //jQuery("#pepe-1").html("Document scroll:" + doc_scroll);
    //jQuery("#pepe-2").html("Zip bar position:" + zip_bar.css("top"));
    /* //For testing zip bar scrolling when height changes */

  });


  /* Calling triggers on init */
  callAnimations(wrapAnimators(5));
  jQuery(document).on("ready", fixHeight);
  jQuery(window).on("resize", fixHeight);
});

/* Home page "How it works section"'s logic */
function animatorMouseOver(elem){
  elem.mouseover(function(){
    var pos = elem.css("top");
    if (pos == "0px") {
      jQuery(this).stop().animate({
        top: "-=160",
        background: "transparent",
      }, 550, function() {
        // Animation complete.
        jQuery(this).css("top", "-160px");
      });
    }
  });
}
function animatorMouseOut(elem){
  elem.mouseout(function(){
    var pos = elem.css("top");
    if (pos == "-160px") {
      jQuery(this).stop().animate({
        top: "+=160",
      }, 550, function() {
        // Animation complete.
        jQuery(this).css("top", "0px");
      });
    }
  });
}
function callAnimations(elems){
  for(i=0;i<elems.length;i++){
    el = jQuery(elems[i]);
    animatorMouseOver(el);
    animatorMouseOut(el);
  }
}
function wrapAnimators(counter){
  var arr = [];
  for(i=1;i<=counter;i++){
    arr.push("#animator-"+i);
  }
  return arr;
}

/* Home page header resizer function */

function fixHeight() {
  var a = jQuery("#home #header-container"), k = jQuery(".orbit-bullets-container"),
      b = (jQuery(window).width(), jQuery(window).height());
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
  var c, d, e, f = jQuery("#home #header-container .header-content"),
      g = jQuery("#home #header-container .header-content");
  c = f.height(), d = a.height(), e = (d - c) / 2, f.css({
    "margin-top": e + "px"
  }), c = g.height(), d = a.height(), e = (d - c) / 2, g.css({
    "margin-top": e + "px"
  })
}

