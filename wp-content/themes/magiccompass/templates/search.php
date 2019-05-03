<?php
/**
 * Template Name: Search Result Page
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
?>

<?php get_header('pofo-simple'); ?>

<?php ittour_show_template('search-results.php') ?>

<?php get_footer(); ?>