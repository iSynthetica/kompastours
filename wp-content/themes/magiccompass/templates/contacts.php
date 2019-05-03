<?php
/**
 * Template Name: Contacts Page
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

<?php snth_show_template('contacts.php', array(
    'template' => 'no-sidebar',
    'content' => 'contacts',
)) ?>

<?php get_footer(); ?>