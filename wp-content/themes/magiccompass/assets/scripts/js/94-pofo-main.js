(function ($) {
    var lastScroll = 0;

    $(document).ready(function() {

    });

    $(window).on('load', function () {

    });

    $(window).on('scroll', function() {
        if ($('body').hasClass('pf-body')) {
            init_scroll_navigate();
        }
    });

    $(window).on('resize', function(e) {

    });

    function init_scroll_navigate() {
        /* ===================================
           sticky nav Start
           ==================================== */
        var headerHeight = $('nav').outerHeight();

        if (!$('#masthead').hasClass('no-sticky')) {
            if ($(document).scrollTop() >= headerHeight) {
                $('#masthead').addClass('sticky');

            } else if ($(document).scrollTop() <= headerHeight) {
                $('#masthead').removeClass('sticky');
                setTimeout(function () {
                    setPageTitleSpace();
                }, 500);
            }

            SetMegamenuPosition();
        }

        /* ===================================
           header appear on scroll up
           =================================== */
        var st = $(this).scrollTop();
        if (st > lastScroll) {
            $('#masthead.sticky').removeClass('header-appear');
            //  $('.dropdown.on').removeClass('on').removeClass('open').find('.dropdown-menu').fadeOut(100);
        } else {
            $('#masthead.sticky').addClass('header-appear');
        }

        lastScroll = st;

        if (lastScroll <= headerHeight) {
            $('#masthead').removeClass('header-appear');
        }

    }

    function SetMegamenuPosition() {
        if ($(window).width() > 991) {
            setTimeout(function () {
                var totalHeight = $('nav.navbar').outerHeight();
                $('.mega-menu').css({top: totalHeight});

                if ($('.navbar-brand-top').length === 0) {
                    $('.dropdown.simple-dropdown > .dropdown-menu').css({top: totalHeight});
                }
            }, 200);
        } else {
            $('.mega-menu').css('top', '');
            $('.dropdown.simple-dropdown > .dropdown-menu').css('top', '');
        }
    }

    //page title space
    function setPageTitleSpace() {
        if ($('.navbar').hasClass('navbar-top') || $('nav').hasClass('navbar-fixed-top')) {
            if ($('.top-space').length > 0) {
                var top_space_height = $('.navbar').outerHeight();

                if ($('.top-header-area').length > 0) {
                    top_space_height = top_space_height + $('.top-header-area').outerHeight();
                }

                $('.top-space').css('margin-top', top_space_height + "px");
            }
        }
    }

}(jQuery));