<?php
/**
 * Created by PhpStorm.
 * User: snth
 * Date: 14.06.19
 * Time: 20:00
 */

/**
 * @var $claim
 */
?>

<div id="claim_info__holder" class="crm-card">
    <div class="crm-card__header">
        <h3><?php _e('Claim Info', 'snthwp'); ?></h3>
    </div>

    <div class="crm-card__body">
        <div id="claim_description" class="crm-card__item">
            <?php echo $claim->excerpt ?>
        </div>
    </div>
</div>
