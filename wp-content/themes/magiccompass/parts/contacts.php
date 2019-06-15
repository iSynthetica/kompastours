<?php
/**
 * Created by PhpStorm.
 * User: snth
 * Date: 27.01.19
 * Time: 12:58
 */

if ( ! defined( 'ABSPATH' ) ) exit;

if (empty($template)) {
    $template = 'no-sidebar';
}

if (empty($content)) {
    $content = 'page';
}

$thumbnail = snth_get_post_thumbnail_url();

snth_show_template('titles/static-image-bg.php', array (
        'title' => get_the_title()
    )
);

$map = get_field('map', 'options');
$map_center = get_field('map_center', 'options');
$offices = get_field('office', 'options');
$map_markers = array();

$content_template = snth_get_template('content/'.$content.'.php', array (
    'offices' => $offices
));


foreach ($offices as $office) {
    ob_start();
    ?>
    <div class="location-info">
        <div class="location-info__inner">
            <div class="location-info__header">
                <h4 class="font-weight-900 mt-0 mb-10" style="font-size: 16px"><?php echo $office["title"] ?></h4>
            </div>

            <div class="location-info__body">
                <?php
                if (!empty($office["schedule"])) {
                    ?>
                    <h5 class="font-alt font-weight-900 mt-15 mb-5" style="font-size: 14px"><?php echo __('Schedule', 'snthwp') ?>:</h5>
                    <ul class="mb-0 pl-10" style="list-style: none">
                        <?php
                        foreach ($office["schedule"] as $schedule) {
                            ?>
                            <li><strong class="font-alt"><?php echo $schedule["description"] ?></strong>: <?php echo $schedule["time"] ?></li>
                            <?php
                        }
                        ?>
                    </ul>
                    <?php
                }
                ?>
            </div>

            <div class="location-info__footer">

            </div>
        </div>
    </div>
    <?php
    $info = ob_get_clean();

    $map_markers[] = array(
        'marker' => array(
            'lat' => $office["map"]["lat"],
            'lng' => $office["map"]["lng"],
        ),
        'title' => $office["title"],
        'info'  => $info
    );
}

$icon = SNTH_IMAGES_URL . '/map-marker.png';

wp_enqueue_script('gmapLocations');

wp_localize_script('gmapLocations', 'jointsMapObj', array(
    'markers'   => $map_markers,
    'center'    => $map_center,
    'icon'      =>  $icon,
    'zoom'      =>  14,
));
?>

<?php snth_show_template('breadcrumbs.php'); ?>

<div class="wrap">
    <?php
    if ( 'full-width' === $template ) {
        ?>
        <div id="primary" class="content-area">
            <main id="main" class="site-main" role="main">
                <?php echo $content_template; ?>
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
                            <?php echo $content_template; ?>
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
                            <?php echo $content_template; ?>
                        </main>
                    </div>
                    <?php
                } else {
                    ?>
                    <div id="primary" class="content-area col-12">
                        <main id="main" class="site-main" role="main">
                            <?php echo $content_template; ?>
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

<section id="office-map__section">
    <div id="map-canvas"></div>
</section>