<?php
/**
 * Created by PhpStorm.
 * User: snth
 * Date: 20.09.18
 * Time: 16:26
 */
?>

<p>
    <strong><?php echo __('Price from', 'snthwp') ?>:</strong>
    <span class="tour-price_amount"><?php echo $price ?></span>
    <span class="tour-price_currency"><?php echo ittour_get_currency_by_id(2); ?></span>
    <strong><?php echo __('Adults', 'snthwp') ?>:</strong> <?php echo $adult_amount; ?>
    <strong><?php echo __('Children', 'snthwp') ?>:</strong> <?php echo $child_amount; ?>
</p>
