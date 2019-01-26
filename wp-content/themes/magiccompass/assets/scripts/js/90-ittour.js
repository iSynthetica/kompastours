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

    $(document.body).on('search_form_loaded', function() {
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

    $(document.body).on('click', '.form-data-toggle-control', function() {
        var controller = $(this);
        var form = controller.parents('#search-form');
        var target = controller.data('form_toggle_target');
        var toggleTarget  = form.find('#' + target);
        var toggleTargets = form.find('.form-data-toggle-target');

        if (toggleTarget.hasClass('active')) {
            toggleTarget.removeClass('active').slideUp();
        } else {
            toggleTargets.removeClass('active').hide();
            toggleTarget.addClass('active').slideDown();
        }
    });

    $(document.body).on('apply.daterangepicker', function(ev, picker) {
        var datesSelect = $('#date-pick__select'),
            datesVal = datesSelect.val();

        datesSelect.data('current_value', datesVal);

        ittourShowDatesDurationSummary();
    });

    $(document.body).on('change', '#country_select', function() {
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

    $(document.body).on('change', '#region_select', function() {
        ittourShowDestinationSummary();
        ittourGetHotelsList();
    });

    $(document.body).on('change', '#hotel_select', function() {
        ittourShowDestinationSummary();
    });

    $(document.body).on('change', '#duration-from__select', function() {
        var durationSelect = $(this),
            durationVal = durationSelect.val();

        console.log(durationVal);

        durationSelect.data('current_value', durationVal);

        ittourShowDatesDurationSummary();
    });

    $(document.body).on('change', '#duration-till__select', function() {
        var durationSelect = $(this),
            durationVal = durationSelect.val();

        console.log(durationVal);

        durationSelect.data('current_value', durationVal);

        ittourShowDatesDurationSummary();
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

        destinationSummary.val(selectedHotel + selectedRegion + selectedCountry);
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
            }, function(response) {
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

    function ittourShowDatesDurationSummary() {
        var datesSelect = $('#date-pick__select'),
            datesCurrentValue = datesSelect.data('current_value');

        var durationFromSelect = $('#duration-from__select'),
            durationFromCurrentValue = durationFromSelect.data('current_value');

        var durationTillSelect = $('#duration-till__select'),
            durationTillCurrentValue = durationTillSelect.data('current_value');

        var datesSelected = '',
            durationSelected = '';

        if (datesCurrentValue) {
            datesSelected = datesCurrentValue + ', ';
        }

        if (durationFromCurrentValue && durationTillCurrentValue) {
            durationSelected = durationFromCurrentValue + ' - ' + durationTillCurrentValue + ' nights';
        }

        var datesDurationSummary = $('#dates-duration_summary');

        datesDurationSummary.val(datesSelected + durationSelected);
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

    function $_GET(param) {
        var vars = {};
        window.location.href.replace( location.hash, '' ).replace(
            /[?&]+([^=&]+)=?([^&]*)?/gi, // regexp
            function( m, key, value ) { // callback
                vars[key] = value !== undefined ? value : '';
            }
        );

        if ( param ) {
            return vars[param] ? vars[param] : null;
        }
        return vars;
    }

}(jQuery));