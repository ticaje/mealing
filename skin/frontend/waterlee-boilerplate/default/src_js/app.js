// Foundation JavaScript
// Documentation can be found at: http://foundation.zurb.com/docs
jQuery(document).foundation();

jQuery(document).ready(function(){

  // media query event handler
  if (matchMedia) {
    var mq = window.matchMedia("(min-width: 640px)");
    mq.addListener(WidthChange);
    WidthChange(mq);
  }

  // media query change
  function WidthChange(mq) {

    if (mq.matches) {
      // window width is at least 500px
      jQuery('.gallery-image.visible').elevateZoom();
      jQuery('.more-views').click(function(){
        jQuery('.gallery-image.visible').elevateZoom();
      })

    }
    else {
      // window width is less than 500px
      jQuery('.gallery-image.visible').elevateZoom({
        constrainType:"height",
      constrainSize:274,
      zoomType: "lens",
      containLensZoom: true,
      cursor: "pointer",
      galleryActiveClass: "active",
      zoomWindowFadeIn: 500,
      zoomWindowFadeOut: 750
      });

      jQuery('.more-views').click(function(){
        jQuery('.gallery-image.visible').elevateZoom({
          constrainType:"height",
          constrainSize:274,
          zoomType: "lens",
          containLensZoom: true,
          cursor: "pointer",
          galleryActiveClass: "active",
          zoomWindowFadeIn: 500,
          zoomWindowFadeOut: 750
        });
      })
    }

  }
  jQuery('#demoTab').easyResponsiveTabs();

  //Scroll to the top
  //Check to see if the window is top if not then display button
  jQuery(window).scroll(function(){
    if (jQuery(this).scrollTop() > 100) {
      jQuery('.scrollToTop').fadeIn();
    } else {
      jQuery('.scrollToTop').fadeOut();
    }
  });

  //Click event to scroll to top
  jQuery('.scrollToTop').click(function(){
    jQuery('html, body').animate({scrollTop : 0},800);
    return false;
  });



})

jQuery(window).load(function(){
  jQuery('#carousel').flexslider({
    animation: "slide",
  controlNav: false,
  animationLoop: false,
  slideshow: false,
  itemWidth: 210,
  itemMargin: 5,
  asNavFor: '#slider'
  });
});


jQuery(document).foundation({
  orbit: {
  animation: 'slide', // Sets the type of animation used for transitioning between slides, can also be 'fade'
  timer_speed: 10000, // Sets the amount of time in milliseconds before transitioning a slide
  pause_on_hover: true, // Pauses on the current slide while hovering
  resume_on_mouseout: false, // If pause on hover is set to true, this setting resumes playback after mousing out of slide
  next_on_click: true, // Advance to next slide on click
  animation_speed: 500, // Sets the amount of time in milliseconds the transition between slides will last
  stack_on_small: false,
  navigation_arrows: false,
  slide_number: false,
  slide_number_text: 'of',
  container_class: 'orbit-container',
  stack_on_small_class: 'orbit-stack-on-small',
  next_class: 'orbit-next', // Class name given to the next button
  prev_class: 'orbit-prev', // Class name given to the previous button
  timer_container_class: 'orbit-timer', // Class name given to the timer
  timer_paused_class: 'paused', // Class name given to the paused button
  timer_progress_class: 'orbit-progress', // Class name given to the progress bar
  slides_container_class: 'orbit-slides-container', // Class name given to the slide container
  preloader_class: 'preloader', // Class given to the perloader
  slide_selector: 'li', // Default is '*' which selects all children under the container
  bullets_container_class: 'orbit-bullets',
  bullets_active_class: 'active', // Class name given to the active bullet
  slide_number_class: 'orbit-slide-number', // Class name given to the slide number
  caption_class: 'orbit-caption', // Class name given to the caption
  active_slide_class: 'active', // Class name given to the active slide
  orbit_transition_class: 'orbit-transitioning',
  bullets: true, // Does the slider have bullets visible?
  circular: true, // Does the slider should go to the first slide after showing the last?
  timer: true, // Does the slider have a timer active? Setting to false disables the timer.
  variable_height: false, // Does the slider have variable height content?
  swipe: true
  //before_slide_change: noop, // Execute a function before the slide changes
  //after_slide_change: noop // Execute a function after the slide changes
  }
});
