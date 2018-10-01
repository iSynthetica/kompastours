<?php
/**
 * Display Single Tour content
 *
 * @package WordPress
 * @subpackage Magiccompass/ITtour
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

$is_ajax = false;

if (empty($_GET['key'])) {
    ittour_show_template('single-tour-content.php', array('tour_info' => $tour_info));
} else {
    $tour_key = $_GET['key'];
    $tour = ittour_tour($tour_key);
    $tour_info = $tour->info();
    ittour_show_template('single-tour-content.php', array('tour_info' => $tour_info));
}
?>