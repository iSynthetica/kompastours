<?php
/**
 * This file handles the admin area and functions
 *
 * @package Magiccompass/Includes
 * @version 0.0.1
 * @since 0.0.1
 */

if (empty($args)) {
    $args = array();
}

$search_disabled = empty($args['country']);

$form_fields = ittour_get_form_fields($args);

if ( !is_array( $form_fields ) ) {
    return;
}

$search_steps = get_field('timeline_items', 493);
?>
<div class="search-form__holder">
    <form id="search-form" action="/search/" method="get" class="search-form repeater">
        <div id="search-form-main__holder">
            <div id="select-from-city__holder">
                <?php echo $form_fields['select_from_city']; ?>
            </div>

            <div class="row">
                <div class="col-md-12 col-lg-9">
                    <div class="row search-summary__row">
                        <div id="from_city_summary__col" class="col search-summary__col d-block d-md-none">
                            <?php echo $form_fields['from_city_summary']; ?>

                            <div class="search-form-toggle__holder">
                                <div id="from-city-select_section" class="form-data-toggle-target">
                                    <div class="form-data-toggle-body bg-gray-5-color p-10 scroll-on-show">
                                        <div class="search-form-step__section">
                                            <div class="search-form-step__header">
                                                <?php
                                                $step_index = 0;
                                                if (!empty($search_steps[$step_index])) {
                                                    if (!empty($search_steps[$step_index]["content"]["title"])) {
                                                        ?><h4><?php echo $search_steps[$step_index]["content"]["title"] ?></h4><?php
                                                    }
                                                } else {
                                                    ?><h4><?php echo __('Select destination', 'snthwp') ?></h4><?php
                                                }
                                                ?>
                                            </div>

                                            <?php echo $form_fields['list_from_city']; ?>
                                        </div>
                                    </div>

                                    <?php
                                    ittour_show_toggle_mobile_header_footer(
                                        'from-city-select_section',
                                        false,
                                        array('label' => __('Destination', 'snthwp'), 'container' => 'destination-select_section', 'disabled' => false),
                                        $search_disabled
                                    )
                                    ?>
                                </div>
                            </div>
                        </div>

                        <div id="destination_summary__col" class="col-md-4 search-summary__col">
                            <?php echo $form_fields['destination_summary']; ?>

                            <div class="search-form-toggle__holder">
                                <div id="destination-select_section" class="form-data-toggle-target">
                                    <div class="form-data-toggle-body bg-gray-5-color p-10 scroll-on-show">
                                        <div class="search-form-step__section">
                                            <div class="search-form-step__header">
                                                <?php
                                                $step_index = 0;
                                                if (!empty($search_steps[$step_index])) {
                                                    if (!empty($search_steps[$step_index]["content"]["title"])) {
                                                        ?><h4><?php echo $search_steps[$step_index]["content"]["title"] ?></h4><?php
                                                    }
                                                } else {
                                                    ?><h4><?php echo __('Select destination', 'snthwp') ?></h4><?php
                                                }
                                                ?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="country_select"><?php echo __('Country', 'snthwp') ?>*:</label>

                                            <?php echo $form_fields['countries']; ?>
                                        </div>

                                        <div class="form-group">
                                            <label for="region_select"><?php echo __('Region', 'snthwp') ?>:</label>

                                            <?php echo $form_fields['regions']; ?>
                                        </div>

                                        <div class="form-group">
                                            <label for="hotel_select"><?php echo __('Hotel', 'snthwp') ?>:</label>

                                            <?php echo $form_fields['hotels']; ?>
                                        </div>

                                        <div class="form-group">
                                            <label for="hotel_rating"><?php echo __('or Hotel Rating', 'snthwp') ?>:</label>

                                            <?php echo $form_fields['hotel_ratings']; ?>
                                        </div>
                                    </div>

                                    <?php
                                    ittour_show_toggle_mobile_header_footer(
                                        'destination-select_section',
                                        array('label' => __('Departure from', 'snthwp'), 'container' => 'from-city-select_section', 'disabled' => false),
                                        array('label' => __('Dates', 'snthwp'), 'container' => 'dates-select_section', 'disabled' => $search_disabled),
                                        $search_disabled
                                    )
                                    ?>
                                </div>
                            </div>
                        </div>

                        <div id="dates-duration_summary__col" class="col-md-4 search-summary__col">
                            <?php echo $form_fields['dates_summary']; ?>

                            <div class="search-form-toggle__holder">
                                <div id="dates-select_section" class="form-data-toggle-target">
                                    <div class="form-data-toggle-body bg-gray-5-color p-10 scroll-on-show">
                                        <div class="search-form-step__section">
                                            <div class="search-form-step__header">
                                                <?php
                                                $step_index = 1;
                                                if (!empty($search_steps[$step_index])) {
                                                    if (!empty($search_steps[$step_index]["content"]["title"])) {
                                                        ?><h4><?php echo $search_steps[$step_index]["content"]["title"] ?></h4><?php
                                                    }
                                                } else {
                                                    ?><h4><?php echo __('Select dates of start tour, duration', 'snthwp') ?></h4><?php
                                                }
                                                ?>
                                            </div>
                                        </div>

                                        <?php
                                        $dates_data = '';
                                        if (!empty($args['dateFrom']) && !empty($args['dateTill'])) {
                                            $dates_data = ' data-date-from="'.$args['dateFrom'].'" data-date-till="'.$args['dateTill'].'"';
                                        }
                                        ?>

                                        <div class="form-group">
                                            <label><?php echo __('Dates of start tour', 'snthwp') ?></label>
                                            <input id="date-pick__select" class="date-pick form-control" name="date" type="text" data-current_value=""<?php echo $dates_data; ?> readonly="readonly">

                                            <div class="date-pick__select__container"></div>
                                        </div>

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
                                                <div class="numbers-alt numbers-gor style_1" style="display: inline-block">
                                                    <input
                                                            type="number"
                                                            value="<?php echo $night_from ?>"
                                                            id="duration-from__select"
                                                            class="qty2 form-control"
                                                            name="night_from"
                                                            data-current_value="<?php echo $night_from ?>"
                                                            readonly="readonly"
                                                    >
                                                </div>
                                                <span class="d-inline-block mrl-10">-</span>
                                                <div class="numbers-alt numbers-gor style_1" style="display: inline-block">
                                                    <input
                                                            type="number"
                                                            value="<?php echo $night_till ?>"
                                                            id="duration-till__select"
                                                            class="qty2 form-control"
                                                            name="night_till"
                                                            data-current_value="<?php echo $night_till ?>"
                                                            readonly="readonly"
                                                    >
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <?php
                                    ittour_show_toggle_mobile_header_footer(
                                        'dates-select_section',
                                        array('label' => __('Destination', 'snthwp'), 'container' => 'destination-select_section', 'disabled' => false),
                                        array('label' => __('Guests', 'snthwp'), 'container' => 'guests-select_section', 'disabled' => $search_disabled),
                                        $search_disabled
                                    )
                                    ?>
                                </div>
                            </div>
                        </div>

                        <div id="guests_summary__col" class="col-md-4 search-summary__col">
                            <?php echo $form_fields['guests_summary']; ?>

                            <div class="search-form-toggle__holder">
                                <div id="guests-select_section" class="form-data-toggle-target">
                                    <div class="form-data-toggle-body bg-gray-5-color p-10 scroll-on-show">
                                        <div class="search-form-step__section">
                                            <div class="search-form-step__header">
                                                <?php
                                                $step_index = 2;
                                                if (!empty($search_steps[$step_index])) {
                                                    if (!empty($search_steps[$step_index]["content"]["title"])) {
                                                        ?><h4><?php echo $search_steps[$step_index]["content"]["title"] ?></h4><?php
                                                    }
                                                } else {
                                                    ?><h4><?php echo __('Select adults, and childrens', 'snthwp') ?></h4><?php
                                                }
                                                ?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <?php
                                            $adult_amount = '2';

                                            if (!empty($args['adultAmount'])) {
                                                $adult_amount = $args['adultAmount'];
                                            }
                                            ?>
                                            <label><?php echo __('Adult amount', 'snthwp') ?></label>

                                            <div class="numbers-alt numbers-gor style_1">
                                                <input type="number" value="<?php echo $adult_amount ?>" id="adult_amount" data-min="1" data-max="4" class="qty2 form-control" name="adult_amount">
                                            </div>
                                        </div>

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

                                    <?php
                                    ittour_show_toggle_mobile_header_footer(
                                        'guests-select_section',
                                        array('label' => __('Dates', 'snthwp'), 'container' => 'dates-select_section', 'disabled' => $search_disabled),
                                        array('label' => __('Filter', 'snthwp'), 'container' => 'filter-select__section', 'disabled' => $search_disabled),
                                        $search_disabled
                                    )
                                    ?>
                            </div>
                            </div>
                        </div>

                        <div id="filter_summary__col" class="col-12 search-summary__col">
                            <div class="d-block d-md-none">
                                <?php echo $form_fields['filter_summary']; ?>
                            </div>

                            <div class="d-none d-md-block">
                                <button id="filter_options" type="button" class="btn form-data-summary form-data-toggle-control" data-form_toggle_target="filter-select__section"<?php echo empty($args['country']) ? ' disabled' : ''; ?>>
                                    <i class="fas fa-sliders-h"></i>
                                </button>
                            </div>

                            <div class="search-form-toggle__holder">
                                <div id="filter-select__section" class="form-data-toggle-target">
                                    <div class="form-data-toggle-body bg-gray-5-color p-10 scroll-on-show">
                                        <div class="search-form-step__section">
                                            <div class="search-form-step__header">
                                                <?php
                                                $step_index = 3;
                                                if (!empty($search_steps[$step_index])) {
                                                    if (!empty($search_steps[$step_index]["content"]["title"])) {
                                                        ?><h4><?php echo $search_steps[$step_index]["content"]["title"] ?></h4><?php
                                                    }
                                                } else {
                                                    ?><h4><?php echo __('Select destination', 'snthwp') ?></h4><?php
                                                }
                                                ?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <?php echo $form_fields['transport_types']; ?>
                                        </div>

                                        <div class="form-group">
                                            <?php echo $form_fields['meal_types']; ?>
                                        </div>

                                        <?php echo $form_fields['price_limit']; ?>
                                    </div>

                                    <?php
                                    ittour_show_toggle_mobile_header_footer(
                                        'filter-select__section',
                                        array('label' => __('Guests', 'snthwp'), 'container' => 'guests-select_section', 'disabled' => $search_disabled),
                                        false,
                                        $search_disabled
                                    )
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="row">
                        <div class="col-12">
                            <div class="search-btn__holder">
                                <button
                                    id="start_search"
                                    class="btn shape-rnd bg-primary-color search-btn font-alt font-weight-900"
                                    type="submit"<?php echo empty($args['country']) ? ' disabled' : ''; ?>
                                >
                                    <?php echo __('Search', 'snthwp') ?>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

<!--    <div>-->
<!--        <button class="modal-popup btn size-xs shape-rnd" href="#find-me-tour-popup">-->
<!--            --><?php //echo __('Find me a tour', 'snthwp'); ?>
<!--        </button>-->
<!--    </div>-->
</div>

<?php // ittour_show_template('general/form-find-me-tour.php', array('form_fields' => $form_fields)); ?>