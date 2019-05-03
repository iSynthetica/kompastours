<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Magiccompass
 * @since 1.0
 * @version 1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;
?>

<?php get_header('pofo-simple'); ?>

<?php snth_show_template('archive.php', array(
    'template' => 'right-sidebar',
    'content' => 'loop',
)) ?>

<?php get_footer(); ?>