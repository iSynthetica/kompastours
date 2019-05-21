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
    $params_obj = ittour_params('uk');
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

    $from_cities_array = get_option('ittour_from_cities');

    return array(
        'from_city_summary' => ittour_get_from_city_summary_field($args),
        'select_from_city' => ittour_get_from_city_field($args, $from_cities_array),
        'list_from_city' => ittour_get_from_city_field($args, $from_cities_array, 'list'),
        'destination_summary' => ittour_get_destination_summary_field($params, $country_params, $args),
        'dates_summary' => ittour_get_dates_summary_field($args),
        'guests_summary' => ittour_get_guests_summary_field($args),
        'filter_summary' => ittour_get_filter_summary_field($args),
        'countries' =>  ittour_get_country_field($params, $args),
        'regions' =>  ittour_get_region_field($params, $args),
        'hotels' =>  ittour_get_hotel_field($params, $args),
        'hotel_ratings' =>  ittour_get_hotel_ratings_field($params, $args),
        'transport_types' =>  ittour_get_transport_type_field($args),
        'meal_types' =>  itour_get_meal_type_field($args),
        'price_limit' =>  ittour_get_price_limit_field($args),
    );
}

function ittour_get_from_city_summary_field($args = array()) {
    $default_city = '2014'; // Kiev is default city
    $from_cities_array = get_option('ittour_from_cities');

    if (empty($args) || empty($args['fromCity'])) {
        $selected_city = $default_city;
    } else {
        $selected_city = $args['fromCity'];
    }

    ob_start();
    ?>
    <div id="from-city_summary__container" class="search-summary__container">
        <div class="input-group input-group__style-1">
            <div class="input-group-prepend">
            <span class="btn btn-light">
                <i class="fas fa-map-signs"></i>
            </span>
            </div>

            <input id="from-city_summary"
                   type="text"
                   class="form-control form-data-toggle-control"
                   data-form_toggle_target="from-city-select_section"
                   placeholder="" readonly
                   value="<?php echo __('departure from', 'snthwp') . ' ' . $from_cities_array[$selected_city]['genitive_case'] ?>"
            >
        </div>
    </div>
    <?php

    return ob_get_clean();
}

function ittour_get_destination_summary_field($params, $country_params, $args = array()) {
    $value = '';

    if (!empty($args)) {
        if (empty($args['hotel']) && !empty($args['hotelRating'])) {
            $hotel_name = '';

            $hotel_rating_array = explode(':', $args['hotelRating']);

            foreach ($hotel_rating_array as $key => $hotel_rating) {
                $hotel_rating_array[$key] = ittour_get_hotel_number_rating_by_id($hotel_rating);
            }

            $hotel_name = implode(', ', $hotel_rating_array);

            $value .= $hotel_name . ', ';
        }
        if (!empty($args['hotel']) && !empty($country_params["hotels"])) {
            $hotel_name = '';

            $hotel_array = explode(':', $args['hotel']);

            if (1 === count($hotel_array)) {
                foreach ($country_params["hotels"] as $hotel) {
                    if ($hotel['id'] === $hotel_array[0]) {
                        $hotel_name = $hotel['name'] . ' ' . ittour_get_hotel_number_rating_by_id($hotel['hotel_rating_id']);

                        continue;
                    }
                }

            } else {
                $hotel_name = count($hotel_array) . ' ' . __('hotel(s)', 'snthwp');
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
    <div id="destination_summary__container" class="search-summary__container">
        <div class="input-group input-group__style-1">
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
        <div class="input-group input-group__style-1">
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
        <div class="input-group input-group__style-1">
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

function ittour_get_filter_summary_field($args) {
    $disabled_class = '';
    $field_status = ' readonly';

    if (empty($args['country'])) {
        $disabled_class = ' disabled-item';
        $field_status = ' disabled';
    }

    $field_value = '';

    if (empty($args)) {
        $field_value .= __('Plane', 'snthwp');
        $field_value .= ', UAI, AI, FB';
    } else {
        if (!empty($args['tourType'])) {
            if ('1' === $args['tourType']) {
                if (!empty($args['tourKind'])) {
                    if ('1' === $args['tourKind']) {
                        $field_value .= __('Plane', 'snthwp');
                    } else {
                        $field_value .= __('Bus', 'snthwp');
                    }
                } else {
                    $field_value .= __('Transit included', 'snthwp');
                }
            } elseif ('2' === $args['tourType']) {
                $field_value = __('Transit not included', 'snthwp');
            }
        }

        if (!empty($args['mealType'])) {
            $meal_types_array = explode(':', $args['mealType']);

            foreach ($meal_types_array as $index => $id) {
                $short = ittour_get_meal_types_array($id);

                if ($short) {
                    $meal_types_array[$index] = $short['short'];
                } else {
                    unset($meal_types_array[$index]);
                }
            }

            if (!empty($field_value)) {
                $field_value .= ', ';
            }

            $field_value .= implode(', ', $meal_types_array);
        }

        if (!empty($args['priceLimit'])) {
            $price_limit_array = explode(':', $args['priceLimit']);

            if ('custom' === $price_limit_array[0]) {
                $price_from = '';
                $price_till = '';

                unset($price_limit_array[0]);

                foreach ($price_limit_array as $price_limit) {
                    $price_array = explode('-', $price_limit);

                    if ('f' === $price_array[0]) {
                        $price_from = $price_array[1];
                    }  elseif ('t' === $price_array[0]) {
                        $price_till = $price_array[1];
                    }
                }

                if (!empty($price_from) && !empty($price_till)) {
                    if (!empty($field_value)) {
                        $field_value .= ', ';
                    }

                    $field_value .= number_format($price_from, 0, ',', ' ') . ' - ' . number_format($price_till, 0, ',', ' ') . ' ' . __('uah.', 'snthwp');
                } elseif (!empty($price_from)) {
                    if (!empty($field_value)) {
                        $field_value .= ', ';
                    }

                    $field_value .= __('more than', 'snthwp') . ' ' . number_format($price_from, 0, ',', ' ') . ' ' . __('uah.', 'snthwp');
                } elseif (!empty($price_till)) {
                    if (!empty($field_value)) {
                        $field_value .= ', ';
                    }

                    $field_value .= __('till', 'snthwp') . ' ' . number_format($price_till, 0, ',', ' ') . ' ' . __('uah.', 'snthwp');
                }
            } else {
                if (!empty($price_limit_array[0]) && !empty($price_limit_array[1])) {
                    if (!empty($field_value)) {
                        $field_value .= ', ';
                    }

                    $field_value .= number_format($price_limit_array[0], 0, ',', ' ') . ' - ' . number_format($price_limit_array[1], 0, ',', ' ') . ' ' . __('uah.', 'snthwp');
                } elseif (!empty($price_limit_array[0])) {
                    if (!empty($field_value)) {
                        $field_value .= ', ';
                    }

                    $field_value .= __('more than', 'snthwp') . ' ' . number_format($price_limit_array[0], 0, ',', ' ') . ' ' . __('uah.', 'snthwp');
                } elseif (!empty($price_limit_array[1])) {
                    if (!empty($field_value)) {
                        $field_value .= ', ';
                    }

                    $field_value .= __('till', 'snthwp') . ' ' . number_format($price_limit_array[1], 0, ',', ' ') . ' ' . __('uah.', 'snthwp');
                }
            }
        }
    }

    ob_start();
    ?>
    <div id="filter_summary__container" class="search-summary__container<?php echo $disabled_class; ?>">
        <div class="input-group input-group__style-1">
            <div class="input-group-prepend">
                <span class="btn btn-light"><i class="fas fa-sliders-h"></i></span>
            </div>

            <input id="filter_summary"
                type="text"
                class="form-control form-data-toggle-control"
                data-form_toggle_target="filter-select__section"
                placeholder="<?php echo __('Additional filter', 'snthwp') ?>"
                value="<?php echo $field_value; ?>"<?php echo $field_status; ?>
            >
        </div>
    </div>
    <?php
    return ob_get_clean();
}

function ittour_get_from_city_field($args, $from_cities_array, $template = 'select') {
    $from_city = !empty($args['fromCity']) ? $args['fromCity'] : '2014';

    ob_start();
    if ('select' === $template) {
        ?>
        <select class="form-control" name="from_city" id="from_city">
            <?php
            foreach ($from_cities_array as $id => $city) {
                ?>
                <option value="<?php echo $id; ?>"<?php echo $id == $from_city ? ' selected' : ''; ?>><?php echo $city['name']; ?></option>
                <?php
            }
            ?>
        </select>
        <?php
    } else {
        ?>
        <ul id="city_from_select_mobile" class="form-list">
            <?php
            foreach ($from_cities_array as $city_id => $city_array) {
                ?>
                <li>
                    <input
                        id="from_city_<?php echo $city_id ?>"
                        class="iCheckGray styled_1"
                        type="checkbox"
                        value="<?php echo $city_id ?>"
                        data-summary="<?php echo __('departure from', 'snthwp') . ' ' . $city_array['genitive_case'] ?>"
                        <?php echo $city_id == $from_city ? ' checked' : ''; ?>
                    >
                    <label for="from_city_<?php echo $city_id ?>">
                        <?php echo $city_array['name'] ?>
                    </label>
                </li>
                <?php
            }
            ?>
        </ul>
        <?php
    }
    ?>

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

                if (!empty($args['hotelRating'])) {
                    $hotel_ratings_array = explode(':', $args['hotelRating']);

                    if (!in_array($hotel['hotel_rating_id'], $hotel_ratings_array)) {
                        $show = false;
                    }
                }

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
            <li style="display: inline-block">

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

function ittour_get_price_limit_field($args = array()) {
    ob_start();
    $selected = '';
    $disabled = '';
    $price_limit = !empty($args['priceLimit']) ? $args['priceLimit'] : '';
    $is_custom = false;
    $price_from = '';
    $price_till = '';

    if (!empty($price_limit)) {
        $price_limit_array = explode(':', $price_limit);

        if ('custom' === $price_limit_array[0]) {
            $is_custom = true;
            unset($price_limit_array[0]);

            if (0 === count($price_limit_array)) {
                $is_custom = false;
                $price_limit = '';
            } else {
                foreach ($price_limit_array as $custom_price_limit) {
                    $value = explode('-', $custom_price_limit);

                    if ('f' === $value[0]) {
                        $price_from = $value[1];
                    }

                    if ('t' === $value[0]) {
                        $price_till = $value[1];
                    }
                }
            }
        }
    }
    ?>

    <label><?php echo __('Price range', 'snthwp') ?> (<?php echo __('uah.', 'snthwp'); ?>)</label>

    <ul id="price_limit_select" class="form-list">
        <li>
            <input id="price_limit_36000" class="styled_1" name="price_limit" type="radio" value="36000:"<?php echo '36000:' === $price_limit ? ' checked' : ''; ?><?php echo $disabled ?>>
            <label for="price_limit_36000"><?php echo __('more than', 'snthwp'); ?> 36 000 <?php echo __('uah.', 'snthwp'); ?></label>
        </li>

        <li>
            <input id="price_limit_28000_36000" class="styled_1" name="price_limit" type="radio" value="28000:36000"<?php echo '28000:36000' === $price_limit ? ' checked' : ''; ?><?php echo $disabled ?>>
            <label for="price_limit_28000_36000">28 000 - 36 000 <?php echo __('uah.', 'snthwp'); ?></label>
        </li>

        <li>
            <input id="price_limit_20000_28000" class="styled_1" name="price_limit" type="radio" value="20000:28000"<?php echo '20000:28000' === $price_limit ? ' checked' : ''; ?><?php echo $disabled ?>>
            <label for="price_limit_20000_28000">20 000 - 28 000 <?php echo __('uah.', 'snthwp'); ?></label>
        </li>

        <li>
            <input id="price_limit_12000_20000" class="styled_1" name="price_limit" type="radio" value="12000:20000"<?php echo '12000:20000' === $price_limit ? ' checked' : ''; ?><?php echo $disabled ?>>
            <label for="price_limit_12000_20000">20 000 - 28 000 <?php echo __('uah.', 'snthwp'); ?></label>
        </li>

        <li>
            <input id="price_limit_12000" class="styled_1" name="price_limit" type="radio" value=":12000"<?php echo ':12000' === $price_limit ? ' checked' : ''; ?><?php echo $disabled ?>>
            <label for="price_limit_12000"><?php echo __('till', 'snthwp'); ?> 12 000 <?php echo __('uah.', 'snthwp'); ?></label>
        </li>

        <li>
            <input id="price_limit_no" class="styled_1" name="price_limit" type="radio" value=""<?php echo '' === $price_limit ? ' checked' : ''; ?><?php echo $disabled ?>>
            <label for="price_limit_no"><?php echo __('Doesn\'t metter', 'snthwp'); ?></label>
        </li>

        <li>
            <input id="price_limit_custom" class="styled_1" name="price_limit" type="radio" value="custom"<?php echo $is_custom ? ' checked' : ''; ?><?php echo $disabled ?>>
            <label for="price_limit_custom"><?php echo __('Your variant', 'snthwp'); ?></label>
        </li>

        <li id="custom_price_limit_holder"<?php echo $is_custom ? '' : ' style="display:none;"' ?>>
            <div class="row">
                <div class="col-12">
                    <div class="numbers-alt numbers-gor" style="display:inline-block;width:120px;">
                        <input id="price_limit_from" name="price_limit_from" data-min="1000" class="form-control form-control-sm qty2 money-format-input" data-currency="<?php echo __('uah.', 'snthwp'); ?>" data-label="<?php echo __('more than', 'snthwp'); ?>" type="number" value="<?php echo $price_from; ?>" placeholder="<?php echo __('from'); ?>" style="width:80px;">
                    </div> - <div class="numbers-alt numbers-gor" style="display:inline-block;width:120px;">
                        <input id="price_limit_till" name="price_limit_till" data-min="1000" class="form-control form-control-sm qty2 money-format-input" data-currency="<?php echo __('uah.', 'snthwp'); ?>" data-label="<?php echo __('till', 'snthwp'); ?>" type="number" value="<?php echo $price_till; ?>" placeholder="<?php echo __('till'); ?>" style="width:80px;">
                    </div>
                </div>
            </div>
        </li>
    </ul>
    <?php
    return ob_get_clean();
}

function ittour_get_transport_type_field($args = array()) {
    ob_start();
    $type = '';
    $kind = '';

    if (empty($args)) {
        $type = '1';
        $kind = '1';
    } else {
        if (!empty($args['tourType'])) {
            $type = $args['tourType'];

            if (!empty($args['tourKind'])) {
                $kind = $args['tourKind'];
            }
        }
    }

    ?>
    <label><?php echo __('Transport', 'snthwp') ?></label>

    <ul id="tour_type_select" class="form-list">
        <li>
            <input id="tour_type_included" class="styled_1" name="tour_type" type="radio" value="1"<?php echo '1' === $type ? ' checked' : ''; ?>>
            <label for="tour_type_included"><?php echo __('Transit included', 'snthwp'); ?></label>
        </li>

        <li>
            <input id="tour_type_excluded" class="styled_1" name="tour_type" type="radio" value="2"<?php echo '2' === $type ? ' checked' : ''; ?>>
            <label for="tour_type_excluded"><?php echo __('Transit not included', 'snthwp'); ?></label>
        </li>

        <li>
            <input id="tour_type_no" class="styled_1" name="tour_type" type="radio" value="" <?php echo '' === $type ? ' checked' : ''; ?>>
            <label for="tour_type_no"><?php echo __('Doesn\'t metter', 'snthwp'); ?></label>
        </li>
    </ul>

    <ul id="tour_kind_select" class="form-list"<?php echo !empty($type) && '2' !== $type ? '' : ' style="display:none;"' ?>>
        <li>
            <input id="tour_kind_flight" class="styled_1" name="tour_kind" type="radio" value="1"<?php echo '1' === $kind ? ' checked' : ''; ?>>
            <label for="tour_kind_flight"><?php echo __('Plane', 'snthwp'); ?></label>
        </li>

        <li>
            <input id="tour_kind_bus" class="styled_1" name="tour_kind" type="radio" value="2"<?php echo '2' === $kind ? ' checked' : ''; ?>>
            <label for="tour_kind_bus"><?php echo __('Bus', 'snthwp'); ?></label>
        </li>

        <li>
            <input id="tour_kind_no" class="styled_1" name="tour_kind" type="radio" value=""<?php echo '' === $kind ? ' checked' : ''; ?>>
            <label for="tour_kind_no"><?php echo __('Doesn\'t metter', 'snthwp'); ?></label>
        </li>
    </ul>
    <?php
    return ob_get_clean();
}

function ittour_get_meal_types_array($id = '') {
    $meal_types = array(
        '560' => array(
            'title' => __('Ultra all inclusive', 'snthwp'),
            'short' => 'UAI'
        ),
        '512' => array(
            'title' => __('All inclusive', 'snthwp'),
            'short' => 'AI'
        ),
        '498' => array(
            'title' => __('Full board', 'snthwp'),
            'short' => 'FB'
        ),
        '496' => array(
            'title' => __('Breakfast and dinner', 'snthwp'),
            'short' => 'HB'
        ),
        '388' => array(
            'title' => __('Bed and breakfast', 'snthwp'),
            'short' => 'BB'
        ),
        '1956' => array(
            'title' => __('Room only', 'snthwp'),
            'short' => 'RO'
        ),
    );

    if (empty($id)) {
        return $meal_types;
    }

    if (!empty($meal_types[$id])) {
        return $meal_types[$id];
    }

    return false;
}

function itour_get_meal_type_field($args = array()) {
    $meal_types = ittour_get_meal_types_array();

    if (empty($args)) {
        $selected_values = array('560', '512', '498');
    } else {
        if (!empty($args['mealType'])) {
            $selected_values = explode(':', $args['mealType']);
        } else {
            $selected_values = array('');
        }
    }

    ob_start();
    ?>
    <label><?php echo __('Meal type', 'snthwp') ?></label>

    <ul id="meal_type_select" class="form-list">
        <?php
        foreach ($meal_types as $id => $meal_type) {
            $selected = '';

            if (in_array($id, $selected_values)) {
                $selected = ' checked';
            }
            ?>
            <li>
                <input id="meal_type_<?php echo $id ?>" class="iCheckGray styled_1" name="meal_type[]" data-short="<?php echo $meal_type['short'] ?>" type="checkbox" value="<?php echo $id ?>"<?php echo $selected ?>>
                <label for="meal_type_<?php echo $id ?>"><?php echo $meal_type['short'] ?> (<?php echo $meal_type['title'] ?>)</label>
            </li>
            <?php
        }
        ?>
    </ul>
    <?php
    return ob_get_clean();
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

function ittour_get_tours_grid($country, $args = array()) {
    $search = ittour_search('uk');
    $search_result = $search->get($country, $args);

    ob_start();
    ittour_show_template('search/tour-grid-default.php', array('result' => $search_result));

    return ob_get_clean();
}

function ittour_get_tours_table_sort_by_date($country, $args = array()) {
    $search = ittour_search('uk');
    $search_result = $search->getList($country, $args);

    if (is_wp_error($search_result)) {
        return false;
    }

    $sort_date_array = array();
    $best_price_array = array(
        'price' => '',
        'ids'   => array()
    );

    $offers = $search_result["offers"];

    foreach ($offers as $key => $offer) {
        $sort_date_array[$offer['date_from']][] = $offer;

        if (empty($best_price_array['price'])) {
            $best_price_array['price'] = $offer['prices']['2'];
            $best_price_array['ids'][] = $offer['key'];
        } else {
            if ($best_price_array['price'] === $offer['prices']['2']) {
                $best_price_array['ids'][] = $offer['key'];
            } elseif($best_price_array['price'] > $offer['prices']['2']) {
                $best_price_array['price'] = $offer['prices']['2'];
                $best_price_array['ids'] = array();
                $best_price_array['ids'][] = $offer['key'];
            }
        }
    }

    ob_start();

    $i = 1;

    foreach ($sort_date_array as $date => $offers) {
        if (!empty($offers)) {
            ?>
            <div class="tour_list_container">
                <div id="tour_list_container-<?php echo $i; ?>" class="tour_list_container-inner card accordion_styled">
                    <div class="card-header">
                        <h3 class="mtb-0">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#tour_list_container-<?php echo $i; ?>" href="#collapse_<?php echo $i; ?>_date">
                                <?php echo $date ?>
                                <i class="fas fa-plus float-right indicator"></i>
                            </a>
                        </h3>
                    </div>

                    <div id="collapse_<?php echo $i; ?>_date" class="collapse<?php echo 1 === $i ? ' show' : ''; ?>" data-parent="#tour_list_container-<?php echo $i; ?>">
                        <div class="tour_list_more scroll-content">
                            <?php
                            foreach ($offers as $offer) {
                                $is_best_price = '';

                                if (in_array($offer['key'], $best_price_array['ids'])) {
                                    $is_best_price = ' best-price-item';
                                }
                                ?>
                                <div class="<?php echo $is_best_price ?> tour_list_more-item">
                                    <div class="row">
                                        <div class="col-12 col-md-6 col-lg-7 col-xl-8">
                                            <div class="row">
                                                <div class="col-12 col-sm-5 col-md-4">
                                                    <div class="tour_list_more_room">
                                                        <?php
                                                        if (!empty($offer['room_type'])) {
                                                            ?>
                                                            <?php echo $offer['room_type']; ?>
                                                            <?php
                                                        }
                                                        ?>
                                                    </div>
                                                </div>

                                                <div class="col-12 col-sm-4 col-md-4">
                                                    <div class="tour_list_more_meal">
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
                                                    </div>
                                                </div>

                                                <div class="col-12 col-sm-3 col-md-4">
                                                    <div class="tour_list_more_duration">
                                                        <?php
                                                        if (!empty($offer['duration'])) {
                                                            ?>
                                                            <?php echo $offer['duration']; ?> <?php echo __('Nights', 'snthwp'); ?>
                                                            <?php
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6 col-lg-5 col-xl-4">
                                            <div class="row">
                                                <div class="col-12 col-sm-6">
                                                    <div class="tour_list_more_price">
                                                        <strong><?php echo $offer['prices'][2] ?></strong><small> <?php echo __('uah.', 'snthwp'); ?></small>

                                                        <span>(<sup>$</sup><strong><?php echo $offer['prices'][1] ?></strong>)</span>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6">
                                                    <div class="tour_list_more_button">
                                                        <a
                                                                href="/tour-result/?key=<?php echo $offer['key'] ?>"
                                                                class="btn shape-rnd type-hollow hvr-invert size-xs"
                                                        >
                                                            <?php echo __('Details', 'snthwp'); ?>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            $i++;
        }
    }

    return ob_get_clean();
}

function ittour_show_toggle_mobile_header_footer($container, $prev = false, $next = false, $search_disabled = false) {
    ?>
    <div class="form-data-toggle-header">
        <div class="col-12">
            <div class="row">
                <div class="col-6 text-left">
                    <?php
                    if (!empty($prev)) {
                        ?>
                        <button type="button" class="btn btn-prev-step size-xs bg-info-color shape-rnd type-hollow form-data-toggle-control font-alt font-weight-900" data-form_toggle_target="<?php echo $prev['container']; ?>"<?php echo true === $prev['disabled'] ? ' disabled' : ''; ?>>
                            <i class="fas fa-chevron-left"></i>
                            <?php echo $prev['label']; ?>
                        </button>
                        <?php
                    }
                    ?>
                </div>

                <div class="col-6 text-right">
                    <?php
                    if (!empty($next)) {
                        ?>
                        <button type="button" class="btn btn-next-step size-xs bg-info-color shape-rnd type-hollow form-data-toggle-control font-alt font-weight-900" data-form_toggle_target="<?php echo $next['container']; ?>"<?php echo true === $next['disabled'] ? ' disabled' : ''; ?>>
                            <?php echo $next['label']; ?>
                            <i class="fas fa-chevron-right"></i>
                        </button>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <div class="form-data-toggle-footer">
        <div class="col-12 text-center">
                <button type="button" class="btn bg-danger-color shape-rnd type-hollow form-data-toggle-control close-current" data-form_toggle_target="<?php echo $container ?>">
                    <i class="fas fa-times"></i>
                </button>

                <button
                        type="submit"
                        class="search-btn start_search btn bg-primary-color shape-rnd font-alt text-uppercase font-weight-900"
                        <?php echo $search_disabled ? ' disabled' : '';  ?>
                ><?php echo __('Search', 'snthwp') ?></button>
        </div>
    </div>
    <?php
}

function ittour_get_min_prices_by_country($country, $args = array()) {
    $saved_prices_by_rating = get_option('ittour_prices_by_rating');
    $time = time();
    $expiration_period = 60 * 60 * 6;
    // $expiration_period = 60 * 10;

    if (!empty($saved_prices_by_rating)) {
        if (!empty($saved_prices_by_rating[$country]['prices'])) {
            $price_by_region = $saved_prices_by_rating[$country]['prices'];

            $old_prices_by_rating = $saved_prices_by_rating[$country]['prices'];
            $prices_expired = $saved_prices_by_rating[$country]['expired'];

            if ($prices_expired > $time) {
                $need_update = false;
            } else {
                $need_update = true;
            }
        } else {
            $need_update = true;
        }
    } else {
        $saved_prices_by_rating = array();
        $need_update = true;
    }

    if ($need_update) {
        $args['items_per_page'] = 1;
        $search = ittour_search('uk');

        $hotel_ratings = array('78', '4', '3');

        $prices_by_rating = array();

        foreach ($hotel_ratings as $rating) {
            $args['hotel_rating'] = $rating;

            $search_result = $search->getList($country, $args);

            if (!is_wp_error($search_result) && !empty($search_result['offers'][0]['prices']['2'])) {
                $prices_by_rating[$rating] = $search_result['offers'][0]['prices']['2'];
            } else {
                if (!empty($old_prices_by_rating[$rating])) {
                    $prices_by_rating[$rating] = $old_prices_by_rating[$rating];
                }
            }
        }

        $saved_prices_by_rating[$country] = array(
            'prices' => $prices_by_rating,
            'expired'   => $time + $expiration_period
        );

        $updated_prices_by_rating = update_option('ittour_prices_by_rating', $saved_prices_by_rating);
    } else {
        $prices_by_rating = $old_prices_by_rating;
    }

    ob_start();

    if (!empty($prices_by_rating)) {
        foreach ($prices_by_rating as $rating => $price) {
            ?>
            <div class="row">
                <div class="col-6">
                    <?php echo __('Hotels', 'snthwp') ?> <?php echo ittour_get_hotel_number_rating_by_id($rating) ?>
                </div>
                <div class="col-6">
                    <?php echo __('from', 'snthwp') ?> <?php echo $price ?> <?php echo __('uah.', 'snthwp') ?>
                </div>
            </div>
            <?php
        }
    }

    return ob_get_clean();
}

function ittour_get_min_prices_by_region($country, $args = array()) {

    $saved_prices_by_rating = get_option('ittour_prices_by_rating');
    $time = time();
    $expiration_period = 60 * 60 * 4;
    $expiration_period = 60 * 10;

    if (!empty($saved_prices_by_rating)) {
        if (!empty($saved_prices_by_rating[$args['region']]['prices'])) {
            $price_by_region = $saved_prices_by_rating[$args['region']]['prices'];

            $old_prices_by_rating = $saved_prices_by_rating[$args['region']]['prices'];
            $prices_expired = $saved_prices_by_rating[$args['region']]['expired'];

            if ($prices_expired > $time) {
                $need_update = false;
            } else {
                $need_update = true;
            }
        } else {
            $need_update = true;
        }
    } else {
        $saved_prices_by_rating = array();
        $need_update = true;
    }

    if ($need_update) {
        $args['items_per_page'] = 1;
        $search = ittour_search('uk');

        $hotel_ratings = array('78', '4', '3');

        $prices_by_rating = array();

        foreach ($hotel_ratings as $rating) {
            $args['hotel_rating'] = $rating;

            $search_result = $search->getList($country, $args);

            if (!is_wp_error($search_result) && !empty($search_result['offers'][0]['prices']['2'])) {
                $prices_by_rating[$rating] = $search_result['offers'][0]['prices']['2'];
            } else {
                if (!empty($old_prices_by_rating[$rating])) {
                   $prices_by_rating[$rating] = $old_prices_by_rating[$rating];
                }
            }
        }

        $saved_prices_by_rating[$args['region']] = array(
            'prices' => $prices_by_rating,
            'expired'   => $time + $expiration_period
        );

        $updated_prices_by_rating = update_option('ittour_prices_by_rating', $saved_prices_by_rating);
    } else {
        $prices_by_rating = $old_prices_by_rating;
    }

    ob_start();

    if (!empty($prices_by_rating)) {
        foreach ($prices_by_rating as $rating => $price) {
            ?>
            <div class="row">
                <div class="col-6">
                    <?php echo __('Hotels', 'snthwp') ?> <?php echo ittour_get_hotel_number_rating_by_id($rating) ?>
                </div>
                <div class="col-6">
                    <?php echo __('from', 'snthwp') ?> <?php echo $price ?> <?php echo __('uah.', 'snthwp') ?>
                </div>
            </div>
            <?php
        }
    }

    return ob_get_clean();
}

function ittour_get_hotel_tours_section($country_id, $hotel_id, $hotel_rating, $args = array()) {
    $search = ittour_search('uk');

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

/**
 * @param string $date in format 'd.m.y'
 * @param int $date_range
 *
 * @return array
 */
function ittour_get_date_range($date, $date_range = 2) {
    $date_obj = date_create_from_format('d.m.y', $date);
    $date = $date_obj->getTimestamp();
    $tomorrow = mktime(0, 0, 0, date('m'), date('d') + 1, date('Y'));

    if ($tomorrow >= ($date - ($date_range * 60 * 60 * 24))) {
        $date_from = $tomorrow;
        $date_till = $date_from + ($date_range * 60 * 60 * 24);
    } else {
        $date_from = $date - ($date_range * 60 * 60 * 24);
        $date_till = $date + ($date_range * 60 * 60 * 24);
    }

    return array(
        'date_from' => date('d.m.y', $date_from),
        'date_till' => date('d.m.y', $date_till)
    );
}