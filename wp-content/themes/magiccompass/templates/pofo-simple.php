<?php
/**
 * Template Name: Pofo Simple Page
 *
 * @package WordPress
 * @subpackage Magiccompass/Parts/Destination
 * @version 0.0.10
 * @since 0.0.10
 */

if ( ! defined( 'ABSPATH' ) ) exit;
?>

<?php get_header('pofo-simple'); ?>

<?php snth_show_template('contacts.php', array(
    'template' => 'no-sidebar',
    'content' => 'contacts',
)) ?>

<?php get_footer('pofo-simple'); ?>
