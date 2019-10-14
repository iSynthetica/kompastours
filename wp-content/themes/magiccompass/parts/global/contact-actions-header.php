<?php
/**
 * Display Head Global Scripts
 *
 * @package WordPress
 * @subpackage Magiccompass/Parts/Global
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;

$phones = get_field('phones', 'options');
$messangers = get_field('messangers', 'options');

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

<div id="contact-actions-header__holder">
    <div class="container-fluid prl-0">
        <div class="row no-gutters">
            <div class="col-12">
                <button id="phones-actions-header__btn" type="button" class="btn shape-rnd size-xs bg-success-color mb-0 ml-10 font-alt font-weight-900">
                    <?php echo $phones[0]["label"]; ?> <i class="fas fa-chevron-down"></i>
                </button>
            </div>
        </div>
    </div>

    <div id="phones-actions-header__holder" class="prl-10">
        <div>
            <?php
            unset ($phones[0]);
            foreach ($phones as $phone) {
                ?>
                <button class="btn bg-success-color size-xs size-extended shape-rnd font-alt font-weight-900"><?php echo $phone["label"]; ?></button>
                <?php
            }
            ?>
        </div>
    </div>
</div>
