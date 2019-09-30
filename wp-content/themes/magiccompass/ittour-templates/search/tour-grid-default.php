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
            <?php
            $i = 1;
            foreach ($result['hotels'] as $hotel) {
                $seconds = $i / 10;
                $first_offer = $hotel['offers'][0];

                unset ($hotel['offers'][0]);
                ?>
                <div class="col-lg-4 col-md-6">
                    <div class="tour_container tour-grid__container">
                        <div class="img_container">
                            <img src="<?php echo SNTH_IMAGES_URL; ?>/tours/tour_box_1.jpg" width="800" height="533" class="img-fluid" alt="Image">

                            <?php
                            if (!empty($hotel['images'][0]['full'])) {
                                ?>
                                <div class="img-overlay" style="background-image: url('<?php echo $hotel['images'][0]['full'] ?>')"></div>
                                <?php
                            }
                            ?>

                            <div class="short_info">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="pl-10">
                                            <?php
                                            echo ittour_get_guests_icon($hotel['adult_amount'], $hotel['child_amount']);
                                            ?> /
                                            <?php echo $first_offer['duration']; ?> <?php echo __('Nights', 'snthwp'); ?>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="price">
                                            <small style="font-size:11px;"><?php echo __('from', 'snthwp') ?></small>
                                            <?php echo $hotel['min_price']; ?>
                                            <sup><?php echo __('uah.', 'snthwp'); ?></sup>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="content__container p-10">
                            <?php
                            if (!empty($hotel['hotel_review_rate'])) {
                                ?>
                                <div class="tour_review_rate">
                                    <?php echo ittour_get_hotel_review_rate_by_value($hotel['hotel_review_rate']) ?>
                                    <span><?php echo $hotel['hotel_review_rate']; ?></span> <?php echo __('out of', 'snthwp'); ?> <span>10</span>
                                </div>
                                <?php
                            }
                            ?>

                            <h3 class="hotel_title mtb-0">
                                <?php echo $hotel['hotel']; ?>
                                <?php echo ittour_get_hotel_number_rating_by_id($hotel['hotel_rating']); ?>
                            </h3>

                            <div class="hotel_location">
                                <?php echo $hotel['region']; ?>, <?php echo $country; ?>
                            </div>

                            <div class="row mt-20">
                                <div class="col-md-10 offset-md-1 col-lg-8 offset-lg-2">
                                    <a href="/tour/<?php echo $first_offer['key'] ?>" class="btn shape-rnd type-hollow hvr-invert size-sm size-extended">
                                        <?php echo __('Want to this hotel', 'snthwp'); ?>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                $i++;
            }
            ?>
        </div>
    </div>
