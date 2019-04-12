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

<section id="single-tour-main-info__container">
    <div class="row">
        <div class="col-md-8 col-lg-9">
            <div class="row">
                <div class="col-md-6 col-lg-7">
                    <?php
                    if (!empty($tour_info['hotel_info']['hotel_facilities'])) {
                        echo ittour_get_hotel_facilities($tour_info['hotel_info']['hotel_facilities']);
                    }
                    ?>
                </div>

                <div class="col-md-6 col-lg-5">
                    <h3><?php _e('Tour price includes', 'snthwp'); ?></h3>

                    <ul class="tour-details-list">
                        <li>
                            <i class="far fa-clock list-item-icon"></i>
                            <small><?php _e('Tour duration', 'snthwp'); ?>:</small>
                            <strong><?php echo $tour_info["duration"] ?></strong> <?php _e('nights', 'snthwp'); ?>
                        </li>

                        <li>
                            <i class="fas fa-utensils list-item-icon"></i>
                            <small><?php _e('Meal type', 'snthwp'); ?>:</small>
                            <strong><?php echo $tour_info["meal_type"] ?></strong> <?php echo $tour_info["meal_type_full"] ?>
                        </li>

                        <li>
                            <i class="fas fa-key list-item-icon"></i>
                            <small><?php _e('Room type', 'snthwp'); ?>:</small>
                            <strong><?php echo $tour_info["accomodation"] ?></strong> <?php echo $tour_info["room_type"] ?>
                        </li>

                        <li>
                            <i class="fas fa-plane-departure list-item-icon"></i>
                            <small><?php _e('Flight from', 'snthwp'); ?>:</small>
                            <strong><?php echo $tour_info["from_city"] ?></strong>
                        </li>

                        <li>
                            <i class="far fa-calendar-alt list-item-icon"></i>
                            <small><?php _e('Flight date', 'snthwp'); ?>:</small>
                            <strong><?php echo $tour_info["date_from"] ?></strong>
                        </li>
                    </ul>

                    <hr>


                    <?php
                    ittour_show_template('single-tour/flights-list.php', array('flights_info' => $tour_info['flights']));
                    ?>
                </div>
            </div>

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
        </div>
        <div class="col-md-4 col-lg-3">

        </div>
    </div>
</section>

<div id="single_tour_tabs">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><?php _e('Hotel Description', 'snthwp'); ?></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Profile</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contact</a>
        </li>
    </ul>

    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <?php ittour_show_template('single-tour/hotel-description.php', array('hotel_info' => $tour_info['hotel_info'])); ?>
        </div>
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            Sed pretium, ligula sollicitudin laoreet viverra, tortor libero sodales leo, eget blandit nunc tortor eu nibh. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Phasellus hendrerit. Pellentesque aliquet nibh nec urna. In nisi neque, aliquet vel, dapibus id, mattis vel, nisi. Nullam mollis.. Phasellus hendrerit. Pellentesque aliquet nibh nec urna. In nisi neque, aliquet vel, dapiPhasellus hendrerit. Pellentesque aliquet nibh nec urna. In nisi neque, aliquet vel, dapi
        </div>
        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
            Sed pretium, ligula sollicitudin laoreet viverra, tortor libero sodales leo, eget blandit nunc tortor eu nibh. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Phasellus hendrerit. Pellentesque aliquet nibh nec urna. In nisi neque, aliquet vel, dapibus id, mattis vel, nisi. Nullam mollis.. Phasellus hendrerit. Pellentesque aliquet nibh nec urna. In nisi neque, aliquet vel, dapiPhasellus hendrerit. Pellentesque aliquet nibh nec urna. In nisi neque, aliquet vel, dapi
        </div>
    </div>
</div>

<!-- Hotel Description - End -->

<?php ittour_show_template('single-tour/content.php', array('tour_info' => $tour_info)); ?>