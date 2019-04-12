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