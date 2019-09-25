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

    $(document.body).on('click', '#start-working', function() {
        var btn = $(this);
        var claimId = btn.data('claim-id');
        var userId = btn.data('user-id');

        $.ajax({
            url: ajaxurl,
            method: 'post',
            data: {
                action: 'crm_ajax_start_claim',
                claimId: claimId,
                userId: userId,
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
                    } else {
                        alert(decoded.message);
                    }
                } else {
                    alert('Something went wrong');
                }
            }
        });
    });

    $(document.body).on('click', '#download_csv', function() {
        var btn = $(this);
        var onlyMail = btn.data('only-mail');
        var tagId = btn.data('tag-id');

        $.ajax({
            url: ajaxurl,
            method: 'post',
            data: {
                action: 'crm_ajax_moi_turisty_download_csv',
                onlyMail: onlyMail,
                tagId: tagId,
            },
            success: function (response) {
                // var decoded;
                //
                // try {
                //     decoded = $.parseJSON(response);
                // } catch(err) {
                //     console.log(err);
                //     decoded = false;
                // }
                //
                // if (decoded) {
                //     if (decoded.success) {
                //         // alert(decoded.message);
                //         // var fragments = decoded.message.fragments;
                //         // updateFragments(fragments);
                //     } else {
                //         alert(decoded.message);
                //     }
                // } else {
                //     alert('Something went wrong');
                // }
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

    /**
     *
     * @param e
     * @param fragments
     */
    function updateFragments( fragments ) {
        if ( fragments ) {
            $.each( fragments, function( key, value ) {
                $( key ).replaceWith( value );
            });
        }
    }

}(jQuery));