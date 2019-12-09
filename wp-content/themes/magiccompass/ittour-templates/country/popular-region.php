<?php
/**
 * Popular region Template.
 *
 * @package WordPress
 * @subpackage Magiccompass/Parts/Destination
 * @version 0.0.10
 * @since 0.0.10
 *
 * @var $country_post_id
 * @var $saved_prices_by_rating
 */

if ( ! defined( 'ABSPATH' ) ) exit;

$region = get_post($post_id);

$ittour_country = get_field('ittour_country_id', $region->ID);
$ittour_region = get_field('ittour_id', $region->ID);

$template_args = array(
    'country' => $ittour_country,
    'region' => $ittour_region,
    'template' => 'min-prices-by-region',
);

if (!empty($saved_prices_by_rating[$ittour_region])) {
    $template_args['saved_prices_by_rating'] = $saved_prices_by_rating[$ittour_region];
}
?>

<div class="region-grid__container mb-20">
    <div class="img_container">
        <div class="img_container">
            <a href="#">
                <img src="<?php echo SNTH_IMAGES_URL; ?>/placeholder-520x346.png" class="img-fluid" alt="Image">

                <?php
                if (!empty(get_the_post_thumbnail_url($region->ID))) {
                    ?>
                    <div class="img-overlay" style="background-image: url('<?php echo get_the_post_thumbnail_url($region->ID, 'full') ?>')"></div>
                    <?php
                } elseif (!empty(get_the_post_thumbnail_url($country_post_id))) {
                    ?>
                    <div class="img-overlay" style="background-image: url('<?php echo get_the_post_thumbnail_url($country_post_id, 'full') ?>')"></div>
                    <?php
                }
                ?>
            </a>
        </div>
    </div>

    <div class="content__container p-10 bg-white-color">
        <h3 class="hotel_title mtb-0">
            <?php echo $region->post_title; ?>
        </h3>

        <div class="ptb-20">
            <?php
            ittour_show_template('general/tours-min-prices.php', $template_args);
            ?>
        </div>

        <div class="row">
            <div class="col-md-10 offset-md-1 col-lg-8 offset-lg-2">
                <a href="<?php echo get_post_permalink( $region->ID ); ?>" class="btn shape-rnd type-hollow hvr-invert size-sm size-extended font-alt font-weight-900">
                    <?php echo __('Find tour', 'snthwp'); ?>
                </a>
            </div>
        </div>
    </div>
</div>
