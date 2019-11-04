(function ($) {

    $(document.body).on('click', '.ittour-add-hotel', function() {
        var button = $(this);
        var postId = button.data('post-id');
        var parentId = button.data('parent-id');
        var ittourId = button.data('ittour-id');
        var ittourName = button.data('ittour-name');
        var ittourRating = button.data('ittour-rating');
        var ittourSlug = button.data('ittour-slug');
        var ittourCountryId = button.data('ittour-country-id');
        var ittourRegionId = button.data('ittour-region-id');
        var ittourType = button.data('ittour-type');

        $.ajax({
            url: ajaxurl,
            method: 'post',
            data: {
                action: 'ittour_ajax_admin_add_hotel',
                postId: postId,
                parentId: parentId,
                ittourId: ittourId,
                ittourName: ittourName,
                ittourRating: ittourRating,
                ittourSlug: ittourSlug,
                ittourCountryId: ittourCountryId,
                ittourRegionId: ittourRegionId,
                ittourType: ittourType
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
                        alert(decoded.message);
                    } else {
                        alert(decoded.message);
                    }
                } else {
                    alert('Something went wrong');
                }

            }
        });
    });

    $(document.body).on('click', '.ittour-add-region', function() {
        var button = $(this);
        var postId = button.data('post-id');
        var parentId = button.data('parent-id');
        var ittourId = button.data('ittour-id');
        var ittourName = button.data('ittour-name');
        var ittourCountryId = button.data('ittour-country-id');
        var ittourSlug = button.data('ittour-slug');
        var ittourType = button.data('ittour-type');

        $.ajax({
            url: ajaxurl,
            method: 'post',
            data: {
                action: 'ittour_ajax_admin_add_region',
                postId: postId,
                parentId: parentId,
                ittourId: ittourId,
                ittourName: ittourName,
                ittourCountryId: ittourCountryId,
                ittourSlug: ittourSlug,
                ittourType: ittourType
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
                        alert(decoded.message);
                    } else {
                        alert(decoded.message);
                    }
                } else {
                    alert('Something went wrong');
                }

            }
        });
    });

    $(document.body).on('click', '.ittour-add-country', function() {
        var button = $(this);
        var postId = button.data('post-id');
        var ittourId = button.data('ittour-id');
        var ittourName = button.data('ittour-name');
        var ittourSlug = button.data('ittour-slug');
        var ittourIso = button.data('ittour-iso');
        var ittourGroup = button.data('ittour-group');
        var ittourType = button.data('ittour-type');
        var ittourTransport = button.data('ittour-transport');
        var ittourCurrency = $('#main_currency_' + ittourId).val();

        $.ajax({
            url: ajaxurl,
            method: 'post',
            data: {
                action: 'ittour_ajax_admin_add_country',
                postId: postId,
                ittourId: ittourId,
                ittourName: ittourName,
                ittourSlug: ittourSlug,
                ittourIso: ittourIso,
                ittourGroup: ittourGroup,
                ittourType: ittourType,
                ittourTransport: ittourTransport,
                ittourCurrency: ittourCurrency
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
                        alert(decoded.message);
                    } else {
                        alert(decoded.message);
                    }
                } else {
                    alert('Something went wrong');
                }

            }
        });
    });

    $(document.body).on('click', '.code-example-copy', function() {
        var control = $(this);
        var parent = control.parents('.code-example');
        var message = parent.find('.code-example-copied');
        var toCopy = parent.find('.code-example-value');

        var $temp = $("<input>");
        $("body").append($temp);
        $temp.val(toCopy.text()).select();
        document.execCommand("copy");
        $temp.remove();

        toCopy.addClass('copied');
        control.hide();
        message.show();

        setTimeout(function() {
            toCopy.removeClass('copied');
            control.show();
            message.hide();
        }, 2000);
    });

    $(document.body).on('change', '#add_parameter_country', function() {
        var val = $(this).val();
        var name = $(this).find('option:selected').text();
        var regionsByCountries = $.parseJSON($('#regions_by_countries_hidden').val());

        $('#param_country_label').text(name);

        var regionsHtml = '';

        var regions = regionsByCountries[parseInt(val)];
        regionsHtml += '<option value="">выберите регион</option>';

        for (var i = 0; i < regions.length; i++) {
            regionsHtml += '<option value="'+regions[i].id+'">'+regions[i].name+'</option>';
        }

        $('#add_parameter_region').empty().html(regionsHtml);

        generate_shortcode();
    });

    $(document.body).on('change', '#add_parameter_from_city', function() {
        var val = $(this).val();
        var name = $(this).find('option:selected').text();

        $('#param_from_city_label').text(name);

        generate_shortcode();
    });

    $(document.body).on('change', '#add_parameter_region', function() {
        var val = $(this).val();
        var name = $(this).find('option:selected').text();

        if (val) {
            $('#param_region_label').text(name);
            $('#param_region_description').css({display: 'inline-block'});
        } else {
            $('#param_region_label').text('');
            $('#param_region_description').css({display: 'none'});
        }

        generate_shortcode();
    });

    $(document.body).on('change', '.add_parameter_text', function() {
        var val = $(this).val();
        var parameter = $(this).data('parameter');

        if (val) {
            $('#param_'+parameter+'_label').text(val);
            $('#param_'+parameter+'_description').css({display: 'inline-block'});
        } else {
            $('#param_'+parameter+'_label').text('');
            $('#param_'+parameter+'_description').css({display: 'none'});
        }

        generate_shortcode();
    });

    function generate_shortcode() {
        var shortcodeHolder = $('#tours_grid_shortcode_holder .code-example-value');
        var country = $('#add_parameter_country').val();
        var from_city = $('#add_parameter_from_city').val();
        var region = $('#add_parameter_region').val();
        var night_from = $('#add_parameter_night_from').val();
        var night_till = $('#add_parameter_night_till').val();
        var date_from = $('#add_parameter_date_from').val();
        var date_till = $('#add_parameter_date_till').val();

        var shortcode = '[ittour_tours_grid';
        shortcode += ' country="' + country + '"';
        shortcode += ' from_city="' + from_city + '"';
        if (region) {
            shortcode += ' region="' + region + '"';
        }
        if (night_from) {
            shortcode += ' night_from="' + night_from + '"';
        }
        if (night_till) {
            shortcode += ' night_till="' + night_till + '"';
        }
        if (date_from) {
            shortcode += ' date_from="' + date_from + '"';
        }
        if (date_till) {
            shortcode += ' date_till="' + date_till + '"';
        }
        shortcode += ']';

        shortcodeHolder.text(shortcode);
    }

    $(document).ready(function() {

    });

    $(window).on('load', function () {

    });

    $(window).on('scroll', function() {

    });

    $(window).on('resize', function(e) {

    });

}(jQuery));