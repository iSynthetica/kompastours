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

if ('country' === $destination_type_template) {
    $country_id = get_field('ittour_id', $post_id);
    $destination_content = snth_get_template('destination/country.php', array('country_id' => $country_id));
} elseif('region' === $destination_type_template) {
    $region_id = get_field('ittour_id', $post_id);
    $country_id = get_field('ittour_country_id', $post_id);
    $destination_content = snth_get_template('destination/region.php', array('country_id' => $country_id, 'region_id' => $region_id));
} elseif('hotel' === $destination_type_template) {
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


?>

<!-- start page title section -->
<section class="cover-background ptb-40 ptb-md-80 ptb-lg-140 bg-overlay-holder" data-stellar-background-ratio="0.5" style="background-image:url('<?php the_post_thumbnail_url('full') ?>');">
    <div class="bg-overlay bg-black-color bg-opacity-40"></div>
    <div class="container">
        <div class="row">
            <div class="col-12 extra-small-screen text-center page-title-extra-small d-flex flex-column justify-content-center">
                <!-- start page title -->
                <h1 class="txt-white-color mt-10 entry-title title-style1"><?php the_title(); ?></h1>
                <!-- end page title -->
                <!-- start sub title -->

                <?php
                if (!empty($subtitle)) {
                    ?><h2 class="txt-white-color"><?php echo $subtitle; ?></h2><?php
                }
                ?>
                <!-- end sub title -->
            </div>
        </div>
    </div>
</section>
<!-- end page title section -->

<?php snth_show_template('breadcrumbs.php'); ?>

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