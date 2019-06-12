<?php

?>
<div id="single-tour-price__holder" class="text-center mb-0 ptb-20<?php echo !empty($tour_on_stop) ? ' tour_on_stop' : ''; ?><?php echo !empty($tour_need_to_validate) ? ' tour_need_to_validate' : ''; ?>">
    <div class="tour_price text-center font-alt d-inline-block d-md-block">
        <strong><?php echo $price_uah ?></strong> <small><?php echo __('uah.', 'snthwp'); ?></small>
    </div>

    <div class="tour_price_currency text-center font-alt d-inline-block d-md-block">
        <sup><?php echo $main_currency_label; ?></sup><strong><?php echo $price_currency; ?></strong>
    </div>
</div>

<button class="btn shape-rnd type-hollow size-xs size-extended text-uppercase font-alt font-weight-900 validate-btn d-none"
        data-key="<?php echo $tour_info_key; ?>"
        data-currency="<?php echo $main_currency; ?>"
        type="button"
>
    <i class="fas fa-sync-alt d-inline-block mr-10"></i> <?php echo __('Check tour actuality', 'snthwp'); ?>
</button>
