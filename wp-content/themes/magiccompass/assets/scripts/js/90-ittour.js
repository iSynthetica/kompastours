/**
 * Ittour scripts
 */
(function ($) {

    $(document).ready(function() {
        $('.datepicker').datepicker({
            autoclose: 1
        });

        var isSingleTourPage = false;
        var singleTourContainer = $('#single-tour-main-info__container');
        
        if (singleTourContainer.length > 0) {
            isSingleTourPage = true;
        }
        
        if (isSingleTourPage) {
            runValidationCountdown();
            ittourSingleTourFunctions();
        }
    });

    function runValidationCountdown() {
        $('.validate-countdown').countdown($('.validate-countdown').attr("data-enddate"))
            .on('update.countdown', function (event) {
                    var minLabel = $('.validate-countdown').attr("data-min-label");
                    var secLabel = $('.validate-countdown').attr("data-sec-label");

                    $(this).html(event.strftime('' + '<div class="validate-counter-container font-alt">' + '<div class="counter-box first  d-inline-block text-center"><div class="number font-weight-900">%M</div><span>'+minLabel+'</span></div><div class="counter-box-divider d-inline-block"><div class="counter-divider">:</div></div>' + '<div class="counter-box last d-inline-block text-center"><div class="number font-weight-900">%S</div><span>'+secLabel+'</span></div></div>'));

                    if (5 > event.offset.minutes) {
                        $('#validate-btn').show();
                    }
            }).on('finish.countdown', function(event) {
                ittourValidateTour();
            });

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
    }

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

    $(document.body).on('click', '#lp-order-form__submit', function() {
        var formData = $("#lp-order-form").serializeArray();

        $.ajax({
            url: snthWpJsObj.ajaxurl,
            method: 'post',
            dataType: "json",
            data: {
                action: 'ittour_ajax_get_lp_proposal',
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

    $(document.body).on('click', '#change-parameters-btn', function() {
        $('#search-form__section').slideToggle();

        $.smoothScroll({
            scrollTarget: '#search-form__section',
            offset: -60
        });
    });

    $(document.body).on('click', '.validate-btn', function() {
        var singleTourSummary = $('#single-tour-booking__holder');

        var key = singleTourSummary.data('key');
        var currency = singleTourSummary.data('currency');
        var tourInfo = singleTourSummary.data('tour-info');

        $.ajax({
            url: snthWpJsObj.ajaxurl,
            method: 'post',
            dataType: "json",
            data: {
                action: 'ittour_ajax_validate_tour',
                key: key,
                currency: currency,
                tourInfo: tourInfo
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
                        runValidationCountdown();
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

    $(document.body).on('click', '.book-btn', function() {
        var formData = $("#booking-form").serializeArray();

        $.ajax({
            url: snthWpJsObj.ajaxurl,
            method: 'post',
            dataType: "json",
            data: {
                action: 'ittour_ajax_book_tour',
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
                        $( ".book-btn" ).remove();
                        $( ".error_messages" ).remove();
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

    $(document.body).on('click', '#changeFlightThere', function() {
        $('#flightThere__list').toggle();
        $('#flightBack__list').hide();
    });

    $(document.body).on('click', '#changeFlightBack', function() {
        $('#flightBack__list').toggle();
        $('#flightThere__list').hide();
    });

    $(document.body).on('click', '.select-flight__holder li', function() {
        var selected = $(this);

        if (selected.hasClass('selected')) {
            return true;
        }

        var type = selected.parents('.select-flight__holder').data('type');
        var selectedHtml = selected.html();
        var selectedVal = selected.data('txt-val');
        var selectedStructured = selected.data('structured-val');
        var variants = selected.parents('.select-flight__holder').find('li');

        variants.each(function () {
            $(this).removeClass('selected');
        });

        selected.addClass('selected');

        var textHolder = $('#'+type+'__holder');
        var formTextHolder = $('#form'+type+'__holder');

        textHolder.html(selectedHtml);
        formTextHolder.html(selectedHtml);
        $('#'+type+'_val').val(selectedVal);
        $('#'+type+'_structured').val(selectedStructured);
        selected.parents('.select-flight__holder').hide();
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
    
    function ittourSingleTourFunctions() {
        var validateSpinner = $('#validation-spinner__holder');

        if (validateSpinner.length > 0) {
            ittourValidateTour();
        }
    }
    
    function ittourValidateTour() {
        var singleTourSummary = $('#single-tour-booking__holder');

        var key = singleTourSummary.data('key');
        var currency = singleTourSummary.data('currency');
        var tourInfo = singleTourSummary.data('tour-info');

        $.ajax({
            url: snthWpJsObj.ajaxurl,
            method: 'post',
            dataType: "json",
            data: {
                action: 'ittour_ajax_validate_tour',
                key: key,
                currency: currency,
                tourInfo: tourInfo
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
                        runValidationCountdown();
                    } else {
                        var fragments = response.message.fragments;
                        updateFragments(fragments);
                    }
                } else {
                    alert('Something went wrong');
                }
            }
        });
    }

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