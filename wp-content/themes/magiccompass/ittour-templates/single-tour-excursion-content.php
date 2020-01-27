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
                    <?php
                    if (!empty($tour_info["countries"][0]["images"][0]["full"])) {
                        $gallery_images = array();

                        foreach ($tour_info["countries"] as $country) {
                            foreach ($country['images'] as $index => $images) {
                                if (!empty($images['full'])) {
                                    $images_array = array();
                                    $images_array['full'] = $images['full'];

                                    if (!empty($images['thumb'])) {
                                        $images_array['thumb'] = $images['thumb'];
                                    } else {
                                        $images_array['thumb'] = $images['full'];
                                    }

                                    $gallery_images[] = $images_array;
                                }
                            }
                        }

                        ittour_show_template('general/tour-gallery.php', array('gallery_images' => $gallery_images));
                    }
                    snth_the_social_share();
                    ?>
                </div>

                <div class="col-md-12 col-lg-5">
                    <ul class="tour-details-list">
                        <?php

                        if (!empty($tour_info["ittour_date_till"])) {
                            $now = time();

                            if ($now < (int)$tour_info["ittour_date_till"]) {
                                $date_actual = snth_convert_date_to_human(date('Y-m-d', $tour_info["ittour_date_till"]));

                                if (!empty($date_actual)) {
                                    ?>
                                    <li>
                                        <i class="far fa-calendar-alt list-item-icon"></i>
                                        <small><?php _e('Tour actual until', 'snthwp'); ?>:</small>
                                        <strong><?php echo $date_actual; ?></strong>
                                    </li>

                                    <?php
                                }
                            } else {
                                ?>
                                <li>
                                    <i class="fas fa-map-pin list-item-icon"></i>
                                    <strong><?php _e('Tour is outdated', 'snthwp'); ?></strong>
                                </li>
                                <?php
                            }
                            ?>
                            <?php
                        }

                        if (!empty($tour_info["from_city"])) {
                            ?>
                            <li>
                                <i class="fas fa-map-pin list-item-icon"></i>
                                <small><?php _e('Departure from', 'snthwp'); ?>:</small>
                                <strong><?php echo $tour_info["from_city"] ?></strong>
                            </li>
                            <?php
                        }

                        if (!empty($tour_info["transport_type"]) && !empty($tour_info["transport_type_id"])) {
                            ?>
                            <li>
                                <?php
                                if (1 == $tour_info["transport_type_id"]) {
                                    ?><i class="fas fa-plane list-item-icon"></i><?php
                                } elseif (2 == $tour_info["transport_type_id"]) {
                                    ?><i class="fas fa-bus list-item-icon"></i><?php
                                } elseif (3 == $tour_info["transport_type_id"]) {
                                    ?><i class="fas fa-train list-item-icon"></i><?php
                                } else {
                                    ?><i class="fas fa-walking list-item-icon"></i><?php
                                }
                                ?>

                                <small><?php _e('Transport', 'snthwp'); ?>:</small>
                                <strong><?php echo $tour_info["transport_type"]; ?></strong>
                            </li>
                            <?php
                        }

                        if (!empty($tour_info["duration"])) {
                            ?>
                            <li>
                                <i class="far fa-clock list-item-icon"></i>
                                <small><?php _e('Tour duration', 'snthwp'); ?>:</small>
                                <strong>
                                    <?php
                                    echo $tour_info["duration"] ?> <?php _e('nights', 'snthwp');
                                    ?>
                                </strong>
                            </li>
                            <?php
                        }

                        if (!empty($tour_info["night_moves"])) {
                            ?>
                            <li>
                                <i class="far fa-moon list-item-icon"></i>
                                <small><?php _e('Night moves', 'snthwp'); ?>:</small>
                                <strong>
                                    <?php echo $tour_info["night_moves"] ?>
                                </strong>
                            </li>
                            <?php
                        }

                        if (!empty($tour_info['cities'])) {
                            $count = count($tour_info['cities']);
                            $i = 1;
                            ?>
                            <li>
                                <i class="fas fa-route list-item-icon"></i>
                                <small><?php _e('Cities in the route', 'snthwp'); ?>:</small>
                                <strong>
                                    <?php
                                    foreach ($tour_info['cities'] as $city) {
                                        echo $city['name'];
                                        if ($i < $count) echo ', ';
                                        $i++;
                                    }

                                    ?>
                                </strong>

                                <?php
                                if (!empty($tour_info["description"])) {
                                    ?>
                                    <small>(<a href="#" class="scroll-to-tab" data-scroll-to="#single_tour_tabs" data-scroll-tab="#excursions-review-tab"><?php _e('tour description', 'snthwp'); ?></a>)</small>
                                    <?php
                                }
                                ?>
                            </li>
                            <?php
                        }

                        if (!empty($tour_info['hikes'])) {
                            $count = count($tour_info['hikes']);
                            ?>
                            <li>
                                <i class="fas fa-archway list-item-icon"></i>
                                <small><?php _e('Excursions', 'snthwp'); ?>:</small>
                                <strong><?php echo $count; ?></strong>
                                <small>(<a href="#" class="scroll-to-tab" data-scroll-to="#single_tour_tabs" data-scroll-tab="#excursions-tab"><?php _e('excursions description', 'snthwp'); ?></a>)</small>
                            </li>
                            <?php
                        }

                        if (!empty($tour_info['meal_type_full'])) {
                            ?>
                            <li>
                                <i class="fas fa-utensils list-item-icon"></i>
                                <small><?php _e('Meal type', 'snthwp'); ?>:</small>
                                <strong>
                                    <?php echo $tour_info['meal_type_full']; ?>
                                </strong>
                            </li>
                            <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-lg-3">
            <?php
            ittour_show_template('single-excursion-tour/book-tour.php', array(
                    'tour_info' => $tour_info,
                    'main_currency_label' => $main_currency_label,
                    'main_currency' => $main_currency,
                )
            );
            ?>

            <?php ittour_show_template('single-excursion-tour/book-by-phone.php') ?>
        </div>
    </div>
</section>

<div id="single_tour_tabs">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <?php
        $first = true;

        if (!empty($tour_info["description"])) {
            ?>
            <li class="nav-item">
                <a class="nav-link active" id="excursions-review-tab" data-toggle="tab" href="#excursions-review" role="tab" aria-controls="excursions-review" aria-selected="true">
                    <?php _e('Tour description', 'snthwp'); ?>
                </a>
            </li>
            <?php
            $first = false;
        }

        if (!empty($tour_info["hikes"])) {
            ?>
            <li class="nav-item">
                <a class="nav-link<?php echo $first ? ' active' : ''; ?>"
                   id="excursions-tab"
                   data-toggle="tab"
                   href="#excursions"
                   role="tab"
                   aria-controls="excursions"
                   aria-selected="<?php echo $first ? 'true' : 'false'; ?>"
                >
                    <?php _e('Excursions List', 'snthwp'); ?>
                </a>
            </li>
            <?php
            $first = false;
        }

        if (!empty($tour_info["include"]) ||!empty($tour_info["not_include"])) {
            ?>
            <li class="nav-item">
                <a class="nav-link<?php echo $first ? ' active' : ''; ?>"
                   id="additional-tab"
                   data-toggle="tab"
                   href="#additional"
                   role="tab"
                   aria-controls="additional"
                   aria-selected="<?php echo $first ? 'true' : 'false'; ?>"
                >
                    <?php _e('Additional info', 'snthwp'); ?>
                </a>
            </li>
            <?php
            $first = false;
        }

        if (!empty($tour_info["document_description"])) {
            ?>
            <li class="nav-item">
                <a class="nav-link<?php echo $first ? ' active' : ''; ?>"
                   id="documents-tab"
                   data-toggle="tab"
                   href="#documents"
                   role="tab"
                   aria-controls="documents"
                   aria-selected="<?php echo $first ? 'true' : 'false'; ?>"
                >
                    <?php _e('Info about Documents', 'snthwp'); ?>
                </a>
            </li>
            <?php
            $first = false;
        }
        ?>
    </ul>

    <div class="tab-content" id="myTabContent">
        <?php
        $first_tab = true;

        if (!empty($tour_info["description"])) {
            ?>
            <div class="tab-pane fade show active" id="excursions-review" role="tabpanel" aria-labelledby="excursions-review-tab">
                <?php
                echo $tour_info['description'];
                ?>
            </div>
            <?php
            $first_tab = false;
        }

        if (!empty($tour_info["hikes"])) {
            ?>
            <div class="tab-pane fade<?php echo $first_tab ? ' show active' : ''; ?>" id="excursions" role="tabpanel" aria-labelledby="excursions-tab">
                <?php
                foreach ($tour_info["hikes"] as $hike) {
                    ?>
                    <div class="hike-item">
                        <h4>
                            <?php echo $hike['name']; ?>
                            (<?php
                            if (empty($hike['prices'])) {
                                echo __('Free', 'snthwp');
                            } else {
                                echo $hike['prices'][10] . '€';
                            }
                            ?>)
                        </h4>
                        <p>
                            <i class="fas fa-map-marker-alt list-item-icon"></i>
                            <?php echo $hike['country']; ?>, <?php echo $hike['city']; ?>
                        </p>

                        <?php //var_dump($hike['prices']); ?>

                        <?php echo wpautop(sanitize_text_field($hike['description']));?>
                    </div>
                    <?php
                }
                ?>
            </div>
            <?php
            $first_tab = false;
        }

        if (!empty($tour_info["include"]) ||!empty($tour_info["not_include"])) {
            ?>
            <div class="tab-pane fade<?php echo $first_tab ? ' show active' : ''; ?>" id="additional" role="tabpanel" aria-labelledby="additional-tab">
                <?php
                if (!empty($tour_info['include'])) {
                    ?>
                    <h3><?php _e('Tour price includes', 'snthwp'); ?></h3>
                    <ul class="p-0 list-style-4 list-success">
                        <?php
                        foreach ($tour_info['include'] as $item) {
                            ?><li><?php echo $item; ?></li><?php
                        }
                        ?>
                    </ul>
                    <?php
                }

                if (!empty($tour_info['not_include'])) {
                    ?>
                    <h3><?php _e('Tour price not includes', 'snthwp'); ?></h3>
                    <ul class="p-0 list-style-4 list-danger">
                        <?php
                        foreach ($tour_info['not_include'] as $item) {
                            ?><li><?php echo $item; ?></li><?php
                        }
                        ?>
                    </ul>
                    <?php
                }
                ?>
            </div>
            <?php
            $first_tab = false;
        }

        if (!empty($tour_info["document_description"])) {
            ?>
            <div class="tab-pane fade<?php echo $first_tab ? ' show active' : ''; ?>" id="documents" role="tabpanel" aria-labelledby="documents-tab">
                <?php
                if (!empty($tour_info['document_description'])) {
                    ?>
                    <h3><?php _e('Important information', 'snthwp'); ?></h3>
                    <?php
                    echo wpautop(sanitize_textarea_field($tour_info['document_description']));
                    ?>
                    <?php
                }
                ?>
            </div>
            <?php
            $first_tab = false;
        }
        ?>
    </div>
</div>

<?php
// var_dump($tour_info);
//
//if (!empty($tour_info['dates'])) {
//    foreach ($tour_info['dates'] as $tour_date) {
//        var_dump($tour_date);
//    }
//}
//
//var_dump($tour_info['accomodations']);
?>