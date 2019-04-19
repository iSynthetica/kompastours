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
                ittourTransport: ittourTransport
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

    $(document).ready(function() {

    });

    $(window).on('load', function () {

    });

    $(window).on('scroll', function() {

    });

    $(window).on('resize', function(e) {

    });

}(jQuery));