<?php
/**
 * Template Name: Tour Result Page
 *
 * @package WordPress
 * @subpackage Magiccompass
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
?>

<?php get_header('plain'); ?>

<?php ittour_show_template('single-tour.php') ?>

<?php get_footer(); ?>