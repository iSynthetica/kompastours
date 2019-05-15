(function ($) {

    $(document).ready(function() {

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

    /* Button show/hide map */
    $(".btn_map").on("click", function () {
        var el = $(this);
        el.text() == el.data("text-swap") ? el.text(el.data("text-original")) : el.text(el.data("text-swap"));
    });

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
                (this.classList.contains("active") === true) ? this.classList.remove("active"): this.classList.add("active");
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

            if ($button.text() == "+") {
                if ( max && parseFloat(oldValue) === parseFloat(max) ) {
                    var newVal = parseFloat(oldValue);
                } else {
                    var newVal = parseFloat(oldValue) + 1;
                }
            } else {
                // Don't allow decrementing below zero

                if ( min && parseFloat(oldValue) === parseFloat(min) ) {
                    var newVal = parseFloat(oldValue);
                } else if ( oldValue > 1) {
                    var newVal = parseFloat(oldValue) - 1;
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

    /* Search */
    $(".search-overlay-menu-btn").on("click", function (a) {
        $('body').addClass('has-fullscreen-modal');
        $(".search-overlay-menu").addClass("open"), $('.search-overlay-menu > form > input[type="search"]').focus();}),
        $(".search-overlay-close").on("click", function (a) {
            $(".search-overlay-menu").removeClass("open");
            $('body').removeClass('has-fullscreen-modal');
        }),
        $(".search-overlay-menu, .search-overlay-menu .search-overlay-close").on("click keyup", function (a) {
            (a.target == this || "search-overlay-close" == a.target.className || 27 == a.keyCode) && $(this).removeClass("open");
        });

    /* Show Password */
    $('#password').hidePassword('focus', {
        toggle: {
            className: 'my-toggle'
        }
    });

    /* Forgot Password */
    $("#forgot").click(function () {
        $("#forgot_pw").fadeToggle("fast");
    });


}(jQuery));