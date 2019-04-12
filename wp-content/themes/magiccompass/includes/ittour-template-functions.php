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

function ittour_get_form_fields() {
    $params_obj = ittour_params();
    $params = $params_obj->get();

    if (is_wp_error( $params )) {
        return $params->get_error_message();
    }

    return array(
        'countries' =>  itour_get_country_field($params),
        'regions' =>  itour_get_region_field($params),
        'hotel_ratings' =>  itour_get_hotel_ratings_field($params),
        'transport_types' =>  itour_get_transport_type_field($params),
    );
}

function itour_get_hotel_ratings_field($params) {
    ob_start();
    ?>
    <ul class="form-list">
        <?php
        foreach ($params['hotel_ratings'] as $hotel_rating) {
            ?>
            <li>
                <label>
                    <input class="iCheckGray" type="checkbox" value="<?php echo $hotel_rating['id'] ?>"> <?php echo $hotel_rating['name'] ?>*
                </label>
            </li>
            <?php
        }
        ?>
    </ul>
    <?php
    return ob_get_clean();
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

function itour_get_transport_type_field($params) {
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
    $meal_types = array(
        560 => ''
    );
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

function itour_get_country_field($params) {

    ob_start();
    if (!empty($params['countries'])) {
        ?>
        <select id="country_select" name="country" class="form-control">
            <option value=""><?php echo __('Select country', 'snthwp'); ?></option>

            <?php
            foreach ($params['countries'] as $country) {
                ?>
                <option value="<?php echo $country['id'] ?>"><?php echo $country['name'] ?></option>
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

function itour_get_region_field($params) {
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

        <select id="region_select" name="region" class="form-control">
            <option value=""><?php echo __('Select country first', 'snthwp'); ?></option>
        </select>
        <?php
    } else {
        ?>
        <input type="text" placeholder="Country" class="form-control" name="country" required>
        <?php
    }

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