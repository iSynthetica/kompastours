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

<?php get_header('white'); ?>

<?php snth_show_template('pofo-simple.php', array(
    'template' => 'full-width',
    'content' => 'shortcodes',
)) ?>

<?php get_footer('pofo-simple'); ?>
