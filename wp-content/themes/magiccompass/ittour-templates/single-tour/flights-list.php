<?php
/**
 * Flights List Template.
 *
 * @package WordPress
 * @subpackage Magiccompass/Parts/Destination
 * @version 0.0.8
 * @since 0.0.8
 */

if ( ! defined( 'ABSPATH' ) ) exit;
?>

<hr>

<h4>
    <?php _e('Flight there', 'snthwp'); ?>

    <?php
    if (!empty($flights_info['from'])) {
        $count_from = count($flights_info['from']);

        if ($count_from > 1) {
            ?>
            <small>(<?php echo __('change', 'snthwp'); ?> <i class="fas fa-angle-down"></i>)</small>
            <?php
        }
    }
    ?>
</h4>

<?php
if (!empty($flights_info['from'])) {
    $from = $flights_info['from'][0];
    ?>
    <div id="flightThere__holder" style="line-height:1.1;font-size:13px;">
            <strong><?php echo $from['date_from'] ?> <?php echo $from['time_from'] ?></strong> <?php echo $from['from_city'] ?> (<?php echo $from['from_airport'] ?>)
            <i class="fas fa-arrow-right"></i>
            <strong><?php echo $from['date_till'] ?> <?php echo $from['time_till'] ?></strong> <?php echo $from['to_city'] ?> (<?php echo $from['to_airport'] ?>)
            <i class="far fa-clock"></i> <?php echo $from['duration'] ?>
            <i class="fas fa-plane"></i> <strong><?php echo $from['code'] ?></strong> <?php echo $from['air_company'] ?> (<?php echo $from['travel_class'] ?>)
    </div>
    <?php
} else {
    ?>
    <div><small><?php _e('Departure time is specified and will be available within 48 hours.', 'snthwp'); ?></small></div>
    <?php
}
?>

<ul class="tour-details-list d-none" style="line-height: 1.1">
    <?php
    if (!empty($flights_info['from'])) {
        foreach ($flights_info['from'] as $from) {
            ?>
            <li>
                <small>

                    <strong><?php echo $from['date_from'] ?> <?php echo $from['time_from'] ?></strong> <?php echo $from['from_city'] ?> (<?php echo $from['from_airport'] ?>)
                    <i class="fas fa-arrow-right"></i>
                    <strong><?php echo $from['date_till'] ?> <?php echo $from['time_till'] ?></strong> <?php echo $from['to_city'] ?> (<?php echo $from['to_airport'] ?>)
                    <i class="far fa-clock"></i> <?php echo $from['duration'] ?>
                    <i class="fas fa-plane"></i> <strong><?php echo $from['code'] ?></strong> <?php echo $from['air_company'] ?> (<?php echo $from['travel_class'] ?>)
                </small>
            </li>
            <?php
        }
    } else {
        ?>
        <li><small><?php _e('Departure time is specified and will be available within 48 hours.', 'snthwp'); ?></small></li>
        <?php
    }
    ?>
</ul>

<h4 class="mt-10 mt-md-20"><?php _e('Flight back', 'snthwp'); ?>
    <?php
    if (!empty($flights_info['to'])) {
        $count_to = count($flights_info['to']);

        if ($count_to > 1) {
            ?>
            <small>(<?php echo __('change', 'snthwp'); ?> <i class="fas fa-angle-down"></i>)</small>
            <?php
        }
    }
    ?>
</h4>

<?php
if (!empty($flights_info['to'])) {
    $from = $flights_info['to'][0];
    ?>
    <div id="flightThere__holder" style="line-height:1.1;font-size:13px;">
        <strong><?php echo $from['date_from'] ?> <?php echo $from['time_from'] ?></strong> <?php echo $from['from_city'] ?> (<?php echo $from['from_airport'] ?>)
        <i class="fas fa-arrow-right"></i>
        <strong><?php echo $from['date_till'] ?> <?php echo $from['time_till'] ?></strong> <?php echo $from['to_city'] ?> (<?php echo $from['to_airport'] ?>)
        <i class="far fa-clock"></i> <?php echo $from['duration'] ?>
        <i class="fas fa-plane"></i> <strong><?php echo $from['code'] ?></strong> <?php echo $from['air_company'] ?> (<?php echo $from['travel_class'] ?>)
    </div>
    <?php
} else {
    ?>
    <li><small><?php _e('Departure time is specified and will be available within 48 hours.', 'snthwp'); ?></small></li>
    <?php
}
?>

<ul class="tour-details-list d-none" style="line-height: 1.1">
    <?php
    if (!empty($flights_info['to'])) {
        foreach ($flights_info['to'] as $from) {
            ?>
            <li>
                <small>
                    <strong><?php echo $from['date_from'] ?> <?php echo $from['time_from'] ?></strong> <?php echo $from['from_city'] ?> (<?php echo $from['from_airport'] ?>)
                    <i class="fas fa-arrow-right"></i>
                    <strong><?php echo $from['date_till'] ?> <?php echo $from['time_till'] ?></strong> <?php echo $from['to_city'] ?> (<?php echo $from['to_airport'] ?>)
                    <i class="far fa-clock"></i> <?php echo $from['duration'] ?>
                    <i class="fas fa-plane"></i> <strong><?php echo $from['code'] ?></strong> <?php echo $from['air_company'] ?> (<?php echo $from['travel_class'] ?>)
                </small>
            </li>
            <?php
        }
    } else {
        ?>
        <li><small><?php _e('Departure time is specified and will be available within 48 hours.', 'snthwp'); ?></small></li>
        <?php
    }
    ?>
</ul>
