<?php
/**
 * Hooka Theme functions and definitions
 *
 * @package Hooka
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

$the_theme = wp_get_theme();
$theme_version = $the_theme->get( 'Version' );
$theme_author = $the_theme->get( 'Author' );
$theme_author_url = $the_theme->get( 'AuthorURI' );

define ('SNTH_VERSION', $theme_version);
define ('SNTH_AUTHOR', $theme_author);
define ('SNTH_AUTHOR_URL', $theme_author_url);

define('SNTH_DIR', get_template_directory());
define('SNTH_ASSETS', SNTH_DIR.'/assets');
define('SNTH_STYLES', SNTH_ASSETS.'/styles');
define('SNTH_SCRIPTS', SNTH_ASSETS.'/scripts');
define('SNTH_VENDORS', SNTH_ASSETS.'/vendors');
define('SNTH_IMAGES', SNTH_ASSETS.'/images');
define('SNTH_FONTS', SNTH_ASSETS.'/fonts');
define('SNTH_INCLUDES', SNTH_DIR.'/includes');

define('SNTH_URL', get_template_directory_uri());
define('SNTH_ASSETS_URL', SNTH_URL.'/assets');
define('SNTH_STYLES_URL', SNTH_ASSETS_URL.'/styles');
define('SNTH_SCRIPTS_URL', SNTH_ASSETS_URL.'/scripts');
define('SNTH_VENDORS_URL', SNTH_ASSETS_URL.'/vendors');
define('SNTH_IMAGES_URL', SNTH_ASSETS_URL.'/images');
define('SNTH_FONTS_URL', SNTH_ASSETS_URL.'/fonts');
define('SNTH_INCLUDES_URL', SNTH_URL.'/includes');

global $ittour_session;

// Helpers library
require_once(SNTH_INCLUDES.'/settings.php');

// Helpers library
require_once(SNTH_INCLUDES.'/helpers.php');

require_once(SNTH_INCLUDES.'/ittour-core.php');

// Theme support options
require_once(SNTH_INCLUDES.'/theme-support.php');

// Theme support options
require_once(SNTH_INCLUDES.'/init.php');

// Remove useless WP outputs
require_once(SNTH_INCLUDES.'/cleanup.php');

//// Helpers library
//require_once(SNTH_INCLUDES.'/customizer.php');

// Helpers library
require_once(SNTH_INCLUDES.'/sidebar.php');

// Helpers library
require_once(SNTH_INCLUDES.'/content-templates.php');

// Shortcodes library
require_once(SNTH_INCLUDES.'/shortcodes.php');
//
//// Helpers library
//require_once(SNTH_INCLUDES.'/core.php');

// Ajax form handler
require_once(SNTH_INCLUDES.'/ajax-forms.php');

// Custom Post Types
require_once(SNTH_INCLUDES.'/ittour-bootstrap.php');

// ittour API
require_once(SNTH_INCLUDES.'/cpt.php');

// ittour API
require_once(SNTH_INCLUDES.'/cpt-library.php');

// ittour API
require_once(SNTH_INCLUDES.'/Class_SNTH_Gallery.php');

// Helpers library
require_once(SNTH_INCLUDES.'/media.php');

// Helpers library
require_once(SNTH_INCLUDES.'/menu.php');
//
//// Helpers library
//require_once(SNTH_INCLUDES.'/content.php');

// Theme support options
require_once(SNTH_INCLUDES.'/enqueue-scripts.php');
//
//// Woocommerce Core library
//if (snth_is_woocommerce_active()) {
//    require_once(SNTH_INCLUDES.'/wc.php');
//}

// Customize the WordPress admin
require_once(SNTH_INCLUDES.'/admin.php');

require_once(SNTH_DIR . '/crm/crm.php');

add_action('wp_head', 'remove_one_wpseo_og', 1);

function remove_one_wpseo_og() {
    if ( is_page_template( 'templates/tour.php' )) {
        remove_action( 'wpseo_head', array( $GLOBALS['wpseo_og'], 'opengraph' ), 30 );
    }
}

add_action("wp", "ittour_set_global_variable");

function ittour_set_global_variable() {
    if ( is_page_template( 'templates/tour.php' )) {
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
}

add_filter( 'wp_title', 'custom_title', 1000 );

function custom_title($title) {
    if ( is_page_template( 'templates/tour.php' )) {
        global $ittour_global_tour_result;

        $title = 'My title';
    }

    return $title;
}

function ittour_change_page_title( $title ) {
    $key = get_query_var( 'tour' );

    if ( !empty($key)) {
        global $ittour_global_tour_result;

        $page_title = '';

        if (!empty($ittour_global_tour_result['result']['country'])) {
            $page_title .= $ittour_global_tour_result['result']['country'];
        }

        if (!empty($ittour_global_tour_result['result']['region'])) {
            if (!empty($page_title)) {
                $page_title .= ' - ';
            }

            $page_title .= $ittour_global_tour_result['result']['region'];
        }

        if (!empty($page_title)) {
            $title = $page_title;
        }
    }

    return $title;
}

add_filter( 'wpseo_title', 'ittour_change_page_title', 1000, 1 );

function ittour_insert_open_graph() {
    $key = get_query_var( 'tour' );

    if (!empty($key)) {
        global $ittour_global_tour_result;

        $image = '';
        $title = __('Hot tour', 'snthwp');

        if (!empty($ittour_global_tour_result["result"]["hotel"])) {
            $title = $ittour_global_tour_result["result"]["hotel"];

            if (!empty($ittour_global_tour_result["result"]["hotel_rating_kn"])) {
                $title .= ' ' . $ittour_global_tour_result["result"]["hotel_rating_kn"];
            }

            if (!empty($ittour_global_tour_result["result"]["prices"][1])) {
                $title .= ' - ' . $ittour_global_tour_result["result"]["prices"][1] . '$';
            }
        }

        if (!empty($ittour_global_tour_result["result"]["hotel_info"]["images"][0]["full"])) {
            $image = $ittour_global_tour_result["result"]["hotel_info"]["images"][0]["full"];
        }

        $description = '';

        if (!empty($ittour_global_tour_result["result"]["country"])) {
            $description .= $ittour_global_tour_result["result"]["country"];
        }

        if (!empty($ittour_global_tour_result["result"]["region"])) {
            if (!empty($description)) {
                $description .= ', ';
            }

            $description .= $ittour_global_tour_result["result"]["region"];
        }

        if (!empty($ittour_global_tour_result["result"]["date_from"])) {
            if (!empty($description)) {
                $description .= ' - ';
            }

            $description .= $ittour_global_tour_result["result"]["date_from"];
        }

        if (!empty($ittour_global_tour_result["result"]["meal_type"])) {
            if (!empty($description)) {
                $description .= ' - ';
            }

            $description .= $ittour_global_tour_result["result"]["meal_type"];

            if (!empty($ittour_global_tour_result["result"]["meal_type_full"])) {
                $description .= ' (' . $ittour_global_tour_result["result"]["meal_type_full"] . ')';
            }
        }

        ?>
        <meta property="og:url" content="<?php echo get_home_url() . '/tour/' . $ittour_global_tour_result["result"]["key"]; ?>"/>
        <meta property="og:title" content="<?php echo $title; ?>"/>
        <meta property="og:type" content="website"/>
        <meta property="og:description" content="<?php echo $description; ?>"/>
        <?php
        if (!empty($image)) {
            ?>
            <meta property="og:image" content="<?php echo $image ?>"/>
            <?php
        }
    }
}

add_action( 'wp_head', 'ittour_insert_open_graph', 5 );

function blog_canonical( $canonical ) {
    $key = get_query_var( 'tour' );

    if (!empty($key)) {
        global $ittour_global_tour_result;

        $canonical = get_home_url() . '/tour/' . $ittour_global_tour_result["result"]["key"];
    }

    return $canonical;
}
// RUN THE FILTER ON PAGES. NORMAL PAGES GET A NORMAL CANONICAL REFERENCE, BLOG POSTS GET THE REMAPPED ONE
add_filter( 'wpseo_canonical', 'blog_canonical' );

// $title = apply_filters( 'pre_get_document_title', '' );
