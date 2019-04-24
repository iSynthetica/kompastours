(function ($) {

    $(document.body).on('search_form_loaded', function() {
        $(".numbers-alt.numbers-gor").append('<div class="incr buttons_inc"><i class="fas fa-chevron-right"></i></div><div class="decr buttons_inc"><i class="fas fa-chevron-left"></i></div>');

        $(".numbers-alt.numbers-ver").append('<div class="incr buttons_inc"><i class="fas fa-chevron-up"></i></div><div class="decr buttons_inc"><i class="fas fa-chevron-down"></i></div>');

        $('.repeater').repeater({
            initEmpty: true
        });

        // $('.iCheckGray').iCheck({
        //     checkboxClass: 'icheckbox_square-grey',
        //     radioClass: 'iradio_square-grey'
        // });

        var dateFrom = $('input.date-pick').data('date-from');
        var dateTill = $('input.date-pick').data('date-till');

        var startDate = moment().startOf('hour').add(12, 'hour');
        var endDate = moment().startOf('hour').add(132, 'hour');

        if (dateFrom && dateTill) {
            startDate = moment(dateFrom, "DD.MM.YY");
            endDate = moment(dateTill, "DD.MM.YY");
        }

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

        var regionsHtml = '<select name="region" id="region_select" class="form-control">';

        if ('' === selectedCountry) {
            $('#reset-country_select').prop('disabled', true);
            regionsHtml += '<option value="">'+ snthWpJsObj.searchForm.selectCountryFirst +'</option>';
        } else {
            $('#reset-country_select').prop('disabled', false);
            var regions = regionsByCountries[parseInt(selectedCountry)];
            regionsHtml += '<option value="">'+ snthWpJsObj.searchForm.selectRegion +'</option>';

            for (var i = 0; i < regions.length; i++) {
                regionsHtml += '<option value="'+regions[i].id+'">'+regions[i].name+'</option>';
            }
        }

        regionsHtml += '</select>';

        $('#region_select').replaceWith(regionsHtml);

        ittourGetHotelsList(function() {
            ittourShowDestinationSummary();
        });

    });

    $(document.body).on('change', '#region_select', function() {
        var newVal = $(this).val();

        if ('' !== newVal) {
            $('#reset-region_select').prop('disabled', false);
        } else {
            $('#reset-region_select').prop('disabled', true);
        }

        ittourGetHotelsList(function() {
            ittourShowDestinationSummary();
        });
    });

    $(document.body).on('change', '#hotel_select', function() {
        var newVal = $(this).val();

        if ('' !== newVal) {
            $('#reset-hotel_select').prop('disabled', false);
        } else {
            $('#reset-hotel_select').prop('disabled', true);
        }

        ittourUpdateHotelRating();
        ittourShowDestinationSummary();
    });

    $(document.body).on('click', '#reset-country_select', function() {
        $(this).prop('disabled', true);
        $('#reset-region_select').prop('disabled', true);
        $('#reset-hotel_select').prop('disabled', true);
        $("#country_select option[value='']").attr('selected', true);
        $('#country_select').trigger('change');
        ittourUpdateHotelRating();
    });

    $(document.body).on('click', '#reset-region_select', function() {
        $(this).prop('disabled', true);
        $('#reset-hotel_select').prop('disabled', true);
        $("#region_select option[value='']").attr('selected', true);
        $('#region_select').trigger('change');
        ittourUpdateHotelRating();
    });

    $(document.body).on('click', '#reset-hotel_select', function() {
        $(this).prop('disabled', true);
        $("#hotel_select option[value='']").attr('selected', true);
        $('#hotel_select').trigger('change');
    });

    $(document.body).on('change', '#hotel_rating_select input', function() {
        var hotelSelect = $('#hotel_select'),
            selectedHotelVal = hotelSelect.find(":selected").val(),
            selectedHotelRating = hotelSelect.find(":selected").data('hotel-rating');

        if ('' === selectedHotelVal) {
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

                console.log(selectedRatingVal);
                console.log(typeof selectedRatingVal);

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

            console.log(selectedRatingsCount);
        } else {
            $(this).prop('disabled', false).prop('checked', true);
        }
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
            selectedCountry = $.trim($('#country_select').find(":selected").text());
        }

        if ( '' !== selectedRegionVal ) {
            selectedRegion = $.trim($('#region_select').find(":selected").text()) + ', ';
        }

        if ( '' !== selectedHotelVal ) {
            selectedHotel = $.trim($('#hotel_select').find(":selected").text()) + ', ';
        }

        destinationSummary.val(selectedHotel + selectedRegion + selectedCountry);
    }

    function ittourGetHotelsList(cb) {
        var selectedCountry = $('#country_select').find(":selected").val(),
            selectedRegion = $('#region_select').find(":selected").val();



        if ('' === selectedCountry) {
            var hotelsHtml = '<select name="hotel" id="hotel_select" class="form-control">';
            hotelsHtml += '<option value="">'+ snthWpJsObj.searchForm.selectCountryFirst +'</option>';
            hotelsHtml += '</select>';

            $('#hotel_select').replaceWith( hotelsHtml );

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

                        var hotelsHtml = '<select name="hotel" id="hotel_select" class="form-control">';
                        hotelsHtml += '<option value="">'+ snthWpJsObj.searchForm.selectHotel +'</option>';

                        for (var i = 0; i < hotels.length; i++) {
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

                        hotelsHtml += '</select>';

                        $('#hotel_select').replaceWith( hotelsHtml );

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
            selectedHotelVal = hotelSelect.find(":selected").val(),
            selectedHotelRating = hotelSelect.find(":selected").data('hotel-rating');

        var hotelRatingSelect = $('#hotel_rating_select');
        var hotelRatings = hotelRatingSelect.find('input');

        if ('' === selectedHotelVal) {
            hotelRatings.each(function() {
                $(this).prop('disabled', false).prop('checked', false);
            });
        } else {
            hotelRatings.each(function() {
                $(this).prop('disabled', true).prop('checked', false);
            });

            hotelRatingSelect.find('#hotel_rating_' + selectedHotelRating).prop('disabled', false).prop('checked', true);
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
                childAge: childAge
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