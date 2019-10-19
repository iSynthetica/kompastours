<?php
/**
 * Created by PhpStorm.
 * User: snth
 * Date: 27.01.19
 * Time: 12:56
 */

$args = array (
    'numberposts' => -1,
    'category'    => 0,
    'orderby'     => 'title',
    'order'       => 'ASC',
    'include'     => array(),
    'exclude'     => array(),
    'post_type'   => 'destination',
    'destination_type' => 'country',
    'tax_query' => array(
		array(
			'taxonomy' => 'destination_type',
			'field'    => 'slug',
			'terms'    => 'country'
		)
	),
//    'meta_key'		=> 'ittour_country_group',
//	'meta_value'	=> '1',
    'suppress_filters' => false, // подавление работы фильтров изменения SQL запроса
);

$latest_posts = get_posts( $args );

if ( $latest_posts ) {

    ob_start();

    $original_post = $GLOBALS['post'];
    ?>
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6 col-xl-4">
            <div class="mt-0 mb-20">
                <input type="text" class="form-control" value="" id="popularCountrySearch" placeholder="<?php echo __('Input Country title', 'snthwp') ?>">
            </div>
        </div>
    </div>

    <div itemscope itemtype="http://schema.org/ItemList">

        <div class="row">
            <div class="col-12 country-section-title">
                <h2 class="text-center mt-0 mb-20 mb-md-40 font-weight-600"><span itemprop="name"><?php echo __('Popular countries', 'snthwp') ?></span></h2>
            </div>

            <?php
            // Start the Loop.
            $i = 1;
            foreach($latest_posts as $country_key => $latest_post) {

                $GLOBALS['post'] = $latest_post;
                setup_postdata( $GLOBALS['post'] );

                $ittour_country_group = get_field('ittour_country_group');

                if (1 === (int)$ittour_country_group["value"] || 2 === (int)$ittour_country_group["value"]) {
                    $ittour_country = get_field('ittour_id');
                    $ittour_iso = get_field('ittour_iso');
                    ?>
                    <div class="col-12 col-md-6 col-lg-4 region-grid__col" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                        <meta itemprop="position" content="<?php echo $i; ?>" />
                        <meta itemprop="url" content="<?php echo esc_url( get_permalink() ); ?>" />
                        <div class="region-grid__container mb-20" itemtype="http://schema.org/TouristDestination" itemscope>
                            <div class="img_container">
                                <a href="<?php echo esc_url( get_permalink() ); ?>" style="display: block" itemprop="url">
                                    <img src="<?php echo SNTH_IMAGES_URL; ?>/ph650-253.jpg" class="img-fluid" alt="Image">

                                    <?php
                                    $img_url = get_the_post_thumbnail_url( get_the_ID(), 'long_small_thumb' );

                                    if (!empty($img_url)) {
                                        ?>
                                        <div class="img-overlay lozad" data-background-image="<?php echo $img_url; ?>"></div>
                                        <?php
                                    } else {
                                        ?>
                                        <div class="img-overlay lozad" data-background-image="<?php echo snth_default_image($size = 'long_small_thumb'); ?>"></div>
                                        <?php
                                    }
                                    ?>

                                    <div class="short_info with-flag">
                                        <span class="flag-icon flag-icon-<?php echo $ittour_iso; ?>"></span>

                                        <h3 class="hotel_title mtb-0 txt-white-color">
                                            <?php the_title(); ?>
                                        </h3>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php

                    unset($latest_posts[$country_key]);
                }
            }
    $GLOBALS['post'] = $original_post;

    echo ob_get_clean();

    if (!empty($latest_posts)) {
        ob_start();

        $original_post = $GLOBALS['post'];
        ?>
            <div class="col-12 country-section-title">
                <h2 class="text-center mt-0 mb-20 mb-md-40 font-weight-600"><?php echo __('Other countries', 'snthwp') ?></h2>
            </div>

            <?php
            // Start the Loop.
            $i = 1;
            foreach($latest_posts as $country_key => $latest_post) {

                $GLOBALS['post'] = $latest_post;
                setup_postdata( $GLOBALS['post'] );

                $ittour_country_group = get_field('ittour_country_group');
                $ittour_country = get_field('ittour_id');
                $ittour_iso = get_field('ittour_iso');
                ?>
                <div class="col-12 col-md-6 col-lg-4 region-grid__col">
                    <div class="region-grid__container mb-20">
                        <div class="img_container">
                            <a href="<?php echo esc_url( get_permalink() ); ?>" style="display: block">
                                <img src="<?php echo SNTH_IMAGES_URL; ?>/ph650-253.jpg" class="img-fluid" alt="Image">

                                <?php
                                $img_url = get_the_post_thumbnail_url( get_the_ID(), 'long_small_thumb' );

                                if (!empty($img_url)) {
                                    ?>
                                    <div class="img-overlay lozad" data-background-image="<?php echo $img_url; ?>"></div>
                                    <?php
                                } else {
                                    ?>
                                    <div class="img-overlay lozad" data-background-image="<?php echo snth_default_image($size = 'long_small_thumb'); ?>"></div>
                                    <?php
                                }
                                ?>

                                <div class="short_info with-flag">
                                    <span class="flag-icon flag-icon-<?php echo $ittour_iso; ?>"></span>

                                    <h3 class="hotel_title mtb-0 txt-white-color">
                                        <?php the_title(); ?>
                                    </h3>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
        <?php
        $GLOBALS['post'] = $original_post;

        echo ob_get_clean();

        ?>
        </div>
        <?php
    }
} else {

}

wp_reset_postdata();
?>
