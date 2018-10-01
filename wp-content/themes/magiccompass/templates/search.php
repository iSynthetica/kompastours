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

<?php get_header(); ?>

<?php snth_show_template('content/search.php', array(
    'template' => 'no-sidebar',
    'content' => 'loop',
)) ?>

<?php get_footer(); ?>