(function ($) {

    $(document.body).on('click', '#phones-actions__btn', function() {
        var parentHolder = $('#contact-actions__holder');

        parentHolder.toggleClass('phones-active');
    });

    $(document.body).on('click', '.phones-actions__close', function() {
        var parentHolder = $('#contact-actions__holder');

        parentHolder.removeClass('phones-active');
    });

    $(document).ready(function() {});

    $(window).on('load', function () {});

    $(window).on('scroll', function() {});

    $(window).on('resize', function(e) {

    });

}(jQuery));