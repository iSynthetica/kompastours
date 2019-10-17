<?php
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
    'post_type'   => 'testimonial',
    'suppress_filters' => false, // подавление работы фильтров изменения SQL запроса
);

$testimonials = get_posts( $args );

if ($testimonials) {
    ?>
    <section id="testimonials" class="ptb-20 ptb-md-40 ptb-lg-60">
        <div class="container">
            <?php snth_show_template('global/testimonials-carousel.php', array('testimonials' => $testimonials)); ?>
        </div>
    </section>
    <?php
}
?>



