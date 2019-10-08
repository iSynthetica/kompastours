<?php
/**
 * Created by PhpStorm.
 * User: snth
 * Date: 27.01.19
 * Time: 14:40
 */
if ( ! defined( 'ABSPATH' ) ) exit;

if (empty($template)) {
    $template = 'no-sidebar';
}

if (empty($content)) {
    $content = 'loop';
}

$thumbnail = get_field('blog_page_thumbnail', 'options');
$home_page_for_posts = 1;

$title = '';
$subtitle = '';

if ((is_home() && $home_page_for_posts)) {
    $title = __('Blog', 'snthwp');
} else {
    ?>
    <?php
    the_archive_title( '<h1 class="page-title">', '</h1>' );
    the_archive_description( '<h3 class="entry-subtitle">', '</h3>' );
    ?>
    <?php
}

snth_show_template('titles/static-image-bg.php', array (
        'title' => $title,
        'thumbnail_url' => wp_get_attachment_image_url($thumbnail, 'full')
    )
);

snth_show_template('breadcrumbs.php');
?>

<div class="wrap">
    <div class="container ptb-20 ptb-md-40 ptb-lg-60">
        <div class="row">
            <?php
            if ( 'right-sidebar' === $template ) {
                ?>
                <div id="primary" class="content-area col-lg-9">
                    <main id="main" class="site-main" role="main">
                        <?php snth_show_template('content/'.$content.'.php'); ?>

                        <!-- Pagination -->
                        <?php snth_pagination(); ?>
                        <!-- End Pagination -->
                    </main>
                </div>

                <aside class="col-lg-3">
                    <?php get_sidebar('blog'); ?>
                </aside>
                <?php
            } elseif ( 'left-sidebar' === $template ) {
                ?>
                <aside class="col-lg-3">
                    <?php get_sidebar('blog'); ?>
                </aside>

                <div id="primary" class="content-area col-lg-9">
                    <main id="main" class="site-main" role="main">
                        <?php snth_show_template('content/'.$content.'.php'); ?>

                        <!-- Pagination -->
                        <?php snth_pagination(); ?>
                        <!-- End Pagination -->
                    </main>
                </div>
                <?php
            } else {
                ?>
                <div id="primary" class="content-area col-12">
                    <main id="main" class="site-main" role="main">
                        <?php snth_show_template('content/'.$content.'.php'); ?>

                        <!-- Pagination -->
                        <?php snth_pagination(); ?>
                        <!-- End Pagination -->
                    </main>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</div>