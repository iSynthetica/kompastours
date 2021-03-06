<?php
/**
 * The Footer for our theme
 *
 * @package Magiccompass
 */

if ( ! defined( 'ABSPATH' ) ) exit;
global $ittour_global_form_fields;
$social = get_field('social', 'options');
$phones = get_field('phones', 'options');
$messangers = get_field('messangers', 'options');
?>

    <?php snth_show_template('global/subscribe.php'); ?>

    <?php snth_show_template('footer/classic.php', array('social' => $social)); ?>

    <!-- start scroll to top -->
    <a class="scroll-top-arrow" href="javascript:void(0);"><i class="fas fa-angle-double-up"></i></a>
    <!-- end scroll to top  -->

    <?php snth_show_template('global/contact-actions.php', array(
        'phones' => $phones,
        'messangers' => $messangers,
    )); ?>


    <?php ittour_show_template('general/form-find-me-tour.php', array('form_fields' => $ittour_global_form_fields)); ?>

    <?php wp_footer(); ?>

    </body>
</html>