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
global $ittour_global_form_fields;

$form_fields = $ittour_global_form_fields;

if ( !is_array( $form_fields ) ) {
    return;
}
$search_disabled = empty($args['country']) || empty($form_fields['tour_params']['countries'][$args['country']]);
$search_excursion_disabled = empty($args['country_excursion']) || empty($form_fields['excursion_params']['selected_country']);
$request_uri = $_SERVER['REQUEST_URI'];
$form_active = 'tour-search-active';
if (false !== strpos($request_uri, 'excursion-search') || false !== strpos($request_uri, 'excursion-tour')) {
 $form_active = 'excursion-search-active';
}
$search_steps = get_field('timeline_items', 493);
?>
<div class="search-form__holder <?php echo $form_active; ?>">
    <form id="search-form" action="/search/" method="get" class="search-form search-tour-form repeater">
        <div class="search-form-main__holder">
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

                                        <!-- Dates settings - start -->
                                        <?php echo $form_fields['dates_holder']; ?>
                                        <!-- Dates settings - start -->

                                        <!-- Duration settings - start -->
                                        <?php echo $form_fields['duration_holder']; ?>
                                        <!-- Duration settings - start -->
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

                                            if (!empty($args['adult_amount'])) {
                                                $adult_amount = $args['adult_amount'];
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
                                <?php echo $form_fields['filter_button']; ?>
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
                                    class="btn shape-rnd bg-success-color search-btn font-alt font-weight-900"
                                    type="submit"<?php echo $search_disabled ? ' disabled' : ''; ?>
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

    <form id="excursion-search-form" action="/excursion-search/" method="get" class="search-form search-excursion-form repeater">
        <div class="search-form-main__holder">
            <div id="select-from-city-excursion__holder">
                <?php echo $form_fields['select_from_city_excursion']; ?>
            </div>
            <div class="row">
                <div class="col-md-12 col-lg-9">
                    <div class="row search-summary__row">

                        <div id="from_city-excursion_summary__col" class="col search-summary__col d-block d-md-none">
                            <?php echo $form_fields['from_city_excursion_summary']; ?>

                            <div class="search-form-toggle__holder">
                                <div id="from-city-excursion-select_section" class="form-data-toggle-target">
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

                                            <?php echo $form_fields['list_from_city_excursion']; ?>
                                        </div>
                                    </div>

                                    <?php
                                    ittour_show_toggle_mobile_header_footer(
                                        'from-city-excursion-select_section',
                                        false,
                                        array('label' => __('Destination', 'snthwp'), 'container' => 'destination-excursion-select_section', 'disabled' => false),
                                        $search_excursion_disabled
                                    )
                                    ?>
                                </div>
                            </div>
                        </div>

                        <div id="destination-excursion_summary__col" class="col-md-6 search-summary__col">
                            <?php echo $form_fields['destination_excursion_summary']; ?>

                            <div class="search-form-toggle__holder">
                                <div id="destination-excursion-select_section" class="form-data-toggle-target">
                                    <div class="form-data-toggle-body bg-gray-5-color p-10 scroll-on-show">
                                        <div class="search-form-step__section">
                                            <div class="search-form-step__header">
                                                <h4><?php echo __('Select destination', 'snthwp') ?></h4>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="country_select"><?php echo __('Countries', 'snthwp') ?>*:</label>

                                            <?php echo $form_fields['countries_excursion']; ?>
                                        </div>

                                        <div class="form-group">
                                            <label for="region_select"><?php echo __('Cities', 'snthwp') ?>:</label>

                                            <?php echo $form_fields['regions_excursion']; ?>
                                        </div>
                                    </div>

                                    <?php
                                    ittour_show_toggle_mobile_header_footer( 'destination-excursion-select_section',
                                        array('label' => __('Departure from', 'snthwp'), 'container' => 'from-city-excursion-select_section', 'disabled' => false),
                                        array('label' => __('Dates', 'snthwp'), 'container' => 'dates-excursion-select_section', 'disabled' => $search_excursion_disabled),
                                        $search_excursion_disabled
                                    )
                                    ?>
                                </div>
                            </div>
                        </div>

                        <div id="dates-duration-excursion_summary__col" class="col-md-6 search-summary__col">
                            <?php echo $form_fields['dates_excursion_summary']; ?>

                            <div class="search-form-toggle__holder">
                                <div id="dates-excursion-select_section" class="form-data-toggle-target">
                                    <div class="form-data-toggle-body bg-gray-5-color p-10 scroll-on-show">
                                        <div class="search-form-step__section">
                                            <div class="search-form-step__header">
                                                <h4><?php echo __('Select dates of start tour', 'snthwp') ?></h4>
                                            </div>
                                        </div>

                                        <!-- Dates settings - start -->
                                        <?php echo $form_fields['dates_excursion_holder']; ?>
                                        <!-- Dates settings - start -->

                                        <?php
                                        ittour_show_toggle_mobile_header_footer(
                                            'dates-excursion-select_section',
                                            array('label' => __('Destination', 'snthwp'), 'container' => 'destination-excursion-select_section', 'disabled' => false),
                                            array('label' => __('Filter', 'snthwp'), 'container' => 'filter-excursion-select__section', 'disabled' => $search_excursion_disabled),
                                            $search_excursion_disabled
                                        )
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="filter-excursion_summary__col" class="col-12 search-summary__col">
                            <div class="d-block d-md-none">
                                <?php echo $form_fields['filter_summary']; ?>
                            </div>

                            <div class="d-none d-md-block">
                                <?php echo $form_fields['filter_excursion_button']; ?>
                            </div>

                            <div class="search-form-toggle__holder">
                                <div id="filter-excursion-select__section" class="form-data-toggle-target">
                                    <div class="form-data-toggle-body bg-gray-5-color p-10 scroll-on-show">
                                        <div class="search-form-step__section">
                                            <div class="search-form-step__header">
                                                <h4><?php echo __('Filter', 'snthwp') ?></h4>
                                            </div>
                                        </div>
                                    </div>

                                    <?php
                                    ittour_show_toggle_mobile_header_footer(
                                        'filter-excursion-select__section',
                                        array('label' => __('Dates', 'snthwp'), 'container' => 'dates-excursion-select_section', 'disabled' => $search_excursion_disabled),
                                        false,
                                        $search_excursion_disabled
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
                                        id="start_excursion_search"
                                        class="btn shape-rnd bg-success-color search-btn font-alt font-weight-900"
                                        type="submit"<?php echo $search_excursion_disabled ? ' disabled' : ''; ?>
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

    <div id="change-search-type-container">
        <i class="fas fa-umbrella-beach ittour-switch-tour"></i>
        <i class="fas fa-archway ittour-switch-excursion"></i>
    </div>
</div>