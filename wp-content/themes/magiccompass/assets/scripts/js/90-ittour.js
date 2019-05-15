/**
 * Ittour scripts
 */
(function ($) {

    $(document).ready(function() {

    });

    $(window).on('load', function () {
        // block($('#tour-flights'));
        ittourLoadSingleTour();
        ittourLoadToursList();
        ittourLoadTourCalendar();
        ittourLoadHotelToursTable();
    });

    $(window).on('scroll', function() {

    });

    $(window).on('resize', function(e) {

    });

    $(document.body).on('click', '.more-offers__link', function() {
        var control = $(this);
        var parent = control.parents('.tour_list_container');
        var moreOffers = parent.find('.tour_list_more');

        if (control.hasClass('active')) {
            control.removeClass('active');
            moreOffers.slideUp();
        } else {
            control.addClass('active');
            moreOffers.slideDown();
        }
    });

    function ittourLoadToursList() {
        var toursListContainer = $('.tours-list-ajax__container');

        if (toursListContainer.length > 0) {
            toursListContainer.each(function() {
                var container = $(this);

                ittourGetToursList(container);
            });
        }
    }

    function ittourGetToursList(container) {
        var type = container.data('tour-type');
        var kind = container.data('tour-kind');
        var country = container.data('country');
        var fromCity = container.data('from-city');
        var region = container.data('region');
        var hotel = container.data('hotel');
        var hotelRating = container.data('hotel-rating');
        var adultAmount = container.data('adult-amount');
        var childAmount = container.data('child-amount');
        var childAge = container.data('child-age');
        var nightFrom = container.data('night-from');
        var nightTill = container.data('night-till');
        var dateFrom = container.data('date-from');
        var dateTill = container.data('date-till');
        var mealType = container.data('meal-type');
        var priceFrom = container.data('price-from');
        var priceTill = container.data('price-till');
        var page = container.data('page');
        var itemsPerPage = container.data('items-per-page');
        var pricesInGroup = container.data('prices-in-group');
        var template = container.data('template');

        $.ajax({
            url: snthWpJsObj.ajaxurl,
            method: 'post',
            data: {
                action: 'ittour_ajax_get_tours_list',
                type: type,
                kind: kind,
                country: country,
                fromCity: fromCity,
                region: region,
                hotel: hotel,
                hotelRating: hotelRating,
                adultAmount: adultAmount,
                childAmount: childAmount,
                childAge: childAge,
                nightFrom: nightFrom,
                nightTill: nightTill,
                dateFrom: dateFrom,
                dateTill: dateTill,
                mealType: mealType,
                priceFrom: priceFrom,
                priceTill: priceTill,
                page: page,
                itemsPerPage: itemsPerPage,
                pricesInGroup: pricesInGroup,
                template: template,
            },
            success: function (response) {
                var decoded;

                try {
                    decoded = $.parseJSON(response);
                } catch(err) {
                    console.log(err);
                    decoded = false;
                }

                if (decoded) {
                    if (decoded.success) {
                        container.html(decoded.message);

                        $(".scroll-content").mCustomScrollbar({
                            axis: "y",
                            theme: 'rounded-dark'
                        });
                    } else {
                        alert(decoded.message);
                    }
                } else {
                    alert('Something went wrong');
                }

            }
        });
    }

    // TODO: Remove
    function ittourLoadHotelToursTable() {
        var tourTableSection = $('#hotel-tour-table__section');

        if (tourTableSection.length > 0) {
            var month = tourTableSection.data('month');
            var year = tourTableSection.data('year');
            var country = tourTableSection.data('country');
            var hotelId = tourTableSection.data('hotel-id');
            var hotelRating = tourTableSection.data('hotel-rating');

            $.ajax({
                url: snthWpJsObj.ajaxurl,
                method: 'post',
                data: {
                    action: 'ittour_ajax_load_hotel_tours_table',
                    month: month,
                    year: year,
                    country: country,
                    hotelId: hotelId,
                    hotelRating: hotelRating
                },
                success: function (response) {
                    var decoded;

                    try {
                        decoded = $.parseJSON(response);
                    } catch(err) {
                        console.log(err);
                        decoded = false;
                    }

                    if (decoded) {
                        if (decoded.success) {
                            tourTableSection.html(decoded.message.table_html);
                        } else {
                            alert(decoded.message);
                        }
                    } else {
                        alert('Something went wrong');
                    }

                }
            });
        }
    }

    function ittourLoadTourCalendar() {
        var tourCalendarSection = $('#hotel-tour-calendar__section');

        if (tourCalendarSection.length > 0) {
            var month = tourCalendarSection.data('month');
            var year = tourCalendarSection.data('year');
            var country = tourCalendarSection.data('country');
            var hotelId = tourCalendarSection.data('hotel-id');
            var hotelRating = tourCalendarSection.data('hotel-rating');

            $.ajax({
                url: snthWpJsObj.ajaxurl,
                method: 'post',
                data: {
                    action: 'ittour_ajax_load_hotel_tour_calendar',
                    month: month,
                    year: year,
                    country: country,
                    hotelId: hotelId,
                    hotelRating: hotelRating
                },
                success: function (response) {
                    var decoded;

                    try {
                        decoded = $.parseJSON(response);
                    } catch(err) {
                        console.log(err);
                        decoded = false;
                    }

                    if (decoded) {
                        if (decoded.success) {
                            tourCalendarSection.html(decoded.message.table_html);
                        } else {
                            alert(decoded.message);
                        }
                    } else {
                        alert('Something went wrong');
                    }

                }
            });
        }
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