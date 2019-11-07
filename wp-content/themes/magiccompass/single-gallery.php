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

<?php get_header('transparent'); ?>

<?php snth_show_template('gallery.php', array(
    'template'  =>  'no-sidebar'
)) ?>

<?php get_footer(); ?>