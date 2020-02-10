<?php
/**
 * Created by PhpStorm.
 * User: snth
 * Date: 17.09.18
 * Time: 19:37
 */

function ittour_api_init() {
    if (defined('ITTOUR_SLAVE')) {
        include_once ITTOUR_DIR . '/class.ittourMCApi.php';
    } else {
        include_once ITTOUR_DIR . '/class.ittourApi.php';
    }
}

function ittour_params($lang = 'ru') {
    ittour_api_init();

    include_once ITTOUR_DIR . '/class.ittourParamsApi.php';

    return new ittourParamsApi($lang);
}

function ittour_search($lang = 'ru') {
    ittour_api_init();

    include_once ITTOUR_DIR . '/class.ittourSearchApi.php';

    return new ittourSearchApi($lang);
}

function ittour_tour($key, $lang = 'ru') {
    ittour_api_init();

    include_once ITTOUR_DIR . '/class.ittourTourApi.php';

    return new ittourTourApi($key, $lang);
}

function ittour_hotel($hotel_id, $lang = 'ru') {
    ittour_api_init();

    include_once ITTOUR_DIR . '/class.ittourHotelApi.php';

    return new ittourHotelApi($hotel_id, $lang);
}

function ittour_excursion_params($lang = 'ru') {
    ittour_api_init();

    include_once ITTOUR_DIR . '/class.ittourExcursionParamsApi.php';

    return new ittourExcursionParamsApi($lang);
}

function ittour_excursion_search($lang = 'ru') {
    ittour_api_init();

    include_once ITTOUR_DIR . '/class.ittourExcursionSearchApi.php';

    return new ittourExcursionSearchApi($lang);
}

function ittour_excursion_tour($key, $lang = 'ru') {
    ittour_api_init();

    include_once ITTOUR_DIR . '/class.ittourExcursionTourApi.php';

    return new ittourExcursionTourApi($key, $lang);
}

add_action('init', 'ittour_rewrite_rule');
/**
 * Add rewrite rule for a pattern matching "post-by-slug/<post_name>"
 */
function ittour_rewrite_rule() {
    // countries/[country_slug]/[region_slug]/[hotel_slug]/tour/[tour_id]/[from_city]/[child_age]
    add_rewrite_rule(
        '^countries/(.*)/([^/]*)/([^/]*)/tour/([^/]*)/([^/]*)/([^/]*)/?',
        'index.php?country=$matches[1]&region=$matches[2]&hotel=$matches[3]&tour=$matches[4]&from_city=$matches[5]&child_age=$matches[6]',
        'top'
    );
    add_rewrite_rule(
        '^countries/(.*)/([^/]*)/([^/]*)/tour/([^/]*)/([^/]*)/?',
        'index.php?country=$matches[1]&region=$matches[2]&hotel=$matches[3]&tour=$matches[4]&from_city=$matches[5]',
        'top'
    );
    add_rewrite_rule(
        '^countries/(.*)/([^/]*)/([^/]*)/tour/([^/]*)/?',
        'index.php?country=$matches[1]&region=$matches[2]&hotel=$matches[3]&tour=$matches[4]',
        'top'
    );
    add_rewrite_tag( '%country%', '(.*)' );
    add_rewrite_tag( '%region%', '(.*)' );
    add_rewrite_tag( '%hotel%', '(.*)' );
    add_rewrite_tag( '%tour%', '(.*)' );
    add_rewrite_tag( '%from_city%', '(.*)' );
    add_rewrite_tag( '%child_age%', '(.*)' );


    add_rewrite_rule('^tour/(.*)/([^/]*)/([^/]*)/?', 'index.php?tour=$matches[1]&from_city=$matches[2]&child_age=$matches[3]', 'top');
    add_rewrite_rule('^tour/(.*)/([^/]*)/?', 'index.php?tour=$matches[1]&from_city=$matches[2]', 'top');
    add_rewrite_rule('^tour/(.*)/?', 'index.php?tour=$matches[1]', 'top');
    add_rewrite_tag( '%tour%', '(.*)' );
    add_rewrite_tag( '%from_city%', '(.*)' );
    add_rewrite_tag( '%child_age%', '(.*)' );

    add_rewrite_rule('^excursion-tour/([^/]*)/([^/]*)/([^/]*)/?', 'index.php?excursion-tour=$matches[1]&date_from=$matches[2]&date_till=$matches[3]', 'top');
    add_rewrite_rule('^excursion-tour/([^/]*)/?', 'index.php?excursion-tour=$matches[1]', 'top');
    add_rewrite_tag( '%excursion-tour%', '(.*)' );
    add_rewrite_tag( '%date_from%', '(.*)' );
    add_rewrite_tag( '%date_till%', '(.*)' );

    // add_rewrite_rule('^download-csv/(.*)/([^/]*)/([^/]*)/?', 'index.php?tour=$matches[1]&from_city=$matches[2]&child_age=$matches[3]', 'top');
    // add_rewrite_rule('^download-csv/(.*)/([^/]*)/?', 'index.php?tour=$matches[1]&from_city=$matches[2]', 'top');
    add_rewrite_rule('^download-file/(.*)/([^/]*)/([^/]*)/?', 'index.php?file_format=$matches[1]&only_mail=$matches[2]&tag_id=$matches[3]', 'top');
    add_rewrite_rule('^download-file/(.*)/?', 'index.php?file_format=$matches[1]', 'top');
    add_rewrite_tag( '%file_format%', '(.*)' );
    add_rewrite_tag( '%only_mail%', '(.*)' );
    add_rewrite_tag( '%tag_id%', '(.*)' );
}

add_action( 'template_redirect', function() {
    $file_format = get_query_var( 'file_format' );

    if ($file_format) {
        $_GET['file_format'] = $file_format;

        $only_mail = get_query_var( 'only_mail' );
        $tag_id = get_query_var( 'tag_id' );

        if ($only_mail) {
            $_GET['only_mail'] = $only_mail;
        } else {
            $_GET['only_mail'] = 'no';
        }

        if ($tag_id) {
            $_GET['tag_id'] = $tag_id;
        } else {
            $_GET['tag_id'] = 'no';
        }

        include SNTH_DIR . '/templates/download.php';
        die;
    }


    $key = get_query_var( 'tour' );

    if ( $key ) {
        include SNTH_DIR . '/templates/tour.php';
        die;
    }

    $key = get_query_var( 'excursion-tour' );

    if ( $key ) {
        include SNTH_DIR . '/templates/excursion-tour.php';
        die;
    }
} );

add_action("wp", "ittour_set_global_variable");

function ittour_set_global_variable() {
    global $ittour_global_tour_result;
    global $ittour_global_form_args;
    global $ittour_global_template_args;

    $ittour_global_tour_result = array();
    $ittour_global_form_args = array();
    $ittour_global_template_args = array();

    ittour_set_default_global_search_form_params();

    $request_uri = $_SERVER['REQUEST_URI'];
    if (false !== strpos($request_uri, '/excursion-search')) {
        ittour_set_global_excursion_search_result();
    } elseif (false !== strpos($request_uri, '/search')) {
        ittour_set_global_tour_search_result();
    } elseif ($key = get_query_var( 'tour' )) { // Single tour page
        ittour_set_global_single_tour($key);
    } elseif ($key = get_query_var( 'excursion-tour' )) { // Single excursion tour page
        ittour_set_global_single_excursion_tour($key);
    }

    ittour_set_global_form_fields();
}

function ittour_set_global_form_fields() {
    global $ittour_global_form_args;
    global $ittour_global_form_fields;

    $ittour_global_form_fields = ittour_get_form_fields($ittour_global_form_args);
}

function ittour_set_global_tour_search_result() {
    global $ittour_global_tour_result;
    global $ittour_global_form_args;
    global $ittour_global_template_args;

    $country_id = !empty($_GET['country']) ? sanitize_text_field($_GET['country']) : false;
    $parameters = $_GET;

    if (!$country_id) { // Open new search page

        if (!empty($parameters)) {
            $ittour_global_tour_result['error'] = 'no_country';
        } else {
            $ittour_global_tour_result['error'] = 'no_parameters';
        }
    } else {
        $ittour_global_form_args['country'] = $country_id;
        $ittour_global_template_args['country_id'] = $country_id;
        $ittour_global_template_args = array_merge($ittour_global_template_args, get_tour_main_currency($country_id));

        $args = array();

        if (!empty($_GET['region'])) {
            $region = sanitize_text_field($_GET['region']);
            $args['region'] = $region;
            $ittour_global_form_args['region'] = $region;
            $ittour_global_template_args['region_id'] = $region;
        }

        if (!empty($_GET['from_city'])) {
            $from_city = sanitize_text_field($_GET['from_city']);
            $args['from_city'] = $from_city;
            $ittour_global_form_args['from_city'] = $from_city;
            $ittour_global_template_args['from_city'] = $from_city;
        }

        if (!empty($_GET['adult_amount'])) {
            $adult_amount = sanitize_text_field($_GET['adult_amount']);
            $args['adult_amount'] = $adult_amount;
            $ittour_global_form_args['adult_amount'] = $adult_amount;
        }

        if (!empty($_GET['child_amount'])) {
            $args['child_amount'] = count($_GET['child_amount']);
            $args['child_age'] = implode(':', $_GET['child_amount']);
            $ittour_global_form_args['child_amount'] = $args['child_amount'];
            $ittour_global_form_args['child_age'] = $args['child_age'];
            $ittour_global_template_args['child_age'] = $args['child_age'];
        }

        if (!empty($_GET['hotel'])) {
            if (is_array($_GET['hotel'])) {
                $hotel = array();

                foreach ($_GET['hotel'] as $key => $id) {
                    $hotel[$key] = sanitize_text_field($id);
                }

                $hotel = implode(':', $hotel);
            } elseif (is_string($_GET['hotel']) || is_integer($_GET['hotel'])) {
                $hotel = sanitize_text_field($_GET['hotel']);
            }

            if (!empty($hotel)) {
                $args['hotel'] = $hotel;
                $ittour_global_form_args['hotel'] = $hotel;
            }
        }

        if (!empty($_GET['hotel_rating'])) {
            if (is_array($_GET['hotel_rating'])) {
                $hotel_rating = array();

                foreach ($_GET['hotel_rating'] as $key => $id) {
                    $hotel_rating[$key] = sanitize_text_field($id);
                }

                $hotel_rating = implode(':', $hotel_rating);
            } elseif (is_string($_GET['hotel_rating']) || is_integer($_GET['hotel_rating'])) {
                $hotel_rating = sanitize_text_field($_GET['hotel_rating']);
            }

            if (!empty($hotel_rating)) {
                $args['hotel_rating'] = $hotel_rating;
                $ittour_global_form_args['hotel_rating'] = $hotel_rating;
            }
        }

        if (!empty($_GET['date']) && is_string($_GET['date'])) {
            $dates = explode('-', sanitize_text_field($_GET['date']));

            if (2 === count($dates)) {
                $date_from = trim($dates[0]);
                $date_till = trim($dates[1]);

                $now = time();

                $date_from_timestamp = snth_convert_date_format($date_from, $format_from = 'd.m.y', $format_to = 'U');
                $date_till_timestamp = snth_convert_date_format($date_till, $format_from = 'd.m.y', $format_to = 'U');

                if ((int)$now > (int)$date_from_timestamp || (int)$now > (int)$date_till_timestamp) {
                    $ittour_global_tour_result['error'] = __('Tour dates must be more or equal to the current date.', 'snthwp');
                } else {
                    $args['date_from'] = $date_from;
                    $args['date_till'] = $date_till;

                    $ittour_global_form_args['date_from'] = $date_from;
                    $ittour_global_form_args['date_till'] = $date_till;

//                    $ittour_global_form_args['date_excursion_from'] = $date_from;
//                    $ittour_global_form_args['date_excursion_till'] = $date_till;
                }
            }
        }

        $tour_nights = get_tour_nights();
        $args = array_merge($args, $tour_nights);
        $ittour_global_form_args = array_merge($ittour_global_form_args, $tour_nights);

        if (!empty($_GET['meal_type'])) {
            if (is_array($_GET['meal_type'])) {
                $meal_type = array();

                foreach ($_GET['meal_type'] as $key => $id) {
                    $meal_type[$key] = sanitize_text_field($id);
                }

                $meal_type = implode(':', $meal_type);
            } elseif (is_string($_GET['meal_type']) || is_integer($_GET['meal_type'])) {
                $meal_type = sanitize_text_field($_GET['meal_type']);
            }

            if (!empty($meal_type)) {
                $args['meal_type'] = $meal_type;
                $ittour_global_form_args['meal_type'] = $meal_type;
            }
        }

        // Price Limit
        if (!empty($_GET['price_limit'])) {
            $price_limit = false;

            if ('custom' === $_GET['price_limit']) {
                $price_from = !empty($_GET["price_limit_from"]) ? $_GET["price_limit_from"] : false;
                $price_till = !empty($_GET["price_limit_till"]) ? $_GET["price_limit_till"] : false;

                if ($price_from || $price_till) {
                    $price_limit = 'custom';

                    if ($price_from) $price_limit .= ':f-' . $price_from;
                    if ($price_till) $price_limit .= ':t-' . $price_till;
                }

            } else {
                $price_limit_array = explode(':', $_GET['price_limit']);

                $price_from = !empty($price_limit_array[0]) ? $price_limit_array[0] : false;
                $price_till = !empty($price_limit_array[1]) ? $price_limit_array[1] : false;

                $price_limit = $_GET['price_limit'];
            }

            if ($price_from) {
                $args['price_from'] = $price_from;
                $ittour_global_form_args['price_from'] = $price_from;
            }

            if ($price_till) {
                $args['price_till'] = $price_till;
                $ittour_global_form_args['price_till'] = $price_till;
            }

            $ittour_global_form_args['price_limit'] = $price_limit;
        }

        if (!empty($_GET['tour_type'])) {
            $tour_type = sanitize_text_field($_GET['tour_type']);
            $args['type'] = $tour_type;
            $ittour_global_form_args['tour_type'] = $tour_type;

            if ('2' !== $tour_type && !empty($_GET['tour_kind'])) {
                $tour_kind = sanitize_text_field($_GET['tour_kind']);
                $args['kind'] = $tour_kind;
                $ittour_global_form_args['tour_kind'] = $tour_kind;
            }
        }

        if (!empty($_GET['search_page'])) {
            $page = sanitize_text_field($_GET['search_page']);
            $args['page'] = $page;
            unset($_GET['search_page']);
        }

        $url = http_build_query($_GET);
        $ittour_global_template_args['url'] = $url;

        if (empty($ittour_global_tour_result['error'])) {
            $search = ittour_search(ITTOUR_LANG);
            $search_result = $search->get($country_id, $args);

            if (is_wp_error($search_result)) {
                $ittour_global_tour_result['result'] = $search_result;
                $ittour_global_template_args['result'] = $search_result;
            } else {
                $ittour_global_tour_result['result'] = $search_result;
                $ittour_global_template_args['result'] = $search_result;
            }
        } else {
            $ittour_global_tour_result['result'] = array();
            $ittour_global_template_args['result'] = array();
        }
    }
}

function ittour_set_global_excursion_search_result() {
    global $ittour_global_tour_result;
    global $ittour_global_form_args;
    global $ittour_global_template_args;

    $allowed_parameters = get_excursion_allowed_parameters();
    $allowed_parameters_keys = array_keys($allowed_parameters);

    $country_id = !empty($_GET['country']) ? $_GET['country'] : false;
    $parameters = $_GET;

    if (empty($country_id)) {
        foreach ($parameters as $parameter_field => $parameter_value) {
            if (!in_array($parameter_field, $allowed_parameters_keys)) {
                unset($parameters[$parameter_field]);
            }
        }

        if (!empty($parameters)) {
            $ittour_global_tour_result['error'] = 'no_country';
        } else {
            $ittour_global_tour_result['error'] = 'no_parameters';
        }
    } elseif (!is_array($country_id)) {
        $ittour_global_tour_result['error'] = 'wrong_country_format';
    } else {
        $ittour_global_template_args = array_merge($ittour_global_template_args, get_tour_main_currency());
        // Set search country
        foreach ($country_id as $key => $id) {
            $country_id[$key] = sanitize_text_field($id);
        }

        $country_id_string = implode(':', $country_id);
        $ittour_global_form_args['country_excursion'] = $country_id_string;

        // Set Search results
        $args = array();

        // City
        $city_id = !empty($_GET['city']) ? $_GET['city'] : false;

        if (!empty($city_id && is_array($city_id))) {
            foreach ($city_id as $key => $id) {
                $city_id[$key] = sanitize_text_field($id);
            }

            $city_id_string = implode(':', $city_id);

            if (!empty($city_id_string)) {
                $args['city'] = $city_id_string;
                $ittour_global_form_args['city'] = $city_id_string;
            }
        }

        // Dates
        if (!empty($_GET['date'])) {
            $dates = explode('-', $_GET['date']);

            $date_from = trim($dates[0]);
            $date_till = trim($dates[1]);

            $now = time();

            $date_from_timestamp = snth_convert_date_format($date_from, $format_from = 'd.m.y', $format_to = 'U');
            $date_till_timestamp = snth_convert_date_format($date_till, $format_from = 'd.m.y', $format_to = 'U');

            if ((int)$now > (int)$date_from_timestamp || (int)$now > (int)$date_till_timestamp) {
                $ittour_global_tour_result['error'] = __('Tour dates must be more or equal to the current date.', 'snthwp');
            } else {
                $args['date_from'] = $date_from;
                $args['date_till'] = $date_till;

                $ittour_global_form_args['date_excursion_from'] = $date_from;
                $ittour_global_form_args['date_excursion_till'] = $date_till;
            }

        }

        if (!empty($_GET['night_moves'])) {
            $night_moves = !empty($_GET['night_moves']) ? $_GET['night_moves'] : false;

            if (!empty($night_moves)) {
                $args['night_moves'] = $night_moves;
                $ittour_global_form_args['night_moves'] = $night_moves;
            }
        }

        if (!empty($_GET['transport_type'])) {
            $transport_type = !empty($_GET['transport_type']) ? $_GET['transport_type'] : false;

            $transport_type_string = $transport_type;

            if (!empty($transport_type_string)) {
                $args['transport_type'] = $transport_type_string;
                $ittour_global_form_args['transport_type_excursion'] = $transport_type_string;
            }
        }

        if (!empty($_GET['from_city'])) {
            $args['from_city'] = sanitize_text_field($_GET['from_city']);
            $ittour_global_form_args['from_city_excursion'] = $args['from_city'];
        }

        if (!empty($_GET['search_page'])) {
            $args['page'] = $_GET['search_page'];
            unset($_GET['search_page']);
        }

        $url = http_build_query($_GET);
        $ittour_global_template_args['url'] = $url;

        if (empty($ittour_global_tour_result['error'])) {
            $search = ittour_excursion_search(ITTOUR_LANG);
            $search_result = $search->get($country_id_string, $args);

            if (is_wp_error($search_result)) {
                $ittour_global_tour_result['result'] = $search_result;
                $ittour_global_template_args['result'] = $search_result;
            } else {
                $ittour_global_tour_result['result'] = $search_result;
                $ittour_global_template_args['result'] = $search_result;
            }
        } else {
            $ittour_global_tour_result['result'] = array();
            $ittour_global_template_args['result'] = array();
        }

    }
}

function ittour_set_global_single_tour($key) {
    $_GET['key'] = $key;

    $from_city = get_query_var( 'from_city' );

    if (!empty($from_city)) {
        $_GET['from_city'] = $from_city;
    }

    $child_age = get_query_var( 'child_age' );

    if (!empty($child_age)) {
        $_GET['child_age'] = $child_age;
    }

    global $ittour_global_tour_result;

    if (empty($_GET['key'])) {
        $ittour_global_tour_result['error'] = 'no_key';
    } else {
        $tour_key = $_GET['key'];
        $tour = ittour_tour($tour_key, ITTOUR_LANG);
        $tour_info = $tour->info();

        if (is_wp_error($tour_info)) {

        } else {
            $ittour_global_tour_result['result'] = $tour_info;
        }
    }
}

function ittour_set_global_single_excursion_tour($key) {
    $date_from = get_query_var( 'date_from' );
    $date_till = get_query_var( 'date_till' );

    $_GET['key'] = $key;
    $_GET['date_from'] = $date_from;
    $_GET['date_till'] = $date_till;

    global $ittour_global_tour_result;

    if (empty($_GET['key'])) {
        $ittour_global_tour_result['error'] = 'no_key';
    } else {
        $tour_key = $_GET['key'];
        $tour = ittour_excursion_tour($tour_key, ITTOUR_LANG);
        $date_from = !empty($_GET['date_from']) ? sanitize_text_field($_GET['date_from']) : false;
        $date_till = !empty($_GET['date_till']) ? sanitize_text_field($_GET['date_till']) : false;
        $hikes = !empty($_GET['hikes']) ? sanitize_text_field($_GET['hikes']) : true;
        $includes = !empty($_GET['includes']) ? sanitize_text_field($_GET['includes']) : true;
        $desc = !empty($_GET['desc']) ? sanitize_text_field($_GET['desc']) : 'day_detail';

        $args = array();

        if ($date_from) $args['date_from']  = $date_from;
        if ($date_till) $args['date_till']  = $date_till;
        if ($hikes) $args['hikes']  = $hikes;
        if ($includes) $args['includes']  = $includes;
        if ($desc) $args['desc']  = $desc;

        $excursion_db = ittour_get_excursion_by_ittour_key($tour_key);
        $tour_info = $tour->info($args);

        $tour_currency = '2';
        $tour_currency_label = __('UAH', 'snthwp');
        $local_currency = $tour_currency;
        $local_currency_label = $tour_currency_label;

        if (is_wp_error($tour_info)) {
            if (!empty($excursion_db)) {
                $post_id = $excursion_db[0]->ID;
                $tour_info_db = get_field('ittour_info', $post_id);

                if (!empty($tour_info_db)) {
                    $tour_info = unserialize($tour_info_db);

                    $tour_info['ittour_date_from'] = get_field('ittour_date_from', $post_id);
                    $tour_info['ittour_date_till'] = get_field('ittour_date_till', $post_id);
                    $ittour_currency_id = get_field('ittour_currency_id', $post_id);

                    if (!empty($ittour_currency_id)) {
                        $tour_currency = $ittour_currency_id;

                        if ('10' === $tour_currency) {
                            $tour_currency_label = __('€', 'snthwp');
                        } else if ('1' === $tour_currency) {
                            $tour_currency_label = __('$', 'snthwp');
                        }
                    }

                    if (!empty($tour_info["countries"])) {
                        $countries = array();
                        $countries_id = array();

                        foreach ($tour_info["countries"] as $country) {
                            if (!empty($country['name'])) $countries[] = $country['name'];
                            if (!empty($country['id'])) $countries_id[] = $country['id'];
                        }

                        if (!empty($countries)) {
                            $countries = implode(', ', $countries);
                            $tour_info['country_name_list'] = $countries;
                        }

                        if (!empty($countries_id)) {
                            $countries_id = implode(', ', $countries_id);
                            $tour_info['country_id_list'] = $countries_id;
                        }
                    }

                    if (!empty($tour_info["cities"])) {
                        $cities = array();
                        $cities_id = array();

                        foreach ($tour_info["cities"] as $city) {
                            if (!empty($city['name'])) $cities[] = $city['name'];
                            if (!empty($city['id'])) $cities_id[] = $city['id'];
                        }

                        if (!empty($cities)) {
                            $cities = implode(',', $cities);
                            $tour_info['city_name_list'] = $cities;
                        }

                        if (!empty($cities_id)) {
                            $cities_id = implode(',', $cities_id);
                            $tour_info['city_id_list'] = $cities_id;
                        }
                    }

                    $tour_info['local_currency'] = $local_currency;
                    $tour_info['local_currency_label'] = $local_currency_label;
                    $tour_info['tour_currency'] = $tour_currency;
                    $tour_info['tour_currency_label'] = $tour_currency_label;
                    $ittour_global_tour_result['result'] = $tour_info;
                }
            }
        } else {
            if (!empty($excursion_db)) {
                $post_id = $excursion_db[0]->ID;
                $post_id = ittour_update_excursion_info($post_id, serialize($tour_info));

                $tour_info['ittour_date_from'] = get_field('ittour_date_from', $post_id);
                $tour_info['ittour_date_till'] = get_field('ittour_date_till', $post_id);
                $ittour_currency_id = get_field('ittour_currency_id', $post_id);

                if (!empty($ittour_currency_id)) {
                    $tour_currency = $ittour_currency_id;

                    if ('10' === $tour_currency) {
                        $tour_currency_label = __('€', 'snthwp');
                    } else if ('1' === $tour_currency) {
                        $tour_currency_label = __('$', 'snthwp');
                    }
                }

                if (!empty($tour_info["countries"])) {
                    $countries = array();
                    $countries_id = array();

                    foreach ($tour_info["countries"] as $country) {
                        if (!empty($country['name'])) $countries[] = $country['name'];
                        if (!empty($country['id'])) $countries_id[] = $country['id'];
                    }

                    if (!empty($countries)) {
                        $countries = implode(', ', $countries);
                        $tour_info['country_name_list'] = $countries;
                    }

                    if (!empty($countries_id)) {
                        $countries_id = implode(', ', $countries_id);
                        $tour_info['country_id_list'] = $countries_id;
                    }
                }

                if (!empty($tour_info["cities"])) {
                    $cities = array();
                    $cities_id = array();

                    foreach ($tour_info["cities"] as $city) {
                        if (!empty($city['name'])) $cities[] = $city['name'];
                        if (!empty($city['id'])) $cities_id[] = $city['id'];
                    }

                    if (!empty($cities)) {
                        $cities = implode(', ', $cities);
                        $tour_info['city_name_list'] = $cities;
                    }

                    if (!empty($cities_id)) {
                        $cities_id = implode(', ', $cities_id);
                        $tour_info['city_id_list'] = $cities_id;
                    }
                }
            }

            $tour_info['local_currency'] = $local_currency;
            $tour_info['local_currency_label'] = $local_currency_label;
            $tour_info['tour_currency'] = $tour_currency;
            $tour_info['tour_currency_label'] = $tour_currency_label;

            $ittour_global_tour_result['result'] = $tour_info;
        }
    }
}

function ittour_set_default_global_search_form_params() {
    global $ittour_global_form_args;

    $date_from = date('d.m.y', mktime(0, 0, 0, date('m'), date('d') + 1, date('Y')));
    $date_till = date('d.m.y', mktime(0, 0, 0, date('m'), date('d') + 7, date('Y')));
    $night_from = '7';
    $night_till = '9';

//    $ittour_global_form_args['hotel_rating'] = '78:4';
    $ittour_global_form_args['from_city'] = '2014'; // 30419 - 1, 753 - 9, 2014
    $ittour_global_form_args['adult_amount'] = '2';
    $ittour_global_form_args['meal_type'] = '560:512:498:496:388:1956';

    $ittour_global_form_args['date_from'] = $date_from;
    $ittour_global_form_args['date_till'] = $date_till;

    $ittour_global_form_args['night_from'] = $night_from;
    $ittour_global_form_args['night_till'] = $night_till;

    $ittour_global_form_args['tour_type'] = '';
    $ittour_global_form_args['tour_kind'] = '';

    $ittour_global_form_args['date_excursion_from'] = $date_from;
    $ittour_global_form_args['date_excursion_till'] = $date_till;

    $ittour_global_form_args['from_city_excursion'] = '2014'; // 30419 - 1, 753 - 9, 2014

    if (is_single()) {
        if ( get_post_type() === 'destination' ) {
            global $post;
            $post_id = $post->ID;
            $destination_type = wp_get_post_terms( $post_id, 'destination_type' )[0]->slug;

            if ('country' === $destination_type) {
                $country_id = get_field('ittour_id', $post_id);
            } elseif ('region' === $destination_type) {
                $region_id = get_field('ittour_id', $post_id);
                $country_id = get_field('ittour_country_id', $post_id);
            }
        }

        if (!empty($country_id)) {
            $ittour_global_form_args['country'] = $country_id;
            $ittour_global_form_args['country_excursion'] = $country_id;

            if (!empty($region_id)) {
                $ittour_global_form_args['region'] = $region_id;
                $ittour_global_form_args['city'] = $region_id;
            }
        }
    }
}

function get_tour_nights($type = 'tour') {
    if (!empty($_GET['night_from']) && empty($_GET['night_till'])) {
        $night_from = sanitize_text_field($_GET['night_from']);
        $night_till = $night_from;
    } elseif (empty($_GET['night_from']) && !empty($_GET['night_till'])) {
        $night_till = sanitize_text_field($_GET['night_till']);
        $night_from = $night_till;
    } else {
        $night_from = '7';
        $night_till = '9';
    }

    return array(
        'night_from' => $night_from,
        'night_till' => $night_till
    );
}

function get_tour_main_currency($country_id = false) {
    if ($country_id) {
        $country_info = ittour_destination_by_ittour_id(sanitize_text_field($country_id));

        $main_currency = $country_info["main_currency"];
    } else {
        $main_currency = '10';
    }

    if ('10' === $main_currency) {
        $main_currency_label = __('€', 'snthwp');
    } else if ('1' === $main_currency) {
        $main_currency_label = __('$', 'snthwp');
    } else {
        $main_currency_label = __('UAH', 'snthwp');
    }

    return array(
        'main_currency_label' => $main_currency_label,
        'main_currency' => $main_currency,
    );
}