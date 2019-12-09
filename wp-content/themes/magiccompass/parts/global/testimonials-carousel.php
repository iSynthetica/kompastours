<?php
/**
 * @var $testimonials
 */

if ( $testimonials ) {
    $original_post = $GLOBALS['post'];
    ?>
    <div class="row position-relative row-eq-height">
        <div class="swiper-container swiper-pagination-bottom black-move blog-slider swiper-three-slides">
            <div class="swiper-wrapper">
                <?php
                foreach ($testimonials as $testimonial) {
                    $GLOBALS['post'] = $testimonial;
                    setup_postdata( $GLOBALS['post'] );
                    $rating = get_field('rating', get_the_ID());
                    $source = get_field('source', get_the_ID());
                    ?>
                    <!-- start testimonial item -->
                    <div class="col-12 col-lg-4 col-md-6 swiper-slide md-margin-four-bottom">
                        <div class="margin-half-all bg-white box-shadow-light text-center p-20 p-md-30">
                            <?php the_excerpt(); ?>
                            <span class="text-extra-dark-gray text-small text-uppercase d-block line-height-10 alt-font font-weight-600"><?php the_title(); ?></span>
                            <?php
                            if (!empty($rating['current']) && !empty($rating['max'])) {
                                ?>
                                <div class="mt-10">
                                    <?php snth_rating($rating['current'], $rating['max']); ?>
                                </div>
                                <?php

                            }

                            if (!empty($source['link'])) {
                                ?>
                                <div class="mt-10 text-small">
                                    <a href="<?php echo $source['link'] ?>" target="_blank" rel="nofollow"><?php echo !empty($source['label']) ? $source['label'] : $source['link']; ?></a>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                    <!-- end testimonial item -->
                    <?php
                }
                ?>
            </div>
            <div class="swiper-pagination swiper-pagination-three-slides h-auto"></div>
        </div>
    </div>
    <?php
    $GLOBALS['post'] = $original_post;
}

wp_reset_postdata();
?>

