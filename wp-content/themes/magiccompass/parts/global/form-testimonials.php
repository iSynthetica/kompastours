<form id="send-testimonial">
    <div class="row">
        <div class="col-12 col-sm-4">
            <div class="form-group">
                <input type="text" class="form-control" id="clientName" name="clientName" placeholder="<?php echo __('Your name', 'snthwp'); ?> (*)">
            </div>
        </div>

        <div class="col-12 col-sm-4">
            <div class="form-group">
                <input type="email" class="form-control" id="clientEmail" name="clientEmail" placeholder="<?php echo __('Your email', 'snthwp'); ?>">
            </div>
        </div>

        <div class="col-12 col-sm-4">
            <div class="form-group">
                <input type="email" class="form-control" id="clientPhone" name="clientPhone" placeholder="<?php echo __('Your phone', 'snthwp'); ?>">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <textarea class="form-control" name="clientComment" id="clientComment" cols="30" rows="10"></textarea>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6 col-xl-4">
            <button id="send-testimonial-form__submit" type="button" class="btn shape-rnd hvr-invert text-uppercase size-extended font-alt font-weight-900 mt-20 mb-0">
                <?php echo __('Send', 'snthwp'); ?>
            </button>
        </div>
    </div>
</form>