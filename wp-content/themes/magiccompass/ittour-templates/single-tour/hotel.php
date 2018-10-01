<?php
/**
 * Created by PhpStorm.
 * User: snth
 * Date: 20.09.18
 * Time: 16:36
 */
?>
<div id="tour-hotel" class="tour-hotel" style="padding-top: 25px; padding-bottom: 25px">
    <h2><?php echo __('Hotel info', 'snthwp'); ?></h2>

    <?php ittour_show_template('single-tour/hotel-description.php', array('hotel_info' => $tour_info['hotel_info'])); ?>

    <?php
    unset($tour_info['beach']);
    unset($tour_info['disposition']);
    unset($tour_info['featureshotel']);
    unset($tour_info['descapt']);
    unset($tour_info['sport']);
    unset($tour_info['child']);
    unset($tour_info['description']);
    ?>

    <?php var_dump($tour_info['hotel_info']); ?>
</div>