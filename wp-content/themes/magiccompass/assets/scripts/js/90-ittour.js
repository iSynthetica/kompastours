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

        $('input.date-pick').daterangepicker({
            startDate: moment().startOf('hour').add(12, 'hour'),
            endDate: moment().startOf('hour').add(132, 'hour'),
            minDate: moment().startOf('hour').add(12, 'hour'),
            maxSpan: {
                "days": 12
            },
            locale: {
                format: 'DD.MM.YY'
            }
        });
    });


    $( document.body ).on('change', '#country_select', function() {
        var selectedCountry = parseInt($('#country_select').find(":selected").val());
        var regionsByCountries = $.parseJSON($('#regions_by_countries').val());

        var regions = regionsByCountries[selectedCountry];

        var regionsHtml = '<select name="region" id="region_select" class="form-control">';
            regionsHtml += '<option value="">Select region</option>';

            for (var i = 0; i < regions.length; i++) {
                regionsHtml += '<option value="'+regions[i].id+'">'+regions[i].name+'</option>';
            }

            regionsHtml += '</select>';

        $('#region_select').replaceWith( regionsHtml );

        ittourShowDestinationSummary();
        ittourGetHotelsList();
    });

    $( document.body ).on('change', '#region_select', function() {
        ittourShowDestinationSummary();
        ittourGetHotelsList();
    });

    $( document.body ).on('change', '#hotel_select', function() {
        ittourShowDestinationSummary();
    });

    /**
     * Get Destination summary
     */
    function ittourShowDestinationSummary() {
        var selectedCountryVal = $('#country_select').find(":selected").val(),
            selectedRegionVal = $('#region_select').find(":selected").val(),
            selectedHotelVal = $('#hotel_select').find(":selected").val();

        var destinationSummary = $('#destination_summary');

        var selectedRegion = '', selectedCountry = '', selectedHotel = '';

        if ( '' !== selectedCountryVal ) {
            selectedCountry = $('#country_select').find(":selected").text();
        }

        if ( '' !== selectedRegionVal ) {
            selectedRegion = $('#region_select').find(":selected").text() + ', ';
        }

        if ( '' !== selectedHotelVal ) {
            selectedHotel = $('#hotel_select').find(":selected").text() + ', ';
        }

        destinationSummary.text(selectedHotel + selectedRegion + selectedCountry);
    }

    function ittourGetHotelsList() {
        var selectedCountry = $('#country_select').find(":selected").val(),
            selectedRegion = $('#region_select').find(":selected").val();

        $.post(
            snthWpJsObj.ajaxurl,
            {
                'action': 'ittour_ajax_get_country_parameters',
                'country_id': selectedCountry,
                'region': selectedRegion
            },
            function(response) {

                if( response.status === 'error') {

                } else {
                    var hotels =  response.message.hotels;

                    var hotelsHtml = '<select name="region" id="hotel_select" class="form-control">';
                    hotelsHtml += '<option value="">Select hotel</option>';

                    for (var i = 0; i < hotels.length; i++) {
                        hotelsHtml += '<option value="'+hotels[i].id+'">'+hotels[i].name+'</option>';
                    }

                    hotelsHtml += '</select>';

                    $('#hotel_select').replaceWith( hotelsHtml );


                }
            },
            'json'
        );
    }

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

                    updateFragments(fragments);
                }
            },
            'json'
        );
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