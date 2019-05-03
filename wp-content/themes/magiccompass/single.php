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

<?php get_header('white'); ?>

<?php snth_show_template('single.php', array(
    'template'  =>  'right-sidebar'
)) ?>

<?php get_footer(); ?>