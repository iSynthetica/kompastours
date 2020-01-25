(function ($) {
    var start = $.now();
    var starsArray = [];
    var maxStarsNum = 2;
    var locale = {
        format: 'DD.MM.YY',
        firstDay: 1,
        daysOfWeek: [
            snthWpJsObj.calendar.daysOfWeekShort.su,
            snthWpJsObj.calendar.daysOfWeekShort.mo,
            snthWpJsObj.calendar.daysOfWeekShort.tu,
            snthWpJsObj.calendar.daysOfWeekShort.we,
            snthWpJsObj.calendar.daysOfWeekShort.th,
            snthWpJsObj.calendar.daysOfWeekShort.fr,
            snthWpJsObj.calendar.daysOfWeekShort.sa
        ],
        monthNames: [
            snthWpJsObj.calendar.monthNamesShort.jan,
            snthWpJsObj.calendar.monthNamesShort.feb,
            snthWpJsObj.calendar.monthNamesShort.mar,
            snthWpJsObj.calendar.monthNamesShort.apr,
            snthWpJsObj.calendar.monthNamesShort.may,
            snthWpJsObj.calendar.monthNamesShort.jun,
            snthWpJsObj.calendar.monthNamesShort.jul,
            snthWpJsObj.calendar.monthNamesShort.aug,
            snthWpJsObj.calendar.monthNamesShort.sep,
            snthWpJsObj.calendar.monthNamesShort.oct,
            snthWpJsObj.calendar.monthNamesShort.nov,
            snthWpJsObj.calendar.monthNamesShort.dec
        ]
    };

    var startDateTime = moment().startOf('hour').add(12, 'hour');

    $(document.body).on('click', '#change-search-type-container i', function() {
        var control = $(this);
        var container = control.parents('.search-form__holder');
        container.removeClass('tour-search-active').removeClass('excursion-search-active');

        if (control.hasClass('ittour-switch-tour')) {
            container.addClass('tour-search-active');
        } else {
            container.addClass('excursion-search-active');
        }
    });

    $(document.body).on('search_form_loaded', function() {
        $(".numbers-alt.numbers-gor").append('<div class="incr buttons_inc"><i class="fas fa-plus"></i></div><div class="decr buttons_inc"><i class="fas fa-minus"></i></div>');

        $(".numbers-alt.numbers-ver").append('<div class="incr buttons_inc"><i class="fas fa-plus"></i></div><div class="decr buttons_inc"><i class="fas fa-minus"></i></div>');

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

        $('#country_excursion_select').select2({
            placeholder: snthWpJsObj.searchForm.selectCountry,
            allowClear: true
        });

        $('#region_select').select2({
            placeholder: regionPlaceholder,
            allowClear: true
        });

        $('#city_excursion_select').select2({
            placeholder: regionPlaceholder,
            maximumSelectionLength: 10,
            allowClear: true
        });

        $('#hotel_select').select2({
            placeholder: hotelPlaceholder,
            maximumSelectionLength: 10
        });

        var dateFrom = $('#search-form input.date-pick').data('date-from');
        var dateTill = $('#search-form input.date-pick').data('date-till');

        var startDate = startDateTime;
        var endDate = moment().startOf('hour').add(132, 'hour');

        if (dateFrom && dateTill) {
            startDate = moment(dateFrom, "DD.MM.YY");
            endDate = moment(dateTill, "DD.MM.YY");
        }

        $('#search-form input.date-pick').daterangepicker({
            startDate: startDate,
            endDate: endDate,
            minDate: startDateTime,
            alwaysShowCalendars: true,
            parentEl: '.date-pick__select__container',
            maxSpan: {
                "days": 12
            },
            locale: locale,
            applyButtonClasses : 'btn hvr-invert shape-rnd size-xs font-alt',
            cancelButtonClasses : 'btn hvr-invert shape-rnd size-xs font-alt',
            autoApply: true
        });

        var dateExcursionFrom = $('#excursion-search-form input.date-pick').data('date-from');
        var dateExcursionTill = $('#excursion-search-form input.date-pick').data('date-till');

        var startDateExcursion = startDateTime;
        var endDateExcursion = moment().startOf('hour').add(132, 'hour');

        if (dateExcursionFrom && dateExcursionFrom) {
            startDateExcursion = moment(dateExcursionFrom, "DD.MM.YY");
            endDateExcursion = moment(dateExcursionTill, "DD.MM.YY");
        }

        $('#excursion-search-form input.date-pick').daterangepicker({
            startDate: startDateExcursion,
            endDate: endDateExcursion,
            minDate: startDateTime,
            alwaysShowCalendars: true,
            parentEl: '.date-pick__select__container',
            maxSpan: {
                "days": 30
            },
            locale: locale,
            applyButtonClasses : 'btn hvr-invert shape-rnd size-xs font-alt',
            cancelButtonClasses : 'btn hvr-invert shape-rnd size-xs font-alt',
            autoApply: true
        });

        var selectedRatings = $( "#hotel_rating_select input:checked" );

        $.each(selectedRatings, function (index, selectedRating) {
            starsArray.push($(selectedRating).val());
        });
    });

    $(document.body).on('click', '.form-data-toggle-control', function() {
        var controller = $(this);
        var form = controller.parents('form');
        var target = controller.data('form_toggle_target');
        var toggleTarget  = form.find('#' + target);
        var toggleTargets = form.find('.form-data-toggle-target');

        if (toggleTarget.hasClass('active')) {
            toggleTarget.removeClass('active').hide('0', function() {
                $('body').removeClass('toggle-is-active');
            });
        } else {
            $('body').addClass('toggle-is-active');
            toggleTargets.removeClass('active').hide();

            toggleTarget.addClass('active').show('0', function () {
                $('.scroll-on-show').mCustomScrollbar({
                    axis: "y",
                    theme: 'rounded-dark'
                });
            });
        }
    });

    // ================================
    //  Destination
    // ================================
    $(document.body).on('click', '#city_from_select_mobile li label', function() {
        var selectedCity = $(this).parent('li').find('input').val();
        var selectedCitySummary = $(this).parent('li').find('input').data('summary');
        var fromCityList = $('#city_from_select_mobile');

        fromCityList.find('li input').each(function() {
            var checkbox = $(this);

            if (checkbox.val() !== selectedCity) {
                checkbox.attr('checked', false);
            }
        });

        $('#from_city').val(selectedCity);
        $('#from-city_summary').val(selectedCitySummary);
    });

    $(document.body).on('change', '#from_city', function() {
        var selectedCity = $(this).val();
        var fromCityList = $('#city_from_select_mobile');
        var selectedCityListItem = $('#from_city_' + selectedCity);

        fromCityList.find('li input').each(function() {
            $(this).attr('checked', false);
        });

        selectedCityListItem.attr('checked', true);
    });

    $(document.body).on('change', '#country_select', function() {
        var selectedCountry = $('#country_select').find(":selected").val(),
            regionsByCountries = $.parseJSON($('#regions_by_countries').val()),
            regionsHtml = '<select name="region" id="region_select" class="form-control form-select2" style="width: 100%">',
            regionPlaceholder;

        if ('' === selectedCountry) {
            regionPlaceholder = snthWpJsObj.searchForm.selectCountryFirst;
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

    $(document.body).on('click', '#hotel_rating_select input', function() {
        var selectedRatings = $( "#hotel_rating_select input:checked" );
        var method = $(this).prop('checked');
        var star = $(this).val();

        if (method === true) {
            $('#hotel_rating_select input').prop('checked',false);

            if (starsArray.length >= maxStarsNum) {
                starsArray.shift();
            }

            starsArray.push(star);

            starsArray.forEach(function(star_el){
                $('#hotel_rating_select input[value="'+star_el+'"]').prop('checked',true);
            });
        } else if (method === false) {
            if (starsArray.length > 0) {
                $('#hotel_rating_select input[value="'+star+'"]').prop('checked',false);

                var tempArray = [];

                starsArray.forEach(function(el){
                    if (el === star && starsArray.length !== 1) {
                        $('#hotel_rating_select input[value="'+el+'"]').prop('checked',false);
                    } else {
                        tempArray.push(el);
                        $('#hotel_rating_select input[value="'+el+'"]').prop('checked',true);
                    }
                });

                starsArray = tempArray;
            }
        }

        ittourGetHotelsList(function() {
            ittourShowDestinationSummary();
        });
    });

    $(document.body).on('change', '#hotel_rating_select input_1', function() {
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

                    selectedHotel += value + '*, ';
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

        if ('' === selectedCountry || ('' !== selectedCountry && '' === selectedHotel)) {
            $('#filter_options').prop('disabled', true);
            $('#start_search').prop('disabled', true);
            $('#search-form .start_search').prop('disabled', true);

            $('#destination-select_section .btn-next-step').prop('disabled', true);
            $('#dates-select_section .btn-next-step').prop('disabled', true);
            $('#guests-select_section .btn-prev-step').prop('disabled', true);
            $('#guests-select_section .btn-next-step').prop('disabled', true);
            $('#filter-select__section .btn-prev-step').prop('disabled', true);

            $('#dates-duration_summary').prop('disabled', true);
            $('#guests_summary').prop('disabled', true);
            $('#filter_summary').prop('disabled', true);
            $('#dates-duration_summary__container').addClass('disabled-item');
            $('#guests_summary__container').addClass('disabled-item');
            $('#filter_summary__container').addClass('disabled-item');
        } else {
            $('#filter_options').prop('disabled', false);
            $('#start_search').prop('disabled', false);
            $('#search-form .start_search').prop('disabled', false);

            $('#destination-select_section .btn-next-step').prop('disabled', false);
            $('#dates-select_section .btn-next-step').prop('disabled', false);
            $('#guests-select_section .btn-prev-step').prop('disabled', false);
            $('#guests-select_section .btn-next-step').prop('disabled', false);
            $('#filter-select__section .btn-prev-step').prop('disabled', false);

            $('#dates-duration_summary').prop('disabled', false).prop('readonly', true);
            $('#guests_summary').prop('disabled', false).prop('readonly', true);
            $('#filter_summary').prop('disabled', false).prop('readonly', true);
            $('#dates-duration_summary__container').removeClass('disabled-item');
            $('#guests_summary__container').removeClass('disabled-item');
            $('#filter_summary__container').removeClass('disabled-item');
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
    //  Excursion
    // ================================
    $(document.body).on('click', '#excursion_city_from_select_mobile li label', function() {
        var selectedCity = $(this).parent('li').find('input').val();
        var selectedCitySummary = $(this).parent('li').find('input').data('summary');
        var fromCityList = $('#city_from_select_mobile');

        fromCityList.find('li input').each(function() {
            var checkbox = $(this);

            if (checkbox.val() !== selectedCity) {
                checkbox.attr('checked', false);
            }
        });

        $('#from_excursion_city').val(selectedCity);
        $('#from-city-excursion_summary').val(selectedCitySummary);

        fromExcursionCityChanged(selectedCity);
    });

    $(document.body).on('change', '#from_excursion_city', function(){
        var selectedCity = $(this).val();
        var fromCityList = $('#excursion_city_from_select_mobile');
        var selectedCityListItem = $('#from_city_' + selectedCity);

        fromCityList.find('li input').each(function() {
            $(this).attr('checked', false);
        });

        selectedCityListItem.attr('checked', true);

        fromExcursionCityChanged(selectedCity);
    });

    function fromExcursionCityChanged(selectedCityFrom) {
        console.log($.parseJSON($('#cities_from_excursion_dependencies').val())[selectedCityFrom]);
        var selectedCountries = $('#country_excursion_select').val(),
            countriesByCityFrom = $.parseJSON($('#cities_from_excursion_dependencies').val())[selectedCityFrom]['countries'],
            countriesHtml = '<select id="country_excursion_select" name="country[]" class="form-control form-select2" style="width: 100%">';

        if (typeof countriesByCityFrom === 'object' && countriesByCityFrom !== null && Object.keys(countriesByCityFrom).length) {
            for (var k in countriesByCityFrom) {
                var selected = '';
                if (selectedCountries && selectedCountries.length && selectedCountries.includes(countriesByCityFrom[k].id)) {
                    selected = ' selected';
                }
                countriesHtml += '<option value="'+countriesByCityFrom[k].id+'"'+selected+'>'+countriesByCityFrom[k].name+'</option>';
            }
        }

        countriesHtml += '<option></option>';
        countriesHtml += '</select>';

        $('#country_excursion_select').select2('destroy');
        $('#country_excursion_select').replaceWith(countriesHtml);
        $('#country_excursion_select').select2({
            placeholder: snthWpJsObj.searchForm.selectCountry,
            allowClear: true
        });

        $( '#country_excursion_select' ).trigger( 'change' );
    }

    $(document.body).on('change', '#country_excursion_select', function() {
        var selectedCountries = $(this).val(),
            selectedCityFrom = $('#from_excursion_city').val(),
            selectedCities = $('#city_excursion_select').val(),
            citiesByCountry = $.parseJSON($('#cities_from_excursion_dependencies').val())[selectedCityFrom]['countries'],
            citiesHtml = '<select id="city_excursion_select" name="city[]" class="form-control form-select2" style="width: 100%" multiple>',
            citiesPlaceholder;

        console.log(selectedCountries);

        if (selectedCountries && selectedCountries.length) {
            citiesPlaceholder = snthWpJsObj.searchForm.selectCity;

            citiesHtml += '<option></option>';

            var countryId = selectedCountries;
            console.log(countryId);
            var citiesByCountryId = citiesByCountry[countryId]['cities'];

            if (citiesByCountryId && snthGetObjectLength(citiesByCountryId)) {
                var citiesByCountryIdLength = snthGetObjectLength(citiesByCountryId);

                $.each( citiesByCountryId, function( key, value ) {
                    // console.log(value);

                    var selected = '';
                    if (selectedCities && selectedCities.length && selectedCities.includes(value.id)) {
                        selected = ' selected';
                    }
                    citiesHtml += '<option value="'+value.id+'"'+selected+'>'+value.name+'</option>';
                });
            }
        } else {
            citiesPlaceholder = snthWpJsObj.searchForm.selectCountryFirst;
            citiesHtml += '<option></option>';
        }

        citiesHtml += '</select>';

        $('#city_excursion_select').select2('destroy');
        $('#city_excursion_select').replaceWith(citiesHtml);
        $('#city_excursion_select').select2({
            placeholder: citiesPlaceholder,
            maximumSelectionLength: 10,
            allowClear: true
        });

        ittourShowExcursionDestinationSummary();
    });

    function snthGetObjectLength(object) {
        var key, count = 0;

        for (key in object) {
            if (object.hasOwnProperty(key)){
                count++;
            }
        }

        return count;
    }

    function ittourShowExcursionDestinationSummary() {
        var selectedCountries = [],
            selectedCities = [];

        var summary = '';

        $.each($('#country_excursion_select').find(":selected"), function() {
            selectedCountries.push($(this).text());

            if ('' !== summary) {
                summary += ', ';
            }

            summary += $(this).text();
        });

        $.each($('#city_excursion_select').find(":selected"), function() {
            selectedCities.push($(this).text());
        });

        if ('' !== summary) {
            $('#destination_excursion_summary').val(summary);

            $('#filter_excursion_options').prop('disabled', false);
            $('#start_excursion_search').prop('disabled', false);
            $('#excursion-search-form .start_search').prop('disabled', false);

            $('#destination-excursion-select_section .btn-next-step').prop('disabled', false);
            $('#dates-excursion-select_section .btn-next-step').prop('disabled', false);
            $('#filter-excursion-select__section .btn-prev-step').prop('disabled', false);

            $('#dates-excursion-duration_summary').prop('disabled', false).prop('readonly', true);
            $('#dates-excursion-duration_summary__container').removeClass('disabled-item');
            // $('#filter_summary').prop('disabled', false).prop('readonly', true);
            // $('#filter_summary__container').removeClass('disabled-item');
        } else {
            $('#destination_excursion_summary').val('');

            $('#filter_excursion_options').prop('disabled', true);
            $('#start_excursion_search').prop('disabled', true);
            $('#excursion-search-form .start_search').prop('disabled', true);

            $('#destination-excursion-select_section .btn-next-step').prop('disabled', true);
            $('#dates-excursion-select_section .btn-next-step').prop('disabled', true);
            $('#filter-excursion-select__section .btn-prev-step').prop('disabled', true);

            $('#dates-excursion-duration_summary').prop('disabled', true);
            $('#dates-excursion-duration_summary__container').addClass('disabled-item');
            //$('#filter_summary').prop('disabled', true);
            //$('#filter_summary__container').addClass('disabled-item');
        }
    }

    // ================================
    //  Guests
    // ================================
    $(document.body).on('blur', '#adult_amount', function() {
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
        var pickerElement = $(picker.element);
        var parentForm  = pickerElement.parents('form.search-form');
        var datesSelect, datesVal;

        if (parentForm.hasClass('search-tour-form')) {
            datesSelect = $('#date-pick__select');
            datesVal = datesSelect.val();

            datesSelect.data('current_value', datesVal);

            ittourShowDatesDurationSummary('');
        } else if (parentForm.hasClass('search-excursion-form')) {
            datesSelect = $('#date-excursion-pick__select');
            datesVal = datesSelect.val();
            datesSelect.data('current_value', datesVal);

            ittourShowDatesDurationSummary('excursion-');
        }
    });

    $(document.body).on('blur', '.duration__select', function() {
        var durationSelect = $(this),
            durationVal = durationSelect.val(),
            parentForm  = durationSelect.parents('form.search-form');

        durationSelect.data('current_value', durationVal);

        if (parentForm.hasClass('search-tour-form')) {
            ittourShowDatesDurationSummary('');
        } else if (parentForm.hasClass('search-excursion-form')) {
            ittourShowDatesDurationSummary('excursion-');
        }
    });

    function ittourShowDatesDurationSummary($type) {
        var datesSelect = $('#date-'+$type+'pick__select'),
            datesCurrentValue = datesSelect.data('current_value');

        var datesSelected = '',
            durationSelected = '';

        if (datesCurrentValue) {
            datesSelected = datesCurrentValue + ', ';
        }

        if ('excursion-' != $type) {
            var durationFromSelect = $('#duration-'+$type+'from__select'),
                durationFromCurrentValue = durationFromSelect.data('current_value');

            var durationTillSelect = $('#duration-'+$type+'till__select'),
                durationTillCurrentValue = durationTillSelect.data('current_value');

            if (durationFromCurrentValue && durationTillCurrentValue) {
                durationSelected = durationFromCurrentValue + ' - ' + durationTillCurrentValue + ' ' + snthWpJsObj.searchForm.nights;
            }
        }


        var datesDurationSummary = $('#dates-'+$type+'duration_summary');

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

        ittourShowFilterSummary();
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

        ittourShowFilterSummary();
    });

    $(document.body).on('change', '#tour_kind_select input[type=\'radio\']', function() {
        ittourShowFilterSummary();
    });

    $(document.body).on('change', '#meal_type_select input[type=\'checkbox\']', function() {
        ittourShowFilterSummary();
    });

    $(document.body).on('blur', '#price_limit_from, #price_limit_till', function() {
        ittourShowFilterSummary();
    });

    function ittourShowFilterSummary() {
        var filterSummary = $('#filter_summary');

        var typeSelected = $('#tour_type_select input[type=\'radio\']:checked').val();
        var kindSelected = $('#tour_kind_select input[type=\'radio\']:checked').val();
        var priceSelected = $('#price_limit_select input[type=\'radio\']:checked').val();

        var mealSelected = $('#meal_type_select input[type=\'checkbox\']:checked');

        var filterSummaryText = '';

        // Transport
        if ('2' === typeSelected) {
            filterSummaryText += $('#tour_type_select input[type=\'radio\']:checked + label').text();
        } else if ('1' === typeSelected) {
            if ('' === kindSelected) {
                filterSummaryText += $('#tour_type_select input[type=\'radio\']:checked + label').text();
            } else {
                filterSummaryText += $('#tour_kind_select input[type=\'radio\']:checked + label').text();
            }
        }

        // Meal type
        var mealSelectedArray = [];

        if (mealSelected.length > 0) {
            mealSelected.each(function() {
                mealSelectedArray.push($(this).data('short'));
            });

            if (mealSelectedArray.length > 0) {
                if ('' !== filterSummaryText) {
                    filterSummaryText += ', ';
                }

                filterSummaryText += mealSelectedArray.join(', ');
            }
        }

        // Price limit
        if ('' !== priceSelected && 'custom' !== priceSelected) {
            if ('' !== filterSummaryText) {
                filterSummaryText += ', ';
            }

            filterSummaryText += $('#price_limit_select input[type=\'radio\']:checked + label').text();
        } else if ('custom' === priceSelected) {
            var price_from = $('input#price_limit_from').val();
            var price_till = $('input#price_limit_till').val();

            if ('' !== price_from && '' !== price_till) {
                if ('' !== filterSummaryText) {
                    filterSummaryText += ', ';
                }

                filterSummaryText += price_from + ' - ' + price_till + ' ' + $('input#price_limit_from').data('currency');
            } else if ('' !== price_from) {
                if ('' !== filterSummaryText) {
                    filterSummaryText += ', ';
                }

                filterSummaryText += $('input#price_limit_from').data('label') + ' ' + price_from + ' ' + $('input#price_limit_from').data('currency');
            } else if ('' !== price_till) {
                if ('' !== filterSummaryText) {
                    filterSummaryText += ', ';
                }

                filterSummaryText += $('input#price_limit_till').data('label') + ' ' + price_till + ' ' + $('input#price_limit_from').data('currency');
            }
        }

        filterSummary.val(filterSummaryText);
    }

    $(document.body).on('click', '.scroll-to-tab', function(e) {
        e.preventDefault();
        var btn = $(this);
        var scrollTo = btn.data('scroll-to');
        var scrollTab = btn.data('scroll-tab');

        console.log(scrollTo);
        console.log(scrollTab);

        $.smoothScroll({
            scrollTarget: scrollTo,
            offset: -60
        });

        $(scrollTab).trigger( "click" );
    });


    $(document).ready(function() {
        var staticForm = $('#search-form');

        if (staticForm.length > 0) {
            $( document.body ).trigger('search_form_loaded');
        } else {
            ittourLoadSearchForm();
        }
    });

    $(window).on('load', function () {});

    $(window).on('scroll', function() {});

    $(window).on('resize', function(e) {});

    function ittourLoadSearchForm() {
        // return true;
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
        var mealType        = searchFormHolder.data('meal-type');

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
                tourKind: tourKind,
                mealType: mealType
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

                        updateFragments(fragments);
                        $( document.body ).trigger('search_form_loaded');

                    } else {
                        alert(decoded.message);
                    }
                } else {
                    alert('Something went wrong');
                }
            }
        });
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