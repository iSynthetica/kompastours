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
$ittour_destination_id = get_field('ittour_id', $post_id);

$destination_content = snth_get_template('destination/'.$destination_type_template.'.php', array('ittour_id' => $ittour_destination_id));
?>

<section class="parallax-window" data-parallax="scroll" data-image-src="<?php the_post_thumbnail_url('full') ?>" data-natural-width="1400"
         data-natural-height="470">
    <div class="parallax-content-1">
        <div class="animated fadeInDown">
            <h1><?php the_title(); ?></h1>
            <?php
            if (!empty($subtitle)) {
                ?><h3 class="entry-subtitle"><?php echo $subtitle; ?></h3><?php
            }
            ?>
        </div>
    </div>
</section>

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
        <div class="container margin_60">
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