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

$country_info = array();
$regions_info = array();

if (!empty($country_id)) {
    $country_info = ittour_destination_by_ittour_id($country_id);
}

if (!empty($country_info)) {
    $country_url = get_permalink($country_info['ID']);
    $country_slug = $country_info['slug'];
    $country_title = '<a target="_blank" href="'.$country_url.'">'.$country_info["title"].'</a>';
} else {
    $country_title = $result['hotels'][0]['country'];
}
?>
    <div class="container mt-30 mb-30">
        <div class="row">
            <?php
            $i = 1;
            foreach ($result['hotels'] as $hotel) {
                $hotel_region_id = !empty($hotel["region_id"]) ? $hotel["region_id"] : false;

                if (!empty($hotel_region_id) && empty($regions_info[$hotel_region_id])) {
                    $hotel_region_info = ittour_destination_by_ittour_id($hotel_region_id);

                    if (empty($hotel_region_info)) {
                        $hotel_region_info = ittour_get_region($hotel_region_id);
                    }

                    if (!empty($hotel_region_info)) {
                        $regions_info[$hotel_region_id] = $hotel_region_info;
                    }
                }

                if (!empty($hotel["region_id"]) && !empty($regions_info[$hotel["region_id"]])) {
                    $region_url = get_permalink($regions_info[$hotel["region_id"]]['ID']);
                    $region_slug = $regions_info[$hotel["region_id"]]['slug'];
                    $region_title = '<a target="_blank" href="'.$region_url.'">'.$hotel['region'].'</a>';
                } else {
                    $region_title = $hotel['region'];
                }

                $seconds = $i / 10;
                $first_offer = $hotel['offers'][0];

                $hotel_title = $hotel['hotel'] . ' ' . ittour_get_hotel_number_rating_by_id($hotel['hotel_rating']);
                $hotel_slug = snth_get_slug_lat($hotel_title);

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
                                <?php echo $hotel_title; ?>
                            </h3>

                            <div class="hotel_location">
                                <?php echo $region_title; ?>, <?php echo $country_title; ?>
                            </div>

                            <div class="row mt-20">
                                <div class="col-md-10 offset-md-1 col-lg-8 offset-lg-2">
                                    <?php
                                    if (!empty($country_slug) && !empty($region_slug) && !empty($hotel_slug)) {
                                        ?>
                                        <a
                                                href="/countries/<?php echo $country_slug ?>/<?php echo $region_slug; ?>/<?php echo $hotel_slug ?>/tour/<?php echo $first_offer['key'] ?>/<?php echo $from_city ?><?php echo !empty($child_age) ? '/' . $child_age : '' ?>"
                                                class="btn shape-rnd type-hollow hvr-invert size-sm size-extended"
                                        >
                                            <?php echo __('Details', 'snthwp'); ?>
                                        </a>
                                        <?php
                                    } else {
                                        ?>
                                        <a href="/tour/<?php echo $first_offer['key'] ?>" class="btn shape-rnd type-hollow hvr-invert size-sm size-extended">
                                            <?php echo __('Want to this hotel', 'snthwp'); ?>
                                        </a>
                                        <?php
                                    }
                                    ?>
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
