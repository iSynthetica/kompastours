<?php
/**
 * Display Head Global Scripts
 *
 * @package WordPress
 * @subpackage Magiccompass/Parts/Global
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * @var $phones
 * @var $messangers
 */
$viber_link = '';

if (!empty($messangers)) {
    foreach ($messangers as $messanger) {
        if ('viber' === $messanger["icon"] && 'mobile' === $messanger["use_on"]) {
            $viber_link = $messanger["link"];

            break;
        }
    }
}
?>

<div id="contact-actions__holder">
    <div class="container-fluid prl-0">
        <div class="row no-gutters">
            <div class="col-6">
                <button id="phones-actions__btn" type="button" class="btn size-sm bg-success-color size-extended mb-0 font-alt font-weight-900">
                    <i class="fas fa-phone-volume"></i>
                    <?php _e('Call Us', 'snthwp') ?>
                </button>
            </div>

            <div class="col-6">
                <a href="<?php echo $viber_link; ?>" class="btn size-sm bg-viber-color size-extended mb-0 font-alt font-weight-900">
                    <i class="fab fa-viber"></i>
                    <?php _e('Write Us', 'snthwp') ?>
                </a>
            </div>

            <div class="col-12">
                <button href="#find-me-tour-popup" type="button" class="modal-popup btn size-sm bg-primary-color size-extended mb-0 font-alt font-weight-900">
                    <i class="far fa-question-circle"></i>
                    <?php _e('Find me a tour', 'snthwp') ?>
                </button>
            </div>
        </div>
    </div>

    <div id="phones-actions__holder" class="p-10">
        <?php
        foreach ($phones as $phone) {
            ?>
            <a href="<?php echo $phone["link"]; ?>" class="btn bg-success-color size-sm size-extended shape-rnd"><?php echo $phone["label"]; ?></a>
            <?php
        }
        ?>

        <button class="phones-actions__close icon type-bg type-hollow hvr-invert size-xs shape-rnd bg-danger-color">
            <i class="fas fa-times"></i>
        </button>
    </div>
</div>
