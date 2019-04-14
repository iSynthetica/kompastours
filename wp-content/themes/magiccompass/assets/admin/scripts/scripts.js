(function ($) {

    $(document.body).on('click', '.ittour-add-country', function() {
        var button = $(this);
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