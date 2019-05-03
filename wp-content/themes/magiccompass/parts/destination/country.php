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

$template_args = array(
    'type' => 1,
    'country' => $country_id,
    'items_per_page' => 12,
);



?>
<section id="recomended-tours__section" class="ptb-40">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="main_title">
                    <h2 class="mt-0 mb-20"><?php the_title(); ?> <small><?php echo __('<span>Top</span> Tours', 'snthwp'); ?></small></h2>
                    <p>Quisque at tortor a libero posuere laoreet vitae sed arcu. Curabitur consequat.</p>
                </div>
            </div>
        </div>
    </div>

    <?php ittour_show_template('general/tours-list-ajax.php', $template_args); ?>
</section>

<section id="search-form__section" class="pt-20 pb-20 bg-gray-10-color">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="main_title">
                    <h2 class="mt-0 mb-40"><?php the_title(); ?> <small><?php echo __('<span>Top</span> Tours', 'snthwp'); ?></small></h2>
                </div>
            </div>
        </div>

        <?php
        ittour_show_template('form/section-search.php', array(
            'country'       => $country_id
        ));
        ?>
    </div>
</section>