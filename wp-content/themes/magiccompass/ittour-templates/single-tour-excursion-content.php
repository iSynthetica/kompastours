<?php
/**
 * Display Single Tour content
 *
 * @package WordPress
 * @subpackage Magiccompass/ITtour
 * @since 1.0
 *
 * @var $tour_info
 */

if ( ! defined( 'ABSPATH' ) ) exit;

?>
<section id="single-tour-main-info__container">
    <div class="row">
        <div class="col-md-8 col-lg-9">
            <div class="row">
                <div class="col-md-12 col-lg-7">
                    <?php snth_the_social_share(); ?>
                </div>

                <div class="col-md-12 col-lg-5">
                    <h3><?php _e('Tour price includes', 'snthwp'); ?></h3>

                    <?php var_dump($tour_info); ?>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-lg-3">
        </div>
    </div>
</section>