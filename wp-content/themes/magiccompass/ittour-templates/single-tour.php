<?php
/**
 * Display Single Tour content
 *
 * @package WordPress
 * @subpackage Magiccompass/ITtour
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

if (empty($template)) {
    $template = 'no-sidebar';
}

$is_ajax = false;

if (empty($_GET['key'])) {
    $ittour_content = ittour_get_template('single-tour-content.php', array('tour_info' => $tour_info));
} else {
    $tour_key = $_GET['key'];
    $tour = ittour_tour($tour_key, 'uk');
    $tour_info = $tour->info();

    $ittour_content = ittour_get_template('single-tour-content.php', array('tour_info' => $tour_info));

    $country = ittour_get_destination_by_ittour_id($tour_info['country_id']);

    if (!empty($country)) {
        $country_url = get_permalink($country[0]->ID);
        $country_title = '<a href="'.$country_url.'">'.$tour_info['country'].'</a>';
    } else {
        $country_title = $tour_info['country'];
    }

    $region = ittour_get_destination_by_ittour_id($tour_info['region_id']);

    if (!empty($region)) {
        $region_url = get_permalink($region[0]->ID);
        $region_title = '<a href="'.$region_url.'">'.$tour_info['region'].'</a>';
    } else {
        $region_title = $tour_info['region'];
    }
    ?>
    <section class="simple-page-title__section bg-gray pb-20 pt-60 mt-60">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-lg-9">
                    <div style="font-size:16px"><strong><?php echo __('Tour description to'); ?>:</strong></div>
                    <h1 class="hotel_title"><?php echo $tour_info['hotel']; ?> <?php echo ittour_get_hotel_number_rating_by_id($tour_info['hotel_rating']); ?></h1>
                    <div class="hotel_location"><i class="fas fa-map-marker-alt"></i> <?php echo $country_title . ', ' .$region_title; ?></div>
                </div>

                <div class="col-md-4 col-lg-3">

                </div>
            </div>
        </div>
    </section>
    <?php
}
?>

<div class="wrap">
    <?php
    if ( 'full-width' === $template ) {
        ?>
        <div id="primary" class="content-area">
            <main id="main" class="site-main" role="main">
                <?php echo $ittour_content; ?>
            </main>
        </div>
        <?php
    } else {
        ?>
        <div class="container margin_60">
            <div class="row">
                <?php
                if ( 'right-sidebar' === $template ) {
                    ?>
                    <div id="primary" class="content-area col-lg-9">
                        <main id="main" class="site-main" role="main">
                            <?php echo $ittour_content; ?>
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
                            <?php echo $ittour_content; ?>
                        </main>
                    </div>
                    <?php
                } else {
                    ?>
                    <div id="primary" class="content-area col-12">
                        <main id="main" class="site-main" role="main">
                            <?php echo $ittour_content; ?>
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
