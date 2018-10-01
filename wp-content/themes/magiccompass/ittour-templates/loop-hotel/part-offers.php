<?php
/**
 * Created by PhpStorm.
 * User: snth
 * Date: 20.09.18
 * Time: 18:18
 */
?>

<h4><?php echo __('Offers', 'snthwp'); ?> <?php echo count($offers) ?></h4>

<div class="tour_hotel-offers">
    <ul>
    <?php
    foreach ($offers as $offer) {
        ?>
        <li>
            <a href="/tour-result/?key=<?php echo $offer['key'] ?>">
                <span><?php echo $offer['room_type'] ?></span> -
                <span><?php echo $offer['meal_type_full'] ?></span> -
                <span><?php echo $offer['duration'] ?> <?php _e('nights', 'snthwp'); ?> </span>
            </a>
        </li>
        <?php
    }
    ?>
    </ul>
</div>
<?php // var_dump($offers) ?>
