<?php
/**
 * Created by PhpStorm.
 * User: snth
 * Date: 17.09.18
 * Time: 19:37
 */


function ittour_ajax_validate_tour() {
    $main_currency = '10';

    if(isset($_POST['key'])) $key = sanitize_key( $_POST['key'] );
    if(isset($_POST['currency'])) $main_currency = sanitize_key( $_POST['currency'] );

    if ('10' === $main_currency) {
        $main_currency_label = __('€', 'snthwp');
    } else if ('1' === $main_currency) {
        $main_currency_label = __('$', 'snthwp');
    } else if ('2' === $main_currency) {
        $main_currency_label = __('UAH', 'snthwp');
    }

    $tour = ittour_tour($key, ITTOUR_LANG);
    $tour_info = $tour->validate();
    // $tour_flights_info = $tour->flights();

    set_transient('ittour_validated_' . $key, 1, 10 * 60);
    $tour_validated_timeout = time() + (10 * 60);
    $counter_date = get_date_from_gmt( date( 'Y-m-d H:i:s', $tour_validated_timeout ), 'Y/m/d H:i:s' );

    $tour_on_stop = false;

    if (!empty($tour_info["stop_sale"]) || $tour_info["stop_flight"]) $tour_on_stop = true;

    $price_fragment = ittour_get_template('single-tour/price.php', array(
        'tour_on_stop' => $tour_on_stop,
        'price_uah' => $tour_info["prices"][2],
        'price_currency' => $tour_info["prices"][$main_currency],
        'main_currency_label' => $main_currency_label,
    ));

    $validation_fragment = ittour_get_template('single-tour/validation-timeout.php', array('counter_date' => $counter_date ));

    $message = array(
        'fragments' => array(
            '#single-tour-price__holder' => $price_fragment,
            '#validation-spinner__holder' => $validation_fragment,
            '#validation-timeout__holder' => $validation_fragment,
            '#price_uah' => '<input id="price_uah" type="hidden" name="price_uah" value="'.$tour_info["prices"][2].'">',
            '#price_usd' => '<input id="price_usd" type="hidden" name="price_usd" value="'.$tour_info["prices"][1].'">',
            '#price_euro' => '<input id="price_euro" type="hidden" name="price_euro" value="'.$tour_info["prices"][10].'">',
        ),
    );

    if ($tour_on_stop) {
        $tour_not_actual_message_fragment = ittour_get_template('single-tour/tour-not-actual-message.php', array(
            'tour_outdated' => false,
            'tour_stop_sale' => $tour_info["stop_sale"],
            'tour_stop_flight' => $tour_info["stop_flight"],
        ));

        $message['fragments']['#open-booking-btn_holder'] = $tour_not_actual_message_fragment;
        $message['fragments']['#tour-not-actual-message_holder'] = $tour_not_actual_message_fragment;
    } else {
        $open_booking_button = ittour_get_template('single-tour/open-booking-btn.php', array('tour_need_to_validate' => false));

        $message['fragments']['#tour-not-actual-message_holder'] = $open_booking_button;
        $message['fragments']['#open-booking-btn_holder'] = $open_booking_button;
    }

    echo json_encode(array( 'success' => 1, 'error' => 0, 'message' => $message ));

    die;
}
add_action('wp_ajax_nopriv_ittour_ajax_validate_tour', 'ittour_ajax_validate_tour');
add_action('wp_ajax_ittour_ajax_validate_tour', 'ittour_ajax_validate_tour');

function ittour_ajax_load_single_tour() {
    if(isset($_POST['key'])) {
        $key = sanitize_key( $_POST['key'] );
    }

    $tour = ittour_tour($key, ITTOUR_LANG);
    $tour_info = $tour->info();

    ob_start();
    ?>
    <?php ittour_show_template('single-tour/content.php', array('tour_info' => $tour_info)); ?>
    <?php
    $tour_content = ob_get_clean();

    $message = array(
        'fragments' => array(
            '.single-tour__content' => $tour_content,
        ),
    );

    echo json_encode(array( "status" => 'success', 'message' => $message ));

    die;
}
add_action('wp_ajax_nopriv_ittour_ajax_load_single_tour', 'ittour_ajax_load_single_tour');
add_action('wp_ajax_ittour_ajax_load_single_tour', 'ittour_ajax_load_single_tour');

function ittour_ajax_load_search_form() {
    unset($_POST['action']);

    $args = $_POST;


    ob_start();
    ittour_show_template('form/search-tab.php', array('args' => $args));
    $search_form_content = ob_get_clean();

    $message = array(
        'fragments' => array(
            '.search-form__holder' => $search_form_content,
        ),
    );

    echo json_encode(array( 'success' => 1, 'error' => 0, 'message' => $message ));

    die;
}
add_action('wp_ajax_nopriv_ittour_ajax_load_search_form', 'ittour_ajax_load_search_form');
add_action('wp_ajax_ittour_ajax_load_search_form', 'ittour_ajax_load_search_form');

function ittour_ajax_get_tours_list() {
    error_log('=========================================');
    error_log(date('H:i:s'));
    $country            = !empty($_POST['country']) ? (int) sanitize_text_field($_POST['country'])  : false;

    $type               = !empty($_POST['type']) ? (int) sanitize_text_field($_POST['type']) : false;
    $kind               = !empty($_POST['kind']) ? (int) sanitize_text_field($_POST['kind']) : false;
    $from_city          = !empty($_POST['fromCity']) ? (int) sanitize_text_field($_POST['fromCity']) : false;
    $region             = !empty($_POST['region']) ? sanitize_text_field($_POST['region'])  : false;
    $hotel              = !empty($_POST['hotel']) ? sanitize_text_field($_POST['hotel']) : false;
    $hotel_rating       = !empty($_POST['hotelRating']) ? sanitize_text_field($_POST['hotelRating']) : false;
    $adult_amount       = !empty($_POST['adultAmount']) ? (int) sanitize_text_field($_POST['adultAmount']) : false;
    $child_amount       = !empty($_POST['child_amount']) ? (int) sanitize_text_field($_POST['child_amount']) : false;
    $child_age          = !empty($_POST['child_age']) ? sanitize_text_field($_POST['child_age']) : false;
    $night_from         = !empty($_POST['nightFrom']) ? (int) sanitize_text_field($_POST['nightFrom']) : false;
    $night_till         = !empty($_POST['nightTill']) ? (int) sanitize_text_field($_POST['nightTill']) : false;
    $date_from          = !empty($_POST['dateFrom']) ? sanitize_text_field($_POST['dateFrom']) : false;
    $date_till          = !empty($_POST['dateTill']) ? sanitize_text_field($_POST['dateTill']) : false;
    $meal_type          = !empty($_POST['mealType']) ? sanitize_text_field($_POST['mealType']) : false;
    $price_from         = !empty($_POST['priceFrom']) ? (int) sanitize_text_field($_POST['priceFrom']) : false;
    $price_till         = !empty($_POST['priceTill']) ? (int) sanitize_text_field($_POST['priceTill']) : false;
    $page               = !empty($_POST['page']) ? (int) sanitize_text_field($_POST['page']) : false;
    $items_per_page     = !empty($_POST['itemsPerPage']) ? (int) sanitize_text_field($_POST['itemsPerPage']) : false;
    $prices_in_group    = !empty($_POST['pricesInGroup']) ? (int) sanitize_text_field($_POST['pricesInGroup']) : false;

    $template           = !empty($_POST['template']) ? sanitize_text_field($_POST['template']) : 'grid';

    $args = array();

    if ($type)              $args['type']               = $type;
    if ($kind)              $args['kind']               = $kind;
    if ($from_city)         $args['from_city']          = $from_city;
    if ($region)            $args['region']             = $region;
    if ($hotel)             $args['hotel']              = $hotel;
    if ($hotel_rating)      $args['hotel_rating']       = $hotel_rating;
    if ($adult_amount)      $args['adult_amount']       = $adult_amount;
    if ($child_amount)      $args['child_amount']       = $child_amount;
    if ($child_age)         $args['child_age']          = $child_age;
    if ($night_from)        $args['night_from']         = $night_from;
    if ($night_till)        $args['night_till']         = $night_till;
    if ($date_from)         $args['date_from']          = $date_from;
    if ($date_till)         $args['date_till']          = $date_till;
    if ($meal_type)         $args['meal_type']          = $meal_type;
    if ($price_from)        $args['price_from']         = $price_from;
    if ($price_till)        $args['price_till']         = $price_till;
    if ($page)              $args['page']               = $page;
    if ($items_per_page)    $args['items_per_page']     = $items_per_page;
    if ($prices_in_group)   $args['prices_in_group']    = $prices_in_group;
    if ($template)          $args['template']           = $template;

    if ('grid' === $template) {
        $result = ittour_get_tours_grid($country, $args);
    } elseif ('table-sort-by-date' === $template) {
        $result = ittour_get_tours_table_sort_by_date($country, $args);
    } elseif ('min-prices-by-region' === $template) {
        $result = ittour_get_min_prices_by_region($country, $args);
    } elseif ('min-prices-by-country' === $template) {
        $result = ittour_get_min_prices_by_country($country, $args);
    } elseif ('min-prices-by-month' === $template) {
        $result = ittour_get_min_prices_by_month($country, $args);
    }


    error_log(date('H:i:s'));
    error_log('=========================================');

    echo json_encode(array( 'success' => 1, 'error' => 0, 'message' => $result ));

    die;
}
add_action('wp_ajax_nopriv_ittour_ajax_get_tours_list', 'ittour_ajax_get_tours_list');
add_action('wp_ajax_ittour_ajax_get_tours_list', 'ittour_ajax_get_tours_list');

function ittour_ajax_get_tours_list_multiple() {
    $parameters = $_POST['parameters'];

    $new_params = $parameters;

    echo json_encode(array( 'success' => 1, 'error' => 0, 'message' => 'done' ));

    die;
}
add_action('wp_ajax_nopriv_ittour_ajax_get_tours_list_multiple', 'ittour_ajax_get_tours_list_multiple');
add_action('wp_ajax_ittour_ajax_get_tours_list_multiple', 'ittour_ajax_get_tours_list_multiple');

function ittour_ajax_load_select_child() {
    ob_start();

    ittour_show_template('form/search-select-child-amount.php');

    $html = ob_get_clean();

    echo json_encode(array( "status" => 'success', 'html' => $html ));

    die;
}
add_action('wp_ajax_nopriv_ittour_ajax_load_select_child', 'ittour_ajax_load_select_child');
add_action('wp_ajax_ittour_ajax_load_select_child', 'ittour_ajax_load_select_child');

function ittour_ajax_get_country_parameters() {

    if(empty($_POST['country_id'])) {
        echo json_encode(array( "status" => 'success', 'message' => 'Select country first' ));
    }

    $country_id = sanitize_key( $_POST['country_id'] );
    $country = $country_id;

    $args = array();

    $region = '';
    if (!empty($_POST['region'])) {
        $args['region'] = sanitize_key( $_POST['region'] );
        $region = '_' . sanitize_key( $_POST['region'] );
    }

    // $params = get_transient('ittour_country_search_params_' . $country . $region);

    if (empty($params)) {
        $params_obj = ittour_params();
        $params = $params_obj->getCountry($country_id, $args);

        set_transient('ittour_country_search_params_' . $country . $region, $params, 60 * 60 * 12);
    }

    echo json_encode(array( "status" => 'success', 'message' => $params ));

    die;
}
add_action('wp_ajax_nopriv_ittour_ajax_get_country_parameters', 'ittour_ajax_get_country_parameters');
add_action('wp_ajax_ittour_ajax_get_country_parameters', 'ittour_ajax_get_country_parameters');

function ittour_ajax_load_hotel_tour_calendar() {
    $month = !empty($_POST['month']) ? $_POST['month'] : false;
    $year = !empty($_POST['year']) ? $_POST['year'] : false;
    $country_id = !empty($_POST['country']) ? $_POST['country'] : false;
    $hotel_id = !empty($_POST['hotelId']) ? $_POST['hotelId'] : false;
    $hotel_rating = !empty($_POST['hotelRating']) ? $_POST['hotelRating'] : false;

    $hotel_calendar = ittour_get_hotel_tours_calendar($country_id, $hotel_id, $hotel_rating, $month, $year);

    $response = array('success' => 1, 'error' => 0, 'message' => array(
        'table_html' => $hotel_calendar['table_html']
    ));

    echo json_encode($response);

    wp_die();
}
add_action('wp_ajax_nopriv_ittour_ajax_load_hotel_tour_calendar', 'ittour_ajax_load_hotel_tour_calendar');
add_action('wp_ajax_ittour_ajax_load_hotel_tour_calendar', 'ittour_ajax_load_hotel_tour_calendar');

function ittour_ajax_load_hotel_tours_table() {
    $month = !empty($_POST['month']) ? $_POST['month'] : false;
    $year = !empty($_POST['year']) ? $_POST['year'] : false;
    $country_id = !empty($_POST['country']) ? $_POST['country'] : false;
    $hotel_id = !empty($_POST['hotelId']) ? $_POST['hotelId'] : false;
    $hotel_rating = !empty($_POST['hotelRating']) ? $_POST['hotelRating'] : false;

    $hotel_calendar = ittour_get_hotel_tours_section($country_id, $hotel_id, $hotel_rating);

    $response = array('success' => 1, 'error' => 0, 'message' => array(
        'table_html' => $hotel_calendar['table_html']
    ));

    echo json_encode($response);

    wp_die();
}
add_action('wp_ajax_nopriv_ittour_ajax_load_hotel_tours_table', 'ittour_ajax_load_hotel_tours_table');
add_action('wp_ajax_ittour_ajax_load_hotel_tours_table', 'ittour_ajax_load_hotel_tours_table');

/**
 * Add Single Ittour country
 */
function ajax_admin_add_country() {
    $ittour_id = !empty($_POST['ittourId']) ? $_POST['ittourId'] : false;
    $post_id = !empty($_POST['postId']) ? $_POST['postId'] : false;
    $ittour_name = !empty($_POST['ittourName']) ? $_POST['ittourName'] : false;
    $ittour_slug = !empty($_POST['ittourSlug']) ? $_POST['ittourSlug'] : false;
    $ittour_iso = !empty($_POST['ittourIso']) ? $_POST['ittourIso'] : false;
    $ittour_group = !empty($_POST['ittourGroup']) ? $_POST['ittourGroup'] : false;
    $ittour_type = !empty($_POST['ittourType']) ? $_POST['ittourType'] : false;
    $ittour_transport = !empty($_POST['ittourTransport']) ? $_POST['ittourTransport'] : false;
    $ittour_currency = !empty($_POST['ittourCurrency']) ? $_POST['ittourCurrency'] : false;

    if (!$ittour_id) {
        $response = array('success' => 0, 'error' => 1, 'message' => __('No ITTour ID', 'wp2leads'));
        echo json_encode($response);

        wp_die();
    }

    if (!$ittour_name) {
        $response = array('success' => 0, 'error' => 1, 'message' => __('No ITTour Name', 'wp2leads'));
        echo json_encode($response);

        wp_die();
    }

    if (!$ittour_slug) {
        $response = array('success' => 0, 'error' => 1, 'message' => __('No ITTour Slug', 'wp2leads'));
        echo json_encode($response);

        wp_die();
    }

    if ($post_id) {
        $post_created = ittour_update_country($post_id, $ittour_name, $ittour_slug, $ittour_id, $ittour_iso, $ittour_group, $ittour_type, $ittour_transport, $ittour_currency);
    } else {
        $post_created = ittour_create_country($ittour_name, $ittour_slug, $ittour_id, $ittour_iso, $ittour_group, $ittour_type, $ittour_transport, $ittour_currency);
    }

    $params_obj = ittour_params();
    $params = $params_obj->getCountry($ittour_id);

    $from_cities_array = get_option('ittour_from_cities');

    if (empty($from_cities_array)) {
        $from_cities_array = array();
    }

    foreach ($params['from_cities'] as $from_city) {
        if (!empty($from_cities_array[$from_city['id']])) {

        } else {
            $from_cities_array[$from_city['id']] = array(
                'name' => $from_city['name'],
                'genitive_case' => $from_city['genitive_case']
            );
        }
    }

    $option_added = update_option( 'ittour_from_cities', $from_cities_array );

    $response = array('success' => 1, 'error' => 0, 'message' => __('Success', 'wp2leads'));

    echo json_encode($response);
    wp_die();
}
add_action( 'wp_ajax_ittour_ajax_admin_add_country', 'ajax_admin_add_country' );

/**
 * Add Single Ittour country
 */
function ajax_admin_add_region() {

    $ittour_id = !empty($_POST['ittourId']) ? $_POST['ittourId'] : false;
    $post_id = !empty($_POST['postId']) ? $_POST['postId'] : false;
    $parent_id = !empty($_POST['parentId']) ? $_POST['parentId'] : false;
    $ittour_name = !empty($_POST['ittourName']) ? $_POST['ittourName'] : false;
    $ittour_country_id = !empty($_POST['ittourCountryId']) ? $_POST['ittourCountryId'] : false;
    $ittour_slug = !empty($_POST['ittourSlug']) ? $_POST['ittourSlug'] : false;
    $ittour_type = !empty($_POST['ittourType']) ? $_POST['ittourType'] : false;

    if (!$ittour_id) {
        $response = array('success' => 0, 'error' => 1, 'message' => __('No ITTour ID', 'wp2leads'));
        echo json_encode($response);

        wp_die();
    }

    if (!$ittour_name) {
        $response = array('success' => 0, 'error' => 1, 'message' => __('No ITTour Name', 'wp2leads'));
        echo json_encode($response);

        wp_die();
    }

    if (!$ittour_slug) {
        $response = array('success' => 0, 'error' => 1, 'message' => __('No ITTour Slug', 'wp2leads'));
        echo json_encode($response);

        wp_die();
    }

    if ($post_id) {
        $post_created = ittour_update_region($post_id, $ittour_name, $ittour_slug, $ittour_id, $ittour_type, $ittour_country_id, $parent_id);
    } else {
        $post_created = ittour_create_region($ittour_name, $ittour_slug, $ittour_id, $ittour_type, $ittour_country_id, $parent_id);
    }

    $response = array('success' => 1, 'error' => 0, 'message' => __('Success', 'wp2leads'));

    echo json_encode($response);
    wp_die();
}
add_action( 'wp_ajax_ittour_ajax_admin_add_region', 'ajax_admin_add_region' );

/**
 * Add Single Ittour country
 */
function ajax_admin_add_hotel() {
    $ittour_id = !empty($_POST['ittourId']) ? $_POST['ittourId'] : false;
    $parent_id = !empty($_POST['parentId']) ? $_POST['parentId'] : false;
    $post_id = !empty($_POST['postId']) ? $_POST['postId'] : false;
    $ittour_name = !empty($_POST['ittourName']) ? $_POST['ittourName'] : false;
    $ittour_rating = !empty($_POST['ittourRating']) ? $_POST['ittourRating'] : false;
    $ittour_country_id = !empty($_POST['ittourCountryId']) ? $_POST['ittourCountryId'] : false;
    $ittour_region_id = !empty($_POST['ittourRegionId']) ? $_POST['ittourRegionId'] : false;
    $ittour_slug = !empty($_POST['ittourSlug']) ? $_POST['ittourSlug'] : false;
    $ittour_type = !empty($_POST['ittourType']) ? $_POST['ittourType'] : false;

    if (!$ittour_id) {
        $response = array('success' => 0, 'error' => 1, 'message' => __('No ITTour ID', 'wp2leads'));
        echo json_encode($response);

        wp_die();
    }

    if (!$ittour_name) {
        $response = array('success' => 0, 'error' => 1, 'message' => __('No ITTour Name', 'wp2leads'));
        echo json_encode($response);

        wp_die();
    }

    if (!$ittour_slug) {
        $response = array('success' => 0, 'error' => 1, 'message' => __('No ITTour Slug', 'wp2leads'));
        echo json_encode($response);

        wp_die();
    }

    if ($post_id) {
        $post_created = ittour_update_hotel($post_id, $ittour_name, $ittour_slug, $ittour_id, $ittour_rating, $ittour_type, $ittour_country_id, $ittour_region_id, $parent_id);
    } else {
        $post_created = ittour_create_hotel($ittour_name, $ittour_slug, $ittour_id, $ittour_rating, $ittour_type, $ittour_country_id, $ittour_region_id, $parent_id);
    }

    $response = array('success' => 1, 'error' => 0, 'message' => __('Success', 'wp2leads'));

    echo json_encode($response);
    wp_die();
}
add_action( 'wp_ajax_ittour_ajax_admin_add_hotel', 'ajax_admin_add_hotel' );

/**
 * Excursions tours Ajax handlers
 */


function ajax_load_excursion_tour_dates() {
    $key = !empty($_POST['key']) ? sanitize_text_field($_POST['key']) : false;
    $date_from = !empty($_POST['date_from']) ? (int) sanitize_text_field($_POST['date_from']) / 1000 : false;
    $date_till = !empty($_POST['date_till']) ? (int) sanitize_text_field($_POST['date_till']) / 1000 : false;

    $start_date = $date_from;
    $end_date = $date_till;

    if (empty($key) && empty($date_from) && empty($date_till)) {
        echo json_encode(array( 'success' => 1, 'error' => 0, 'message' => __('No dates available', 'snthwp') ));

        die;
    }

    $dates = get_transient( 'ittour_excursion_tour_dates_' . $key );
    $dates_till = get_transient( 'ittour_excursion_tour_dates_till' . $key );

    $now = time();

    if ($date_from < $now) {
        $date_from = $now;
    }

    $max_date = $date_from + (60 * 60 * 24 * 29);

    if ($max_date < $date_till) {
        $date_till = $max_date;
    }

    if (empty($dates)) {
        $args = array(
            'date_from' => date('d.m.y', $date_from),
            'date_till' => date('d.m.y', $date_till),
        );

        $tour = ittour_excursion_tour($key, ITTOUR_LANG);
        $tour_info = $tour->info($args);

        if (is_wp_error($tour_info)) {
            echo json_encode(array( 'success' => 1, 'error' => 0, 'message' => __('No dates available', 'snthwp') ));

            die;
        }

        if (empty($tour_info['dates'])) {
            echo json_encode(array( 'success' => 1, 'error' => 0, 'message' => __('No dates available', 'snthwp') ));

            die;
        }

        $dates = $tour_info['dates'];

        set_transient( 'ittour_excursion_tour_dates_' . $key, $dates, 60 * 60 * 3);
        set_transient( 'ittour_excursion_tour_dates_till' . $key, $date_till, 60 * 60 * 3);
    }

    ob_start();
    foreach ($dates as $date) {
        $tour_date = snth_convert_date_format($date["date_from"]);
        ?>
        <a href="<?php echo get_site_url(); ?>/excursion-tour/<?php echo $key ?>/<?php echo $tour_date ?>/<?php echo $tour_date ?>/" class="btn size-xs shape-rnd type-hollow hvr-invert">
            <i class="far fa-calendar-alt"></i> <?php echo snth_convert_date_to_human($date["date_from"]); ?>
        </a>
        <?php
    }

    if ($end_date > $date_till) {
        ?>
        <span class="btn btn-success size-xs shape-rnd type-hollow hvr-invert load-more-dates">
            <?php echo __('More', 'snthwp'); ?>...
        </span>
        <?php
    }
    $dates_list = ob_get_clean();

    $message = array(
        'dates' => $dates_list,
    );

    $response = array('success' => 1, 'error' => 0, 'message' => $message);

    echo json_encode($response);

    wp_die();
}

add_action('wp_ajax_nopriv_ittour_ajax_load_excursion_tour_dates', 'ajax_load_excursion_tour_dates');
add_action('wp_ajax_ittour_ajax_load_excursion_tour_dates', 'ajax_load_excursion_tour_dates');