<?php
/**
 * Destination Template.
 *
 * @package WordPress
 * @subpackage Magiccompass/ITtour
 * @version 0.0.8
 * @since 0.0.8
 */

if ( ! defined( 'ABSPATH' ) ) exit;

if (empty($template)) {
    $template = 'no-sidebar';
}

if (empty($content)) {
    $content = 'single';
}
$post_id = get_the_ID();

$subtitle = get_field('subtitle', get_the_ID());
$destination_type = wp_get_post_terms( $post_id, 'destination_type' );
$destination_type_template = $destination_type[0]->slug;
$thumbnail_url = get_the_post_thumbnail_url(null, 'full');

if (empty($thumbnail_url)) {
    $thumbnail_url = snth_default_image();
}

if ('country' === $destination_type_template) {
    $template = 'full-width';
    $country_id = get_field('ittour_id', $post_id);
    $destination_content = snth_get_template('destination/country.php', array('country_id' => $country_id));
} elseif('region' === $destination_type_template) {
    $template = 'full-width';
    $region_id = get_field('ittour_id', $post_id);
    $country_id = get_field('ittour_country_id', $post_id);
    $destination_content = snth_get_template('destination/region.php', array('country_id' => $country_id, 'region_id' => $region_id));
} elseif('hotel' === $destination_type_template) {
    $template = 'full-width';
    $hotel_id = get_field('ittour_id', $post_id);
    $hotel_rating = get_field('ittour_hotel_rating', $post_id);
    $country_id = get_field('ittour_country_id', $post_id);
    $region_id = get_field('ittour_region_id', $post_id);
    $destination_content = snth_get_template('destination/hotel.php', array(
            'country_id' => $country_id,
            'region_id' => $region_id,
            'hotel_id' => $hotel_id,
            'hotel_rating' => $hotel_rating,
    ));
}

snth_show_template('titles/static-image-bg.php', array(
        'title' => get_the_title(),
        'thumbnail_url' => $thumbnail_url
    )
);
?>

<div class="wrap">
    <?php
    if ( 'full-width' === $template ) {
        ?>
        <div id="primary" class="content-area">
            <main id="main" class="site-main" role="main">
                <?php echo $destination_content; ?>
            </main>
        </div>
        <?php
    } else {
        ?>
        <div class="container ptb-20 ptb-md-40 ptb-lg-60">
            <div class="row">
                <?php
                if ( 'right-sidebar' === $template ) {
                    ?>
                    <div id="primary" class="content-area col-lg-9">
                        <main id="main" class="site-main" role="main">
                            <?php echo $destination_content; ?>
                        </main>
                    </div>

                    <aside class="col-lg-3">
                        <?php get_sidebar(); ?>
                    </aside>
                    <?php
                } elseif ( 'left-sidebar' === $template ) {
                    ?>
                    <aside class="col-lg-3">
                        <?php get_sidebar(); ?>
                    </aside>

                    <div id="primary" class="content-area col-lg-9">
                        <main id="main" class="site-main" role="main">
                            <?php echo $destination_content; ?>
                        </main>
                    </div>
                    <?php
                } else {
                    ?>
                    <div id="primary" class="content-area col-12">
                        <main id="main" class="site-main" role="main">
                            <?php echo $destination_content; ?>
                        </main>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
        <?php
    }
    ?>
</div>