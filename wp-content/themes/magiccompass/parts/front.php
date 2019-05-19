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

<?php snth_show_template('home/section-why-us.php') ?>

<div class="wrap">
    <?php snth_show_template('content/front-tour-section.php'); ?>
</div>