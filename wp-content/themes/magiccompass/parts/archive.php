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
?>

<section class="parallax-window" data-parallax="scroll" data-image-src="<?php echo wp_get_attachment_image_url($thumbnail, 'full') ?>" data-natural-width="1400"
         data-natural-height="470">
    <div class="parallax-content-1">
        <div class="animated fadeInDown">
            <h1><?php _e('Blog', 'snthwp'); ?></h1>
            <p>Ridiculus sociosqu cursus neque cursus curae ante scelerisque vehicula.</p>
        </div>
    </div>
</section>

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
                <div id="primary" class="content-area">
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