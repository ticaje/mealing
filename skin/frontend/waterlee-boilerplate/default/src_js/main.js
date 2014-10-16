// PNG Fallback for SVG
jQuery(document).ready(function() {
    if (!Modernizr.svg) {
        jQuery('img[src*="svg"]').attr('src', function() {
            return jQuery(this).attr('src').replace('.svg', '.png');
        });
    }
});

// Legal notice
jQuery(function() {
    jQuery(".link_legal-notice").click(function() {
        jQuery("#legal-notice-wrapper").slideToggle();
        jQuery("html, body").animate({
            scrollTop: jQuery("#legal-notice-wrapper").offset().top
                // need only when navigation is fixed
                //scrollTop: jQuery("#unternehmen").offset().top -navHeight
        }, 1000);
        return false;
    });

    jQuery("#legal-notice-wrapper .btn-close").click(function() {
        jQuery("#legal-notice-wrapper").slideUp();
        return false;
    });
});

//Fallback for Internet Explorer
if (navigator.userAgent.indexOf('MSIE') !== -1 || navigator.appVersion.indexOf('Trident/') > 0) {
    jQuery('html').addClass('internet-explorer');
}

//Flip
jQuery(document).ready(function() {
    var currentDate = new Date();
    var jQuerycountdown = jQuery('.counter-container .countdown');
    var firstCalculation = true;
    jQuerycountdown.countDown({
        day: 1,
        month: 1,
        year: 2015,
        leftHandZeros: true,
        dayLabel: null,
        hourLabel: null,
        minuteLabel: null,
        secondLabel: null,
        afterCalculation: function() {
            var plugin = this,
                units = {
                    days: this.days,
                    hours: this.hours,
                    minutes: this.minutes,
                    seconds: this.seconds
                },
                //max values per unit
                maxValues = {
                    hours: '23',
                    minutes: '59',
                    seconds: '59'
                },
                actClass = 'active',
                befClass = 'before';

            //build necessary elements
            if (firstCalculation == true) {
                firstCalculation = false;

                //build necessary markup
                jQuerycountdown.find('.unit-wrap div').each(function() {
                    var jQuerythis = jQuery(this),
                        className = jQuerythis.attr('class'),
                        value = units[className],
                        sub = '',
                        dig = '';

                    //build markup per unit digit
                    for (var x = 0; x < 10; x++) {
                        sub += [
                            '<div class="digits-inner">',
                            '<div class="effect-wrap">',
                            '<div class="up">',
                            '<div class="shadow"></div>',
                            '<div class="inn">' + x + '</div>',
                            '</div>',
                            '<div class="down">',
                            '<div class="shadow"></div>',
                            '<div class="inn">' + x + '</div>',
                            '</div>',
                            '</div>',
                            '</div>'
                        ].join('');
                    }

                    //build markup for number
                    //for (var i = 0; i < value.length; i++) {
                    //  dig += '<div class="digits">' + sub + '</div>';
                    //}
                    //jQuerythis.append(dig);
                });
            }

            //iterate through units
            jQuery.each(units, function(unit) {
                var digitCount = jQuerycountdown.find('.' + unit + ' .digits').length,
                    maxValueUnit = maxValues[unit],
                    maxValueDigit,
                    value = plugin.strPad(this, digitCount, '0');

                //iterate through digits of an unit
                for (var i = value.length - 1; i >= 0; i--) {
                    var jQuerydigitsWrap = jQuerycountdown.find('.' + unit + ' .digits:eq(' + (i) + ')'),
                        jQuerydigits = jQuerydigitsWrap.find('div.digits-inner');

                    //use defined max value for digit or simply 9
                    if (maxValueUnit) {
                        maxValueDigit = (maxValueUnit[i] == 0) ? 9 : maxValueUnit[i];
                    } else {
                        maxValueDigit = 9;
                    }

                    //which numbers get the active and before class
                    var activeIndex = parseInt(value[i]),
                        beforeIndex = (activeIndex == maxValueDigit) ? 0 : activeIndex + 1;

                    //check if value change is needed
                    if (jQuerydigits.eq(beforeIndex).hasClass(actClass)) {
                        jQuerydigits.parent().addClass('play');
                    }

                    //remove all classes
                    jQuerydigits
                        .removeClass(actClass)
                        .removeClass(befClass);

                    //set classes
                    jQuerydigits.eq(activeIndex).addClass(actClass);
                    jQuerydigits.eq(beforeIndex).addClass(befClass);
                }
            });
        }
    });
});
