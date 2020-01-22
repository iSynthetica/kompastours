<?php
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
    global $ittour_get_form_fields;

    $params = get_transient('ittour_search_params');
    $params_obj = ittour_params(ITTOUR_LANG);
    $excursion_params_obj = ittour_excursion_params(ITTOUR_LANG);

    if (!$params) {
        $params = $params_obj->get();

        if (is_wp_error( $params )) {
            return $params->get_error_message();
        } else {
            set_transient('ittour_search_params', $params, 60 * 60 * 6);
        }
    }

    $params['countries'] = ittour_get_destination_by_id($params["countries"]);

    $excursion_params = get_transient('ittour_search_excursion_params');

    if (!$excursion_params) {
        $excursion_params = $excursion_params_obj->get();

        if (is_wp_error( $excursion_params )) {
            return $excursion_params->get_error_message();
        } else {
            set_transient('ittour_search_excursion_params', $excursion_params, 60 * 60 * 6);
        }
    }

    $excursion_params = ittour_set_excursion_parameters($excursion_params, $args);

    $country_params = array();

    if (!empty($args['country'])) {
        $country_params = $params_obj->getCountry($args['country']);

        if (is_wp_error( $params )) {
            return $country_params->get_error_message();
        }
    }

    delete_transient('ittour_search_fields_empty');

    $form_fields = false;

    if (empty($args)) {
        $form_fields = get_transient('ittour_search_fields_empty');
    }

    if (!$form_fields) {
        $from_cities_array = get_option('ittour_from_cities');

        $form_fields = array(
            'from_city_summary' => ittour_get_from_city_summary_field($args, $from_cities_array),
            'select_from_city' => ittour_get_from_city_field($args, $from_cities_array),
            'list_from_city' => ittour_get_from_city_field($args, $from_cities_array, 'list'),

            'destination_summary' => ittour_get_destination_summary_field($params, $country_params, $args),
            'countries' =>  ittour_get_country_field($params, $args),
            'regions' =>  ittour_get_region_field($params, $args),
            'hotels' =>  ittour_get_hotel_field($params, $args),
            'hotel_ratings' =>  ittour_get_hotel_ratings_field($params, $args),

            'dates_summary' => ittour_get_dates_summary_field($params, $args),
            'dates_holder' => ittour_get_tour_dates_holder($args),
            'duration_holder' => ittour_get_tour_duration_holder($args),

            'guests_summary' => ittour_get_guests_summary_field($params, $args),

            'filter_summary' => ittour_get_filter_summary_field($params, $args),
            'filter_button' => ittour_get_filter_button($params, $args),
            'meal_types' =>  itour_get_meal_type_field($args),
            'price_limit' =>  ittour_get_price_limit_field($args),

            'tour_params' => $params,

            'from_city_excursion_summary' => ittour_get_from_city_excursion_summary_field($excursion_params, $args),
            'select_from_city_excursion' => ittour_get_from_city_excursion_field($excursion_params, $args),
            'list_from_city_excursion' => ittour_get_from_city_excursion_field($excursion_params, $args, 'list'),

            'destination_excursion_summary' => ittour_get_destination_excursion_summary_field($excursion_params, $args),
            'regions_excursion' =>  ittour_get_region_excursion_field($excursion_params, $args),
            'dates_excursion_summary' => ittour_get_dates_excursion_summary_field($excursion_params, $args),
            'countries_excursion' =>  ittour_get_country_excursion_field($excursion_params, $args),

            'filter_excursion_button' => ittour_get_filter_excursion_button($excursion_params, $args),
            'dates_excursion_holder' => ittour_get_excursion_dates_holder($args),
            'transport_types' =>  ittour_get_transport_type_field($args),
            'countries_req' =>  ittour_get_country_req_field($params, $args),

            'excursion_params' => $excursion_params,
        );

        if (empty($args)) {
            set_transient('ittour_search_fields_empty', $form_fields, 60 * 60 * 6);
        }
    }

    $ittour_get_form_fields = $form_fields;

    return $form_fields;
}

// Tour search
function ittour_get_from_city_summary_field($args, $from_cities_array) {
    $default_city = '2014'; // Kiev is default city

    if (empty($args) || empty($args['from_city'])) {
        $selected_city = $default_city;
    } else {
        $selected_city = $args['from_city'];
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
        if (empty($args['hotel']) && !empty($args['hotel_rating'])) {
            $hotel_name = '';

            $hotel_rating_array = explode(':', $args['hotel_rating']);

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
                    if ((int)$hotel['id'] === (int)$hotel_array[0]) {
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
                if ((int)$region['id'] === (int)$args['region']) {
                    $region_name = $region['name'];
                    continue;
                }
            }

            $value .= $region_name . ', ';
        }

        if (!empty($args['country']) && !empty($params['countries'])) {
            $country_name = '';

            foreach ($params['countries'] as $country) {
                if ((int)$country['id'] === (int)$args['country']) {
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

function ittour_get_dates_summary_field($params, $args) {
    $disabled_class = '';
    $field_status = ' readonly';

    if (empty($args['country']) || empty($params['countries'][$args['country']])) {
        $disabled_class = ' disabled-item';
        $field_status = ' disabled';
    }

    $date_from = $args['date_from'];
    $date_till = $args['date_till'];
    $night_from = $args['night_from'];
    $night_till = $args['night_till'];
    $dates_value = $date_from . ' - ' . $date_till . ', '.$night_from.' - '.$night_till.' ' . __('nights', 'snthwp');

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

function ittour_get_guests_summary_field($params, $args) {
    $disabled_class = '';
    $field_status = ' readonly';

    if (empty($args['country']) || empty($params['countries'][$args['country']])) {
        $disabled_class = ' disabled-item';
        $field_status = ' disabled';
    }

    if (empty($args['adult_amount'])) {
        $guests_value = '2';
    } else {
        $adults_amount = $args['adult_amount'];
        $guests_value = $adults_amount;

        if (!empty($args['child_amount']) && !empty($args['child_age'])) {
            $child_ages = explode(':', $args['child_age']);

            foreach ($child_ages as $key => $child_age) {
                $child_ages[$key] = $child_age . __('y', 'snthwp');
            }

            $guests_value .= ' + ' . $args['child_amount'] . ' ( ' . implode(' ', $child_ages) . ' )';
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

function ittour_get_filter_summary_field($params, $args) {
    $disabled_class = '';
    $field_status = ' readonly';

    if (empty($args['country']) || empty($params['countries'][$args['country']])) {
        $disabled_class = ' disabled-item';
        $field_status = ' disabled';
    }

    $field_value = '';

    if (empty($args)) {
        $field_value .= __('Plane', 'snthwp');
        $field_value .= ', UAI, AI, FB';
    } else {
        if (!empty($args['tour_type'])) {
            if ('1' === $args['tour_type']) {
                if (!empty($args['tour_kind'])) {
                    if ('1' === $args['tour_kind']) {
                        $field_value .= __('Plane', 'snthwp');
                    } else {
                        $field_value .= __('Bus', 'snthwp');
                    }
                } else {
                    $field_value .= __('Transit included', 'snthwp');
                }
            } elseif ('2' === $args['tour_type']) {
                $field_value = __('Transit not included', 'snthwp');
            }
        }

        if (!empty($args['meal_type'])) {
            $meal_types_array = explode(':', $args['meal_type']);

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

        if (!empty($args['price_limit'])) {
            $price_limit_array = explode(':', $args['price_limit']);

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
                <span class="btn btn-light"><i class="fas fa-sliders-h form-data-toggle-control-icon"></i></span>
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

function ittour_get_filter_button($params, $args) {
    $field_status = '';

    if (empty($args['country']) || empty($params['countries'][$args['country']])) {
        $field_status = ' disabled';
    }
    ob_start();
    ?>
    <button id="filter_options" type="button" class="btn form-data-summary form-data-toggle-control" data-form_toggle_target="filter-select__section"<?php echo $field_status; ?>>
        <i class="fas fa-sliders-h form-data-toggle-control-icon"></i>
    </button>
    <?php
    return ob_get_clean();
}

function ittour_get_tour_dates_holder($args) {
    $date_from = date('d.m.y', mktime(0, 0, 0, date('m'), date('d') + 1, date('Y')));
    $date_till = date('d.m.y', mktime(0, 0, 0, date('m'), date('d') + 7, date('Y')));
    $dates_data = ' data-date-from="'.$date_from.'" data-date-till="'.$date_till.'"';
    if (!empty($args['date_from']) && !empty($args['date_till'])) {
        $dates_data = ' data-date-from="'.$args['date_from'].'" data-date-till="'.$args['date_till'].'"';
    }
    ob_start();
    ittour_dates_holder($dates_data, $date_from, $date_till);
    return ob_get_clean();
}

function ittour_get_tour_duration_holder($args) {
    $night_from = '7';
    $night_till = '9';

    if (!empty($args['night_from']) &&!empty($args['night_till'])) {
        $night_from = $args['night_from'];
        $night_till = $args['night_till'];
    }
    ob_start();
    ittour_duration_holder($night_from, $night_till);
    return ob_get_clean();
}

function ittour_get_from_city_field($args, $from_cities_array, $template = 'select') {
    $from_city = !empty($args['from_city']) ? $args['from_city'] : '2014';

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

                if ($country_id && (int)$country['id'] === (int)$country_id) {
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

                    if (!empty($args['region']) && (int)$args['region'] === (int)$region['id']) {
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

// Excursion Tour search
function ittour_set_excursion_parameters($excursion_params, $args = array()) {
    $selected_from_city = $args['from_city_excursion'];
    $selected_country = !empty($args["country_excursion"]) ? explode(':', $args["country_excursion"]) : array();
    $selected_city = !empty($args["city"]) ? explode(':', $args["city"]) : array();

    $excursion_params['from_cities'] = ittour_get_destination_by_id($excursion_params["from_cities"]);
    $excursion_params['countries'] = ittour_get_destination_by_id($excursion_params["countries"]);
    $excursion_params['cities'] = ittour_get_destination_by_id($excursion_params["cities"]);
    $excursion_params['transport_types'] = ittour_get_destination_by_id($excursion_params["transport_types"]);

    foreach ($selected_country as $i => $sc) {
        if (empty($excursion_params['countries'][$sc])) {
            unset($selected_country[$i]);
        }
    }

    foreach ($selected_city as $i => $sc) {
        if (empty($excursion_params['cities'][$sc])) {
            unset($selected_city[$i]);
        }
    }

    $cities_from_dependencies = array();

    foreach ($excursion_params['from_cities'] as $from_city_id => $from_city) {
        if (!empty($from_city['country_id'])) {
            $countries_by_city_from = array();
            $country_ids = explode(',', $from_city['country_id']);

            foreach ($country_ids as $country_id) {
                $countries_by_city_from[$country_id] = $excursion_params['countries'][trim($country_id)];
            }

            $cities_from_dependencies[$from_city_id]['countries'] = $countries_by_city_from;
        }

        if (!empty($from_city['transport_id'])) {
            $transport_by_city_from = array();
            $transport_ids = explode(',', $from_city['transport_id']);

            foreach ($transport_ids as $transport_id) {
                $transport_by_city_from[$transport_id] = $excursion_params['transport_types'][trim($transport_id)];
            }

            $cities_from_dependencies[$from_city_id]['transport'] = $transport_by_city_from;
        }
    }

    foreach ($excursion_params['cities'] as $city_id => $city) {
        if (!empty($city['from_city_id'])) {
            $from_city_ids = explode(',', $city['from_city_id']);

            foreach ($from_city_ids as $from_city_id) {
                $cities_from_dependencies[$from_city_id]['countries'][$city['country_id']]['cities'][$city_id] = $city;
            }
        }
    }

    $excursion_params['cities_from_dependencies'] = $cities_from_dependencies;

    $excursion_params['selected_from_city'] = $selected_from_city;
    $excursion_params['selected_country'] = $selected_country;
    $excursion_params['selected_city'] = $selected_city;

    return $excursion_params;
}

function ittour_get_from_city_excursion_summary_field($params, $args) {
    $from_city = !empty($args['from_city_excursion']) ? $args['from_city_excursion'] : '2014';
    $from_cities_array = $params["from_cities"];
    ob_start();
    ?>
    <div id="from-city-excursion_summary__container" class="search-summary__container">
        <div class="input-group input-group__style-1">
            <div class="input-group-prepend">
            <span class="btn btn-light">
                <i class="fas fa-map-signs"></i>
            </span>
            </div>

            <input id="from-city-excursion_summary"
                   type="text"
                   class="form-control form-data-toggle-control"
                   data-form_toggle_target="from-city-excursion-select_section"
                   placeholder="" readonly
                   value="<?php echo __('city of departure', 'snthwp') . ' ' . $from_cities_array[$from_city]['name'] ?>"
            >
        </div>
    </div>
    <?php

    return ob_get_clean();
}

function ittour_get_destination_excursion_summary_field($params, $args = array()) {
    $value = '';
    if (!empty($args["country_excursion"])) {
        $country_array = explode(':', $args["country_excursion"]);

        foreach ($country_array as $country_id) {
            if (!empty($params["countries"][$country_id]) && !empty($params["countries"][$country_id]['name'])) {
                if (!empty($value)) {
                    $value .= ', ';
                }

                $value .= $params["countries"][$country_id]['name'];
            }
        }
    }

    ob_start();
    ?>
    <input type="hidden" id="cities_from_excursion_dependencies" value='<?php echo json_encode($params["cities_from_dependencies"], JSON_HEX_APOS) ?>'>
    <div id="destination-excursion_summary__container" class="search-summary__container">
        <div class="input-group input-group__style-1">
            <div class="input-group-prepend">
                <span class="btn"><i class="fas fa-map-marker-alt"></i></span>
            </div>

            <input id="destination_excursion_summary"
                   type="text"
                   class="form-control form-data-toggle-control"
                   data-form_toggle_target="destination-excursion-select_section"
                   placeholder="<?php echo __('Select Destination *', 'snthwp'); ?>"
                   value="<?php echo $value; ?>" readonly
            >
        </div>
    </div>
    <?php
    return ob_get_clean();
}

function ittour_get_country_excursion_field($params, $args = array()) {
    $city_from = $args['from_city_excursion'];
    $country_id = !empty($args['country_excursion']) ? $args['country_excursion'] : false;
    $country_array = array();

    if (!empty($country_id)) {
        $country_array = explode(':', $country_id);

        foreach ($country_array as $index => $cntr_id) {
            if (empty($params["cities_from_dependencies"][$city_from]['countries'][$cntr_id])) {
                unset($country_array[$index]);
            }
        }
    }

    ob_start();

        ?>
        <select id="country_excursion_select" name="country[]" class="form-control form-select2" style="width: 100%" multiple>
            <?php
            if (!empty($params['cities_from_dependencies'][$city_from]['countries'])) {
                foreach ($params['cities_from_dependencies'][$city_from]['countries'] as $id => $country) {
                    $selected = '';

                    if (!empty($country_array) && in_array($id, $country_array)) {
                        $selected .= ' selected';
                    }
                    ?>
                    <option value="<?php echo $id ?>"<?php echo $selected ?>><?php echo $country['name'] ?></option>
                    <?php
                }
            } else {
                ?>
                <option value=""><?php echo __('No tours from ', 'snthwp') . $params["from_cities"][$city_from]['name']; ?></option>
                <?php
            }
            ?>
        </select>
        <?php

    return ob_get_clean();
}

function ittour_get_region_excursion_field($params, $args = array()) {
    $city_from = $args['from_city_excursion'];
    $country_id = !empty($args['country_excursion']) ? $args['country_excursion'] : false;
    $city_id = !empty($args['city']) ? $args['city'] : false;

    $country_array = array();
    $cities_array = array();
    $city_array = array();

    if (!empty($country_id)) {
        $country_array = explode(':', $country_id);

        foreach ($country_array as $index => $cntr_id) {
            if (empty($params["cities_from_dependencies"][$city_from]['countries'][$cntr_id])) {
                unset($country_array[$index]);
            } else {
                if (!empty($params["cities_from_dependencies"][$city_from]['countries'][$cntr_id]['cities'])) {
                    foreach ($params["cities_from_dependencies"][$city_from]['countries'][$cntr_id]['cities'] as $ct_id => $city) {
                        $cities_array[$ct_id] = $city;
                    }
                }
            }
        }

        if (!empty($city_id)) {
            $city_array = explode(':', $city_id);

            foreach ($city_array as $index => $ct_id) {
                if (empty($cities_array[$ct_id])) {
                    unset($city_array[$index]);
                }
            }
        }
    }


    ob_start();
        ?>

        <select id="city_excursion_select" name="city[]" class="form-control form-select2" style="width: 100%" multiple>
            <?php
            if (!empty($cities_array)) {
                foreach ($cities_array as $city) {
                    if (!empty($country_array) && in_array($city['country_id'], $country_array)) {
                        $selected = '';

                        if (!empty($city_array) && in_array($city['id'], $city_array)) {
                            $selected .= ' selected';
                        }
                        ?>
                        <option value="<?php echo $city['id']; ?>"<?php echo $selected ?>><?php echo $city['name']; ?></option>
                        <?php
                    }
                }
            } else {
                ?>
                <option value=""><?php echo __('No tours from ', 'snthwp'); ?></option>
                <?php
            }
            ?>
        </select>
        <?php

    return ob_get_clean();
}

function ittour_get_dates_excursion_summary_field($params, $args = array()) {
    $disabled_class = '';
    $field_status = ' readonly';

    if (empty($params['selected_country'])) {
        $disabled_class = ' disabled-item';
        $field_status = ' disabled';
    }

    ob_start();
    ?>
    <div id="dates-excursion-duration_summary__container" class="search-summary__container<?php echo $disabled_class; ?>">
        <div class="input-group input-group__style-1">
            <div class="input-group-prepend">
            <span class="btn btn-light">
                <i class="far fa-calendar-alt"></i>
            </span>
            </div>

            <input id="dates-excursion-duration_summary"
                   type="text"
                   class="form-control form-data-toggle-control"
                   data-form_toggle_target="dates-excursion-select_section"
                   placeholder="<?php echo __('Dates / Duration *', 'snthwp') ?>"
                   value="<?php echo $args['date_excursion_from'] . ' - ' . $args['date_excursion_till'] ?>"<?php echo $field_status; ?>
            >
        </div>
    </div>
    <?php

    return ob_get_clean();
}

function ittour_get_excursion_dates_holder($args) {
    $date_from = date('d.m.y', mktime(0, 0, 0, date('m'), date('d') + 1, date('Y')));
    $date_till = date('d.m.y', mktime(0, 0, 0, date('m'), date('d') + 7, date('Y')));
    $dates_data = ' data-date-from="'.$date_from.'" data-date-till="'.$date_till.'"';
    if (!empty($args['date_excursion_from']) && !empty($args['date_excursion_till'])) {
        $dates_data = ' data-date-from="'.$args['date_excursion_from'].'" data-date-till="'.$args['date_excursion_till'].'"';
    }
    ob_start();
    ittour_dates_holder($dates_data, $date_from, $date_till, 'excursion-');
    return ob_get_clean();
}

function ittour_get_filter_excursion_button($params, $args) {
    $field_status = '';

    if (empty($args['country']) || empty($params['countries'][$args['country']])) {
        $field_status = ' disabled';
    }
    ob_start();
    ?>
    <button id="filter_excursion_options" type="button" class="btn form-data-summary form-data-toggle-control" data-form_toggle_target="filter-excursion-select__section"<?php echo $field_status; ?>>
        <i class="fas fa-sliders-h form-data-toggle-control-icon"></i>
    </button>
    <?php
    return ob_get_clean();
}

function ittour_get_from_city_excursion_field($params, $args, $template = 'select') {
    $from_city = !empty($args['from_city_excursion']) ? $args['from_city_excursion'] : '2014';

    ob_start();
    if ('select' === $template) {
        ?>
        <select class="form-control" name="from_city" id="from_excursion_city">
            <?php
            foreach ($params['from_cities'] as $city) {
                ?>
                <option value="<?php echo $city['id']; ?>"<?php echo $city['id'] == $from_city ? ' selected' : ''; ?>><?php echo $city['name']; ?></option>
                <?php
            }
            ?>
        </select>
        <?php
    } else {
        ?>
        <ul id="excursion_city_from_select_mobile" class="form-list">
            <?php
            foreach ($params['from_cities'] as $city) {
                ?>
                <li>
                    <input
                            id="from_city_excursion_<?php echo $city['id'] ?>"
                            class="iCheckGray styled_1"
                            type="checkbox"
                            value="<?php echo $city['id'] ?>"
                            data-summary="<?php echo __('departure from', 'snthwp') . ' ' . $city['name'] ?>"
                        <?php echo $city['id'] == $from_city ? ' checked' : ''; ?>
                    >
                    <label for="from_city_excursion_<?php echo $city['id'] ?>">
                        <?php echo $city['name'] ?>
                    </label>
                </li>
                <?php
            }
            ?>
        </ul>
        <?php
    }
    return ob_get_clean();
}

// Shared
function ittour_dates_holder($dates_data, $date_from, $date_till, $type = '') {
    ?>
    <div class="form-group">
        <label><?php echo __('Dates of start tour', 'snthwp') ?></label>
        <input id="date-<?php echo $type ?>pick__select" class="date-pick form-control" name="date" type="text" data-current_value="<?php echo $date_from . ' - ' . $date_till ?>"<?php echo $dates_data; ?> readonly="readonly">

        <div class="date-pick__select__container"></div>
    </div>
    <?php
}

function ittour_duration_holder($night_from, $night_till, $type = '') {
    ?>
    <div class="duration-holder">
        <label><?php echo __('Duration', 'snthwp') ?> (<?php echo __('nights', 'snthwp') ?>)</label>
        <div class="form-group">

            <div class="numbers-alt numbers-gor style_1" style="display: inline-block">
                <input
                        type="number"
                        value="<?php echo $night_from ?>"
                        id="duration-<?php echo $type ?>from__select"
                        class="qty2 form-control duration__select"
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
                        id="duration-<?php echo $type ?>till__select"
                        class="qty2 form-control duration__select"
                        name="night_till"
                        data-current_value="<?php echo $night_till ?>"
                        readonly="readonly"
                >
            </div>
        </div>
    </div>
    <?php
}

function ittour_get_country_req_field($params, $args = array()) {
    $country_id = !empty($args['country']) ? $args['country'] : false;

    ob_start();
    if (!empty($params['countries'])) {
        ?>
        <select id="country_req_select" name="country" class="form-control form-select2" style="width: 100%">
            <option></option>

            <?php
            foreach ($params['countries'] as $country) {
                $selected = '';

                if ($country_id && (int)$country['id'] === (int)$country_id) {
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

                if (!empty($args['hotel_rating'])) {
                    $hotel_ratings_array = explode(':', $args['hotel_rating']);
                    $hotel_rating_name = $hotel['hotel_rating_id'];

                    if ('7' === $hotel_rating_name) {
                        $hotel_rating_name = '2';
                    } elseif ('78' === $hotel_rating_name) {
                        $hotel_rating_name = '5';
                    }

                    if (!in_array($hotel['hotel_rating_id'], $hotel_ratings_array) && !in_array($hotel_rating_name, $hotel_ratings_array)) {
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

            if (!empty($args['hotel_rating'])) {
                $hotel_rating_array = explode(':', $args['hotel_rating']);

                if (in_array($hotel_rating['id'], $hotel_rating_array) || (!empty($hotel_rating['name']) && in_array($hotel_rating['name'], $hotel_rating_array))) {
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
                <label class="star-checkbox">
                    <input id="hotel_rating_<?php echo $hotel_rating['id'] ?>" type="checkbox" name="hotel_rating[]" value="<?php echo $hotel_rating['id'] ?>"<?php echo $selected ?>>
                    <span data-star="<?php echo $hotel_rating['name'] ?>"></span>
                </label>
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
    $price_limit = !empty($args['price_limit']) ? $args['price_limit'] : '';
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
        $kind = '';
    } else {
        if (!empty($args['tour_type'])) {
            $type = $args['tour_type'];

            if (!empty($args['tour_kind'])) {
                $kind = $args['tour_kind'];
            }
        }
    }

    ?>
    <label><?php echo __('Transport', 'snthwp') ?></label>

    <ul id="tour_type_select" class="form-list">
        <li>
            <input id="tour_type_included" class="styled_1" name="tour_type" type="radio" value="1"<?php echo 1 === (int)$type ? ' checked' : ''; ?>>
            <label for="tour_type_included"><?php echo __('Transit included', 'snthwp'); ?></label>
        </li>

        <li>
            <input id="tour_type_excluded" class="styled_1" name="tour_type" type="radio" value="2"<?php echo 2 === (int)$type ? ' checked' : ''; ?>>
            <label for="tour_type_excluded"><?php echo __('Transit not included', 'snthwp'); ?></label>
        </li>

        <li>
            <input id="tour_type_no" class="styled_1" name="tour_type" type="radio" value="" <?php echo '' === $type ? ' checked' : ''; ?>>
            <label for="tour_type_no"><?php echo __('Doesn\'t metter', 'snthwp'); ?></label>
        </li>
    </ul>

    <ul id="tour_kind_select" class="form-list"<?php echo !empty($type) && '2' !== $type ? '' : ' style="display:none;"' ?>>
        <li>
            <input id="tour_kind_flight" class="styled_1" name="tour_kind" type="radio" value="1"<?php echo 1 === (int)$kind ? ' checked' : ''; ?>>
            <label for="tour_kind_flight"><?php echo __('Plane', 'snthwp'); ?></label>
        </li>

        <li>
            <input id="tour_kind_bus" class="styled_1" name="tour_kind" type="radio" value="2"<?php echo 2 === (int)$kind ? ' checked' : ''; ?>>
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

function itour_get_meal_type_field($args = array()) {
    $meal_types = ittour_get_meal_types_array();

    if (empty($args)) {
        $selected_values = array('560', '512', '498', '496', '388', '1956');
    } else {
        if (!empty($args['meal_type'])) {
            $selected_values = explode(':', $args['meal_type']);
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

function ittour_get_flights_structured_data($flight_info_array) {
    $structured = array(
        'from' => array(),
        'to' => array(),
    );

    if (!empty($flight_info_array["from"])) {
        foreach ($flight_info_array["from"] as $flight_info) {
            $structured_val =   $flight_info['code'] . '{}'
                                     . $flight_info['air_company'] . '{}'
                                     . $flight_info['travel_class'] . '{}'
                                     . $flight_info['date_from'] . '{}'
                                     . $flight_info['time_from'] . '{}'
                                     . $flight_info['from_city'] . '{}'
                                     . $flight_info['from_airport'] . '{}'
                                     . $flight_info['date_till'] . '{}'
                                     . $flight_info['time_till'] . '{}'
                                     . $flight_info['to_city'] . '{}'
                                     . $flight_info['to_airport'] . '{}'
                                     . $flight_info['duration'];

            $txt_val =   $flight_info['code'] . ' - '
                              . $flight_info['air_company'] . ' - '
                              . $flight_info['travel_class'] . ' - '
                              . $flight_info['date_from'] . ' - '
                              . $flight_info['time_from'] . ' - '
                              . $flight_info['from_city'] . ' - '
                              . $flight_info['from_airport'] . ' - '
                              . $flight_info['date_till'] . ' - '
                              . $flight_info['time_till'] . ' - '
                              . $flight_info['to_city'] . ' - '
                              . $flight_info['to_airport'] . ' - '
                              . $flight_info['duration'];

            $json_val = json_encode($flight_info, JSON_FORCE_OBJECT);

            $structured['from'][] = array (
                'structured_val' => $structured_val,
                'txt_val' => $txt_val,
                'json_val' => $json_val,
            );
        }
    }

    if (!empty($flight_info_array["to"])) {
        foreach ($flight_info_array["to"] as $flight_info) {
            $structured_val =   $flight_info['code'] . '{}'
                                     . $flight_info['air_company'] . '{}'
                                     . $flight_info['travel_class'] . '{}'
                                     . $flight_info['date_from'] . '{}'
                                     . $flight_info['time_from'] . '{}'
                                     . $flight_info['from_city'] . '{}'
                                     . $flight_info['from_airport'] . '{}'
                                     . $flight_info['date_till'] . '{}'
                                     . $flight_info['time_till'] . '{}'
                                     . $flight_info['to_city'] . '{}'
                                     . $flight_info['to_airport'] . '{}'
                                     . $flight_info['duration'];

            $txt_val =   $flight_info['code'] . ' - '
                              . $flight_info['air_company'] . ' - '
                              . $flight_info['travel_class'] . ' - '
                              . $flight_info['date_from'] . ' - '
                              . $flight_info['time_from'] . ' - '
                              . $flight_info['from_city'] . ' - '
                              . $flight_info['from_airport'] . ' - '
                              . $flight_info['date_till'] . ' - '
                              . $flight_info['time_till'] . ' - '
                              . $flight_info['to_city'] . ' - '
                              . $flight_info['to_airport'] . ' - '
                              . $flight_info['duration'];

            $json_val = json_encode($flight_info, JSON_FORCE_OBJECT);

            $structured['to'][] = array (
                'structured_val' => $structured_val,
                'txt_val' => $txt_val,
                'json_val' => $json_val,
            );
        }
    }

    return $structured;
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
        case '78':
            $rating = '5*';
            break;
        default:
            $rating = false;
    }

    return $rating;
}

function ittour_get_tour_operator($form) {
    $form_string = $form;
    $operator_title = '';

    if (strpos($form_string, 'tpg.ua')) {
        $operator_title = 'TPG';
    } elseif (strpos($form_string, 'anextour.com.ua')) {
        $operator_title = 'Anex Tour';
    } elseif (strpos($form_string, 'joinup.ua')) {
        $operator_title = 'Join UP';
    } elseif (strpos($form_string, 'tui.ua')) {
        $operator_title = 'TUI';
    } elseif (strpos($form_string, 'coraltravel.com.ua')) {
        $operator_title = 'Coral Travel';
    } elseif (strpos($form_string, 'teztour.ua')) {
        $operator_title = 'TEZ Tour';
    } elseif (strpos($form_string, 'kompastour.com.ua')) {
        $operator_title = 'Kompas';
    } elseif (strpos($form_string, 'alf-ua.com')) {
        $operator_title = 'ALF';
    } elseif (strpos($form_string, 'mouzenidis-travel.ru')) {
        $operator_title = 'Mouzenidis';
    } elseif (strpos($form_string, 'pegast.com.ua')) {
        $operator_title = 'Pegas';
    } elseif (strpos($form_string, 'zeus.travel')) {
        $operator_title = 'Zeus Travel';
    }

    if (empty($operator_title)) {
        error_log($form);
        error_log('===============================================================');
        return '';
    }

    ob_start();
    ?>
    <li>
        <i class="fas fa-info list-item-icon"></i>
        <small><?php _e('Tour operator', 'snthwp'); ?>:</small>
        <strong><?php echo $operator_title ?></strong>
    </li>
    <?php

    return ob_get_clean();
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
    $search = ittour_search(ITTOUR_LANG);
    $search_result = $search->get($country, $args);

    if (is_wp_error($search_result)) {
        $search_result = array();
    }

    ob_start();
    $template_args = array('result' => $search_result, 'country_id' => $country);

    if (!empty($args['from_city'])) {
        $template_args['from_city'] = $args['from_city'];
    }

    ittour_show_template('search/tour-grid-default.php', $template_args);

    return ob_get_clean();
}

function ittour_get_tours_table_sort_by_date($country, $args = array()) {
    $search = ittour_search(ITTOUR_LANG);
    $search_result = $search->getList($country, $args);

    $country_info = ittour_destination_by_ittour_id($country);

    $main_currency = $country_info["main_currency"];

    if ('10' === $main_currency) {
        $main_currency_label = __('€', 'snthwp');
    } else if ('1' === $main_currency) {
        $main_currency_label = __('$', 'snthwp');
    } else if ('2' === $main_currency) {
        $main_currency_label = __('UAH', 'snthwp');
    }

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

    ksort($sort_date_array);

    ob_start();

    $i = 1;

    foreach ($sort_date_array as $date => $offers) {
        if (!empty($offers)) {
            ?>
            <div class="tour_list_container">
                <div id="tour_list_container-<?php echo $i; ?>" class="tour_list_container-inner card accordion_styled">
                    <div class="card-header">
                        <h5 class="mtb-0 font-weight-900">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#tour_list_container-<?php echo $i; ?>" href="#collapse_<?php echo $i; ?>_date">
                                <?php echo snth_convert_date_to_human($date); ?>
                                <i class="fas fa-plus float-right indicator"></i>
                            </a>
                        </h5>
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

                                                        <span><sup><?php echo $main_currency_label; ?></sup><strong><?php echo $offer['prices'][$main_currency] ?></strong></span>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6">
                                                    <div class="tour_list_more_button">
                                                        <a
                                                                href="/tour/<?php echo $offer['key'] ?>/<?php echo $args["from_city"] ?><?php echo !empty($args["child_age"]) ? '/' . $args["child_age"] : '' ?>"
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
                        class="search-btn start_search btn bg-success-color shape-rnd font-alt text-uppercase font-weight-900"
                        <?php echo $search_disabled ? ' disabled' : '';  ?>
                ><?php echo __('Search', 'snthwp') ?></button>
        </div>
    </div>
    <?php
}

function ittour_get_min_prices_by_month($country, $args) {
    $country_info = ittour_destination_by_ittour_id($country);

    $main_currency = $country_info["main_currency"];

    if ('10' === $main_currency) {
        $main_currency_label = __('€', 'snthwp');
    } else if ('1' === $main_currency) {
        $main_currency_label = __('$', 'snthwp');
    } else if ('2' === $main_currency) {
        $main_currency_label = __('UAH', 'snthwp');
    }

    $settings_key = '';
    $settings_key .= 'country_min_prices';
    $settings_key .= $country;
    $settings_key .= $args["type"];

    if (1 === $args["type"] && !empty($args["kind"])) {
        $settings_key .= $args["kind"];
    }

    $settings_key .= $args["night_from"];
    $settings_key .= $args["night_till"];
    $settings_key .= $args["adult_amount"];

    if (!empty($args["child_amount"])) {
        $settings_key .= $args["child_amount"];
        $settings_key .= $args["child_age"];
    } else {
        $settings_key .= '0';
    }

    $settings_key_hash = md5($settings_key);
    $saved_prices = get_transient('lp_' . $settings_key_hash);

    $show_months = 4;

    $months_array = array();

    $current_year = (int) date('Y');
    $current_month = (int) date('n');
    $current_day = date('j') + 1;
    $current_numbers_of_days = (int) date('t');

    $days_left = $current_numbers_of_days - $current_day;

    if (5 > $days_left) {
        $first_month = $current_month === 12 ? 1 : $current_month + 1;
        $first_year = $current_month === 12 ? $current_year + 1 : $current_year;

        $start_date_time = mktime(0, 0, 0, $first_month, 1, $first_year);
        $end_date_time = mktime(0, 0, 0, $first_month, 10, $first_year);
    } else {
        $first_month = $current_month;
        $first_year = $current_year;

        $start_date_time = mktime(0, 0, 0, $first_month, $current_day, $first_year);

        if (10 > $days_left) {
            $end_date_time = mktime(0, 0, 0, $first_month, $current_numbers_of_days, $first_year);
        } else {
            $end_date_time = mktime(0, 0, 0, $first_month, $current_day + 10, $first_year);
        }
    }

    $args['type'] = 1;
    $args['items_per_page'] = 1;

    $months_array[$first_month] = array(
        'year' => $first_year,
        'args' => $args,
        'results' => array(
            '78' => array(),
            '4' => array(),
            '3' => array(),
        ),
    );

    $months_array[$first_month]['args']['date_from'] = date('d.m.y', $start_date_time);
    $months_array[$first_month]['args']['date_till'] = date('d.m.y', $end_date_time);

    $prev_month = $first_month;
    $prev_year = $first_year;

    for ($i = 1; $i < $show_months; $i++) {
        $next_month = $prev_month === 12 ? 1 : $prev_month + 1;
        $next_year = $prev_month === 12 ? $prev_year + 1 : $prev_year;

        $start_date_time = mktime(0, 0, 0, $next_month, 1, $next_year);
        $end_date_time = mktime(0, 0, 0, $next_month, 10, $next_year);

        $months_array[$next_month] = array(
            'year' => $next_year,
            'args' => $args,
            'results' => array(
                '78' => array(),
                '4' => array(),
                '3' => array(),
            ),
        );

        $months_array[$next_month]['args']['date_from'] = date('d.m.y', $start_date_time);
        $months_array[$next_month]['args']['date_till'] = date('d.m.y', $end_date_time);

        $prev_month = $next_month;
        $prev_year = $next_year;
    }

    $search = ittour_search(ITTOUR_LANG);

    foreach ($months_array as $month => $params) {

        foreach ($params['results'] as $hotel_rating => $data) {
            $month_args = $params['args'];
            $month_args['hotel_rating'] = $hotel_rating;

            $search_result = $search->getList($country, $month_args);

            if (!is_wp_error($search_result) && !empty($search_result["offers"][0])) {
                $months_array[$month]['results'][$hotel_rating] = $search_result["offers"][0];
            }
        }
    }

    set_transient('lp_' . $settings_key_hash, $months_array, 60 * 60 * 12);

    ob_start();

    ?>
    <div class="row">
        <?php
        foreach($months_array as $month => $data) {
            ?>
            <div class="col-6 col-md-3">
                <h4 class="text-uppercase text-center font-weight-900 mb-20">
                    <?php echo ittour_get_month_by_number($month); ?>
                    <?php echo $data['year']; ?>
                </h4>

                <?php
                foreach ($data['results'] as $rating => $offer) {
                    ?>
                    <div class="row justify-content-center">
                        <div class="col-6 col-md-4 font-weight-900 font-alt">
                            <?php echo __('Hotels', 'snthwp') ?> <?php echo ittour_get_hotel_number_rating_by_id($rating) ?>
                        </div>

                        <div class="col-6 col-md-4">
                            <small><?php echo __('from', 'snthwp') ?></small>
                            <strong class="font-weight-900 font-alt">
                                <?php echo $offer['prices'][$main_currency] ?> <?php echo $main_currency_label ?>
                            </strong>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
            <?php
        }
        ?>
    </div>
    <?php

    return ob_get_clean();
}

function ittour_get_month_by_number($month, $format = '') {
    switch ((string) $month) {
        case '1':
        case '01':
            if ('genetive' === $format) {
                return __('of January', 'snthwp');
            }

            if ('short' === $format) {
                return __('Jan', 'snthwp');
            }

            return __('January', 'snthwp');

        case '2':
        case '02':
            if ('genetive' === $format) {
                return __('of February', 'snthwp');
            }

            if ('short' === $format) {
                return __('Feb', 'snthwp');
            }

            return __('February', 'snthwp');

        case '3':
        case '03':
            if ('genetive' === $format) {
                return __('of March', 'snthwp');
            }

            if ('short' === $format) {
                return __('Mar', 'snthwp');
            }

            return __('March', 'snthwp');

        case '4':
        case '04':
            if ('genetive' === $format) {
                return __('of April', 'snthwp');
            }

            if ('short' === $format) {
                return __('Apr', 'snthwp');
            }

            return __('April', 'snthwp');

        case '5':
        case '05':
            if ('genetive' === $format) {
                return __('of May', 'snthwp');
            }

            if ('short' === $format) {
                return __('May', 'snthwp');
            }

            return __('May', 'snthwp');

        case '6':
        case '06':
            if ('genetive' === $format) {
                return __('of June', 'snthwp');
            }

            if ('short' === $format) {
                return __('Jun', 'snthwp');
            }

            return __('June', 'snthwp');

        case '7':
        case '07':
            return __('July', 'snthwp');

        case '8':
        case '08':
            if ('genetive' === $format) {
                return __('of August', 'snthwp');
            }

            if ('short' === $format) {
                return __('Aug', 'snthwp');
            }

            return __('August', 'snthwp');

        case '9':
        case '09':
            if ('genetive' === $format) {
                return __('of September', 'snthwp');
            }

            if ('short' === $format) {
                return __('Sep', 'snthwp');
            }

            return __('September', 'snthwp');

        case '10':
            if ('genetive' === $format) {
                return __('of October', 'snthwp');
            }

            if ('short' === $format) {
                return __('Oct', 'snthwp');
            }

            return __('October', 'snthwp');

        case '11':
            if ('genetive' === $format) {
                return __('of November', 'snthwp');
            }

            if ('short' === $format) {
                return __('Nov', 'snthwp');
            }

            return __('November', 'snthwp');

        case '12':
            if ('genetive' === $format) {
                return __('of December', 'snthwp');
            }

            if ('short' === $format) {
                return __('Dec', 'snthwp');
            }

            return __('December', 'snthwp');
    }
}

function ittour_get_min_prices_by_country($country, $args = array()) {
    $saved_prices_by_rating = get_option('ittour_prices_by_rating');
    $time = time();
    $expiration_period = 60 * 60 * 6;

    $url = '/search/';
    $url .= '?from_city=2014';
    $url .= '&country=' . $country;
    $url .= '&region=';
    $url .= '&tour_type=' . $args['type'];
    $url .= '&tour_kind=' . $args['kind'];
    $url .= '&adult_amount=2';
    $url .= '&night_from=' . $args['night_from'];
    $url .= '&night_till=' . $args['night_till'];
    $url .= '&price_limit=';
    $url .= '&price_limit_from=';
    $url .= '&price_limit_till=';

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
        $search = ittour_search(ITTOUR_LANG);

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
            $search_link = $url . '&hotel_rating[]=' .  $rating;
            ?>
            <div class="row">
                <div class="col-6 font-weight-900 font-alt">
                    <?php echo __('Hotels', 'snthwp') ?> <?php echo ittour_get_hotel_number_rating_by_id($rating) ?>
                </div>
                <div class="col-6">
                    <small><?php echo __('from', 'snthwp') ?></small>
                    <a href="<?php echo $search_link ?>" class="font-weight-900 font-alt">
                        <?php echo $price ?> <?php echo __('uah.', 'snthwp') ?>
                    </a>
                </div>
            </div>
            <?php
        }
    }

    return ob_get_clean();
}

function ittour_get_min_prices_by_region($country, $args = array()) {
    error_log(date('H:i:s'));
    $saved_prices_by_rating = ittour_get_region_prices_by_rating($country);
    // $saved_prices_by_rating_region = get_option('ittour_prices_by_rating_' . $country . '_' . $args['region']);
    $time = time();
    $expiration_period = 60 * 60 * 6;

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
        $search = ittour_search(ITTOUR_LANG);

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

        // $saved_prices_by_rating = get_option('ittour_prices_by_rating', array()); // Updated array

        $prices_array = array(
            'prices' => $prices_by_rating,
            'expired'   => $time + $expiration_period
        );

        $updated_prices_by_rating_region = update_option('ittour_prices_by_rating_' . $country . '_' . $args['region'], $prices_array);

//        $saved_prices_by_rating[$args['region']] = $prices_array;
//        $updated_prices_by_rating = update_option('ittour_prices_by_rating', $saved_prices_by_rating);
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
                                    <a href="/tour/<?php echo $offer['key'] ?>" class="btn_1 small"><?php echo __('Details', 'snthwp'); ?></a>
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

function ittour_get_destination_by_id($array) {
    $array_by_id = array();

    foreach ($array as $item) {
        if (!empty($item['id'])) {
            $array_by_id[$item['id']] = $item;
        }
    }

    return $array_by_id;
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

                    $offer_html = '<br>' . __('from', 'snthwp') . ' <a href="/tour/'.$first_offer['key'].'">' . $first_offer['prices'][2] . '</a>';
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

function ittour_excursion_get_transport_by_id($id) {
    switch ($id) {
        case 1:
            $transport = array(
                'icon' => 'fas fa-plane',
                'label' => __('Plane', 'snthwp'),
            );
            break;
        case 2:
            $transport = array(
                'icon' => 'fas fa-bus',
                'label' => __('Bus', 'snthwp'),
            );
            break;
        case 3:
            $transport = array(
                'icon' => 'fas fa-train',
                'label' => __('Train', 'snthwp'),
            );
            break;
        case 5:
            $transport = array(
                'icon' => 'fas fa-walking',
                'label' => __('Walking', 'snthwp'),
            );
            break;
        default:
            $transport = array();
    }

    return $transport;
}