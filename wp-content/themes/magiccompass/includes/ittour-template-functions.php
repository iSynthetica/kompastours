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
        'adult_amount' =>  itour_get_adult_amount_field($params),
    );
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
            $regions_by_countries[$region['country_id']][] = array(
                'id' => $region['id'],
                'name' => $region['name']
            );
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