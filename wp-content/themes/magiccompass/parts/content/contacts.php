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

/**
 * @var $offices
 */

// var_dump($offices);
?>

<div class="row">
    <div class="col-md-8 col-lg-9">
        <div class="form_title">
            <h3 class="font-weight-900"><strong><i class="fas fa-thumbtack"></i></strong><?php _e('Our offices', 'snthwp'); ?></h3>
        </div>

        <div class="step">
            <div class="row">
                <?php
                foreach ($offices as $office) {
                    ?>
                    <div class="col-md-6">
                        <h4 class="font-weight-900 mt-0 mb-10"><?php echo $office["title"] ?></h4>
                        <?php
                        if (!empty($office["address"])) {
                            ?>
                            <p><?php echo $office["address"]; ?></p>
                            <?php
                        }
                        ?>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>

        <div class="form_title">
            <h3 class="font-weight-900"><strong><i class="fas fa-pencil-alt"></i></strong><?php _e('Write us a message', 'snthwp'); ?></h3>
        </div>

        <div class="step">
            <div id="message-contact"></div>

            <?php snth_show_template('global/form-contact.php'); ?>
        </div>
    </div>

    <div class="col-md-4 col-lg-3">
        <div class="box_style_5">
            <div class="box_header">
                <i class="icon_set_1_icon-57"></i>
            </div>

            <?php snth_show_template('shortcodes/sidebar-contacts.php'); ?>
        </div>
    </div>
</div>