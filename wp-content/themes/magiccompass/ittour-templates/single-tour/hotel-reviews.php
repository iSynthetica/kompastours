<?php
/**
 * Display Single Tour's hotel
 *
 * @package WordPress
 * @subpackage Magiccompass/ITtour
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;

if (empty($hotel_id)) {
    return;
}

$hotel_obj = ittour_hotel($hotel_id, ITTOUR_LANG);

$reviews = $hotel_obj->reviews();

if (!empty($reviews)) {
    ?>
    <div id="hotel-reviews__holder" class="scroll-content">
        <?php
        foreach ($reviews as $review) {
            ?>
            <div class="hotel-reviews__item mb-10 mb-md-20">
                <div class="hotel-reviews__header">
                    <h5 class="font-weight-900 mt-0"><?php echo $review['title']; ?></h5>

                    <div class="tour_review_rate">
                        <?php
                        echo ittour_get_hotel_review_rate_by_value((int) $review['rating']);
                        ?>
                        <span><?php echo (int) $review['rating']; ?></span> <?php echo __('out of', 'snthwp'); ?> <span>10</span>
                        <?php
                        if (!empty($review['user_name'])) {
                            ?>
                            <span class="d-inline-block mrl-10">-</span>
                            <i class="far fa-user-circle"></i> <?php echo $review['user_name']; ?>
                            <?php
                        }
                        ?>
                        <span class="d-inline-block mrl-10">-</span>
                        <i class="far fa-calendar-alt"></i> <?php echo snth_convert_date_to_human($review['published_date'], 'Y-m-d H:i:s'); ?>
                    </div>
                </div>

                <div class="hotel-reviews__body">
                    <?php echo $review['text']; ?>
                </div>

                <div class="hotel-reviews__footer mt-10">
                    <small><a href="<?php echo $review["url"] ?>" target="_blank"><?php echo __('Read full review on', 'snthwp'); ?></a></small> <?php echo $review['service_name']; ?>
                </div>
            </div>

            <hr>
            <?php
        }
        ?>
    </div>
    <?php
}