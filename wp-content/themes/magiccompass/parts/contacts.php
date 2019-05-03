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

$content_template = snth_get_template('content/'.$content.'.php');
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