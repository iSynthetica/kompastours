<?php
/**
 * Created by PhpStorm.
 * User: snth
 * Date: 10.04.19
 * Time: 20:03
 */

if (empty($result['hotels'])) {
    return;
}

$country = $result['hotels'][0]['country'];
?>
    <div class="container mt-30 mb-30">
        <div class="row">
            <div class="col-12">
                <div class="main_title">
                    <h2 class="mt-0 mb-20"><?php echo $country; ?> <small><?php echo __('<span>Top</span> Tours', 'snthwp'); ?></small></h2>
                    <p>Quisque at tortor a libero posuere laoreet vitae sed arcu. Curabitur consequat.</p>
                </div>
            </div>
        </div>

        <div class="row">
            <?php
            $i = 1;
            foreach ($result['hotels'] as $hotel) {
                $seconds = $i / 10;
                $first_offer = $hotel['offers'][0];

                unset ($hotel['offers'][0]);
                ?>
                <div class="col-lg-4 col-md-6 wow zoomIn" data-wow-delay="<?php echo $seconds ?>s">
                    <div class="tour_container grid-tour__container tour__container_01">
                        <div class="img_container">
                            <a href="/tour-result/?key=<?php echo $first_offer['key'] ?>">
                                <img src="<?php echo SNTH_IMAGES_URL; ?>/tours/tour_box_1.jpg" width="800" height="533" class="img-fluid" alt="Image">

                                <div class="img-overlay" style="background-image: url('<?php echo $hotel['images'][0]['full'] ?>')"></div>

                                <div class="short_info">
                                    <span class="price"><small style="font-size:11px;"><?php echo __('from', 'snthwp') ?></small> <sup>$</sup><?php echo $hotel['min_price']; ?></span>
                                </div>
                            </a>
                        </div>

                        <div class="tour_title">
                            <div class="region_title">
                                <?php echo $hotel['region']; ?>
                            </div>

                            <h3 class="hotel_title">
                                <strong><?php echo $hotel['hotel']; ?></strong><br>
                                <?php echo ittour_get_hotel_rating_by_id($hotel['hotel_rating']) ? ittour_get_hotel_rating_by_id($hotel['hotel_rating']) : ittour_get_hotel_rating_by_number($hotel['hotel_rating']) ?>
                            </h3>

                            <div class="rating">
                                <i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile"></i><small>(75)</small>
                            </div><!-- end rating -->
                        </div>
                    </div>
                </div>
                <?php
                $i++;
            }
            ?>
        </div>
    </div>
