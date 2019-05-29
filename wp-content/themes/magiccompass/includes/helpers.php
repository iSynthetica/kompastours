<?php
/**
 * Helpers library
 *
 * @package Hooka/Includes
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Get current request type
 *
 * @param $type
 *
 * @return bool
 */
function snth_is_request( $type )
{
    switch ( $type ) {
        case 'admin' :
            return is_admin();
        case 'ajax' :
            return defined( 'DOING_AJAX' );
        case 'cron' :
            return defined( 'DOING_CRON' );
        case 'frontend' :
            return ( ! is_admin() || defined( 'DOING_AJAX' ) ) && ! defined( 'DOING_CRON' );
    }
}

/**
 * Show templates passing attributes and including the file.
 *
 * @param string $template_name
 * @param array $args
 * @param string $template_path
 */
function snth_show_template($template_name, $args = array(), $template_path = 'parts')
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
function snth_get_template($template_name, $args = array(), $template_path = 'parts')
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
function snth_locate_template($template_name, $template_path = 'parts')
{
    if (!$template_path) {
        $template_path = 'parts';
    }

    $template = locate_template(
        array(
            trailingslashit($template_path) . $template_name,
            $template_name
        )
    );

    return $template;
}

/**
 * Checks if a plugin is activated
 *
 * @link https://codex.wordpress.org/Function_Reference/is_plugin_active
 * @param $plugin
 *
 * @return mixed
 */
function snth_is_plugin_active( $plugin )
{
    // TODO: Check what is wrong with this condition
    //if ( snth_is_request( 'frontend' ) ) {
    include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
    //}

    return is_plugin_active( $plugin );
}

/**
 * Checks if a woocommerce is activated
 *
 * @return mixed
 */
function snth_is_woocommerce_active()
{
    return snth_is_plugin_active ( 'woocommerce/woocommerce.php' );
}

/**
 * Checks if a woocommerce is activated
 *
 * @return mixed
 */
function snth_is_yoast_seo_active()
{
    return snth_is_plugin_active ( 'wordpress-seo/wp-seo.php' );
}

function snth_get_slug_lat($string) {
    $cyr = [
        'а','б','в','г','д','е','ё','ж','з','и','й','к','л','м','н','о','п',
        'р','с','т','у','ф','х','ц','ч','ш','щ','ъ','ы','ь','э','ю','я',
        'А','Б','В','Г','Д','Е','Ё','Ж','З','И','Й','К','Л','М','Н','О','П',
        'Р','С','Т','У','Ф','Х','Ц','Ч','Ш','Щ','Ъ','Ы','Ь','Э','Ю','Я'
    ];
    $lat = [
        'a','b','v','g','d','e','io','zh','z','i','y','k','l','m','n','o','p',
        'r','s','t','u','f','h','ts','ch','sh','sht','a','i','y','e','yu','ya',
        'A','B','V','G','D','E','Io','Zh','Z','I','Y','K','L','M','N','O','P',
        'R','S','T','U','F','H','Ts','Ch','Sh','Sht','A','I','Y','e','Yu','Ya'
    ];

    $string_lat = str_replace($cyr, $lat, $string);
    $string_lat_slug = sanitize_title( $string_lat );

    return $string_lat_slug;
}

function snth_convert_date_to_human($date, $format = 'Y-m-d') {
    $date_obj = date_create_from_format($format, $date);

    $year = date_format($date_obj, 'Y');
    $month = date_format($date_obj, 'm');
    $day = date_format($date_obj, 'j');

    return $day . ' ' . ittour_get_month_by_number($month, 'genetive') . ' ' . $year;
}