<?php

?>
<div id="single-tour-price__holder" class="text-center mb-0 ptb-20<?php echo !empty($tour_on_stop) ? ' tour_on_stop' : ''; ?>">
    <div class="tour_price text-center font-alt d-inline-block d-md-block">
        <strong><?php echo $price_uah ?></strong> <small><?php echo __('uah.', 'snthwp'); ?></small>
    </div>

    <div class="tour_price_currency text-center font-alt d-inline-block d-md-block">
        <sup><?php echo $main_currency_label; ?></sup><strong><?php echo $price_currency; ?></strong>
    </div>
</div>
