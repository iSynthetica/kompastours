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
    <form action="/search-results/" method="get" class="search-form repeater">
        <h3>Search Tours in Paris</h3>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="destination_summary"><?php echo __('Destination', 'snthwp') ?>:</label>
                    <div id="destination_summary" class="form-control"></div>
                </div>

                <div class="form-group">
                    <label for="country_select"><?php echo __('Country', 'snthwp') ?>:</label>
                    <?php echo $form_fields['countries']; ?>
                </div>

                <div class="form-group">
                    <label for="region_select"><?php echo __('Region', 'snthwp') ?>:</label>
                    <?php echo $form_fields['regions']; ?>
                </div>

                <div class="form-group">
                    <label for="hotel_select"><?php echo __('Hotel', 'snthwp') ?>:</label>

                    <select id="hotel_select" name="hotel" class="form-control">
                        <option value=""><?php echo __('Select country first', 'snthwp'); ?></option>
                    </select>
                </div>
            </div>

            <div class="col-md-4">
                <div class="dates-holder">
                    <div class="form-group">
                        <label><i class="far fa-calendar-alt"></i> <?php echo __('Dates of start tour', 'snthwp') ?></label>
                        <input class="date-pick form-control" name="date" type="text">
                    </div>

                    <div class="duration-holder">
                        <label><?php echo __('Duration from', 'snthwp') ?></label>
                        <div class="form-group">
                            <div class="numbers-alt numbers-ver" style="display: inline-block">
                                <input type="number" value="1" id="adult_amount" class="qty2 form-control" name="night_from">
                            </div>
                            -
                            <div class="numbers-alt numbers-ver" style="display: inline-block">
                                <input type="number" value="1" id="child_amount" class="qty2 form-control" name="night_till">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">

            </div>
        </div>
        <!-- End row -->
        <div class="row">

            <div class="col-md-2 col-6">
                <div class="form-group">
                    <label><?php echo __('Adult amount', 'snthwp') ?></label>

                    <div class="numbers-alt numbers-gor">
                        <input type="number" value="1" id="adult_amount" data-min="1" data-max="4" class="qty2 form-control" name="adult_amount">
                    </div>
                </div>
            </div>

            <div class="col-6 col-md-8">
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

        </div>
        <!-- End row -->

        <div class="row">
        </div>
        <hr>
        <button class="btn_1 green" type="submit"><i class="icon-search"></i>Search now</button>
    </form>
</div>