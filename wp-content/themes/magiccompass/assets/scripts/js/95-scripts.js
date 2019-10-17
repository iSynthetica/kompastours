const observer = lozad(); // lazy loads elements with default selector as '.lozad'
observer.observe();

(function ($) {

    $(document.body).on('click', '#phones-actions__btn', function() {
        var parentHolder = $('#contact-actions__holder');

        parentHolder.toggleClass('phones-active');
    });

    $(document.body).on('click', '.phones-actions__close', function() {
        var parentHolder = $('#contact-actions__holder');

        parentHolder.removeClass('phones-active');
    });

    $(document.body).on('click', '#contact-form__submit', function() {
        var formData = $("#contact-form").serializeArray();

        $.ajax({
            url: snthWpJsObj.ajaxurl,
            method: 'post',
            dataType: "json",
            data: {
                action: 'snth_ajax_contact_form',
                formData: formData
            },
            success: function (response) {
                var decoded;

                try {
                    decoded = response;
                } catch(err) {
                    console.log(err);
                    decoded = false;
                }

                if (decoded) {
                    if (decoded.success) {
                        var fragments = response.message.fragments;
                        updateFragments(fragments);
                    } else {
                        var fragments = response.message.fragments;

                        updateFragments(fragments);
                    }
                } else {
                    alert('Something went wrong');
                }
            }
        });
    });

    $(document.body).on('click', '#phones-actions-header__btn', function() {
        var parentHolder = $('#contact-actions-header__holder');

        parentHolder.toggleClass('phones-active');
    });

    $('body').click(function (event) {
        if (!$('body').hasClass('et_mobile_device')) {
            if(
                !$(event.target).closest('.form-data-toggle-target').length &&
                !$(event.target).closest('.select2-container').length &&
                !$(event.target).hasClass('form-data-toggle-target') &&
                !$(event.target).hasClass('form-data-toggle-control') &&
                !$(event.target).hasClass('available') &&
                !$(event.target).closest('.date-pick__select__container').length &&
                !$(event.target).closest('.available').length &&
                !$(event.target).hasClass('form-data-toggle-control-icon'))
            {
                var openedSearchModal = $('.form-data-toggle-target.active');

                if (openedSearchModal.length > 0) {
                    openedSearchModal.removeClass('active').hide('0', function() {
                        $('body').removeClass('toggle-is-active');
                    });
                }
            }
        }
    });

    $(document.body).on('click', '#send-testimonial-form__submit', function() {
        var formData = $("#send-testimonial").serializeArray();

        $.ajax({
            url: snthWpJsObj.ajaxurl,
            method: 'post',
            dataType: "json",
            data: {
                action: 'snth_ajax_send_testimonial',
                formData: formData
            },
            success: function (response) {
                var decoded;

                try {
                    decoded = response;
                } catch(err) {
                    console.log(err);
                    decoded = false;
                }

                if (decoded) {
                    if (decoded.success) {
                        $("#send-testimonial").remove();
                        var fragments = response.message.fragments;
                        updateFragments(fragments);
                    } else {
                        var fragments = response.message.fragments;

                        updateFragments(fragments);
                    }
                } else {
                    alert('Something went wrong');
                }
            }
        });
    });

    $(document).ready(function() {});

    $(window).on('load', function () {});

    $(window).on('scroll', function() {});

    $(window).on('resize', function(e) {

    });

    /**
     *
     * @param e
     * @param fragments
     */
    function updateFragments( fragments ) {
        if ( fragments ) {
            $.each( fragments, function( key ) {
                $( key )
                    .addClass( 'updating' )
                    .fadeTo( '400', '0.6' )
                    .block({
                        message: null,
                        overlayCSS: {
                            opacity: 0.6
                        }
                    });
            });

            $.each( fragments, function( key, value ) {
                $( key ).replaceWith( value );
                $( key ).stop( true ).css( 'opacity', '1' ).unblock();
            });
        }
    }

}(jQuery));
