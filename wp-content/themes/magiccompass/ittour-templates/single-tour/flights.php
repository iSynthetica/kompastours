<?php
/**
 * Created by PhpStorm.
 * User: snth
 * Date: 20.09.18
 * Time: 16:27
 */
?>
<div id="tour-flights" class="tour-flights">
    <table class="table table-striped cart-list add_bottom_30">
        <thead>
            <tr>
                <th></th>
                <th><?php echo __('Departure', 'snthwp'); ?></th>
                <th><?php echo __('Duration', 'snthwp'); ?></th>
                <th><?php echo __('Arrival', 'snthwp'); ?></th>
                <th></th>
            </tr>
        </thead>

        <tbody>
            <?php
            foreach ($flights_info['from'] as $from) {
                ?>
                <tr>
                    <td>
                        <?php echo $from['air_company'] ?><br>
                        <?php echo $from['code'] ?> (<?php echo $from['travel_class'] ?>)
                    </td>
                    <td>
                        <i class="fas fa-plane-departure"></i> <?php echo $from['from_city'] ?> (<?php echo $from['from_airport'] ?>)<br>
                        <?php echo $from['date_from'] ?> <?php echo $from['time_from'] ?>
                    </td>

                    <td>
                        <i class="far fa-clock"></i>  <?php echo $from['duration'] ?>
                    </td>

                    <td>
                        <i class="fas fa-plane-arrival"></i>  <?php echo $from['to_city'] ?> (<?php echo $from['to_airport'] ?>)<br>
                        <?php echo $from['date_till'] ?> <?php echo $from['time_till'] ?>
                    </td>

                    <td>

                    </td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>

    <table class="table table-striped cart-list add_bottom_30">
        <thead>
            <tr>
                <th></th>
                <th><?php echo __('Departure', 'snthwp'); ?></th>
                <th><?php echo __('Duration', 'snthwp'); ?></th>
                <th><?php echo __('Arrival', 'snthwp'); ?></th>
                <th></th>
            </tr>
        </thead>

        <tbody>
            <?php
            foreach ($flights_info['to'] as $from) {
                ?>
                <tr>
                    <td>
                        <?php echo $from['air_company'] ?><br>
                        <?php echo $from['code'] ?> (<?php echo $from['travel_class'] ?>)
                    </td>
                    <td>
                        <i class="fas fa-plane-departure"></i> <?php echo $from['from_city'] ?> (<?php echo $from['from_airport'] ?>)<br>
                        <?php echo $from['date_from'] ?> <?php echo $from['time_from'] ?>
                    </td>

                    <td>
                        <i class="far fa-clock"></i>  <?php echo $from['duration'] ?>
                    </td>

                    <td>
                        <i class="fas fa-plane-arrival"></i>  <?php echo $from['to_city'] ?> (<?php echo $from['to_airport'] ?>)<br>
                        <?php echo $from['date_till'] ?> <?php echo $from['time_till'] ?>
                    </td>

                    <td>

                    </td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>

    <?php // var_dump($flights_info); ?>
</div>
