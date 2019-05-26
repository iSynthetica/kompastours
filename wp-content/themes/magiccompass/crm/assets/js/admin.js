(function ($) {

    $(document.body).on('click', '.updateCRMTable', function() {
        var container = $(this).parents('.fragment-holder');
        var table = $(this).data('table');
        var operation = $(this).data('operation');

        $.ajax({
            url: ajaxurl,
            method: 'post',
            data: {
                action: 'crm_ajax_update_table',
                table: table,
                operation: operation,
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