<?php
/**
 * The Footer for our theme
 *
 * @package Magiccompass
 */

if ( ! defined( 'ABSPATH' ) ) exit;
?>

    <?php snth_show_template('footer/empty.php'); ?>
    <?php
    $form_fields = ittour_get_form_fields();

    ittour_show_template('general/form-find-me-tour.php', array('form_fields' => $form_fields));
    ?>
    <?php wp_footer(); ?>

    </body>
</html>