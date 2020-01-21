<?php
/**
 * Country Content Template.
 *
 * @package WordPress
 * @subpackage Magiccompass/Parts/Destination
 * @version 0.0.9
 * @since 0.0.8
 */

if ( ! defined( 'ABSPATH' ) ) exit;

global $post;
global $ittour_global_form_args;

$template_args = array(
    'type' => 1,
    'items_per_page' => 12,
);

$popular_regions = get_field('popular_country_regions', get_the_ID());
?>

<section id="search-form__section" class="pt-10 pb-10 ptb-md-0 ">
    <div class="container">
        <?php ittour_show_template('form/section-search.php', $ittour_global_form_args); ?>
    </div>
</section>

<?php snth_show_template('breadcrumbs.php'); ?>

<section id="recomended-tours__section" class="ptb-40">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="main_title">
                    <h2 class="mt-0 mb-20"><?php the_title(); ?> - <small><?php echo __('<span>Top</span> Tours', 'snthwp'); ?></small></h2>
                </div>
            </div>
        </div>
    </div>

    <?php ittour_show_template('general/tours-list-ajax.php', array_merge($ittour_global_form_args, $template_args)); ?>
</section>

<?php
if (!empty($post->post_content)) {
    ?>
    <section id="recomended-tours__section" class="pb-40">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <?php the_content(); ?>
                </div>
            </div>
        </div>
    </section>
    <?php
}
if (!empty($popular_regions)) {
    ?>
    <section id="popular-regions__section" class="ptb-40 bg-gray-10-color">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="main_title">
                        <h2 class="mt-0 mb-40"><?php the_title(); ?> - <small><?php echo __('<span>Popular</span> Regions', 'snthwp'); ?></small></h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php
                $saved_prices_by_rating = ittour_get_region_prices_by_rating($country_id);
                $id_index = 1;

                foreach ($popular_regions as $region) {
                    ?>
                    <div class="col-lg-4 col-md-6">
                        <?php ittour_show_template('country/popular-region.php', array(
                            'post_id' => $region,
                            'country_post_id' => $post->ID,
                            'saved_prices_by_rating' => $saved_prices_by_rating
                        )); ?>
                    </div>
                    <?php
                    $id_index++;
                }
                ?>
            </div>
        </div>
    </section>
    <?php
}
?>