(function ($) {
    var lastScroll = 0;
    var isMobile = false;
    var isiPhoneiPad = false;

    if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
        isMobile = true;
    }

    if (/iPhone|iPad|iPod/i.test(navigator.userAgent)) {
        isiPhoneiPad = true;
    }

    /*==============================================================*/
//Search - START CODE
    /*==============================================================*/
    function ScrollStop() {
        return false;
    }
    function ScrollStart() {
        return true;
    }

    $(document).ready(function() {

        //Click event to scroll to top
        $(document).on('click', '.scroll-top-arrow', function () {
            $('html, body').animate({scrollTop: 0}, 800);
            return false;
        });

        var swiperThreeSlides = new Swiper('.swiper-three-slides', {
            allowTouchMove: true,
            slidesPerView: 3,
            preventClicks: false,
            pagination: {
                el: '.swiper-pagination-three-slides',
                clickable: true
            },
            autoplay: {
                delay: 3000
            },
            keyboard: {
                enabled: true
            },
            navigation: {
                nextEl: '.swiper-three-slide-next',
                prevEl: '.swiper-three-slide-prev'
            },
            breakpoints: {
                991: {
                    slidesPerView: 2
                },
                767: {
                    slidesPerView: 1
                }
            },
            on: {
                resize: function () {
                    swiperThreeSlides.update();
                }
            }
        });

        /*==============================================================*/
        //magnificPopup Start
        /*==============================================================*/
        $('.header-search-form').magnificPopup({
            mainClass: 'mfp-fade',
            closeOnBgClick: true,
            preloader: false,
            // for white backgriund
            fixedContentPos: false,
            closeBtnInside: false,
            callbacks: {
                open: function () {
                    setTimeout(function () {
                        $('.search-input').focus();
                    }, 500);
                    $('#search-header').parent().addClass('search-popup');
                    if (!isMobile) {
                        $('body').addClass('overflow-hidden');
                        //$('body').addClass('position-fixed');
                        $('body').addClass('width-100');
                        document.onmousewheel = ScrollStop;
                    } else {
                        $('body, html').on('touchmove', function (e) {
                            e.preventDefault();
                        });
                    }
                },
                close: function () {
                    if (!isMobile) {
                        $('body').removeClass('overflow-hidden');
                        //$('body').removeClass('position-fixed');
                        $('body').removeClass('width-100');
                        $('#search-header input[type=text]').each(function (index) {
                            if (index == 0) {
                                $(this).val('');
                                $("#search-header").find("input:eq(" + index + ")").css({"border": "none", "border-bottom": "2px solid rgba(255,255,255,0.5)"});
                            }
                        });
                        document.onmousewheel = ScrollStart;
                    } else {
                        $('body, html').unbind('touchmove');
                    }
                }
            }
        });


        /*==============================================================*/
        //Modal popup - START CODE
        /*==============================================================*/
        $('.modal-popup').magnificPopup({
            type: 'inline',
            preloader: false,
            // modal: true,
            blackbg: true,
            callbacks: {
                open: function () {
                    $('html').css('margin-right', 0);
                }
            }
        });

        $(document).on('click', '.popup-modal-dismiss', function (e) {
            e.preventDefault();
            $.magnificPopup.close();
        });

        /*==============================================================
         counter
         ==============================================================*/
        $(function ($) {animatecounters();});

        function animatecounters() {
            $('.timer').each(count);
            function count(options) {
                var $this = $(this);
                options = $.extend({}, options || {}, $this.data('countToOptions') || {});
                $this.countTo(options);
            }
        }

        $('.countdown').countdown(
            $('.countdown').attr("data-enddate")
        ).on('update.countdown', function (event) {
            $(this).html(event.strftime('' + '<div class="counter-container font-alt">' + '<div class="counter-box first d-inline-block text-center"><div class="number font-weight-900">%H</div><span>Hours</span></div><div class="counter-box-divider d-inline-block"><div class="counter-divider">:</div></div>' + '<div class="counter-box d-inline-block text-center"><div class="number font-weight-900">%M</div><span>Minutes</span></div><div class="counter-box-divider d-inline-block"><div class="counter-divider">:</div></div>' + '<div class="counter-box last d-inline-block text-center"><div class="number font-weight-900">%S</div><span>Seconds</span></div></div>'));
        });
    });

    $(window).on('load', function () {

    });

    $(window).on('scroll', function() {
        if ($('body').hasClass('pf-body')) {
            init_scroll_navigate();
        }

        if ($(this).scrollTop() > 150)
            $('.scroll-top-arrow').fadeIn('slow');
        else
            $('.scroll-top-arrow').fadeOut('slow');
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