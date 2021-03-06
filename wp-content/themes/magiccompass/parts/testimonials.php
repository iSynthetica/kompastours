<?php
$thumbnail_url = get_the_post_thumbnail_url(null, 'full');

if (empty($thumbnail_url)) {
    $thumbnail_url = snth_default_image();
}

snth_show_template('titles/static-image-bg.php', array(
        'title' => get_the_title(),
        'thumbnail_url' => $thumbnail_url
    )
);
?>

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
</div>