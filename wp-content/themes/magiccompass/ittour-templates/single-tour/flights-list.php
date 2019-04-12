<?php
/**
 * Created by PhpStorm.
 * User: snth
 * Date: 20.09.18
 * Time: 16:27
 */
?>

<h3><?php _e('Flights', 'snthwp'); ?></h3>

<h4><?php _e('Flight there', 'snthwp'); ?></h4>

<ul class="tour-details-list" style="line-height: 1.1">
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
        <li><?php _e('Departure time is specified and will be available within 48 hours.', 'snthwp'); ?></li>
        <?php
    }
    ?>
</ul>

<h4><?php _e('Flight back', 'snthwp'); ?></h4>

<ul class="tour-details-list" style="line-height: 1.1">
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
