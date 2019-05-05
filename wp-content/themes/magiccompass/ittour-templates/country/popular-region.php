<?php
/**
 * Popular region Template.
 *
 * @package WordPress
 * @subpackage Magiccompass/Parts/Destination
 * @version 0.0.10
 * @since 0.0.10
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
?>

<div class="region-grid__container mb-20">
    <div class="img_container">
        <div class="img_container">
            <a href="#">
                <img src="<?php echo SNTH_IMAGES_URL; ?>/placeholder-520x346.png" class="img-fluid" alt="Image">

                <?php
                if (!empty($hotel['images'][0]['full'])) {
                    ?>
                    <div class="img-overlay" style="background-image: url('<?php echo $hotel['images'][0]['full'] ?>')"></div>
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
            ittour_show_template('general/tours-list-ajax.php', $template_args);
            ?>
        </div>
    </div>
</div>
