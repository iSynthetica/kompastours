<?php
/**
 * @var $tour
 */

global $ittour_global_form_args;
?>

<div class="tour_list_container mt-20 mb-20">
    <div class="tour-list-item">
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="img_container__wrapper mb-20 mb-md-0">
                    <div class="img_container">
                        <img src="<?php echo SNTH_IMAGES_URL; ?>/placeholder-520x450.png" class="img-fluid" alt="Image">

                        <?php
                        if (!empty($tour['country_images'][0]['full'])) {
                            ?>
                            <div class="img-overlay" style="background-image: url('<?php echo $tour['country_images'][0]['full'] ?>')"></div>
                            <?php

                            unset($tour['country_images']);
                        }
                        ?>
                    </div>
                </div>
            </div>

            <div class="col-lg-8 col-md-6">
                <div class="row">
                    <div class="col-12">
                        <div class="tour_list_description pt-md-10 pr-lg-20 pb-10 pb-xl-20 d-none d-md-block">
                            <h3 class="hotel_title m-0">
                                <strong>
                                    <?php
                                    echo $tour['name'];
                                    unset($tour['name']);
                                    ?>
                                </strong>
                            </h3>

                            <div class="hotel_location">
                                <?php
                                if (!empty($tour['country_names'])) {
                                    $countries_list = implode(', ', $tour['country_names']);
                                    echo $countries_list;
                                    unset($tour['country_names']);
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-8 col-md-12">
                        <div class="tour_list_details pl-10 pr-10 pl-md-0 pr-md-0 mb-10">
                            <div class="row">
                                <?php
                                if (!empty($tour['from_city'])) {
                                    ?>
                                    <div class="col-6">
                                        <p>
                                            <i class="fas fa-map-marker-alt list-item-icon"></i> <?php echo $tour['from_city']; ?>
                                        </p>
                                    </div>
                                    <?php
                                }

                                if (!empty($tour['city_names'])) {
                                    $city_list = implode(', ', $tour['city_names']);
                                    ?>
                                    <div class="col-6">
                                        <p>
                                            <i class="fas fa-route list-item-icon"></i> <?php echo $city_list; ?>
                                        </p>
                                    </div>
                                    <?php
                                }

                                if (!empty($tour["duration"])) {
                                    ?>
                                    <div class="col-6">
                                        <p>
                                            <i class="far fa-clock list-item-icon"></i>
                                            <strong><?php echo $tour["duration"] ?></strong> <?php _e('nights', 'snthwp'); ?>
                                            (<?php echo !empty($tour["night_moves"]) ? __('night moves', 'snthwp') . ': ' . $tour["night_moves"] : __('no night moves', 'snthwp') ?>)
                                        </p>
                                    </div>
                                    <?php
                                }

                                if (!empty($tour["hikes_count"])) {
                                    ?>
                                    <div class="col-6">
                                        <p>
                                            <i class="fas fa-archway list-item-icon"></i>
                                            <?php _e('Excursions', 'snthwp'); ?>: <strong><?php echo $tour["hikes_count"] ?></strong>
                                        </p>
                                    </div>
                                    <?php
                                }

                                if (!empty($tour['transport_type_id'])) {
                                    ?>
                                    <div class="col-6">
                                        <p>
                                            <?php
                                            if (1 == $tour["transport_type_id"]) {
                                                ?><i class="fas fa-plane list-item-icon"></i><?php
                                            } elseif (2 == $tour["transport_type_id"]) {
                                                ?><i class="fas fa-bus list-item-icon"></i><?php
                                            } elseif (3 == $tour["transport_type_id"]) {
                                                ?><i class="fas fa-train list-item-icon"></i><?php
                                            } else {
                                                ?><i class="fas fa-walking list-item-icon"></i> <?php _e('only', 'snthwp'); ?><?php
                                            }
                                            ?>
                                            <?php echo $tour["transport_type"]; ?>
                                        </p>
                                    </div>
                                    <?php
                                }

                                if (!empty($tour['meal_type_full'])) {
                                    ?>
                                    <div class="col-6">
                                        <p>
                                            <i class="fas fa-utensils list-item-icon"></i> <?php echo $tour['meal_type_full']; ?>
                                            <?php echo !empty($tour['meal_type']) ? '(' . $tour['meal_type'] . ')' : ''; ?>
                                        </p>
                                    </div>
                                    <?php
                                }

                                if (!empty($tour['date_from']) && !empty($tour['date_till'])) {
                                    ?>
                                    <div class="col-12 more-dates__container">
                                        <p style="margin-top:15px;">
                                            <i class="far fa-calendar-alt list-item-icon"></i>
                                            <?php echo snth_convert_date_to_human($tour['date_from']); ?> - <?php echo snth_convert_date_to_human($tour['date_till']); ?>
                                        </p>

                                        <?php
                                        if (false) {
                                            ?>
                                            <p style="padding-left:35px;margin-top:8px;">
                                            <span class="more-dates__link" data-tour-key="<?php echo $tour['key'] ?>" data-date-from="<?php echo $tour['date_from_unix']; ?>" data-date-till="<?php echo $tour['date_till_unix']; ?>">
                                                <span class="show-more-dates">
                                                    <?php echo __('Show available dates', 'snthwp'); ?>
                                                    <i class="fas fa-chevron-down"></i>
                                                </span>
                                                <span class="hide-more-dates">
                                                    <?php echo __('Hide dates', 'snthwp'); ?>
                                                    <i class="fas fa-chevron-up"></i>
                                                </span>
                                            </span>
                                            </p>

                                            <div class="dates_list_more" style="display: none;">
                                                idhsfh soihfisdhf
                                                dfsjh fshdofds
                                            </div>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-12">
                        <div class="tour_list_price">
                            <div>
                                <div class="row">
                                    <div class="col-lg-12 col-7">
                                        <div class="tour_price d-inline-block d-lg-block mr-10 mr-lg-0">
                                            <small><?php echo __('from', 'snthwp'); ?></small> <strong><?php echo $tour['prices'][2] ?></strong> <small><?php echo __('uah.', 'snthwp'); ?></small>
                                        </div>

                                        <div class="tour_price_currency d-inline-block d-lg-block mb-lg-10">
                                            <small><?php echo __('from', 'snthwp'); ?></small> <sup><?php echo $main_currency_label ?></sup><strong><?php echo $tour['prices'][$main_currency] ?></strong>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-5">
                                        <a
                                            href="/excursion-tour/<?php echo $tour['key'] ?>/?date_from = <?php echo $ittour_global_form_args["date_excursion_from"]; ?>?date_till=<?php echo $ittour_global_form_args["date_excursion_till"]; ?>"
                                            class="btn shape-rnd type-hollow hvr-invert size-sm size-extended"
                                        >
                                            <?php echo __('Details', 'snthwp'); ?>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php // var_dump($tour); ?>