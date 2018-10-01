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

<section class="parallax-window" data-parallax="scroll" data-image-src="img/single_hotel_bg_1.jpg" data-natural-width="1400" data-natural-height="470">
    <div class="parallax-content-2">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <span class="rating"><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class=" icon-star-empty"></i></span>
                    <h1>Mariott Hotel</h1>
                    <span>Champ de Mars, 5 Avenue Anatole, 75007 Paris.</span>
                </div>
                <div class="col-md-4">
                    <div id="price_single_main" class="hotel">
                        from/per night <span><sup>$</sup>95</span>
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
            <div id="position">
                <div class="container">
                    <ul>
                        <li><a href="#">Home</a>
                        </li>
                        <li><a href="#">Category</a>
                        </li>
                        <li>Page active</li>
                    </ul>
                </div>
            </div>

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

                    </div>
                </div>
            </div>
            <?php ittour_show_template('single-tour/content.php', array('tour_info' => $tour_info)); ?>
        </main>
    </div>
</div>