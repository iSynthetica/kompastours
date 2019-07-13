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

/**
 * Set a cookie - wrapper for setcookie using WP constants.
 *
 * @param  string  $name   Name of the cookie being set.
 * @param  string  $value  Value of the cookie.
 * @param  integer $expire Expiry of the cookie.
 * @param  bool    $secure Whether the cookie should be served only over https.
 * @param  bool    $httponly Whether the cookie is only accessible over HTTP, not scripting languages like JavaScript. @since 3.6.0.
 */
function snth_setcookie( $name, $value, $expire = 0, $secure = false, $httponly = false ) {
    if ( ! headers_sent() ) {
        setcookie( $name, $value, $expire, COOKIEPATH ? COOKIEPATH : '/', COOKIE_DOMAIN, $secure, apply_filters( 'woocommerce_cookie_httponly', $httponly, $name, $value, $expire, $secure ) );
    } elseif ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
        headers_sent( $file, $line );
        trigger_error( "{$name} cookie cannot be set - headers already sent by {$file} on line {$line}", E_USER_NOTICE ); // @codingStandardsIgnoreLine
    }
}

/**
 * Generate a unique customer ID for guests, or return user ID if logged in.
 *
 * Uses Portable PHP password hashing framework to generate a unique cryptographically strong ID.
 *
 * @return string
 */
function snth_generate_customer_id() {
    $customer_id = '';

    if ( is_user_logged_in() ) {
        $customer_id = get_current_user_id();
    }

    if ( empty( $customer_id ) ) {
        require_once ABSPATH . 'wp-includes/class-phpass.php';
        $hasher      = new PasswordHash( 8, false );
        $customer_id = md5( $hasher->get_random_bytes( 32 ) );
    }

    return $customer_id;
}

function snth_use_secure_cookie() {
    return snth_site_is_https() && is_ssl();
}

function snth_site_is_https() {
    return false !== strstr( get_option( 'home' ), 'https:' );
}

function snth_get_transient_timeout( $transient ) {
    global $wpdb;

    $transient_timeout = $wpdb->get_col( "
      SELECT option_value
      FROM $wpdb->options
      WHERE option_name
      LIKE '%_transient_timeout_$transient%'
    " );

    return $transient_timeout[0];
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

function snth_convert_date_format($date, $format_from = 'Y-m-d', $format_to = 'd.m.y') {
    $date_obj = date_create_from_format($format_from, $date);

    $date_converted = date_format($date_obj, $format_to);

    return $date_converted;
}