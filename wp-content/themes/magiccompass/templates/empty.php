<?php
/**
 * Template Name: Empty Page
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
?>

<?php get_header('empty'); ?>

<?php snth_show_template('empty.php', array(
    'template' => 'no-sidebar',
    'content' => 'contacts',
)) ?>

<?php get_footer('empty'); ?>