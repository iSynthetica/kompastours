<?php
/**
 * The main template file
 *
 * @package Hooka
 */

if ( ! defined( 'ABSPATH' ) ) exit;
?>

<?php get_header('pofo-simple'); ?>

<?php snth_show_template('archive.php', array(
    'template' => 'no-sidebar',
    'content' => 'loop',
)) ?>

<?php get_footer(); ?>