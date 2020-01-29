<?php
/**
 * Simple page title with center alignment
 *
 * @package WordPress
 * @subpackage Magiccompass/IttourParts/General
 * @version 0.1.0
 * @since 0.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;

$client_name = !empty($_COOKIE['clientName']) ? $_COOKIE['clientName'] : '';
$client_phone = !empty($_COOKIE['clientPhone']) ? $_COOKIE['clientPhone'] : '';
$client_email = !empty($_COOKIE['clientEmail']) ? $_COOKIE['clientEmail'] : '';

/**
 * @var array $tour_info
 */
?>
<div id="modal-request-popup" class="bg-white-color mfp-hide col-xl-5 col-md-9 col-11 m-auto modal-popup-main p-20">
    <div id="booking-form__container">
        <div id="booking-form__body">
            <form action="" id="booking-form">
                <?php ittour_show_template('single-excursion-tour/book-tour-form-hidden-fields.php', array('tour_info' => $tour_info)) ?>

                <header id="booking-form__header" class="mb-10 mb-md-20"></header>

                <div id="booking-form__content">
                    <div class="row">
                        <div class="col-lg-6">
                            <div id="booking-details__holder">
                                <h5 class="mt-0 mb-10 font-weight-700 text-center"><?php echo $tour_info['name']; ?></h5>

                                <div class="mb-10">
                                    <?php
                                    if (!empty($tour_info["countries"][0]["images"][0]["full"])) {
                                        ?>
                                        <img src="<?php echo $tour_info["countries"][0]["images"][0]["full"] ?>" alt="">
                                        <?php
                                    }
                                    ?>
                                </div>

                                <div class="tour-details-list mb-20 prl-5 prl-md-10 prl-lg-20">
                                    <div class="row">
                                        <?php
                                        if (!empty($tour_info["duration"])) {
                                            ?>
                                            <div class="col-6">
                                                <i class="far fa-clock list-item-icon"></i>

                                                <strong class="font-alt"><?php echo $tour_info["duration"] ?> <?php _e('nights', 'snthwp'); ?></strong>
                                            </div>
                                            <?php
                                        }

                                        if (!empty($tour_info["meal_type"]) && !empty($tour_info["meal_type_full"])) {
                                            ?>
                                            <div class="col-md-6">
                                                <i class="fas fa-utensils list-item-icon"></i>
                                                <strong class="font-alt"><?php echo $tour_info["meal_type"] ?> (<?php echo $tour_info["meal_type_full"] ?>)</strong>
                                            </div>
                                            <?php
                                        }

                                        if (!empty($tour_info["transport_type"])) {
                                            ?>
                                            <div class="col-md-6">
                                                <?php
                                                if ('flight' === $tour_info["transport_type"]) {
                                                    $transport = __('Plane', 'snthwp');
                                                    ?><i class="fas fa-plane list-item-icon"></i><?php
                                                } else {
                                                    $transport = __('Bus', 'snthwp');
                                                    ?><i class="fas fa-bus list-item-icon"></i><?php
                                                }
                                                ?>

                                                <strong class="font-alt"><?php echo $transport; ?></strong>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div id="contact-details__holder">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group text-left">
                                            <input type="text" value="<?php echo $client_name ?>" class="form-control" name="clientName" id="clientName" placeholder="<?php echo __('Your name', 'snthwp'); ?> (*)">
                                        </div>

                                        <div class="form-group text-left mb-5">
                                            <input type="text" value="<?php echo $client_phone ?>" class="form-control" name="clientPhone" id="clientPhone" placeholder="<?php echo __('Your phone', 'snthwp'); ?> +380XXXXXXXXX (*)">
                                        </div>

                                        <div class="form-group text-left">
                                            <div class="mt-5 pl-10 pr-10">
                                                <div class="d-inline-block mr-10">
                                                    <input id="clientViber" name="clientViber" type="checkbox" value="viber">
                                                    <small><label class="mb-0" for="clientViber">Viber</label></small>
                                                </div>

                                                <div class="d-inline-block mr-10">
                                                    <input id="clientTelegram" name="clientTelegram" type="checkbox" value="telegram">
                                                    <small><label class="mb-0" for="clientTelegram">Telegram</label></small>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group text-left">
                                            <input type="text" value="<?php echo $client_email ?>" class="form-control" name="clientEmail" id="clientEmail" placeholder="<?php echo __('Your email', 'snthwp'); ?>">
                                        </div>

                                        <div id="additional-details__holder" class="mb-20">
                                            <div class="form-group text-left">
                                                <textarea name="clientQuestions" id="clientQuestions" rows="6" class="form-control" placeholder="<?php echo __('Do you have any questions? Ask them here.', 'snthwp'); ?>"></textarea>
                                            </div>
                                        </div>

                                        <div id="send-request__holder">
                                            <button
                                                    type="button"
                                                    class="book-btn btn-block btn bg-primary-color hvr-invert  size-sm shape-rnd font-alt text-uppercase font-weight-900"
                                            >
                                                <?php echo __('Send request', 'snthwp') ?>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="error_messages"></div>

                <footer id="booking-form__footer" class="text-center mt-0"></footer>
            </form>
        </div>
    </div>
</div>
