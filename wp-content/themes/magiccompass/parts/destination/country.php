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

$template_args = array(
    'type' => 1,
    'country' => $country_id,
    'tour_type'     => 1,
    'tour_kind'     => 1,
    'meal_type'     => '560:512:498',
    'items_per_page' => 12,
);

$template_args = array(
    'type' => 1,
    'country' => $country_id,
    'items_per_page' => 12,
    'from_city' => 2014,
);

$popular_regions = get_field('popular_country_regions', get_the_ID());
?>

<section id="search-form__section" class="pt-10 pb-10 ptb-md-0 ">
    <div class="container">
        <?php
        ittour_show_template('form/section-search.php', array(
            'country'       => $country_id,
            'hotel_rating'  => '78:4',
            'tour_type'     => '1',
            'tour_kind'     => '0',
            'meal_type'     => '560:512:498:496:388:1956',
        ));
        ?>
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

    <?php ittour_show_template('general/tours-list-ajax.php', $template_args); ?>
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
                //if (false) {
                    $id_index = 1;
                    foreach ($popular_regions as $region) {
                        ?>
                        <div class="col-lg-4 col-md-6">
                            <?php ittour_show_template('country/popular-region.php', array(
                                'post_id' => $region
                            )); ?>
                        </div>
                        <?php
                        $id_index++;
                    }
                //}
                ?>
            </div>
        </div>
    </section>
    <?php
}
?>