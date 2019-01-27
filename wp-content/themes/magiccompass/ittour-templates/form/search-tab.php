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
<div class="search-form__holder">
    <form id="search-form" action="/search-results/" method="get" class="search-form repeater">
        <div id="search-form-main__holder">
            <div class="row">
                <div class="col-md-3">
                    <label for="destination_summary"><?php echo __('Destination', 'snthwp') ?>:</label>
                    <input id="destination_summary" type="text" class="form-control form-data-toggle-control" data-form_toggle_target="destination-select_section" value="" readonly>
                </div>
                <div class="col-md-3">
                    <label for="dates-duration_summary"><?php echo __('Dates / Duration / Departure', 'snthwp') ?>:</label>
                    <input id="dates-duration_summary" type="text" class="form-control form-data-toggle-control" data-form_toggle_target="dates-select_section" value="" readonly>
                </div>
                <div class="col-md-3">
                    <label for="guests_summary"><?php echo __('Guests', 'snthwp') ?>:</label>
                    <input id="guests_summary" type="text" class="form-control form-data-toggle-control" data-form_toggle_target="guests-select_section" value="" readonly>
                </div>
                <div class="col-md-1">
                    <label for="destination_summary"><?php echo __('Filter', 'snthwp') ?>:</label>

                    <div id="filter_options" class="form-data-summary form-data-toggle-control" data-form_toggle_target="filter-select__section">
                        <i class="fas fa-angle-double-down"></i>
                    </div>
                </div>
                <div class="col-md-2">
                    <button class="btn_1 green" type="submit"><i class="icon-search"></i><?php echo __('Search', 'snthwp') ?></button>
                </div>
            </div>
        </div>

        <div id="search-form-toggle__holder">
            <div id="destination-select_section" class="form-data-toggle-target">
                <div class="row">
                    <div class="col-md-3">
                        <p><?php echo __('Select destination', 'snthwp') ?></p>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="country_select"><?php echo __('Country', 'snthwp') ?>:</label>

                            <?php echo $form_fields['countries']; ?>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="region_select"><?php echo __('Region', 'snthwp') ?>:</label>

                            <?php echo $form_fields['regions']; ?>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="hotel_select"><?php echo __('Hotel', 'snthwp') ?>:</label>

                            <select id="hotel_select" name="hotel" class="form-control" data-current_value="">
                                <option value=""><?php echo __('Select country first', 'snthwp'); ?></option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div id="dates-select_section" class="form-data-toggle-target">
                <div class="row">
                    <div class="col-md-3">
                        <p><?php echo __('Select dates of start tour, duration', 'snthwp') ?></p>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label><i class="far fa-calendar-alt"></i> <?php echo __('Dates of start tour', 'snthwp') ?></label>
                            <input id="date-pick__select" class="date-pick form-control" name="date" type="text" data-current_value="">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="duration-holder">
                            <label><?php echo __('Duration', 'snthwp') ?></label>
                            <div class="form-group">
                                <div class="numbers-alt numbers-ver" style="display: inline-block">
                                    <input type="number" value="7" id="duration-from__select" class="qty2 form-control" name="night_from" data-current_value="7">
                                </div>
                                -
                                <div class="numbers-alt numbers-ver" style="display: inline-block">
                                    <input type="number" value="9" id="duration-till__select" class="qty2 form-control" name="night_till" data-current_value="9">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3"></div>
                </div>
            </div>

            <div id="guests-select_section" class="form-data-toggle-target">
                <div class="row">
                    <div class="col-md-3">
                        <p><?php echo __('Select adults, and childrens', 'snthwp') ?></p>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label><?php echo __('Adult amount', 'snthwp') ?></label>

                            <div class="numbers-alt numbers-gor">
                                <input type="number" value="1" id="adult_amount" data-min="1" data-max="4" class="qty2 form-control" name="adult_amount">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group child_amount_holder">
                            <label><?php echo __('Children amount', 'snthwp') ?></label>
                            <div id="child_amount_repeater_holder" data-limit="3">
                                <div class="child_amount_group"></div>

                                <button class="btn-create" type="button">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">

                    </div>
                </div>
            </div>

            <div id="filter-select__section" class="form-data-toggle-target">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="hotel_rating"><?php echo __('Hotel Rating', 'snthwp') ?>:</label>

                            <?php echo $form_fields['hotel_ratings']; ?>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="hotel_rating"><?php echo __('Transport Type', 'snthwp') ?>:</label>

                            <?php echo $form_fields['transport_types']; ?>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <p><?php echo __('Select adults, and childrens', 'snthwp') ?></p>
                    </div>

                    <div class="col-md-3">
                        <p><?php echo __('Select adults, and childrens', 'snthwp') ?></p>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>