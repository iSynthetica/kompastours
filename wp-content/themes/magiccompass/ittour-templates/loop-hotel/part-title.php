<?php
/**
 * Created by PhpStorm.
 * User: snth
 * Date: 20.09.18
 * Time: 18:05
 */
?>
<h3>
    <span class="tour_hotel-title"><?php echo $hotel['hotel']; ?></span>
    <span class="tour_hotel-rating"><?php echo ittour_get_hotel_rating_by_id($hotel['hotel_rating']); ?></span>
</h3>

<h4>
    <?php echo $hotel['country'] . ', ' .$hotel['region']; ?>
</h4>