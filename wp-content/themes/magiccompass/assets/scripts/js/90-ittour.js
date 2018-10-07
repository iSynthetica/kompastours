/**
 * Ittour scripts
 */
(function ($) {

    $(document).ready(function() {

    });

    $(window).on('load', function () {
        // block($('#tour-flights'));
        ittourLoadSingleTour();
        ittourLoadSearchForm();
    });

    $(window).on('scroll', function() {

    });

    $(window).on('resize', function(e) {

    });

    $( document.body ).on('search_form_loaded', function() {
        $(".numbers-alt.numbers-gor").append('<div class="incr buttons_inc"><i class="fas fa-chevron-right"></i></div><div class="decr buttons_inc"><i class="fas fa-chevron-left"></i></div>');

        $(".numbers-alt.numbers-ver").append('<div class="incr buttons_inc"><i class="fas fa-chevron-up"></i></div><div class="decr buttons_inc"><i class="fas fa-chevron-down"></i></div>');

        $('.repeater').repeater({
            initEmpty: true
        });
    });


    function ittourLoadSearchForm() {
        var searchFormHolder = $('.search-form_ajax');

        if (0 === searchFormHolder.length) {return;}

        $.post(
            snthWpJsObj.ajaxurl,
            {
                'action': 'ittour_ajax_load_search_form',
            },
            function(response) {
                if( response.status === 'error') {

                } else {
                    var fragments = response.message.fragments;
                    updateFragments(fragments);
                }

                $( document.body ).trigger( 'search_form_loaded' );
            },
            'json'
        );
    }

    function ittourLoadSingleTour() {
        var tourHolder = $('.single-tour__ajax'),
            tourKey = tourHolder.data('tourKey');

        if (0 === tourHolder.length) {
            return;
        }


        $.post(
            snthWpJsObj.ajaxurl,
            {
                'action': 'ittour_ajax_load_single_tour',
                'key': tourKey
            },
            function(response) {

                if( response.status === 'error') {

                } else {
                    var fragments = response.message.fragments;

                    console.log(fragments);

                    updateFragments(fragments);
                }
            },
            'json'
        );

        console.log(tourKey);
    }

    /**
     * Check if a node is blocked for processing.
     *
     * @param {JQuery Object} $node
     * @return {bool} True if the DOM Element is UI Blocked, false if not.
     */
    function is_blocked( $node ) {
        return $node.is( '.processing' ) || $node.parents( '.processing' ).length;
    }

    /**
     * Block a node visually for processing.
     *
     * @param {JQuery Object} $node
     */
    function block( $node ) {
        if ( ! is_blocked( $node ) ) {
            $node.addClass( 'processing' ).block( {
                message: null,
                overlayCSS: {
                    background: '#fff',
                    opacity: 0.6
                }
            } );
        }
    }

    /**
     * Unblock a node after processing is complete.
     *
     * @param {JQuery Object} $node
     */
    function unblock( $node ) {
        $node.removeClass( 'processing' ).unblock();
    }

    /**
     *
     * @param e
     * @param fragments
     */
    function updateFragments( fragments ) {

        console.log(fragments);
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