<?php
/**
 * Created by PhpStorm.
 * User: snth
 * Date: 17.09.18
 * Time: 19:37
 */

/**
 * Show templates passing attributes and including the file.
 *
 * @param string $template_name
 * @param array $args
 * @param string $template_path
 */
function ittour_show_template($template_name, $args = array(), $template_path = 'ittour-templates')
{
    if (!empty($args) && is_array($args)) {
        extract($args);
    }

    $located = snth_locate_template($template_name, $template_path);

    if (!file_exists($located)) {
        return;
    }

    include($located);
}

/**
 * Like show, but returns the HTML instead of outputting.
 *
 * @param $template_name
 * @param array $args
 * @param string $template_path
 * @param string $default_path
 *
 * @return string
 */
function ittour_get_template($template_name, $args = array(), $template_path = 'ittour-templates')
{
    ob_start();
    snth_show_template($template_name, $args, $template_path);
    return ob_get_clean();
}

/**
 * Locate a template and return the path for inclusion.
 *
 * @param $template_name
 * @param string $template_path
 * @return string
 */
function ittour_locate_template($template_name, $template_path = 'ittour-templates')
{
    if (!$template_path) {
        $template_path = 'ittour-templates';
    }

    $template = locate_template(
        array(
            trailingslashit($template_path) . $template_name,
            $template_name
        )
    );

    return $template;
}

function ittour_get_form_fields($args = array()) {
    $params_obj = ittour_params();
    $params = $params_obj->get();

    if (is_wp_error( $params )) {
        return $params->get_error_message();
    }

    $country_params = array();

    if (!empty($args['country'])) {
        $country_params = $params_obj->getCountry($args['country']);

        if (is_wp_error( $params )) {
            return $country_params->get_error_message();
        }
    }

    return array(
        'destination_summary' => ittour_get_destination_summary_field($params, $country_params, $args),
        'dates_summary' => ittour_get_dates_summary_field($args),
        'guests_summary' => ittour_get_guests_summary_field($args),
        'countries' =>  ittour_get_country_field($params, $args),
        'regions' =>  ittour_get_region_field($params, $args),
        'hotels' =>  ittour_get_hotel_field($params, $args),
        'hotel_ratings' =>  ittour_get_hotel_ratings_field($params, $args),
        'transport_types' =>  ittour_get_transport_type_field($params),
    );
}

function ittour_get_destination_summary_field($params, $country_params, $args = array()) {
    $value = '';

    if (!empty($args)) {
        if (!empty($args['hotel']) && !empty($country_params["hotels"])) {
            $hotel_name = '';

            foreach ($country_params["hotels"] as $hotel) {
                if ($hotel['id'] === $args['hotel']) {
                    $hotel_name = $hotel['name'] . ' ' . ittour_get_hotel_number_rating_by_id($hotel['hotel_rating_id']);

                    continue;
                }
            }

            $value .= $hotel_name . ', ';
        }

        if (!empty($args['region']) && !empty($params['regions'])) {
            $region_name = '';

            foreach ($params['regions'] as $region) {
                if ($region['id'] === $args['region']) {
                    $region_name = $region['name'];
                    continue;
                }
            }

            $value .= $region_name . ', ';
        }

        if (!empty($args['country']) && !empty($params['countries'])) {
            $country_name = '';

            foreach ($params['countries'] as $country) {
                if ($country['id'] === $args['country']) {
                    $country_name = $country['name'];
                    continue;
                }
            }

            $value .= $country_name;
        }
    }
    ob_start();
    ?>
    <div id="dates-duration_summary__container" class="search-summary__container">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="btn"><i class="fas fa-map-marker-alt"></i></span>
            </div>

            <input id="destination_summary"
                   type="text"
                   class="form-control form-data-toggle-control"
                   data-form_toggle_target="destination-select_section"
                   placeholder="<?php echo __('Select Destination *', 'snthwp'); ?>"
                   value="<?php echo $value; ?>" readonly
            >
        </div>
    </div>
    <?php
    return ob_get_clean();
}

function ittour_get_dates_summary_field($args) {
    $disabled_class = '';
    $field_status = ' readonly';

    if (empty($args['country'])) {
        $disabled_class = ' disabled-item';
        $field_status = ' disabled';
    }

    if (empty($args['dateFrom'])) {
        $date_from = date('d.m.y', mktime(0, 0, 0, date('m'), date('d') + 1, date('Y')));
        $date_till = date('d.m.y', mktime(0, 0, 0, date('m'), date('d') + 6, date('Y')));
        $dates_value = $date_from . ' - ' . $date_till . ', 7 - 9 ' . __('nights', 'snthwp');
    } else {
        $date_from = $args['dateFrom'];
        $date_till = $args['dateTill'];
        $night_from = $args['nightFrom'];
        $night_till = $args['nightTill'];
        $dates_value = $date_from . ' - ' . $date_till . ', '.$night_from.' - '.$night_till.' ' . __('nights', 'snthwp');
    }

    ob_start();
    ?>
    <div id="dates-duration_summary__container" class="search-summary__container<?php echo $disabled_class; ?>">
        <div class="input-group">
            <div class="input-group-prepend">
            <span class="btn btn-light">
                <i class="far fa-calendar-alt"></i>
            </span>
            </div>

            <input id="dates-duration_summary"
                   type="text"
                   class="form-control form-data-toggle-control"
                   data-form_toggle_target="dates-select_section"
                   placeholder="<?php echo __('Dates / Duration *', 'snthwp') ?>"
                   value="<?php echo $dates_value ?>"<?php echo $field_status; ?>
            >
        </div>
    </div>
    <?php

    return ob_get_clean();
}

function ittour_get_guests_summary_field($args) {
    $disabled_class = '';
    $field_status = ' readonly';

    if (empty($args['country'])) {
        $disabled_class = ' disabled-item';
        $field_status = ' disabled';
    }

    if (empty($args['adultAmount'])) {
        $guests_value = '2';
    } else {
        $adults_amount = $args['adultAmount'];
        $guests_value = $adults_amount;

        if (!empty($args['childAmount']) && !empty($args['childAge'])) {
            $child_ages = explode(':', $args['childAge']);

            foreach ($child_ages as $key => $child_age) {
                $child_ages[$key] = $child_age . __('y', 'snthwp');
            }

            $guests_value .= ' + ' . $args['childAmount'] . ' ( ' . implode(' ', $child_ages) . ' )';
        }
    }

    ob_start();
    ?>
    <div id="guests_summary__container" class="search-summary__container<?php echo $disabled_class; ?>">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="btn btn-light"><i class="fas fa-users"></i></span>
            </div>

            <input id="guests_summary"
                type="text"
                class="form-control form-data-toggle-control"
                data-form_toggle_target="guests-select_section"
                placeholder="<?php echo __('Guests', 'snthwp') ?>"
                value="<?php echo $guests_value ?>"<?php echo $field_status; ?>
            >
        </div>
    </div>
    <?php
    return ob_get_clean();
}

/**
 * @param $params
 * @param array $args
 *
 * @return string
 */
function ittour_get_country_field($params, $args = array()) {

    $country_id = !empty($args['country']) ? $args['country'] : false;

    ob_start();
    if (!empty($params['countries'])) {
        ?>
        <select id="country_select" name="country" class="form-control form-select2" style="width: 100%">
            <option></option>

            <?php
            foreach ($params['countries'] as $country) {
                $selected = '';

                if ($country_id && $country['id'] === $country_id) {
                    $selected .= ' selected';
                }
                ?>
                <option value="<?php echo $country['id'] ?>"<?php echo $selected ?>><?php echo $country['name'] ?></option>
                <?php
            }
            ?>
        </select>
        <?php
    } else {
        ?>
        <input type="text" placeholder="Country" class="form-control" name="country" required>
        <?php
    }

    return ob_get_clean();
}

/**
 * @param $params
 * @param array $args
 *
 * @return string
 */
function ittour_get_region_field($params, $args = array()) {
    ob_start();

    if (!empty($params['regions'])) {
        $regions_by_countries = array();

        foreach ( $params['regions'] as $region ) {
            if (false === strpos($region['id'], '-')) {
                $regions_by_countries[$region['country_id']][] = array(
                    'id' => $region['id'],
                    'name' => $region['name']
                );
            }
        }

        $regions_by_countries_json = json_encode($regions_by_countries, JSON_HEX_APOS);
        ?>
        <input id="regions_by_countries" type="hidden" value='<?php echo $regions_by_countries_json; ?>'>

        <select id="region_select" name="region" class="form-control form-select2" style="width: 100%">
            <?php
            if (!empty($args['country']) && !empty($regions_by_countries[$args['country']])) {
                ?>
                <option></option>
                <?php
                foreach ($regions_by_countries[$args['country']] as $region) {
                    $selected = '';

                    if (!empty($args['region']) && $args['region'] === $region['id']) {
                        $selected .= ' selected';
                    }
                    ?>
                    <option value="<?php echo $region['id']; ?>"<?php echo $selected ?>><?php echo $region['name']; ?></option>
                    <?php
                }
            } else {
                ?><option value=""><?php echo __('Select country first', 'snthwp'); ?></option><?php
            }
            ?>
        </select>
        <?php
    } else {
        ?>
        <input type="text" placeholder="Country" class="form-control" name="country" required>
        <?php
    }

    return ob_get_clean();
}

/**
 * @param array $args
 *
 * @return string
 */
function ittour_get_hotel_field($params, $args = array()) {
    if (!empty($args['country'])) {
        $params_obj = ittour_params();
        $params = $params_obj->getCountry($args['country']);
    }

    ob_start();
    ?>
    <select id="hotel_select" name="hotel[]" class="form-control form-select2" data-current_value="" style="width: 100%" multiple>
        <?php
        if (!empty($args['country'])) {
            foreach ($params['hotels'] as $hotel) {
                $show = true;

                if (!empty($args['region']) && $args['region'] !== $hotel['region_id']) $show = false;

                if ($show) {
                    $selected = '';

                    if (!empty($args['hotel'])) {
                        $hotels_array = explode(':', $args['hotel']);

                        if (in_array($hotel['id'], $hotels_array)) {
                            $selected .= ' selected';
                        }
                    }
                    ?>
                    <option value="<?php echo $hotel['id']; ?>" data-hotel-rating="<?php echo $hotel['hotel_rating_id']; ?>"<?php echo $selected ?>>
                        <?php echo $hotel['name']; ?> <?php echo ittour_get_hotel_number_rating_by_id($hotel['hotel_rating_id']); ?>
                    </option>
                    <?php
                }
            }
        }
        ?>
    </select>
    <?php
    return ob_get_clean();
}

function ittour_get_hotel_ratings_field($params, $args = array()) {
    ob_start();
    ?>
    <ul id="hotel_rating_select" class="form-list">
        <?php
        foreach ($params['hotel_ratings'] as $hotel_rating) {
            $selected = '';
            $disabled = '';

            if (!empty($args['hotelRating'])) {
                $hotel_rating_array = explode(':', $args['hotelRating']);

                if (in_array($hotel_rating['id'], $hotel_rating_array)) {
                    $selected = ' checked';
                } else {
                    $disabled = ' disabled';
                }
            } else {
                if ('78' === $hotel_rating['id'] || '4' === $hotel_rating['id']) {
                    $selected = ' checked';
                } else {
                    $disabled = ' disabled';
                }
            }
            ?>
            <li>

                <input id="hotel_rating_<?php echo $hotel_rating['id'] ?>" class="iCheckGray styled_1" name="hotel_rating[]" type="checkbox" value="<?php echo $hotel_rating['id'] ?>"<?php echo $selected ?><?php echo $disabled ?>>
                <label for="hotel_rating_<?php echo $hotel_rating['id'] ?>"><?php echo $hotel_rating['name'] ?>*</label>
            </li>
            <?php
        }
        ?>
    </ul>
    <?php
    return ob_get_clean();
}

function ittour_get_transport_type_field($params) {
    ob_start();
    ?>
    <ul class="form-list">
        <?php
        foreach ($params['transport_types'] as $transport_type) {
            ?>
            <li>
                <label>
                    <input class="iCheckGray" type="checkbox" value="<?php echo $transport_type['id'] ?>"> <?php echo $transport_type['name'] ?>*
                </label>
            </li>
            <?php
        }
        ?>
    </ul>
    <?php
    return ob_get_clean();
}

function itour_get_meal_type_field() {
//    $meal_types = array(
//        560 => ''
//    );
//    ob_start();
//    ?>
<!--    <ul class="form-list">-->
<!--        --><?php
//        foreach ($params['transport_types'] as $transport_type) {
//            ?>
<!--            <li>-->
<!--                <label>-->
<!--                    <input class="iCheckGray" type="checkbox" value="--><?php //echo $transport_type['id'] ?><!--"> --><?php //echo $transport_type['name'] ?><!--*-->
<!--                </label>-->
<!--            </li>-->
<!--            --><?php
//        }
//        ?>
<!--    </ul>-->
<!--    --><?php
//    return ob_get_clean();
}

function itour_get_adult_amount_field() {
    ob_start();
    ?>
    <input type="number" name="adult_amount" class="form-control" min="1" max="4" value="2">
    <?php

    return ob_get_clean();
}

function itour_get_child_amount_field($params) {
    ob_start();
    ?>
    <input type="number" name="child_amount" min="0" max="3" value="2">
    <?php
}

function ittour_get_guests_icon($adult, $child) {
    $icons = '';

    if (!empty($adult)) {
        for ($i = 0; $i < $adult; $i++) {
            $icons .= '<i class="fas fa-male"></i>';
        }
    }

    if (!empty($child)) {
        for ($i = 0; $i < $child; $i++) {
            $icons .= '<i class="fas fa-child"></i>';
        }
    }

    return $icons;
}

function ittour_get_hotel_facilities($facilities) {
    $wifi = array();
    $food = array();
    $pool = array();
    $beach = array();
    $children = array();
    $sport = array();
    $html = '';

    foreach ($facilities as $facility) {
        if (!empty($facility['id']) && '60' === $facility['id'] && isset($facility['is_paid']) && 0 === $facility['is_paid']) {
            $wifi[] = __('Free WiFi', 'snthwp');
        }

        // Food
        if (!empty($facility['id']) && '4' === $facility['id']) {
            $paid = $facility['is_paid'] ? ' ($)' : '';
            $food[] = $facility['name'] . $paid;
        }

        if (!empty($facility['id']) && '48' === $facility['id']) {
            $paid = $facility['is_paid'] ? ' ($)' : '';
            $food[] = $facility['name'] . $paid;
        }

        if (!empty($facility['id']) && '96' === $facility['id']) {
            $paid = $facility['is_paid'] ? ' ($)' : '';
            $food[] = $facility['name'] . $paid;
        }

        // Pool
        if (!empty($facility['id']) && '8' === $facility['id']) {
            $paid = $facility['is_paid'] ? ' ($)' : '';
            $pool[] = $facility['name'] . $paid;
        }

        if (!empty($facility['id']) && '46' === $facility['id']) {
            $paid = $facility['is_paid'] ? ' ($)' : '';
            $pool[] = $facility['name'] . $paid;
        }

        // Beach
        if (!empty($facility['id']) && '79' === $facility['id']) {
            $paid = $facility['is_paid'] ? ' ($)' : '';
            $beach[] = $facility['name'] . $paid;
        }

        if (!empty($facility['id']) && '81' === $facility['id']) {
            $paid = $facility['is_paid'] ? ' ($)' : '';
            $beach[] = $facility['name'] . $paid;
        }

        if (!empty($facility['id']) && '85' === $facility['id']) {
            $paid = $facility['is_paid'] ? ' ($)' : '';
            $beach[] = $facility['name'] . $paid;
        }

        if (!empty($facility['id']) && '88' === $facility['id']) {
            $paid = $facility['is_paid'] ? ' ($)' : '';
            $beach[] = $facility['name'] . $paid;
        }

        // Children
        if (!empty($facility['id']) && '8' === $facility['id']) {
            $paid = $facility['is_paid'] ? ' ($)' : '';
            $children[] = $facility['name'] . $paid;
        }

        if (!empty($facility['id']) && '36' === $facility['id']) {
            $paid = $facility['is_paid'] ? ' ($)' : '';
            $children[] = $facility['name'] . $paid;
        }

        if (!empty($facility['id']) && '47' === $facility['id']) {
            $paid = $facility['is_paid'] ? ' ($)' : '';
            $children[] = $facility['name'] . $paid;
        }

        if (!empty($facility['id']) && '50' === $facility['id']) {
            $paid = $facility['is_paid'] ? ' ($)' : '';
            $children[] = $facility['name'] . $paid;
        }

        if (!empty($facility['id']) && '94' === $facility['id']) {
            $paid = $facility['is_paid'] ? ' ($)' : '';
            $children[] = $facility['name'] . $paid;
        }

        if (!empty($facility['id']) && '95' === $facility['id']) {
            $paid = $facility['is_paid'] ? ' ($)' : '';
            $children[] = $facility['name'] . $paid;
        }

        // Sport
        if (!empty($facility['id']) && '17' === $facility['id']) {
            $paid = $facility['is_paid'] ? ' ($)' : '';
            $sport[] = $facility['name'] . $paid;
        }

        if (!empty($facility['id']) && '19' === $facility['id']) {
            $paid = $facility['is_paid'] ? ' ($)' : '';
            $sport[] = $facility['name'] . $paid;
        }

        if (!empty($facility['id']) && '22' === $facility['id']) {
            $paid = $facility['is_paid'] ? ' ($)' : '';
            $sport[] = $facility['name'] . $paid;
        }

        if (!empty($facility['id']) && '23' === $facility['id']) {
            $paid = $facility['is_paid'] ? ' ($)' : '';
            $sport[] = $facility['name'] . $paid;
        }

        if (!empty($facility['id']) && '39' === $facility['id']) {
            $paid = $facility['is_paid'] ? ' ($)' : '';
            $sport[] = $facility['name'] . $paid;
        }

        if (!empty($facility['id']) && '40' === $facility['id']) {
            $paid = $facility['is_paid'] ? ' ($)' : '';
            $sport[] = $facility['name'] . $paid;
        }
    }

    if (!empty($wifi) || !empty($pool)) {
        ob_start();

        ?>
        <div class="hotel_facilities">
            <ul class="add_info">
                <?php
                if (!empty($wifi)) {
                    ?>
                    <li>
                        <div class="tooltip_styled tooltip-effect-4">
                            <span class="tooltip-item"><i class="fas fa-wifi"></i></span>

                            <div class="tooltip-content">
                                <?php echo $wifi[0] ?>
                            </div>
                        </div>
                    </li>
                    <?php
                }

                if (!empty($food)) {
                    ?>
                    <li>
                        <div class="tooltip_styled tooltip-effect-4">
                            <span class="tooltip-item"><i class="fas fa-utensils"></i></span>

                            <div class="tooltip-content">
                                <h4><?php echo __('Meal', 'snthwp'); ?></h4>
                                <?php echo implode('<br>', $food); ?>
                            </div>
                        </div>
                    </li>
                    <?php
                }

                if (!empty($pool)) {
                    ?>
                    <li>
                        <div class="tooltip_styled tooltip-effect-4">
                            <span class="tooltip-item"><i class="fas fa-swimming-pool"></i></span>

                            <div class="tooltip-content">
                                <h4><?php echo __('Pool', 'snthwp'); ?></h4>
                                <?php echo implode('<br>', $pool); ?>
                            </div>
                        </div>
                    </li>
                    <?php
                }

                if (!empty($beach)) {
                    ?>
                    <li>
                        <div class="tooltip_styled tooltip-effect-4">
                            <span class="tooltip-item"><i class="fas fa-umbrella-beach"></i></span>

                            <div class="tooltip-content">
                                <h4><?php echo __('Beach', 'snthwp'); ?></h4>
                                <?php echo implode('<br>', $beach); ?>
                            </div>
                        </div>
                    </li>
                    <?php
                }

                if (!empty($sport)) {
                    ?>
                    <li>
                        <div class="tooltip_styled tooltip-effect-4">
                            <span class="tooltip-item"><i class="fas fa-dumbbell"></i></span>

                            <div class="tooltip-content">
                                <h4><?php echo __('Sport', 'snthwp'); ?></h4>
                                <?php echo implode('<br>', $sport); ?>
                            </div>
                        </div>
                    </li>
                    <?php
                }

                if (!empty($children)) {
                    ?>
                    <li>
                        <div class="tooltip_styled tooltip-effect-4">
                            <span class="tooltip-item"><i class="fas fa-baby"></i></span>

                            <div class="tooltip-content">
                                <h4><?php echo __('Children', 'snthwp'); ?></h4>
                                <?php echo implode('<br>', $children); ?>
                            </div>
                        </div>
                    </li>
                    <?php
                }
                ?>
            </ul>
        </div>
        <?php
        $html = ob_get_clean();
    }

    return $html;
}

function ittour_get_currency_by_id($id) {
    switch ($id) {
        case 1:
            $currency = __('USD', 'snthwp');
            break;
        case 2:
            $currency = __('UAH', 'snthwp');
            break;
        case 10:
            $currency = __('EUR', 'snthwp');
            break;
        default:
            $currency = false;
    }

    return $currency;
}

function ittour_get_hotel_review_rate_by_value($review_rate) {
    switch ($review_rate) {
        case $review_rate < 2:
            $rating = '<i class="far fa-sad-tear"></i>';
            break;
        case $review_rate < 4:
            $rating = '<i class="far fa-frown"></i>';
            break;
        case $review_rate < 6:
            $rating = '<i class="far fa-meh"></i>';
            break;
        case $review_rate < 8:
            $rating = '<i class="far fa-smile"></i>';
            break;
        default:
            $rating = '<i class="far fa-grin-hearts"></i>';
    }

    return $rating;
}

function ittour_get_hotel_rating_by_id($id) {
    switch ($id) {
        case '7':
            $rating = '<i class="fas fa-star"></i><i class="fas fa-star"></i>';
            break;
        case '3':
            $rating = '<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>';
            break;
        case '4':
            $rating = '<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>';
            break;
        case '78':
            $rating = '<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>';
            break;
        default:
            $rating = false;
    }

    return $rating;
}

function ittour_get_hotel_rating_by_number($id) {
    switch ($id) {
        case '2':
            $rating = '<i class="fas fa-star"></i><i class="fas fa-star"></i>';
            break;
        case '3':
            $rating = '<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>';
            break;
        case '4':
            $rating = '<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>';
            break;
        case '5':
            $rating = '<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>';
            break;
        default:
            $rating = false;
    }

    return $rating;
}

function ittour_get_hotel_number_rating_by_id($id) {
    switch ($id) {
        case '2':
            $rating = '2*';
            break;
        case '7':
            $rating = '2*';
            break;
        case '3':
            $rating = '3*';
            break;
        case '4':
            $rating = '4*';
            break;
        case '5':
            $rating = '5*';
            break;
            break;
        case '78':
            $rating = '5*';
            break;
        default:
            $rating = false;
    }

    return $rating;
}

function ittour_get_transport_type_by_id($id) {
    switch ($id) {
        case "0":
            $rating = '<i class="fas fa-plane"></i> <i class="fas fa-bus"></i>';
            break;
        case "flight":
            $rating = '<i class="fas fa-plane"></i>';
            break;
        case "2":
            $rating = '<i class="fas fa-bus"></i>';
            break;
        case "-2":
            $rating = '<i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>';
            break;
        default:
            $rating = false;
    }

    return $rating;
}

function ittour_get_hotel_tours_section($country_id, $hotel_id, $hotel_rating, $args = array()) {
    $search = ittour_search('ru');

    if (is_wp_error($search)) {
        return false;
    }

    $args = wp_parse_args( $args, array(
        'from_city' => '2014',
        'adult_amount' => 2,
        'night_from' => 7,
        'night_till' => 9,
        'items_per_page' => 1,
        'prices_in_group' => 30,
        'currency' => 1,
    ) );

    $args['hotel'] = $hotel_id;
    $args['hotel_rating'] = $hotel_rating;

    $timestamp = time();
    $timestamp_from = $timestamp + (24 * 60 * 60);
    $timestamp_till = $timestamp_from + (9 * 24 * 60 * 60);

    $date_from = date('d.m.y', $timestamp_from);
    $date_till = date('d.m.y', $timestamp_till);
    $args['date_from'] = $date_from;
    $args['date_till'] = $date_till;

    $sort_date_array = array();

    for ($i = 0; $i < 10; $i++) {
        $date_item_timestamp = $timestamp_from + ($i * 24 * 60 * 60);
        $date_item = date('Y-m-d', $date_item_timestamp);
        $sort_date_array[$date_item] = array();
    }

    $search_result = $search->get($country_id, $args);

    if (is_wp_error($search_result)) {
        return false;
    }

    if (empty($search_result["hotels"][0]["offers"])) {
        return false;
    }

    $offers = $search_result["hotels"][0]["offers"];

    foreach ($offers as $key => $offer) {
        $sort_date_array[$offer['date_from']][] = $offer;
    }

    ob_start();

    foreach ($sort_date_array as $date => $offers) {
        if (!empty($offers)) {
            ?>
            <div class="tour_list_container">
                <div class="tour_list_container-inner" style="padding:10px;">
                    <h3 style="margin-top:0;"><?php echo $date ?></h3>
                    <table class="tour_list_more table table-sm table-striped" style="margin-bottom:0;">
                        <thead>
                        <tr>
                            <th><?php echo __('Room Type', 'snthwp'); ?></th>
                            <th><?php echo __('Meal Type', 'snthwp'); ?></th>
                            <th><?php echo __('Guests / Nights', 'snthwp'); ?></th>
                            <th><?php echo __('Price', 'snthwp'); ?></th>
                            <th><?php echo __('', 'snthwp'); ?></th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php
                        foreach ($offers as $offer) {
                            ?>
                            <tr>
                                <td>
                                    <?php
                                    if (!empty($offer['room_type'])) {
                                        ?>
                                        <?php echo $offer['room_type']; ?>
                                        <?php
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if (!empty($offer['meal_type']) || !empty($offer['meal_type_full'])) {
                                        if (!empty($offer['meal_type'])) {
                                            ?>
                                            <?php echo $offer['meal_type']; ?>
                                            <?php
                                        }

                                        if (!empty($offer['meal_type_full'])) {
                                            ?>
                                            (<?php echo $offer['meal_type_full']; ?>)
                                            <?php
                                        }
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if (!empty($offer['duration'])) {
                                        ?>
                                        <?php echo $offer['duration']; ?> <?php echo __('Nights', 'snthwp'); ?>
                                        <?php
                                    }
                                    ?>
                                </td>
                                <td class="tour_list_more_price">
                                    <strong><?php echo $offer['prices'][2] ?></strong><small> <?php echo __('uah.', 'snthwp'); ?></small>

                                    <span>(<sup>$</sup><strong><?php echo $offer['prices'][1] ?></strong>)</span>
                                </td>
                                <td>
                                    <a href="/tour-result/?key=<?php echo $offer['key'] ?>" class="btn_1 small"><?php echo __('Details', 'snthwp'); ?></a>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php
        }
    }

    $table_html = ob_get_clean();

    return array( 'table_html' => $table_html );
}

/**
 * @param $country_id
 * @param $hotel_id
 * @param $hotel_rating
 * @param $month
 * @param $year
 * @param array $args
 *
 * @return array
 */
function ittour_get_hotel_tours_calendar($country_id, $hotel_id, $hotel_rating, $month, $year, $args = array()) {
    $search = ittour_search('ru');

    if (is_wp_error($search)) {
        return false;
    }

    $current_month = date("n");
    $current_year = date("Y");

    $is_current_month = ($current_month === $month && $current_year === $year);

    $args = wp_parse_args( $args, array(
        'from_city' => '2014',
        'adult_amount' => 2,
        'night_from' => 7,
        'night_till' => 9,
        'items_per_page' => 1,
        'prices_in_group' => 1,
        'currency' => 1,
    ) );

    $args['hotel'] = $hotel_id;
    $args['hotel_rating'] = $hotel_rating;

    $date = mktime(12, 0, 0, $month, 1, $year);
    $daysInMonth = date("t", $date);
    $offset = (date("w", $date)-1)%7;
    $searchMonth = date('m', $date);
    $searchYear = date('y', $date);
    $rows = 1;

    ob_start();
    ?>
    <table class="table hotel-calendar_table">
        <tr>
            <th><?php _e('Monday', 'snthwp'); ?></th>
            <th><?php _e('Tuesday', 'snthwp'); ?></th>
            <th><?php _e('Wednesday', 'snthwp'); ?></th>
            <th><?php _e('Thursday', 'snthwp'); ?></th>
            <th><?php _e('Friday', 'snthwp'); ?></th>
            <th><?php _e('Saturday', 'snthwp'); ?></th>
            <th><?php _e('Sunday', 'snthwp'); ?></th>
        </tr>
        <?php
        echo "\t";
        echo "\n\t<tr>";

        for($i = 1; $i <= $offset; $i++)  {
            echo "<td></td>";
        }

        for($day = 1; $day <= $daysInMonth; $day++)
        {
            if( ($day + $offset - 1) % 7 == 0 && $day != 1) {
                echo "</tr>\n\t<tr>";
                $rows++;
            }

            if ($day == date("j") && $is_current_month) {
                echo "<td class='current-item'>" . $day . "<br>" . __('Today', 'snthwp') . "</td>";
            } elseif ($day > date("j") || !$is_current_month) {
                $args['date_from'] = $day . '.'.$searchMonth.'.' . $searchYear;
                $args['date_till'] = $day . '.'.$searchMonth.'.' . $searchYear;

                $search_result = $search->get($country_id, $args);

                $offer_html = '';

                if (!empty($search_result['hotels'][0])) {
                    $offers = $search_result['hotels'][0]['offers'];
                    $first_offer = $offers[0];

                    $offer_html = '<br>' . __('from', 'snthwp') . ' <a href="/tour-result/?key='.$first_offer['key'].'">' . $first_offer['prices'][2] . '</a>';
                }

                echo "<td>" . $day . $offer_html . "</td>";
            } else {
                echo "<td class='outdated-item'>" . $day . "</td>";
            }
        }

        while( ($day + $offset) <= $rows * 7) {
            echo "<td></td>";
            $day++;
        }

        echo "</tr>\n";
        ?>
    </table>
    <?php
    $table_html = ob_get_clean();

    return array(
        'table_html' => $table_html
    );
}