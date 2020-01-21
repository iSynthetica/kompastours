<?php
/**
 * Created by PhpStorm.
 * User: snth
 * Date: 27.01.19
 * Time: 12:58
 */

if ( ! defined( 'ABSPATH' ) ) exit;

global $ittour_global_form_args;

if (empty($template)) {
    $template = 'no-sidebar';
}

if (empty($content)) {
    $content = 'page';
}

$thumbnail_url = !empty($thumbnail_url) ? $thumbnail_url : get_the_post_thumbnail_url(null, 'full');
?>

<section class="pt-120 pb-80 ptb-lg-0 cover-background screen-lg-medium screen-md-medium bg-overlay-holder" data-stellar-background-ratio="0.5" style="background-image:url('<?php echo $thumbnail_url ?>');">
    <div class="bg-overlay bg-black-color bg-opacity-1"></div>

    <div class="container">
        <div class="row">
            <div class="col-12 screen-xl-small-medium screen-lg-medium text-center page-title-extra-small d-flex flex-column justify-content-center">
                <h1 class="txt-white-color mt-10 entry-title title-style1"><?php echo the_title(); ?></h1>

                <?php
                if (!empty($subtitle)) {
                    ?><h2 class="txt-white-color"><?php echo $subtitle; ?></h2><?php
                }
                ?>

            </div>
        </div>
    </div>
</section>

<section id="search-form__section" class="pt-10 pb-10 ptb-md-0 ">
    <div class="container">
        <?php ittour_show_template('form/section-search.php', $ittour_global_form_args); ?>
    </div>
</section>

<?php snth_show_template('home/section-popular-destinations.php') ?>

<?php snth_show_template('home/section-why-us.php') ?>

<?php snth_show_template('home/section-testimonials.php') ?>

<?php snth_show_template('home/section-blog.php') ?>

<?php snth_show_template('home/section-gallery.php') ?>

<?php snth_show_template('home/section-partners.php') ?>

<?php snth_show_template('home/section-content.php') ?>

<div class="wrap">
    <?php snth_show_template('content/front-tour-section.php'); ?>
</div>