<?php
/**
 * Simple page title with center alignment
 *
 * @package WordPress
 * @subpackage Magiccompass/IttourParts/SingleTour
 * @version 0.1.0
 * @since 0.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;

if (empty($tour_info)) {
    return;
}
?>

<div class="box_style_1 expose table-summary_holder">
    <div class="text-center mb-0 ptb-20">
        <div class="tour_price text-center font-alt d-inline-block d-md-block">
            <strong><?php echo $tour_info['prices'][2] ?></strong> <small><?php echo __('uah.', 'snthwp'); ?></small>
        </div>

        <div class="tour_price_currency text-center font-alt d-inline-block d-md-block">
            (<sup>$</sup><strong><?php echo $tour_info['prices'][1] ?></strong>)
        </div>
    </div>

    <?php
    if (false ) {
        if (0 === $tour_info['stop_flight']) {
            ?>
            <a class="btn bg-success-color size-md shape-rnd hvr-invert size-extended" href="cart.html" style="margin-bottom:0;">Book now</a>
            <?php
        } else if (1 === $tour_info['stop_flight']) {
            ?>
            <?php echo __('Tour is not actual', 'snthwp'); ?>
            <?php
        }
    }
    ?>
    <button class="btn modal-popup bg-success-color size-md shape-rnd hvr-invert size-extended text-uppercase font-alt font-weight-900 mb-0" href="#modal-popup"><?php echo __('Book now', 'snthwp'); ?></button>

    <span class="mtb-5 d-block text-center txt-gray-40-color"><?php echo __('or', 'snthwp'); ?></span>

    <button class="btn bg-gray-50-color type-hollow size-sm shape-rnd hvr-invert size-extended text-uppercase font-alt font-weight-900"><?php echo __('Ask a question', 'snthwp'); ?></button>

    <!-- start modal pop-up -->
    <div id="modal-popup" class="bg-white-color mfp-hide col-xl-5 col-md-9 col-11 m-auto modal-popup-main p-20">

        <div id="booking-form__container">
            <div id="booking-form__body">
                <form action="" id="booking-form">
                    <header id="booking-form__header" class="mb-10 mb-md-20">
                        <h3 class="font-weight-900 mtb-0 text-center"><?php echo __('Tour booking', 'snthwp'); ?></h3>
                    </header>

                    <div id="booking-form__content">
                        <h4 class="mt-0 mb-10 font-weight-900 text-center"><?php echo __('Tour details', 'snthwp'); ?></h4>

                        <div id="booking-details__holder">
                            <div class="tour-details-list mb-20 prl-5 prl-md-10 prl-lg-20">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <i class="fas fa-map-marker-alt list-item-icon"></i>
                                        <strong>
                                            <?php echo $tour_info["country"] ?>, <?php echo $tour_info["region"] ?>
                                        </strong>
                                    </div>

                                    <div class="col-lg-6">
                                        <i class="fas fa-h-square list-item-icon"></i>
                                        <strong>
                                            <?php echo $tour_info["hotel"] ?> <?php echo ittour_get_hotel_number_rating_by_id($tour_info["hotel_rating"]) ?>
                                        </strong>
                                    </div>

                                    <?php
                                    if (!empty($tour_info["date_from"])) {
                                        ?>
                                        <div class="col-6">
                                            <i class="far fa-calendar-alt list-item-icon"></i>
                                            <strong><?php echo $tour_info["date_from"] ?></strong>
                                        </div>
                                        <?php
                                    }

                                    if (!empty($tour_info["duration"])) {
                                        ?>
                                        <div class="col-6">
                                            <i class="far fa-clock list-item-icon"></i>
                                            <strong><?php echo $tour_info["duration"] ?> <?php _e('nights', 'snthwp'); ?></strong>
                                        </div>
                                        <?php
                                    }

                                    if (!empty($tour_info["adult_amount"])) {
                                        ?>
                                        <div class="col-md-6">
                                            <i class="fas fa-male list-item-icon"></i>
                                            <small><?php echo __('Adults', 'snthwp') ?>:</small>
                                            <strong><?php echo $tour_info["adult_amount"] ?></strong>
                                        </div>
                                        <?php
                                    }

                                    if (!empty($tour_info["child_amount"])) {
                                        ?>
                                        <div class="col-md-6">
                                            <i class="fas fa-baby list-item-icon"></i>
                                            <small><?php echo __('Children', 'snthwp') ?>:</small>
                                            <strong><?php echo $tour_info["child_amount"] ?></strong>
                                        </div>
                                        <?php
                                    }

                                    if (!empty($tour_info["meal_type"]) && !empty($tour_info["meal_type_full"])) {
                                        ?>
                                        <div class="col-md-6">
                                            <i class="fas fa-utensils list-item-icon"></i>
                                            <strong><?php echo $tour_info["meal_type"] ?> (<?php echo $tour_info["meal_type_full"] ?>)</strong>
                                        </div>
                                        <?php
                                    }

                                    if (!empty($tour_info["accomodation"]) && !empty($tour_info["room_type"])) {
                                        ?>
                                        <div class="col-md-6">
                                            <i class="fas fa-key list-item-icon"></i>
                                            <?php echo $tour_info["room_type"] ?>
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

                                            <strong><?php echo $transport; ?></strong>
                                        </div>
                                        <?php
                                    }

                                    if (!empty($tour_info["from_city"])) {
                                        ?>
                                        <div class="col-md-6">
                                            <i class="fas fa-map-pin list-item-icon"></i>
                                            <small><?php _e('Departure from', 'snthwp'); ?>:</small>
                                            <strong><?php echo $tour_info["from_city"] ?></strong>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>

                        <h4 class="mt-0 mb-10 font-weight-900 text-center"><?php echo __('Contact details', 'snthwp'); ?></h4>

                        <div id="contact-details__holder">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group text-left">
                                        <label for="clientName"><small><?php echo __('Your name', 'snthwp'); ?> (*)</small></label>
                                        <input type="text" class="form-control" id="clientName" placeholder="<?php echo __('Enter your name', 'snthwp'); ?>">
                                    </div>
                                </div>

                                <div class="col-md-6 text-left">
                                    <div class="form-group">
                                        <label for="clientEmail"><small><?php echo __('Your email', 'snthwp'); ?></small></label>
                                        <input type="text" class="form-control" id="clientEmail" placeholder="<?php echo __('Enter your email', 'snthwp'); ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="row client-phone__row">
                                <div class="col-md-6">
                                    <div class="form-group text-left">
                                        <label for="clientPhone"><small><?php echo __('Your phone', 'snthwp'); ?> (*)</small></label>
                                        <input type="text" class="form-control" id="clientPhone" placeholder="<?php echo __('Enter your phone', 'snthwp'); ?>">
                                    </div>
                                </div>

                                <div class="col-md-6 text-left">
                                    <div class="form-group text-left">
                                        <label><small><?php echo __('Messangers for this phone', 'snthwp'); ?></small></label>

                                        <div class="mt-10">
                                            <div class="d-inline-block mr-10">
                                                <input id="clientViber" class="iCheckGray styled_1" type="checkbox" value="viber">
                                                <label class="mb-0" for="clientViber">Viber</label>
                                            </div>

                                            <div class="d-inline-block mr-10">
                                                <input id="clientTelegram" class="iCheckGray styled_1" type="checkbox" value="telegram">
                                                <label class="mb-0" for="clientTelegram">Telegram</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <footer id="booking-form__footer" class="text-center mt-10 mt-md-20">
                        <button type="button" class="btn bg-danger-color shape-rnd type-hollow popup-modal-dismiss">
                            <i class="fas fa-times"></i>
                        </button>

                        <button
                                type="button"
                                class="book-btn btn bg-primary-color shape-rnd font-alt text-uppercase font-weight-900"
                        >
                            <?php echo __('Book now', 'snthwp') ?>
                        </button>
                    </footer>
                </form>
            </div>
        </div>
    </div>
    <!-- end modal pop-up -->
</div>
