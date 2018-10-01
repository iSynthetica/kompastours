<?php
/**
 * Created by PhpStorm.
 * User: snth
 * Date: 20.09.18
 * Time: 16:26
 */
?>


<p>
    <strong><?php echo __('Price', 'snthwp') ?>:</strong> <span class="tour-price_amount"><?php echo $tour_info['price'] ?></span> <span class="tour-price_currency"><?php echo ittour_get_currency_by_id($tour_info['currency_id']); ?></span>
</p>
<p>
    <strong><?php echo __('Price table', 'snthwp') ?>:</strong><br>
    <?php
    foreach ($tour_info['prices'] as $key => $price) {
        ?>
        <span class="tour-price_amount"><?php echo $price; ?></span> <span class="tour-price_currency"><?php echo ittour_get_currency_by_id($key); ?></span><br>
        <?php
    }
    ?>
</p>
