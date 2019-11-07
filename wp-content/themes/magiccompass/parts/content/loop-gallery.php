<?php
/**
 * Created by PhpStorm.
 * User: snth
 * Date: 27.01.19
 * Time: 12:56
 */
?>

<?php
if ( have_posts() ) {
    ?>
    <div class="row">
        <?php
        // Start the Loop.
        while ( have_posts() ) :
            the_post();

            if (has_post_thumbnail()) {
                $img_url = get_the_post_thumbnail_url( get_the_ID(), 'archive_photo_thumb' );
            } else {
                $thumbnail = get_field('blog_page_thumbnail', 'options');
                $img_url = wp_get_attachment_image_url($thumbnail, 'archive_photo_thumb');
            }
            ?>
            <div class="col-12 col-md-6 col-lg-4">
                <article class="post box_style_3">
                    <a href="<?php echo esc_url( get_permalink() ); ?>">
                        <img src="<?php echo $img_url; ?>" alt="Image" class="img-fluid">
                    </a>

                    <h2 class="entry-title"><?php the_title(); ?></h2>
                </article>
            </div>
        <?php
        endwhile;
        ?>
    </div>
    <?php
} else {

}
?>