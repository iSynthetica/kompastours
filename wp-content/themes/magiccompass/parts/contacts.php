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
?>

<!-- start page title section -->
<section class="cover-background ptb-40 ptb-md-80 ptb-lg-140" data-stellar-background-ratio="0.5" style="background-image:url('<?php the_post_thumbnail_url('full') ?>');">
    <div class="opacity-medium bg-extra-dark-gray"></div>
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
    <div class="container margin_60">
        <div class="row">
            <?php
            if ( 'right-sidebar' === $template ) {
                ?>
                <div id="primary" class="content-area col-lg-9">
                    <main id="main" class="site-main" role="main">
                        <?php snth_show_template('content/'.$content.'.php'); ?>
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
                        <?php snth_show_template('content/'.$content.'.php'); ?>
                    </main>
                </div>
                <?php
            } else {
                ?>
                <div id="primary" class="content-area col-12">
                    <main id="main" class="site-main" role="main">
                        <?php snth_show_template('content/'.$content.'.php'); ?>
                    </main>
                </div>
                <?php
            }
            ?>
        </div>
    </div>

    <?php snth_show_template('content/contacts-map.php'); ?>
</div>