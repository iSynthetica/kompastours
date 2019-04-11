<?php
/**
 * Display Single Tour content
 *
 * @package WordPress
 * @subpackage Magiccompass/ITtour
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

?>

<section class="parallax-window" data-parallax="scroll" data-image-src="<?php echo $tour_info['hotel_info']['images'][0]['full'] ?>" data-natural-width="1400" data-natural-height="470">
    <div class="parallax-content-2">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <span class="rating">
                        <?php echo ittour_get_hotel_rating_by_id($tour_info['hotel_rating']); ?>
                    </span>

                    <h1><?php echo $tour_info['hotel']; ?></h1>

                    <span><?php echo $tour_info['country'] . ', ' .$tour_info['region']; ?></span>
                </div>
                <div class="col-md-4">
                    <div id="price_single_main" class="hotel">
                        <span><sup><?php echo ittour_get_currency_by_id($tour_info['currency_id']); ?></sup><?php echo $tour_info['price'] ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End section -->

<div class="wrap">
    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">

            <div class="container margin_60">
                <div class="row">
                    <div class="col-lg-8" id="single_tour_desc">
                        <div id="single_tour_feat">
                            <ul>
                                <li><i class="icon_set_2_icon-116"></i>Plasma TV</li>
                                <li><i class="icon_set_1_icon-86"></i>Free Wifi</li>
                                <li><i class="icon_set_2_icon-110"></i>Poll</li>
                                <li><i class="icon_set_1_icon-59"></i>Breakfast</li>
                                <li><i class="icon_set_1_icon-22"></i>Pet allowed</li>
                                <li><i class="icon_set_1_icon-13"></i>Accessibiliy</li>
                                <li><i class="icon_set_1_icon-27"></i>Parking</li>
                            </ul>
                        </div>

                        <hr>

                        <!-- Flights - Start -->
                        <?php
                        if (!empty($tour_info['flights'])) {
                            ?>
                            <div class="row">
                                <div class="col-12">
                                    <h3><?php _e('Flight', 'snthwp'); ?></h3>
                                </div>

                                <div class="col-12">
                                    <?php
                                    ittour_show_template('single-tour/flights.php', array('flights_info' => $tour_info['flights']));
                                    ?>
                                </div>
                            </div>

                            <hr>
                            <?php
                        }
                        ?>
                        <!-- Hotel Description - End -->

                        <!-- Hotel Description - Start -->
                        <div class="row">
                            <div class="col-lg-3">
                                <h3><?php _e('Description', 'snthwp'); ?></h3>
                            </div>

                            <div class="col-lg-9">
                                <?php ittour_show_template('single-tour/hotel-description.php', array('hotel_info' => $tour_info['hotel_info'])); ?>
                            </div>
                        </div>
                        <!-- Hotel Description - End -->

                    </div>
                </div>
            </div>

            <?php ittour_show_template('single-tour/content.php', array('tour_info' => $tour_info)); ?>
        </main>
    </div>
</div>