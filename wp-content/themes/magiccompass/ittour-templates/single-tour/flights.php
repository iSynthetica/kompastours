<?php
/**
 * Created by PhpStorm.
 * User: snth
 * Date: 20.09.18
 * Time: 16:27
 */
?>
<div id="tour-flights" class="tour-flights" style="padding-top: 25px; padding-bottom: 25px">
    <h2><?php echo __('Flights', 'snthwp'); ?></h2>

    <?php _e(''); ?>
    <?php
    foreach ($tour_info['flights']['from'] as $from) {

    }
    ?>

    <?php
    foreach ($tour_info['flights']['to'] as $to) {

    }
    ?>

    <?php var_dump($tour_info['flights']); ?>
</div>
