<?php
/**
 * Single Landing template file
 *
 * @package WordPress
 * @subpackage Magiccompass
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;
?>

<?php get_header('landing'); ?>

<?php snth_show_template('landing.php', array(
    'template'  =>  'full-width'
)) ?>

<?php get_footer('landing'); ?>