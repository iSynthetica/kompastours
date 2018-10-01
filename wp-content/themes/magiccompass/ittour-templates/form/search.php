<?php
/**
 * Created by PhpStorm.
 * User: snth
 * Date: 20.09.18
 * Time: 18:52
 */

// var_dump(ittour_get_countries_list());

$form_fields = ittour_get_form_fields();

if ( !is_array( $form_fields ) ) {
    return;
}
?>
<div class="search-form__container">
    <div class="search-form__inner">
        <form action="/search-results/" method="get" class="search-form">
            <p class="form-group">
                <label for="country"><b><?php echo __('Country', 'snthwp') ?>:</b></label>
                <?php echo $form_fields['countries']; ?>
            </p>

            <p>
                <label for="email"><b><?php echo __('Adults', 'snthwp') ?>:</b></label>
                <?php echo $form_fields['adult_amount']; ?>
            </p>

            <p>
                <button type="submit" class="search-form__btn btn btn-primary mt-3">Search</button>
            </p>
        </form>
    </div>
</div>
