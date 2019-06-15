<?php
/**
 * Country Content Template.
 *
 * @package WordPress
 * @subpackage Magiccompass/Parts/Destination
 * @version 0.0.9
 * @since 0.0.8
 */

if ( ! defined( 'ABSPATH' ) ) exit;
?>
<form id="contact-form">
    <div class="row">
        <div class="col-12 col-sm-6">
            <div class="form-group">
                <label for="clientName" class="font-alt"><?php echo __('Your name', 'snthwp'); ?> (<strong class="txt-red-color">*</strong>)</label>
                <input type="text" class="form-control" id="clientName" name="clientName" placeholder="<?php echo __('Enter your name', 'snthwp'); ?>">
            </div>
        </div>

        <div class="col-12 col-sm-6">
            <div class="form-group">
                <label for="clientName" class="font-alt"><?php echo __('Your email', 'snthwp'); ?> (<strong class="txt-red-color">*</strong>)</label>
                <input type="email" class="form-control" id="clientEmail" name="clientEmail" placeholder="<?php echo __('Enter your email', 'snthwp'); ?>">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-sm-6">
            <div class="form-group">
                <label for="clientName" class="font-alt"><?php echo __('Your phone', 'snthwp'); ?></label>
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
                <label for="clientMessage" class="font-alt"><?php echo __('Your message', 'snthwp'); ?></label>
                <textarea class="form-control" id="clientMessage" name="clientMessage" style="height: 124px"></textarea>
            </div>
        </div>
    </div>

    <div class="message-holder"></div>

    <div class="row">
        <div class="col-12 col-sm-6">
            <button id="contact-form__submit" type="button" class="btn shape-rnd hvr-invert text-uppercase size-extended font-alt font-weight-900 mt-20 mb-0">
                <i class="fas fa-paper-plane"></i> <?php echo __('Send', 'snthwp'); ?>
            </button>
        </div>
    </div>
</form>
