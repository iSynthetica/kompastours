<?php
/**
 * Shortcodes
 *
 * @package Magiccompass/Includes
 */

if ( ! defined( 'ABSPATH' ) ) exit;

function snth_footer_first_sidebar_shortcode() {
    ob_start();

    snth_show_template('shortcodes/footer-sidebar-need-help.php');

    $content = ob_get_clean();

    return $content;
}
add_shortcode( 'snth_footer_first_sidebar', 'snth_footer_first_sidebar_shortcode' );

function snth_galleries_list($attr = array()) {
    $atts = shortcode_atts(
        array(
            'numberposts' => 6,
            'category'    => 0,
            'orderby'     => 'date',
            'order'       => 'DESC',
            'post_type'   => 'gallery',
            'suppress_filters' => false, // подавление работы фильтров изменения SQL запроса
        ),
        $attr
    );

    $latest_posts = get_posts( $atts );

    ob_start();
    if (!empty($latest_posts)) {
        $original_post = $GLOBALS['post'];
        ?>
        <div class="row">
            <?php
            foreach($latest_posts as $latest_post){
                $GLOBALS['post'] = $latest_post;
                setup_postdata( $GLOBALS['post'] );
                ?>
                <div class="col-12 col-lg-4 col-md-6 grid-item mb-20 mb-lg-30 text-center text-md-left">
                    <div class="blog-post bg-light-gray inner-match-height">
                        <div class="blog-post-images overflow-hidden position-relative">
                            <a href="<?php the_permalink(); ?>">
                                <?php
                                if('' !== get_the_post_thumbnail()) {
                                    the_post_thumbnail( 'blog_thumb' );
                                } else {
                                    ?>
                                    <img src="http://placehold.it/900x650" alt="">
                                    <?php
                                }
                                ?>
                                <div class="blog-hover-icon"><span class="text-extra-large font-weight-300">+</span></div>
                            </a>
                        </div>

                        <div class="post-details p-20 p-md-20">
                            <a href="<?php the_permalink(); ?>"
                               class="alt-font post-title width-100 d-block"
                            >
                                <h3 class="font-weight-900 mt-0"><?php the_title(); ?></h3>
                            </a>

                            <div class="separator-line-horrizontal-full bg-gray-10-color mtb-10"></div>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
        <?php
        $GLOBALS['post'] = $original_post;
    }

    wp_reset_postdata();
    return ob_get_clean();
}
add_shortcode( 'snth_galleries_list', 'snth_galleries_list' );

function snth_ittour_tours_grid($attr = array()) {
    $atts = shortcode_atts(
        array(
            'country' => 338,
            'type' => 1,
            'kind' => '',
            'from_city' => 2014,
            'region' => '',
            'hotel' => '',
            'hotel_rating' => '78', //
            'adult_amount' => '',
            'child_amount' => '',
            'child_age' => '',
            'night_from' => '',
            'night_till' => '',
            'date_from' => '',
            'date_till' => '',
            'meal_type' => '560:512:498:496:388:1956',
            'price_from' => '',
            'price_till' => '',
            'items_per_page' => 12,
        ),
        $attr
    );

    return ittour_get_template( 'general/tours-list-ajax.php', $atts );
}
add_shortcode( 'ittour_tours_grid', 'snth_ittour_tours_grid' );

function snth_tour_request_by_country_shortcode() {
    ob_start();

    snth_show_template('landings/section-order-form.php', array(
        'country' => 318,
        'title' => get_the_title()
    ));

    $content = ob_get_clean();

    return $content;
}
add_shortcode( 'snth_tour_request_by_country', 'snth_tour_request_by_country_shortcode' );

function snth_find_me_a_tour_shortcode() {
    $form_fields = ittour_get_form_fields(array());

    ob_start();

    ittour_show_template('general/form-find-me-tour-static.php', array('form_fields' => $form_fields));

    $content = ob_get_clean();

    return $content;
}
add_shortcode( 'snth_find_me_a_tour', 'snth_find_me_a_tour_shortcode' );

