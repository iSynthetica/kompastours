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

<div id="single_tour_tabs">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <?php
        $first = true;

        if (!empty($tour_info["description"])) {
            ?>
            <li class="nav-item">
                <a class="nav-link active" id="review-tab" data-toggle="tab" href="#review" role="tab" aria-controls="review" aria-selected="true">
                    <?php _e('Tour description', 'snthwp'); ?>
                </a>
            </li>
            <?php
            $first = false;
        }
        ?>

        <li class="nav-item">
            <a class="nav-link<?php echo $first ? ' active' : ''; ?>"
               id="calendar-tab"
               data-toggle="tab"
               href="#calendar"
               role="tab"
               aria-controls="calendar"
               aria-selected="<?php echo $first ? 'true' : 'false'; ?>"
            >
                <?php _e('More Tours', 'snthwp'); ?>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" id="home-tab" data-toggle="tab" href="#description" role="tab" aria-controls="description" aria-selected="false">
                <?php _e('Hotel Description', 'snthwp'); ?>
            </a>
        </li>

        <?php
        if (!empty($tour_info["hotel_info"]['lat']) && !empty($tour_info["hotel_info"]['lng'])) {
            ?>
            <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">
                    <?php _e('Location', 'snthwp'); ?>
                </a>
            </li>
            <?php
        }
        ?>
    </ul>

    <div class="tab-content" id="myTabContent">
        <?php
        $first_tab = true;

        if (!empty($tour_info["description"])) {
            ?>
            <div class="tab-pane fade show active" id="review" role="tabpanel" aria-labelledby="home-tab">
                <?php
                echo $tour_info['description'];
                ?>
            </div>
            <?php
            $first_tab = false;
        }
        ?>

        <div class="tab-pane fade<?php echo $first_tab ? ' show active' : ''; ?>" id="calendar" role="tabpanel" aria-labelledby="home-tab">
            <?php
            $template_args = array(
                'country' => $tour_info["country_id"],
                'region' => $tour_info["region_id"],
                'hotel' => $tour_info["hotel_id"],
                'hotel_rating' => $tour_info["hotel_rating"],
            );

            if (!empty($tour_info['date_from'])) {
                $date_obj = date_create_from_format('Y-m-d', $tour_info['date_from']);
                $tour_date = date_format($date_obj, 'd.m.y');

                $date_range = ittour_get_date_range($tour_date, 2);

                $template_args['date_from'] = $date_range["date_from"];
                $template_args['date_till'] = $date_range["date_till"];
            }

            if (!empty($tour_info['adult_amount'])) {
                $template_args['adult_amount'] = $tour_info["adult_amount"];
            }

            if (!empty($tour_info['from_city_id'])) {
                $template_args['from_city'] = $tour_info["from_city_id"];
            }

            if (!empty($tour_info['child_amount']) && !empty($tour_info['child_age'])) {
                $template_args['child_amount'] = $tour_info["child_amount"];
                $template_args['child_age'] = $tour_info["child_age"];
            }

            if (!empty($tour_info["type"])) {
                $template_args['type'] = $tour_info["type"];

                if (1 === $tour_info["type"] && !empty($tour_info["transport_type"])) {
                    $kind = 1;

                    if ('bus' === $tour_info["transport_type"]) {
                        $kind = 2;
                    }

                    $template_args['kind'] = $kind;
                }
            }

            $template_args['template'] = 'table-sort-by-date';

            ittour_show_template('general/tours-list-ajax.php', $template_args); ?>
        </div>

        <div class="tab-pane fade" id="description" role="tabpanel" aria-labelledby="home-tab">
            <?php
            ittour_show_template('single-tour/hotel-description.php', array('hotel_info' => $tour_info['hotel_info']));
            ?>
        </div>



        <?php
        if (!empty($tour_info["hotel_info"]['lat']) && !empty($tour_info["hotel_info"]['lng'])) {
            ?>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <?php
                ittour_show_template('single-tour/hotel-map.php', array(
                    'hotel_info' => $tour_info['hotel_info'],
                    'hotel_title' => $tour_info['hotel'] . ' ' . ittour_get_hotel_number_rating_by_id($tour_info['hotel_rating'])
                ));
                ?>
            </div>
            <?php
        }
        ?>
    </div>
</div>