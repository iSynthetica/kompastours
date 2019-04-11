<?php
/**
 * Created by PhpStorm.
 * User: snth
 * Date: 10.04.19
 * Time: 20:03
 */
?>
    <div class="container mt-30 mb-30">
        <div class="row">
            <?php
            foreach ($result['hotels'] as $hotel) {
                $first_offer = $hotel['offers'][0];

                unset ($hotel['offers'][0]);
                ?>
                <div class="col-lg-4 col-md-6 wow zoomIn" data-wow-delay="0.1s">
                    <div class="tour_container">
                        <div class="img_container">
                            <a href="single_tour.html">
                                <img src="<?php echo SNTH_IMAGES_URL; ?>/tours/tour_box_1.jpg" width="800" height="533" class="img-fluid" alt="Image">
                                <div class="img-overlay" style="background-image: url('<?php echo $hotel['images'][0]['full'] ?>')"></div>
                                <div class="short_info">
                                    <i class="icon_set_1_icon-44"></i>Historic Buildings<span class="price"><sup>$</sup>39</span>
                                </div>
                            </a>
                        </div>

                        <div class="tour_title">
                            <h3><strong><?php echo $hotel['hotel']; ?></strong></h3>
                            <div class="rating">
                                <i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile"></i><small>(75)</small>
                            </div><!-- end rating -->
                            <div class="wishlist">
                                <a class="tooltip_flip tooltip-effect-1" href="javascript:void(0);">+<span class="tooltip-content-flip"><span class="tooltip-back">Add to wishlist</span></span></a>
                            </div><!-- End wish list-->
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
