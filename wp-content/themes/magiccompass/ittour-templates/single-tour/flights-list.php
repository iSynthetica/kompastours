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
            <small id="changeFlightThere" class="change-flight__holder d-inline-block">(<span><?php echo __('change', 'snthwp'); ?> <i class="fas fa-angle-down"></i></span>)</small>
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
        <i class="fas fa-plane"></i> <strong><?php echo $from['code'] ?></strong> <?php echo $from['air_company'] ?> (<?php echo $from['travel_class'] ?>)<br>
        <strong><?php echo $from['date_from'] ?> <?php echo $from['time_from'] ?></strong> <?php echo $from['from_city'] ?> (<?php echo $from['from_airport'] ?>)
        <i class="fas fa-arrow-right"></i>
        <strong><?php echo $from['date_till'] ?> <?php echo $from['time_till'] ?></strong> <?php echo $from['to_city'] ?> (<?php echo $from['to_airport'] ?>)
        <i class="far fa-clock"></i> <?php echo $from['duration'] ?>
    </div>
    <?php
} else {
    ?>
    <div><small><?php _e('Departure time is specified and will be available within 48 hours.', 'snthwp'); ?></small></div>
    <?php
}
?>

<?php

if (!empty($flights_info['from'])) {
    $i = 1;
    ?>
    <ul id="flightThere__list" class="tour-details-list select-flight__holder" data-type="flightThere" style="display:none; line-height: 1.1">
        <?php
        foreach ($flights_info['from'] as $from) {
            $structured_val =   $from['code'] . '{}'
                       . $from['air_company'] . '{}'
                       . $from['travel_class'] . '{}'
                       . $from['date_from'] . '{}'
                       . $from['time_from'] . '{}'
                       . $from['from_city'] . '{}'
                       . $from['from_airport'] . '{}'
                       . $from['date_till'] . '{}'
                       . $from['time_till'] . '{}'
                       . $from['to_city'] . '{}'
                       . $from['to_airport'] . '{}'
                       . $from['duration'];

            $txt_val =   $from['code'] . ' - '
                       . $from['air_company'] . ' - '
                       . $from['travel_class'] . ' - '
                       . $from['date_from'] . ' - '
                       . $from['time_from'] . ' - '
                       . $from['from_city'] . ' - '
                       . $from['from_airport'] . ' - '
                       . $from['date_till'] . ' - '
                       . $from['time_till'] . ' - '
                       . $from['to_city'] . ' - '
                       . $from['to_airport'] . ' - '
                       . $from['duration'];
            ?>
            <li<?php echo 1 === $i ? ' class="selected"' : '' ?> data-structured-val="<?php echo $structured_val ?>" data-txt-val="<?php echo $txt_val ?>">
                <i class="fas fa-plane"></i> <strong><?php echo $from['code'] ?></strong> <?php echo $from['air_company'] ?> (<?php echo $from['travel_class'] ?>)<br>
                <strong><?php echo $from['date_from'] ?> <?php echo $from['time_from'] ?></strong> <?php echo $from['from_city'] ?> (<?php echo $from['from_airport'] ?>)
                <i class="fas fa-arrow-right"></i>
                <strong><?php echo $from['date_till'] ?> <?php echo $from['time_till'] ?></strong> <?php echo $from['to_city'] ?> (<?php echo $from['to_airport'] ?>)
                <i class="far fa-clock"></i> <?php echo $from['duration'] ?>
            </li>
            <?php
            $i++;
        }
        ?>
    </ul>

    <?php
}

?>

<h4 class="mt-10 mt-md-20"><?php _e('Flight back', 'snthwp'); ?>
    <?php
    if (!empty($flights_info['to'])) {
        $count_to = count($flights_info['to']);

        if ($count_to > 1) {
            ?>
            <small id="changeFlightBack" class="change-flight__holder d-inline-block">(<span><?php echo __('change', 'snthwp'); ?> <i class="fas fa-angle-down"></i></span>)</small>
            <?php
        }
    }
    ?>
</h4>

<?php
if (!empty($flights_info['to'])) {
    $from = $flights_info['to'][0];
    ?>
    <div id="flightBack__holder" style="line-height:1.1;font-size:13px;">
        <i class="fas fa-plane"></i> <strong><?php echo $from['code'] ?></strong> <?php echo $from['air_company'] ?> (<?php echo $from['travel_class'] ?>)<br>
        <strong><?php echo $from['date_from'] ?> <?php echo $from['time_from'] ?></strong> <?php echo $from['from_city'] ?> (<?php echo $from['from_airport'] ?>)
        <i class="fas fa-arrow-right"></i>
        <strong><?php echo $from['date_till'] ?> <?php echo $from['time_till'] ?></strong> <?php echo $from['to_city'] ?> (<?php echo $from['to_airport'] ?>)
        <i class="far fa-clock"></i> <?php echo $from['duration'] ?>
    </div>
    <?php
} else {
    ?>
    <div><small><?php _e('Departure time is specified and will be available within 48 hours.', 'snthwp'); ?></small></div>
    <?php
}
?>

<?php
if (!empty($flights_info['to'])) {
    $i = 1;
    ?>
    <ul id="flightBack__list" class="tour-details-list select-flight__holder" data-type="flightBack" style="display:none; line-height: 1.1">
        <?php
        foreach ($flights_info['to'] as $from) {
            $structured_val =   $from['code'] . '{}'
                                . $from['air_company'] . '{}'
                                . $from['travel_class'] . '{}'
                                . $from['date_from'] . '{}'
                                . $from['time_from'] . '{}'
                                . $from['from_city'] . '{}'
                                . $from['from_airport'] . '{}'
                                . $from['date_till'] . '{}'
                                . $from['time_till'] . '{}'
                                . $from['to_city'] . '{}'
                                . $from['to_airport'] . '{}'
                                . $from['duration'];

            $txt_val =   $from['code'] . ' - '
                         . $from['air_company'] . ' - '
                         . $from['travel_class'] . ' - '
                         . $from['date_from'] . ' - '
                         . $from['time_from'] . ' - '
                         . $from['from_city'] . ' - '
                         . $from['from_airport'] . ' - '
                         . $from['date_till'] . ' - '
                         . $from['time_till'] . ' - '
                         . $from['to_city'] . ' - '
                         . $from['to_airport'] . ' - '
                         . $from['duration'];
            ?>
            <li<?php echo 1 === $i ? ' class="selected"' : '' ?> data-structured-val="<?php echo $structured_val ?>" data-txt-val="<?php echo $txt_val ?>">
                <i class="fas fa-plane"></i> <strong><?php echo $from['code'] ?></strong> <?php echo $from['air_company'] ?> (<?php echo $from['travel_class'] ?>)<br>
                <strong><?php echo $from['date_from'] ?> <?php echo $from['time_from'] ?></strong> <?php echo $from['from_city'] ?> (<?php echo $from['from_airport'] ?>)
                <i class="fas fa-arrow-right"></i>
                <strong><?php echo $from['date_till'] ?> <?php echo $from['time_till'] ?></strong> <?php echo $from['to_city'] ?> (<?php echo $from['to_airport'] ?>)
                <i class="far fa-clock"></i> <?php echo $from['duration'] ?>
            </li>
            <?php
            $i++;
        }
        ?>
    </ul>
    <?php
}
?>

<hr>
