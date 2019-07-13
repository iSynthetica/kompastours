<?php
/**
 * Simple page title with center alignment
 *
 * @package WordPress
 * @subpackage Magiccompass/Parts
 * @version 0.1.2
 * @since 0.1.2
 */

if ( ! defined( 'ABSPATH' ) ) exit;

$from_cities_array = get_option('ittour_from_cities');
?>

<div id="find-me-tour-popup" class="bg-white-color mfp-hide col-md-9 col-12 m-auto find-me-tour-popup p-20">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <h3 class="section-title text-uppercase font-weight-900 text-center mt-0 mb-20 mb-md-40 mb-lg-60"><?php echo __('Send request', 'snthwp'); ?></h3>

                <form id="find-me-tour-form">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label for="clientName" class="font-alt"><?php echo __('Your name', 'snthwp'); ?> (<strong class="txt-red-color">*</strong>)</label>
                                <input type="text" class="form-control" id="clientName" name="clientName" placeholder="<?php echo __('Enter your name', 'snthwp'); ?>">
                            </div>
                        </div>

                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label for="clientEmail" class="font-alt"><?php echo __('Your email', 'snthwp'); ?></label>
                                <input type="email" class="form-control" id="clientEmail" name="clientEmail" placeholder="<?php echo __('Enter your email', 'snthwp'); ?>">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label for="clientPhone" class="font-alt"><?php echo __('Your phone', 'snthwp'); ?> (<strong class="txt-red-color">*</strong>)</label>
                                <input type="text" class="form-control" id="clientPhone" name="clientPhone" placeholder="+380XXXXXXXXX">
                            </div>
                        </div>

                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label class="font-alt"><?php echo __('Messangers for this phone', 'snthwp'); ?></label>
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

                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-6">
                                        <label for="date_from" class="font-alt"><?php echo __('Tour dates', 'snthwp'); ?> (<strong class="txt-red-color">*</strong>)</label>
                                        <input type="text" class="form-control datepicker" id="date_from" name="date_from" placeholder="<?php echo __('Enter tour date', 'snthwp'); ?>" readonly>
                                    </div>

                                    <div class="col-6">
                                        <label for="night_from" class="font-alt"><?php echo __('Nights', 'snthwp'); ?></label>
                                        <div class="numbers-alt numbers-gor style_1">
                                            <input type="number" value="7" id="night_from" data-min="1" data-max="30" class="qty2 form-control" name="night_from" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6">
                            <div class="row">
                                <div class="col-6 col-md-6">
                                    <div class="form-group">
                                        <label class="font-alt"><?php echo __('Adult amount', 'snthwp'); ?></label>
                                        <div class="numbers-alt numbers-gor style_1">
                                            <input type="number" value="2" id="adult_amount" data-min="1" data-max="4" class="qty2 form-control" name="adult_amount" readonly>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6 col-md-6">
                                    <div class="form-group">
                                        <label class="font-alt"><?php echo __('Children amount', 'snthwp'); ?></label>
                                        <div class="numbers-alt numbers-gor style_1">
                                            <input type="number" value="0" id="child_amount" data-min="0" data-max="3" class="qty2 form-control" name="child_amount" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <div class="row">
                                <div class="col-6 col-md-6">
                                    <div class="form-group">
                                        <label for="from_city" class="font-alt"><?php echo __('Departure city', 'snthwp'); ?></label>

                                        <select class="form-control" name="from_city" id="from_city">
                                            <?php
                                            foreach ($from_cities_array as $from_city_id => $from_city) {
                                                ?>
                                                <option value="<?php echo $from_city['name'] ?>"<?php echo $from_city_id == 2014 ? ' selected' : ''; ?>><?php echo $from_city['name'] ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-6 col-md-6">
                                    <div class="form-group">
                                        <label for="country_select" class="font-alt"><?php echo __('Select country', 'snthwp'); ?></label>
                                        <?php echo $form_fields["countries_req"]; ?>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="font-alt"><?php echo __('Price range', 'snthwp'); ?> ($)</label>
                                <div class="row">
                                    <div class="col-6">
                                        <input type="number" class="form-control" id="price_from" name="price_from" placeholder="<?php echo __('from', 'snthwp'); ?>">
                                    </div>

                                    <div class="col-6">
                                        <input type="number" class="form-control" id="price_till" name="price_till" placeholder="<?php echo __('till', 'snthwp'); ?>">
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label for="clientMessage" class="font-alt"><?php echo __('Your message', 'snthwp'); ?></label>
                                <textarea class="form-control" id="clientMessage" name="clientMessage" style="height: 124px"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="messages__holder"></div>

                    <div class="row justify-content-center">
                        <div class="col-12 col-md-10 col-lg-8 col-xl-6">
                            <button id="find-me-tour-form__submit" type="button" class="btn shape-rnd hvr-invert text-uppercase size-extended font-alt font-weight-900 mt-20 mb-0">
                                <?php echo __('Get proposals', 'snthwp'); ?>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


