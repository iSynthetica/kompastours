<?php
/**
 * Template Name: Excursion Search Result Page
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
?>

<?php get_header('transparent'); ?>

<?php ittour_show_template('excursion-search-results.php') ?>

<?php get_footer(); ?>