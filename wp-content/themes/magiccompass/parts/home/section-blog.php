<?php
/**
 * Why us sections for Home page
 *
 * @package WordPress
 * @subpackage Magiccompass/Parts/Home
 * @version 0.0.11
 * @since 0.0.11
 */

if ( ! defined( 'ABSPATH' ) ) exit;

$blog = get_field('blog');

$blog_items = array(
        'test1',
        'test2',
        'test3',
        'test4',
        'test5',
        'test6',
);

$num = 6;

$args = array (
    'numberposts' => $num,
    'category'    => 0,
    'orderby'     => 'date',
    'order'       => 'DESC',
    'include'     => array(),
    'exclude'     => array(),
    'meta_key'    => '',
    'meta_value'  =>'',
    'post_type'   => 'post',
    'suppress_filters' => false, // подавление работы фильтров изменения SQL запроса
);

$latest_posts = get_posts( $args );

if ( $latest_posts ) {
    $original_post = $GLOBALS['post'];
    ?>
    <section id="blog" class="ptb-20 ptb-md-40 ptb-lg-60 bg-white-color blog-post-style3">
        <div class="container">
            <?php
            if (!empty($blog["section_title"])) {
                ?>
                <div class="row">
                    <div class="col-12">
                        <h2 class="text-center mt-0 mb-20 mb-md-40 font-weight-600"><?php echo $blog["section_title"]; ?></h2>
                    </div>
                </div>
                <?php
            }

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

                            <div class="blog-item-meta pb-10">
                                <span class="txt-gray-20-color txt-small text-uppercase d-inline-block"><?php echo get_the_date() ?></span>
                            </div>

                            <p><?php the_excerpt(); ?></p>

                            <div class="separator-line-horrizontal-full bg-gray-10-color mtb-10"></div>
                        </div>
                    </div>
                </div>
                <?php
            }

            ?>
            </div>
            <?php

            if (!empty($blog["primary_button"]["link"]) || $blog["secondary_button"]["link"]) {
                ?>
                <div class="row">
                    <div class="col-12">
                        <div class="text-center mt-10 mt-md-20 mt-lg-40">
                            <?php
                            if (!empty($blog["primary_button"]["link"])) {
                                ?>
                                <a
                                    class="btn size-xl shape-rnd hvr-invert prl-40 mrl-10 mb-0 text-uppercase font-alt font-weight-900"
                                    href="<?php echo $blog["primary_button"]["link"]['url'] ?>"
                                >
                                    <?php echo $blog['primary_button']['label'] ?>
                                </a>
                                <?php
                            }

                            if (!empty($blog["secondary_button"]["link"])) {
                                ?>
                                <a
                                    class="btn size-xl type-hollow shape-rnd hvr-invert prl-40 mrl-10 mb-0 text-uppercase font-alt font-weight-900"
                                    href="<?php echo $blog["secondary_button"]["link"]['url'] ?>"
                                >
                                    <?php echo $blog['secondary_button']['label'] ?>
                                </a>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </section>
    <?php
    $GLOBALS['post'] = $original_post;
}

wp_reset_postdata();

?>


