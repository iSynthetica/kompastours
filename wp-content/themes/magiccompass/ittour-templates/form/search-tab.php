<?php
/**
 * Created by PhpStorm.
 * User: snth
 * Date: 20.09.18
 * Time: 18:52
 */

// var_dump(ittour_get_countries_list());

if (empty($args)) {
    $args = array();
}

$form_fields = ittour_get_form_fields($args);
$from_cities_array = get_option('ittour_from_cities');

if ( !is_array( $form_fields ) ) {
    return;
}

$search_steps = get_field('timeline_items', 493);
?>
<div class="search-form__holder">
    <form id="search-form" action="/search/" method="get" class="search-form repeater">
        <div id="search-form-main__holder">
            <div id="select-from-city__holder">
                <select class="form-control" name="from_city" id="from_city">
                    <?php
                    foreach ($from_cities_array as $id => $city) {
                        ?>
                        <option value="<?php echo $id; ?>"<?php echo $id == 2014 ? ' selected' : ''; ?>><?php echo $city['name']; ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>

            <div class="row">
                <div class="col-md-12 col-lg-9">
                    <div class="row search-summary__row">
                        <div id="destination_summary__col" class="col-md-4 search-summary__col">
                            <?php echo $form_fields['destination_summary']; ?>
                        </div>

                        <div id="dates-duration_summary__col" class="col-6 col-md-4 search-summary__col">
                            <?php echo $form_fields['dates_summary']; ?>
                        </div>

                        <div id="guests_summary__col" class="col-6 col-md-4 search-summary__col">
                            <?php echo $form_fields['guests_summary']; ?>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="row">
                        <div class="col-12">
                            <div class="search-btn__holder">
                                <button id="filter_options" type="button" class="btn form-data-summary form-data-toggle-control" data-form_toggle_target="filter-select__section"<?php echo empty($args['country']) ? ' disabled' : ''; ?>>
                                    <i class="fas fa-sliders-h"></i>
                                </button>

                                <button id="start_search" class="search-btn btn_1 green" type="submit"<?php echo empty($args['country']) ? ' disabled' : ''; ?>><i class="fas fa-search-location"></i><?php echo __('Search', 'snthwp') ?></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="search-form-toggle__holder">
            <div id="destination-select_section" class="form-data-toggle-target">
                <div class="row">
                    <div class="col-md-12 col-lg-3">
                        <div class="search-form-step__section">
                            <div class="search-form-step__header">
                                <?php
                                $step_index = 0;
                                if (!empty($search_steps[$step_index])) {
                                    if (!empty($search_steps[$step_index]["steps"]["icon"])) {
                                        ?><i class="cbp_tmicon <?php echo $search_steps[$step_index]["steps"]["icon"] ?>"></i><?php
                                    }

                                    if (!empty($search_steps[$step_index]["steps"]["title"])) {
                                        ?><h3><?php echo $search_steps[$step_index]["steps"]["title"] ?></h3><?php
                                    }

                                    if (!empty($search_steps[$step_index]["content"]["title"])) {
                                        ?><h4><?php echo $search_steps[$step_index]["content"]["title"] ?></h4><?php
                                    }
                                } else {
                                    ?><h3><?php echo __('Select destination', 'snthwp') ?></h3><?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-lg-3">
                        <div class="form-group">
                            <label for="country_select"><?php echo __('Country', 'snthwp') ?>*:</label>

                            <?php echo $form_fields['countries']; ?>
                        </div>
                    </div>

                    <div class="col-md-4 col-lg-3">
                        <div class="form-group">
                            <label for="region_select"><?php echo __('Region', 'snthwp') ?>:</label>

                            <?php echo $form_fields['regions']; ?>
                        </div>
                    </div>

                    <div class="col-md-4 col-lg-3">
                        <div class="form-group">
                            <label for="hotel_select"><?php echo __('Hotel', 'snthwp') ?>:</label>

                            <?php echo $form_fields['hotels']; ?>
                        </div>

                        <div class="form-group">
                            <label for="hotel_rating"><?php echo __('or Hotel Rating', 'snthwp') ?>:</label>

                            <?php echo $form_fields['hotel_ratings']; ?>
                        </div>
                    </div>
                </div>
            </div>

            <div id="dates-select_section" class="form-data-toggle-target">
                <div class="row">
                    <div class="col-md-3">
                        <div class="search-form-step__section">
                            <div class="search-form-step__header">
                                <?php
                                $step_index = 1;
                                if (!empty($search_steps[$step_index])) {
                                    if (!empty($search_steps[$step_index]["steps"]["icon"])) {
                                        ?><i class="cbp_tmicon <?php echo $search_steps[$step_index]["steps"]["icon"] ?>"></i><?php
                                    }

                                    if (!empty($search_steps[$step_index]["steps"]["title"])) {
                                        ?><h3><?php echo $search_steps[$step_index]["steps"]["title"] ?></h3><?php
                                    }

                                    if (!empty($search_steps[$step_index]["content"]["title"])) {
                                        ?><h4><?php echo $search_steps[$step_index]["content"]["title"] ?></h4><?php
                                    }
                                } else {
                                    ?><h3><?php echo __('Select dates of start tour, duration', 'snthwp') ?></h3><?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <?php
                        $dates_data = '';
                        if (!empty($args['dateFrom']) && !empty($args['dateTill'])) {
                            $dates_data = ' data-date-from="'.$args['dateFrom'].'" data-date-till="'.$args['dateTill'].'"';
                        }
                        ?>
                        <div class="form-group">
                            <label><?php echo __('Dates of start tour', 'snthwp') ?></label>
                            <input id="date-pick__select" class="date-pick form-control" name="date" type="text" data-current_value=""<?php echo $dates_data; ?>>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="duration-holder">
                            <?php
                            $night_from = '7';
                            $night_till = '9';

                            if (!empty($args['nightFrom']) &&!empty($args['nightTill'])) {
                                $night_from = $args['nightFrom'];
                                $night_till = $args['nightTill'];
                            }
                            ?>
                            <label><?php echo __('Duration', 'snthwp') ?> (<?php echo __('nights', 'snthwp') ?>)</label>
                            <div class="form-group">
                                <div class="numbers-alt numbers-ver" style="display: inline-block">
                                    <input type="number" value="<?php echo $night_from ?>" id="duration-from__select" class="qty2 form-control" name="night_from" data-current_value="<?php echo $night_from ?>">
                                </div>
                                -
                                <div class="numbers-alt numbers-ver" style="display: inline-block">
                                    <input type="number" value="<?php echo $night_till ?>" id="duration-till__select" class="qty2 form-control" name="night_till" data-current_value="<?php echo $night_till ?>">
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
                        <div class="search-form-step__section">
                            <div class="search-form-step__header">
                                <?php
                                $step_index = 2;
                                if (!empty($search_steps[$step_index])) {
                                    if (!empty($search_steps[$step_index]["steps"]["icon"])) {
                                        ?><i class="cbp_tmicon <?php echo $search_steps[$step_index]["steps"]["icon"] ?>"></i><?php
                                    }

                                    if (!empty($search_steps[$step_index]["steps"]["title"])) {
                                        ?><h3><?php echo $search_steps[$step_index]["steps"]["title"] ?></h3><?php
                                    }

                                    if (!empty($search_steps[$step_index]["content"]["title"])) {
                                        ?><h4><?php echo $search_steps[$step_index]["content"]["title"] ?></h4><?php
                                    }
                                } else {
                                    ?><h3><?php echo __('Select adults, and childrens', 'snthwp') ?></h3><?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <?php
                            $adult_amount = '2';

                            if (!empty($args['adultAmount'])) {
                                $adult_amount = $args['adultAmount'];
                            }
                            ?>
                            <label><?php echo __('Adult amount', 'snthwp') ?></label>

                            <div class="numbers-alt numbers-gor">
                                <input type="number" value="<?php echo $adult_amount ?>" id="adult_amount" data-min="1" data-max="4" class="qty2 form-control" name="adult_amount">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group child_amount_holder">
                            <label><?php echo __('Children amount', 'snthwp') ?></label>

                            <div id="child_amount_repeater_holder" data-limit="3">
                                <div class="child_amount_group">
                                    <?php
                                    if (!empty($args['childAmount']) && !empty($args['childAge'])) {
                                        $child_ages = explode(':', $args['childAge']);

                                        foreach ($child_ages as $child_age) {
                                            ittour_show_template('form/search-select-child-amount.php', array('child_age' => (int)$child_age));
                                        }
                                    }
                                    ?>
                                </div>

                                <button class="btn-create" type="button">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="filter-select__section" class="form-data-toggle-target">
                <div class="row">
                    <div class="col-md-3">
                        <div class="search-form-step__section">
                            <div class="search-form-step__header">
                                <?php
                                $step_index = 3;
                                if (!empty($search_steps[$step_index])) {
                                    if (!empty($search_steps[$step_index]["steps"]["icon"])) {
                                        ?><i class="cbp_tmicon <?php echo $search_steps[$step_index]["steps"]["icon"] ?>"></i><?php
                                    }

                                    if (!empty($search_steps[$step_index]["steps"]["title"])) {
                                        ?><h3><?php echo $search_steps[$step_index]["steps"]["title"] ?></h3><?php
                                    }

                                    if (!empty($search_steps[$step_index]["content"]["title"])) {
                                        ?><h4><?php echo $search_steps[$step_index]["content"]["title"] ?></h4><?php
                                    }
                                } else {
                                    ?><h3><?php echo __('Select destination', 'snthwp') ?></h3><?php
                                }
                                ?>
                            </div>
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