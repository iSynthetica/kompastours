<?php
/**
 * Single page template file
 *
 * @package WordPress
 * @subpackage Magiccompass
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;
?>

<?php get_header(); ?>

<?php snth_show_template('destination.php', array(
    'template'  =>  'no-sidebar'
)) ?>

<?php get_footer(); ?>