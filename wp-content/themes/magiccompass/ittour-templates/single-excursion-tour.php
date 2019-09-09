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

$tour_key = $_GET['key'];
$date_from                  = !empty($_GET['date_from']) ? sanitize_text_field($_GET['date_from']) : false;
$date_till                  = !empty($_GET['date_till']) ? sanitize_text_field($_GET['date_till']) : false;
$hikes                  = !empty($_GET['hikes']) ? sanitize_text_field($_GET['hikes']) : true;
$includes                  = !empty($_GET['includes']) ? sanitize_text_field($_GET['includes']) : true;
$desc                  = !empty($_GET['desc']) ? sanitize_text_field($_GET['desc']) : 'day_detail';

$args = array();

if ($date_from) $args['date_from']  = $date_from;
if ($date_till) $args['date_till']  = $date_till;
if ($hikes) $args['hikes']  = $hikes;
if ($includes) $args['includes']  = $includes;
if ($desc) $args['desc']  = $desc;

$tour = ittour_excursion_tour($tour_key, ITTOUR_LANG);
$tour_info = $tour->info($args);

$main_currency_label = array();
$main_currency = array();

$ittour_content = ittour_get_template('single-tour-excursion-content.php', array(
        'tour_info' => $tour_info,
        'main_currency_label' => $main_currency_label,
        'main_currency' => $main_currency,
    )
);

if (!empty($tour_info["countries"])) {
    foreach ($tour_info["countries"] as $country) {
        if (!empty($country["images"])) {
            foreach ($country["images"] as $image) {
                if (!empty($image['full'])) {
                    $thumbnail_url = $image['full'];

                    break 2;
                }
            }
        }
    }
}

if (empty($thumbnail_url)) {
    $thumbnail_url = snth_default_image();
}
?>

<section id="single_tour__heading" class="bg-gray-5-color ptb-lg-40 ptb-20 top-space">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-lg-9">
                <h1 class="hotel_title mt-0"><?php echo $tour_info['name']; ?></h1>

                <?php
                if (!empty($tour_info["countries"])) {
                    ?>
                    <div class="hotel_location">
                        <i class="fas fa-map-marker-alt"></i>
                        <?php
                        $i = 1;
                        $count = count($tour_info["countries"]);
                        foreach ($tour_info["countries"] as $country) {
                            ?>
                            <?php echo $country['name']; ?><?php echo $i < $count ? ', ' : ''; ?>
                            <?php
                            $i++;
                        }
                        ?>
                    </div>
                    <?php
                }
                ?>
            </div>

            <div class="col-md-4 col-lg-3">

            </div>
        </div>
    </div>
</section>

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
        <div class="container ptb-15 ptb-md-40">
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
