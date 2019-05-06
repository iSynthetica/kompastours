(function ($) {
    $(document.body).on('search_form_loaded', function() {
        $(".numbers-alt.numbers-gor").append('<div class="incr buttons_inc"><i class="fas fa-chevron-right"></i></div><div class="decr buttons_inc"><i class="fas fa-chevron-left"></i></div>');

        $(".numbers-alt.numbers-ver").append('<div class="incr buttons_inc"><i class="fas fa-chevron-up"></i></div><div class="decr buttons_inc"><i class="fas fa-chevron-down"></i></div>');

        // $('.repeater').repeater({
        //     initEmpty: true
        // });

        var dateFrom = $('input.date-pick').data('date-from');
        var dateTill = $('input.date-pick').data('date-till');

        var startDate = moment().startOf('hour').add(12, 'hour');
        var endDate = moment().startOf('hour').add(132, 'hour');

        if (dateFrom && dateTill) {
            startDate = moment(dateFrom, "DD.MM.YY");
            endDate = moment(dateTill, "DD.MM.YY");
        }

        var selectedCountryVal = $('#country_select').val();

        var regionPlaceholder = snthWpJsObj.searchForm.selectRegion;
        var hotelPlaceholder = snthWpJsObj.searchForm.selectHotel;

        if ('' === selectedCountryVal) {
            regionPlaceholder = snthWpJsObj.searchForm.selectCountryFirst;
            hotelPlaceholder = snthWpJsObj.searchForm.selectCountryFirst;
        }

        $('#country_select').select2({
            placeholder: snthWpJsObj.searchForm.selectCountry,
            allowClear: true
        });

        $('#region_select').select2({
            placeholder: regionPlaceholder,
            allowClear: true
        });

        // $('.form-select2').select2();
        $('#hotel_select').select2({
            placeholder: hotelPlaceholder,
            maximumSelectionLength: 10
        });

        $('input.date-pick').daterangepicker({
            startDate: startDate,
            endDate: endDate,
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

    // ================================
    //  Destination
    // ================================
    $(document.body).on('change', '#country_select', function() {
        var selectedCountry = $('#country_select').find(":selected").val();
        var regionsByCountries = $.parseJSON($('#regions_by_countries').val());

        var regionsHtml = '<select name="region" id="region_select" class="form-control form-select2" style="width: 100%">';

        if ('' === selectedCountry) {
            var regionPlaceholder = snthWpJsObj.searchForm.selectCountryFirst;
            regionsHtml += '<option></option>';
        } else {
            regionPlaceholder = snthWpJsObj.searchForm.selectRegion;
            var regions = regionsByCountries[parseInt(selectedCountry)];
            regionsHtml += '<option></option>';

            for (var i = 0; i < regions.length; i++) {
                regionsHtml += '<option value="'+regions[i].id+'">'+regions[i].name+'</option>';
            }
        }

        regionsHtml += '</select>';

        $('#region_select').select2('destroy');
        $('#region_select').replaceWith(regionsHtml);
        $('#region_select').select2({
            placeholder: regionPlaceholder,
            allowClear: true
        });

        ittourGetHotelsList(function() {
            ittourShowDestinationSummary();
        });

    });

    $(document.body).on('change', '#region_select', function() {
        var newVal = $(this).val();

        ittourGetHotelsList(function() {
            ittourShowDestinationSummary();
        });
    });

    $(document.body).on('change', '#hotel_select', function() {
        var newVal = $(this).val();

        ittourUpdateHotelRating();
        ittourShowDestinationSummary();
    });

    $(document.body).on('change', '#hotel_rating_select input', function() {
        var selectedRatingsCount = $( "#hotel_rating_select input:checked" ).length;

        if (0 === selectedRatingsCount) {
            $( "#hotel_rating_select input" ).prop('disabled', false);
        } else if (2 === selectedRatingsCount) {
            $( "#hotel_rating_select input" ).prop('disabled', true);

            $( "#hotel_rating_select input:checked" ).each(function () {
                $(this).prop('disabled', false);
            });
        } else {
            var selectedRating = $( "#hotel_rating_select input:checked" );
            var selectedRatingVal = selectedRating.val();

            $( "#hotel_rating_select input" ).prop('disabled', true);

            selectedRating.prop('disabled', false);

            if ('78' === selectedRatingVal) {
                $( "input#hotel_rating_4" ).prop('disabled', false);
            } else if ('4' === selectedRatingVal) {
                $( "input#hotel_rating_78" ).prop('disabled', false);
                $( "input#hotel_rating_3" ).prop('disabled', false);
            } else if ('3' === selectedRatingVal) {
                $( "input#hotel_rating_4" ).prop('disabled', false);
                $( "input#hotel_rating_7" ).prop('disabled', false);
            } else if ('7' === selectedRatingVal) {
                $( "input#hotel_rating_3" ).prop('disabled', false);
            }
        }

        ittourGetHotelsList(function() {
            ittourShowDestinationSummary();
        });
    });

    /**
     * Get Destination summary
     */
    function ittourShowDestinationSummary() {
        var selectedCountryVal = $('#country_select').find(":selected").val(),
            selectedRegionVal = $('#region_select').find(":selected").val(),
            selectedHotelVal = $('#hotel_select').find(":selected").val(),
            selectedHotels = [],
            selectedHotelRatings = [];

        var hotelSelect = $('#hotel_select');

        $.each(hotelSelect.find(":selected"), function() {
            selectedHotels.push($(this).val());
        });

        $( "#hotel_rating_select input:checked" ).each(function () {
            selectedHotelRatings.push($(this).val());
        });

        var destinationSummary = $('#destination_summary');

        var selectedRegion = '', selectedCountry = '', selectedHotel = '';

        if (0 === selectedHotels.length) {
            if (0 < selectedHotelRatings.length) {
                $.each(selectedHotelRatings, function(index, value) {
                    if ('78' === value) {
                        value = '5';
                    } else if ('7' === value) {
                        value = '2';
                    }

                    selectedHotel += value + '*, '
                });
            }
        } else {
            if (1 === selectedHotels.length) {
                var value = selectedHotels[0];
                selectedHotel = $.trim($('#hotel_select option[value="'+value+'"]').text()) + ', ';
            } else {
                selectedHotel = selectedHotels.length + ' hotel(s), ';
            }
        }

        if ( '' !== selectedCountryVal ) {
            selectedCountry = $.trim($('#country_select').find(":selected").text());
        }

        if ( '' !== selectedRegionVal ) {
            selectedRegion = $.trim($('#region_select').find(":selected").text()) + ', ';
        }

        // if ( '' !== selectedHotelVal ) {
        //     selectedHotel = $.trim($('#hotel_select').find(":selected").text()) + ', ';
        // }

        if ('' === selectedCountry || ('' !== selectedCountry && '' === selectedHotel)) {
            $('#filter_options').prop('disabled', true);
            $('#start_search').prop('disabled', true);
            $('#dates-duration_summary').prop('disabled', true);
            $('#guests_summary').prop('disabled', true);
            $('#dates-duration_summary__container').addClass('disabled-item');
            $('#guests_summary__container').addClass('disabled-item');
        } else {
            $('#filter_options').prop('disabled', false);
            $('#start_search').prop('disabled', false);
            $('#dates-duration_summary').prop('disabled', false).prop('readonly', true);
            $('#guests_summary').prop('disabled', false).prop('readonly', true);
            $('#dates-duration_summary__container').removeClass('disabled-item');
            $('#guests_summary__container').removeClass('disabled-item');
        }

        destinationSummary.val(selectedHotel + selectedRegion + selectedCountry);
    }

    function ittourGetHotelsList(cb) {
        var selectedCountry = $('#country_select').find(":selected").val(),
            selectedRegion = $('#region_select').find(":selected").val(),
            selectedHotels = [],
            selectedHotelRatings = [];

        $.each($("input[name='hotel_rating[]']:checked"), function(){
            selectedHotelRatings.push($(this).val());
        });

        $.each($('#hotel_select').find(":selected"), function(){
            selectedHotels.push($(this).val());
        });

        if ('' === selectedCountry) {
            var hotelsHtml = '<select name="hotel[]" id="hotel_select" class="form-control form-select2" style="width: 100%" multiple>';
            hotelsHtml += '</select>';


            $('#hotel_select').select2('destroy');
            $('#hotel_select').replaceWith( hotelsHtml );
            $('#hotel_select').select2({
                placeholder: snthWpJsObj.searchForm.selectCountryFirst,
                maximumSelectionLength: 10
            });

            if ('function' === typeof cb) {
                cb();
            }
        } else {
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

                        var hotelsHtml = '<select name="hotel[]" id="hotel_select" class="form-control form-select2-multiple" style="width: 100%" multiple>';

                        for (var i = 0; i < hotels.length; i++) {
                            if (0 === selectedHotelRatings.length || -1 < $.inArray(hotels[i].hotel_rating_id, selectedHotelRatings)) {
                                var hotelRating = '5*';

                                if ('7' === hotels[i].hotel_rating_id || '2' === hotels[i].hotel_rating_id) {
                                    hotelRating = '2*';
                                } else if ('3' === hotels[i].hotel_rating_id) {
                                    hotelRating = '3*';
                                }  else if ('4' === hotels[i].hotel_rating_id) {
                                    hotelRating = '4*';
                                }

                                hotelsHtml += '<option value="'+hotels[i].id+'" data-hotel-rating="'+hotels[i].hotel_rating_id+'">'+hotels[i].name+ ' ' + hotelRating +'</option>';
                            }
                        }

                        hotelsHtml += '</select>';

                        $('#hotel_select').select2('destroy');
                        $('#hotel_select').replaceWith( hotelsHtml );

                        $.each(selectedHotels, function(index, value) {
                            $('#hotel_select option[value="'+value+'"]').prop('selected', true);
                        });

                        $('#hotel_select').select2({
                            placeholder: snthWpJsObj.searchForm.selectHotel,
                            maximumSelectionLength: 10
                        });

                        if ('function' === typeof cb) {
                            cb();
                        }
                    }
                },
                'json'
            );
        }
    }

    function ittourUpdateHotelRating() {
        var hotelSelect = $('#hotel_select'),
            selectedHotel = hotelSelect.find(":selected"),
            selectedHotelVal = selectedHotel.val(),
            selectedHotelRatings = [];

        var isRatingChanged = false;

        var alreadySelectedHotelRatings = [];

        $.each($("input[name='hotel_rating[]']:checked"), function(){
            alreadySelectedHotelRatings.push(parseInt($(this).val()));
        });

        selectedHotel.each(function () {
            var dataHotelRating = $(this).data('hotel-rating');

            if (-1 === $.inArray(dataHotelRating, alreadySelectedHotelRatings)) {
                selectedHotelRatings.push(dataHotelRating);
                isRatingChanged = true;
            }
        });

        selectedHotelRatings = $.unique(selectedHotelRatings);

        var hotelRatingSelect = $('#hotel_rating_select');
        var hotelRatings = hotelRatingSelect.find('input');

        $.each(selectedHotelRatings, function(index, value) {
            hotelRatingSelect.find('#hotel_rating_' + value).prop('disabled', false).prop('checked', true);
        });

        if (isRatingChanged) {
            $( '#hotel_rating_select input' ).trigger( 'change' );
        }
    }

    // ================================
    //  Guests
    // ================================
    $(document.body).on('input', '#adult_amount', function() {
        var adults = $(this).val();

        ittourShowGuestsSummary();
    });

    $(document.body).on('click', '#child_amount_repeater_holder .btn-create', function() {
        var btn = $(this);
        var limit = $('#child_amount_repeater_holder').data('limit');
        var childSelectItems = $('#child_amount_repeater_holder .child_amount_item');

        ittourLoadSelectChild(function(selectChildHtml) {
            var repeaterHolder = $('#child_amount_repeater_holder .child_amount_group');
            repeaterHolder.append(selectChildHtml);

            var childSelectItemsNew = $('#child_amount_repeater_holder .child_amount_item');

            if (limit === childSelectItemsNew.length) {
                btn.addClass('disabled').hide();
            }

            ittourShowGuestsSummary();
        });

    });

    $(document.body).on('change', '#child_amount_repeater_holder .child_amount_item select', function() {
        ittourShowGuestsSummary();
    });

    $(document.body).on('click', '#child_amount_repeater_holder .child_amount_item .btn-delete', function() {
        $(this).parent('.child_amount_item').remove();

        var btn = $('#child_amount_repeater_holder .btn-create');
        var limit = $('#child_amount_repeater_holder').data('limit');
        var childSelectItemsNew = $('#child_amount_repeater_holder .child_amount_item');

        if (limit > childSelectItemsNew.length && btn.hasClass('disabled')) {
            btn.removeClass('disabled').show();
        }

        ittourShowGuestsSummary();
    });

    /**
     * Add Child amount item
     * @param cb
     */
    function ittourLoadSelectChild(cb) {
        $.post(
            snthWpJsObj.ajaxurl,
            {
                'action': 'ittour_ajax_load_select_child',
            }, function(response) {

                var selectChildHtml = '';

                if( response.status === 'success') {
                    selectChildHtml = response.html;
                }

                if (typeof cb === 'function') {
                    cb(selectChildHtml);
                }
            },
            'json'
        );
    }

    function ittourShowGuestsSummary() {
        var adults = $('#adult_amount');
        var children = $('#child_amount_repeater_holder .child_amount_item');

        var adultsAmount = adults.val();
        var childrenAmount = children.length;

        var childrenSummary = '';

        if (childrenAmount > 0) {
            childrenSummary += ' + ' + childrenAmount + ' (';

            children.each(function() {
                var childAge = $(this).find('select').val();

                childrenSummary += ' ' + childAge + 'y ';
            });
            childrenSummary += ')';
        }

        var guestsSummary = $('#guests_summary');

        guestsSummary.val(adultsAmount + childrenSummary);
    }

    // ================================
    //  Dates / Duration
    // ================================
    $(document.body).on('apply.daterangepicker', function(ev, picker) {
        var datesSelect = $('#date-pick__select'),
            datesVal = datesSelect.val();

        datesSelect.data('current_value', datesVal);

        ittourShowDatesDurationSummary();
    });

    $(document.body).on('input', '#duration-from__select', function() {
        var durationSelect = $(this),
            durationVal = durationSelect.val();

        durationSelect.data('current_value', durationVal);

        ittourShowDatesDurationSummary();
    });

    $(document.body).on('input', '#duration-till__select', function() {
        var durationSelect = $(this),
            durationVal = durationSelect.val();

        durationSelect.data('current_value', durationVal);

        ittourShowDatesDurationSummary();
    });

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
            durationSelected = durationFromCurrentValue + ' - ' + durationTillCurrentValue + ' ' + snthWpJsObj.searchForm.nights;
        }


        var datesDurationSummary = $('#dates-duration_summary');

        datesDurationSummary.val(datesSelected + durationSelected);
    }

    // ================================
    //  Filter
    // ================================
    $(document.body).on('change', '#price_limit_select input[type=\'radio\']', function() {

        var priceSelected = $('#price_limit_select input[type=\'radio\']:checked').val();

        if ('custom' === priceSelected) {
            $('#custom_price_limit_holder').show();
            $('#price_limit_from').val('1000');
            $('#price_limit_till').val('500000');
        } else {
            $('#custom_price_limit_holder').hide();
            $('#price_limit_from').val('');
            $('#price_limit_till').val('');
        }
    });

    $(document.body).on('change', '#tour_type_select input[type=\'radio\']', function() {
        var typeSelected = $('#tour_type_select input[type=\'radio\']:checked').val();

        if ('' === typeSelected || '2' === typeSelected) {
            $('#tour_kind_select').hide();

            $('#tour_kind_select input[type=\'radio\']').each(function () {
                $(this).prop('checked', false);
            });

            $('#tour_kind_select input[value=\'\']').prop('checked', true);
        } else {
            $('#tour_kind_select').show();
        }
    });


    $(document).ready(function() {});

    $(window).on('load', function () {
        ittourLoadSearchForm();
    });

    $(window).on('scroll', function() {});

    $(window).on('resize', function(e) {});

    function ittourLoadSearchForm() {
        var searchFormHolder = $('.search-form_ajax');

        if (0 === searchFormHolder.length) {return;}

        var country         = searchFormHolder.data('country');
        var region          = searchFormHolder.data('region');
        var hotel           = searchFormHolder.data('hotel');
        var hotelRating     = searchFormHolder.data('hotel-rating');
        var fromCity        = searchFormHolder.data('from-city');
        var dateFrom        = searchFormHolder.data('date-from');
        var dateTill        = searchFormHolder.data('date-till');
        var nightFrom       = searchFormHolder.data('night-from');
        var nightTill       = searchFormHolder.data('night-till');
        var adultAmount     = searchFormHolder.data('adult-amount');
        var childAmount     = searchFormHolder.data('child-amount');
        var childAge        = searchFormHolder.data('child-age');
        var priceLimit      = searchFormHolder.data('price-limit');
        var tourType        = searchFormHolder.data('tour-type');
        var tourKind        = searchFormHolder.data('tour-kind');

        $.ajax({
            url: snthWpJsObj.ajaxurl,
            method: 'post',
            data: {
                action: 'ittour_ajax_load_search_form',
                country: country,
                region: region,
                hotel: hotel,
                hotelRating: hotelRating,
                fromCity: fromCity,
                dateFrom: dateFrom,
                dateTill: dateTill,
                nightFrom: nightFrom,
                nightTill: nightTill,
                adultAmount: adultAmount,
                childAmount: childAmount,
                childAge: childAge,
                priceLimit: priceLimit,
                tourType: tourType,
                tourKind: tourKind
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
                        var fragments = decoded.message.fragments;

                        setTimeout(function () {
                            updateFragments(fragments);

                            $( document.body ).trigger( 'search_form_loaded' );
                        }, 1000);
                    } else {
                        alert(decoded.message);
                    }
                } else {
                    alert('Something went wrong');
                }

            }
        });

        // $.post(snthWpJsObj.ajaxurl,
        //     {
        //         'action': 'ittour_ajax_load_search_form',
        //     }, function(response) {
        //         if( response.status === 'error') {
        //
        //         } else {
        //             var fragments = response.message.fragments;
        //
        //             setTimeout(function () {
        //                 updateFragments(fragments);
        //
        //                 $( document.body ).trigger( 'search_form_loaded' );
        //             }, 1000);
        //         }
        //     },
        //     'json'
        // );
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