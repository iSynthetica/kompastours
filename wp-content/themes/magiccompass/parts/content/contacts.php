<?php
/**
 * Created by PhpStorm.
 * User: snth
 * Date: 27.01.19
 * Time: 12:56
 */
?>

<div class="row">
    <div class="col-md-8 col-lg-9">

        <div class="form_title">
            <h3><strong><i class="fas fa-pencil-alt"></i></strong>Fill the form below</h3>
            <p>
                Mussum ipsum cacilds, vidis litro abertis.
            </p>
        </div>

        <div class="step">
            <div id="message-contact"></div>

            <?php echo do_shortcode('[contact-form-7 id="1760" title="Contacts"]'); ?>
        </div>
    </div>
    <div class="col-md-4 col-lg-3">
        <div class="box_style_4">
            <i class="icon_set_1_icon-57"></i>

            <?php echo do_shortcode('[snth_footer_first_sidebar]'); ?>
        </div>
    </div>
</div>