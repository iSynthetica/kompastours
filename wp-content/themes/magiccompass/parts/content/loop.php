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
    <div class="box_style_1">
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
            <article class="post">
                <a href="<?php echo esc_url( get_permalink() ); ?>">
                    <img src="<?php echo $img_url; ?>" alt="Image" class="img-fluid">
                </a>

                <div class="post_info clearfix">
                    <div class="post-left">
                        <ul>
                            <li>
                                <i class="far fa-calendar-alt"></i> <span><?php echo get_the_date(); ?></span>
                            </li>

                            <li>
                                <i class="far fa-folder"></i> In <?php echo get_the_term_list( get_the_ID(), 'category', '', ',', '' ); ?>
                            </li>

                            <li>
                                <i class="fas fa-tag"></i> Tags <?php echo get_the_term_list( get_the_ID(), 'post_tag', '', ',', '' ); ?>
                            </li>
                        </ul>
                    </div>

                    <div class="post-right"><i class="far fa-comment-dots"></i> <a href="#">25</a></div>
                </div>

                <h2 class="entry-title"><?php the_title(); ?></h2>

                <p>
                    <?php echo get_the_excerpt(); ?>
                </p>

                <a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark" class="btn_1">
                    <?php _e( 'Read more...', 'snthwp' ) ?>
                </a>
            </article>
        <?php
        endwhile;
        ?>
    </div>
    <?php
} else {

}
?>