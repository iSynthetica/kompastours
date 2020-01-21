var SNTHJS = SNTHJS || {};

(function ($) {
    var $window = $(window),
        $body = $('body');

    SNTHJS.content = {
        addBodyClass: function() {
            var orientation = SNTHJS.device.orientation();
            $body.removeClass('device-landscape device-portrait').addClass(orientation);

            var deviceType = SNTHJS.device.type();
            $body.removeClass('device-mobile device-desktop').addClass(deviceType);
        }
    };

    SNTHJS.device = {
        isMobile: {
            Android: function () {
                return navigator.userAgent.match(/Android/i);
            },
            BlackBerry: function () {
                return navigator.userAgent.match(/BlackBerry/i);
            },
            iOS: function () {
                return navigator.userAgent.match(/iPhone|iPad|iPod/i);
            },
            Opera: function () {
                return navigator.userAgent.match(/Opera Mini/i);
            },
            Windows: function () {
                return navigator.userAgent.match(/IEMobile/i);
            },
            any: function () {
                return (
                    SNTHJS.device.isMobile.Android() ||
                    SNTHJS.device.isMobile.BlackBerry() ||
                    SNTHJS.device.isMobile.iOS() ||
                    SNTHJS.device.isMobile.Opera() ||
                    SNTHJS.device.isMobile.Windows()
                );
            }
        },
        type: function () {
            if (SNTHJS.device.isMobile.any()) {
                return 'device-mobile';
            }

            return 'device-desktop';
        },
        orientation: function () {
            if($(window).width() > $(window).height()) {
                return 'device-landscape';
            }

            return 'device-portrait';
        }
    };

    $(document).ready(function() {
        SNTHJS.content.addBodyClass();

        $(".numbers-alt.numbers-gor").append('<div class="incr buttons_inc"><i class="fas fa-plus"></i></div><div class="decr buttons_inc"><i class="fas fa-minus"></i></div>');
        $(".numbers-alt.numbers-ver").append('<div class="incr buttons_inc"><i class="fas fa-plus"></i></div><div class="decr buttons_inc"><i class="fas fa-minus"></i></div>');
    });

    /* Preload */
    $(window).load(function () { // makes sure the whole site is loaded
        $('#status').fadeOut(); // will first fade out the loading animation
        $('#preloader').delay(350).fadeOut('slow'); // will fade out the white DIV that covers the website.
        $('body').delay(350).css({
            'overflow': 'visible'
        });

        var scrollContent = $(".scroll-content");

        if (scrollContent.length > 0) {
            scrollContent.each(function() {
                $(this).mCustomScrollbar({
                    axis: "y",
                    theme: 'rounded-dark'
                });
            });
        }

        $(window).scroll();
    });

    $(window).on('resize', function(e) {
        SNTHJS.content.addBodyClass();
    });

    /* Sticky nav */
    $(window).scroll(function () {
        'use strict';
        if ($(this).scrollTop() > 1) {
            $('header').addClass("sticky");
        } else {
            $('header').removeClass("sticky");
        }
    });

    /* Menu */
    $('a.open_close').on("click", function () {
        $('.main-menu').toggleClass('show');
        $('.layer').toggleClass('layer-is-visible');
    });
    $('a.show-submenu').on("click", function () {
        $(this).next().toggleClass("show_normal");
    });
    $('a.show-submenu-mega').on("click", function () {
        $(this).next().toggleClass("show_mega");
    });
    if ($(window).width() <= 480) {
        $('a.open_close').on("click", function () {
            $('.cmn-toggle-switch').removeClass('active');
        });
    }

    /* Collapse filters */
    if ($(this).width() < 991) {
        $('.collapse#collapseFilters').removeClass('show');
    } else {
        $('.collapse#collapseFilters').addClass('show');
    }

    /* Overaly mask form */
    $('.expose').on("click", function (e) {
        "use strict";
        $(this).css('z-index', '4');
        $('#overlay').fadeIn(300);
    });
    $('#overlay').click(function (e) {
        "use strict";
        $('#overlay').fadeOut(300, function () {
            $('.expose').css('z-index', '3');
        });
    });

    /* Tooltip */
    $('.tooltip-1').tooltip({
        html: true
    });

    /* Accordion */
    function toggleChevron(e) {
        $(e.target)
            .prev('.card-header')
            .find("i.indicator")
            .toggleClass('icon-minus icon-plus');
    }
    $('.accordion_styled').on('hidden.bs.collapse shown.bs.collapse', toggleChevron);
    function toggleIcon(e) {
        $(e.target)
            .prev('.card-header')
            .find(".indicator")
            .toggleClass('icon-minus icon-plus');
    }

    /* Animation on scroll */
    new WOW().init();

    /* Video modal dialog + Parallax + Scroll to top + Incrementer */
    $(function () {
        'use strict';
        $('.parallax-window').parallax({zIndex:1}); /* Parallax modal*/

        /* Cart header drop down */
        $('.dropdown-menu').on("click", function (e) {
            e.stopPropagation();
        });
        $('ul#top_tools li .dropdown').hover(function () {
            $(this).find('.dropdown-menu').stop(true, true).delay(50).fadeIn(300);
        }, function () {
            $(this).find('.dropdown-menu').stop(true, true).delay(50).fadeOut(300);
        });

        /* Hamburger icon */
        var toggles = document.querySelectorAll(".cmn-toggle-switch");
        for (var i = toggles.length - 1; i >= 0; i--) {
            var toggle = toggles[i];
            toggleHandler(toggle);
        }
        function toggleHandler(toggle) {
            toggle.addEventListener("click", function (e) {
                e.preventDefault();
                if (this.classList.contains("active") === true) {
                    this.classList.remove("active");
                } else {
                    this.classList.add("active");
                }
            });
        }

        /* Scroll to top*/
        var pxShow = 800; // height on which the button will show
        var scrollSpeed = 500; // how slow / fast you want the button to scroll to top.

        $(window).scroll(function(){
            if($(window).scrollTop() >= pxShow){
                $("#toTop").addClass('visible');
            } else {
                $("#toTop").removeClass('visible');
            }
        });

        $('#toTop').on('click', function(){
            $('html, body').animate({scrollTop:0}, scrollSpeed);
            return false;
        });

        /* Input incrementer*/
        $(".numbers-row").append('<div class="inc button_inc"><i class="fas fa-plus"></i></div><div class="dec button_inc"><i class="fas fa-minus"></i></div>');

        $( document.body ).on('click', ".button_inc", function () {
            var $button = $(this);
            var oldValue = $button.parent().find("input").val();
            var max = $button.parent().find("input").data('max');
            var min = $button.parent().find("input").data('min');
            var newVal;

            if ($button.text() == "+") {
                if ( max && parseFloat(oldValue) === parseFloat(max) ) {
                    newVal = parseFloat(oldValue);
                } else {
                    newVal = parseFloat(oldValue) + 1;
                }
            } else {
                // Don't allow decrementing below zero

                if ( min && parseFloat(oldValue) === parseFloat(min) ) {
                    newVal = parseFloat(oldValue);
                } else if ( oldValue > 1) {
                    newVal = parseFloat(oldValue) - 1;
                } else {
                    newVal = 0;
                }
            }

            $button.parent().find("input").val(newVal);
        });

        $( document.body ).on('input', 'input[type="number"]', function () {
            var max = parseFloat($(this).data('max'));
            var min = parseFloat($(this).data('min'));
            var value = parseFloat($(this).val());

            if (max && value > max) {
                $(this).val(max);
            }

            if (min && value < min) {
                $(this).val(min);
            }
        });

        $( document.body ).on('click', ".buttons_inc", function () {
            var $button = $(this);
            var oldValue = parseFloat($button.parent().find("input").val());
            var max = parseFloat($button.parent().find("input").data('max'));
            var min = parseFloat($button.parent().find("input").data('min'));
            var isPrice = $button.parent().find("input").hasClass('money-format-input');
            var newVal = 0;

            if ($button.hasClass('incr')) {
                if ( max && oldValue === max ) {
                    newVal = oldValue;
                } else {
                    if (isPrice) {
                        newVal = oldValue + 1000;
                    } else {
                        newVal = oldValue + 1;
                    }
                }
            } else {
                // Don't allow decrementing below zero
                if (isPrice) {
                    if (min && oldValue === min) {
                        newVal = oldValue;
                    } else if (min && min > oldValue - 1000) {
                        newVal = min;
                    } else if (oldValue > 1000) {
                        newVal = oldValue - 1000;
                    } else {
                        newVal = 0;
                    }
                } else {
                    if ( min && oldValue === min ) {
                        newVal = oldValue;
                    } else if ( oldValue > 1) {
                        newVal = oldValue - 1;
                    } else {
                        newVal = 0;
                    }
                }
            }

            $button.parent().find("input").val(newVal).trigger('blur');
        });
    });

    /* Cat nav onclick active */
    $('ul#cat_nav li a').on('click', function () {
        $('ul#cat_nav li a.active').removeClass('active');
        $(this).addClass('active');
    });

    /* Map filter onclick active */
    $('#map_filter ul li a').on('click', function () {
        $('#map_filter ul li a.active').removeClass('active');
        $(this).addClass('active');
    });

    /* Footer reveal */
    if ($(window).width() >= 768) {
        var $footerRevealed = $('footer.revealed');

        if (0 === $footerRevealed.length) {
            return;
        }
        $('footer.revealed').footerReveal({
            shadow: false,
            opacity:0.6,
            zIndex: 0
        });
    }
}(jQuery));