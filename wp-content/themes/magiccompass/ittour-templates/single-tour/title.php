<?php
/**
 * Created by PhpStorm.
 * User: snth
 * Date: 20.09.18
 * Time: 16:24
 */

?>

<h1>
    <span class="tour_hotel-title"><?php echo $tour_info['hotel']; ?></span>
    <span class="tour_hotel-rating"><?php echo ittour_get_hotel_rating_by_id($tour_info['hotel_rating']); ?></span>,
    <span class="tour_meal-type"><?php echo $tour_info['meal_type']; ?></span>
    <span class="tour_transport-type"><?php echo ittour_get_transport_type_by_id($tour_info['transport_type']); ?></span>
</h1>

<h2>
    <?php echo $tour_info['country'] . ', ' .$tour_info['region']; ?>
</h2>
