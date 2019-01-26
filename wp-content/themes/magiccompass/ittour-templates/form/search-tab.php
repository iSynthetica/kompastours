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
                    <label for="destination_summary"><?php echo __('Guests', 'snthwp') ?>:</label>
                    <input type="text" class="form-control form-data-toggle-control" data-form_toggle_target="guests-select_section" value="" readonly>
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
                            <label><?php echo __('Child amount', 'snthwp') ?></label>
                            <div class="repeater-holder">
                                <div data-repeater-list="child_amount_group" class="child_amount_group">
                                    <div data-repeater-item class="child_amount_item" data-limit="4" style="display:none;margin-right:10px;float:left">
                                        <select name="child_amount" class="form-control" >
                                            <option value="1"><?php _e('1 year', 'snthwp') ?></option>
                                            <option value="2"><?php _e('2 years', 'snthwp') ?></option>
                                            <option value="3"><?php _e('3 years', 'snthwp') ?></option>
                                            <option value="4"><?php _e('4 years', 'snthwp') ?></option>
                                            <option value="5"><?php _e('5 years', 'snthwp') ?></option>
                                            <option value="6"><?php _e('6 years', 'snthwp') ?></option>
                                            <option value="7"><?php _e('7 years', 'snthwp') ?></option>
                                            <option value="8"><?php _e('8 years', 'snthwp') ?></option>
                                            <option value="9"><?php _e('9 years', 'snthwp') ?></option>
                                            <option value="10"><?php _e('10 years', 'snthwp') ?></option>
                                            <option value="11"><?php _e('11 years', 'snthwp') ?></option>
                                            <option value="12"><?php _e('12 years', 'snthwp') ?></option>
                                            <option value="13"><?php _e('13 years', 'snthwp') ?></option>
                                            <option value="14"><?php _e('14 years', 'snthwp') ?></option>
                                            <option value="15"><?php _e('15 years', 'snthwp') ?></option>
                                            <option value="16"><?php _e('16 years', 'snthwp') ?></option>
                                            <option value="17"><?php _e('17 years', 'snthwp') ?></option>
                                        </select>

                                        <button class="btn-delete" data-repeater-delete type="button">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>

                                <button class="btn-create" data-repeater-create type="button">
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

            </div>
        </div>
    </form>
</div>