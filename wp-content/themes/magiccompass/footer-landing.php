<?php
/**
 * The Footer for our theme
 *
 * @package Magiccompass
 */

if ( ! defined( 'ABSPATH' ) ) exit;
?>

    <?php snth_show_template('global/subscribe.php'); ?>

    <?php snth_show_template('footer/landing.php'); ?>

    <!-- start scroll to top -->
    <a class="scroll-top-arrow" href="javascript:void(0);"><i class="fas fa-angle-double-up"></i></a>
    <!-- end scroll to top  -->

    <?php wp_footer(); ?>

    </body>
</html>