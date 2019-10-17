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

    <?php
}
?>
<h1>Testimonials</h1>