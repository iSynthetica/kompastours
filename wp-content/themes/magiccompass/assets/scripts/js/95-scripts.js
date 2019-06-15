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