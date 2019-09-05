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
$tour = ittour_excursion_tour($tour_key, ITTOUR_LANG);
$tour_info = $tour->info();

$main_currency_label = array();
$main_currency = array();

$ittour_content = ittour_get_template('single-tour-excursion-content.php', array(
        'tour_info' => $tour_info,
        'main_currency_label' => $main_currency_label,
        'main_currency' => $main_currency,
    )
);

$thumbnail_url = snth_default_image();

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
