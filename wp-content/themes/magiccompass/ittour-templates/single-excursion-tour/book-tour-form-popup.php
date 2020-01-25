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

/**
 * @var array $tour_info
 */
?>
<div id="modal-popup" class="bg-white-color mfp-hide col-xl-5 col-md-9 col-11 m-auto modal-popup-main p-20">
    <div id="booking-form__container">
        <div id="booking-form__body">
            <form action="" id="booking-form">
                <?php ittour_show_template('single-excursion-tour/book-tour-form-hidden-fields.php', array(
                    'tour_info' => $tour_info,
                )) ?>

                <header id="booking-form__header" class="mb-10 mb-md-20">
                    <h3 class="font-weight-900 mtb-0 text-center"><?php echo __('Tour booking', 'snthwp'); ?></h3>
                </header>

                <div id="booking-form__content">
                    <div id="booking-details__holder">
                        <h4 class="mt-0 mb-10 font-weight-900 text-center"><?php echo __('Tour details', 'snthwp'); ?></h4>

                        <div class="tour-details-list mb-20 prl-5 prl-md-10 prl-lg-20">
                            <div class="row">
                                <?php
                                if (!empty($tour_info["country"]) || !empty($tour_info["region"])) {
                                    ?>
                                    <div class="col-lg-6">
                                        <i class="fas fa-map-marker-alt list-item-icon"></i>

                                        <strong class="font-alt">
                                            <?php
                                            if (!empty($tour_info["country"])) {
                                                echo $tour_info["country"];
                                            }

                                            if (!empty($tour_info["region"])) {
                                                if (!empty($tour_info["country"])) {
                                                    echo ', ';
                                                }
                                                echo $tour_info["region"];
                                            }
                                            ?>
                                        </strong>
                                    </div>
                                    <?php
                                }

                                if (!empty($tour_info["hotel"])) {
                                    ?>
                                    <div class="col-lg-6">
                                        <i class="fas fa-h-square list-item-icon"></i>

                                        <strong class="font-alt">
                                            <?php echo $tour_info["hotel"] ?><?php echo $tour_info["hotel_rating"] ? ' ' . ittour_get_hotel_number_rating_by_id($tour_info["hotel_rating"]) : ''; ?>
                                        </strong>
                                    </div>
                                    <?php
                                }

                                if (!empty($tour_info["date_from"])) {
                                    ?>
                                    <div class="col-6">
                                        <i class="far fa-calendar-alt list-item-icon"></i>

                                        <strong class="font-alt"><?php echo snth_convert_date_to_human($tour_info["date_from"]); ?></strong>
                                    </div>
                                    <?php
                                }

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

                                if (!empty($tour_info["accomodation"]) && !empty($tour_info["room_type"])) {
                                    ?>
                                    <div class="col-md-6">
                                        <i class="fas fa-key list-item-icon"></i>
                                        <strong class="font-alt"><?php echo $tour_info["room_type"] ?></strong>
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

                                if (!empty($tour_info["from_city"])) {
                                    ?>
                                    <div class="col-md-6">
                                        <i class="fas fa-map-pin list-item-icon"></i>
                                        <small><?php _e('Departure from', 'snthwp'); ?>:</small>
                                        <strong class="font-alt"><?php echo $tour_info["from_city"] ?></strong>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                    <div id="contact-details__holder">
                        <h4 class="mt-0 mb-10 font-weight-900 text-center"><?php echo __('Contact details', 'snthwp'); ?></h4>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group text-left">
                                    <label for="clientName"><small><?php echo __('Your name', 'snthwp'); ?> (*)</small></label>
                                    <input type="text" class="form-control" name="clientName" id="clientName" placeholder="<?php echo __('Enter your name', 'snthwp'); ?>">
                                </div>
                            </div>

                            <div class="col-md-6 text-left">
                                <div class="form-group">
                                    <label for="clientEmail"><small><?php echo __('Your email', 'snthwp'); ?></small></label>
                                    <input type="text" class="form-control" name="clientEmail" id="clientEmail" placeholder="<?php echo __('Enter your email', 'snthwp'); ?>">
                                </div>
                            </div>
                        </div>

                        <div class="row client-phone__row">
                            <div class="col-md-6">
                                <div class="form-group text-left">
                                    <label for="clientPhone"><small><?php echo __('Your phone', 'snthwp'); ?> (*)</small></label>
                                    <input type="text" class="form-control" name="clientPhone" id="clientPhone" placeholder="+380XXXXXXXXX">
                                </div>
                            </div>

                            <div class="col-md-6 text-left">
                                <div class="form-group text-left">
                                    <label><small><?php echo __('Messangers for this phone', 'snthwp'); ?></small></label>

                                    <div class="mt-10">
                                        <div class="d-inline-block mr-10">
                                            <input id="clientViber" name="clientViber" type="checkbox" value="viber">
                                            <label class="mb-0" for="clientViber">Viber</label>
                                        </div>

                                        <div class="d-inline-block mr-10">
                                            <input id="clientTelegram" name="clientTelegram" type="checkbox" value="telegram">
                                            <label class="mb-0" for="clientTelegram">Telegram</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="error_messages"></div>

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
