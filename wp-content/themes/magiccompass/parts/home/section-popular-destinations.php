<?php
/**
 * Popular destinations for Home page
 *
 * @package WordPress
 * @subpackage Magiccompass/Parts/Home
 * @version 0.0.11
 * @since 0.0.11
 */

if ( ! defined( 'ABSPATH' ) ) exit;

$popular_destinations = get_field('popular_destinations');

if (empty($popular_destinations) || empty($popular_destinations['section_content']['countries'])) {
    return;
}
?>

<section id="popular_destinations" class="ptb-20 ptb-md-40 ptb-lg-40 bg-white-color">
    <div class="container">
        <?php
        if (!empty($popular_destinations['section_title'])) {
            ?>
            <div class="row">
                <div class="col-12">
                    <h2 class="text-center mt-0 mb-20 mb-md-40 font-weight-600"><?php echo $popular_destinations['section_title']; ?></h2>
                </div>
            </div>
            <?php
        }
        ?>

        <div class="row">
            <?php
            $saved_prices_by_rating = get_option('ittour_prices_by_rating');
            $time = time();

            foreach ($popular_destinations['section_content']['countries'] as $country) {
                $ittour_country = get_field('ittour_id', $country->ID);
                $ittour_iso = get_field('ittour_iso', $country->ID);

                ?>
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="region-grid__container mb-20">
                        <div class="img_container">
                            <a href="<?php echo get_post_permalink( $country->ID ); ?>" style="display: block">
                                <img src="<?php echo SNTH_IMAGES_URL; ?>/ph650-253.jpg" class="img-fluid" alt="Image">

                                <?php
                                $img_url = get_the_post_thumbnail_url( $country->ID, 'long_small_thumb' );

                                if (!empty($img_url)) {
                                    ?>
                                    <div class="img-overlay lozad" data-background-image="<?php echo $img_url; ?>"></div>
                                    <?php
                                }
                                ?>

                                <div class="short_info with-flag">
                                    <span class="flag-icon flag-icon-<?php echo $ittour_iso; ?>"></span>

                                    <h3 class="hotel_title mtb-0 txt-white-color">
                                        <?php echo $country->post_title; ?>
                                    </h3>
                                </div>
                            </a>
                        </div>



                        <div class="content__container prl-20 ptb-10 bg-white-color">
                            <div class="pb-10" style="max-width: 240px; margin: auto">
                                <?php
                                if (empty($saved_prices_by_rating[$ittour_country])) {
                                    $template_args = array(
                                        'country' => $ittour_country,
                                        'type' => '1',
                                        'kind' => '1',
                                        'night_from' => '7',
                                        'night_till' => '7',
                                        'template' => 'min-prices-by-country',
                                    );

                                    ittour_show_template('general/tours-min-prices.php', $template_args);
                                } else {
                                    $prices_expired = $saved_prices_by_rating[$ittour_country]['expired'];

                                    if ($prices_expired > $time) {
                                        ittour_show_template('general/prices-by-rating.php', array(
                                            'country' => $ittour_country,
                                            'prices_by_rating' => $saved_prices_by_rating[$ittour_country]["prices"]
                                        ));
                                    } else {
                                        $template_args = array(
                                            'country' => $ittour_country,
                                            'type' => '1',
                                            'kind' => '1',
                                            'night_from' => '7',
                                            'night_till' => '7',
                                            'template' => 'min-prices-by-country',
                                            'prices_by_rating' => $saved_prices_by_rating[$ittour_country]["prices"]
                                        );

                                        ittour_show_template('general/tours-min-prices.php', $template_args);
                                    }
                                }
                                ?>
                            </div>

                            <div class="row">
                                <div class="col-md-10 offset-md-1 col-lg-8 offset-lg-2">
                                    <a href="<?php echo get_post_permalink( $country->ID ); ?>" class="btn shape-rnd type-hollow hvr-invert size-sm size-extended font-alt font-weight-900">
                                        <?php echo __('Find tour', 'snthwp'); ?>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</section>

