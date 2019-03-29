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
                            <li><i class="icon-calendar-empty"></i> On <span>12 Nov 2020</span>
                            </li>
                            <li><i class="icon-inbox-alt"></i> In <a href="#">Top tours</a>
                            </li>
                            <li><i class="icon-tags"></i> Tags <a href="#">Works</a>, <a
                                        href="#">Personal</a>
                            </li>
                        </ul>
                    </div>

                    <div class="post-right"><i class="icon-comment"></i><a href="#">25 </a></div>
                </div>

                <h2 class="entry-title"><?php the_title(); ?></h2>

                <p>
                    Ludus albucius adversarium eam eu. Sit eu reque tation aliquip. Quo no dolorum albucius lucilius, hinc eligendi ut sed. Ex nam quot ferri suscipit, mea ne legere alterum repudiandae. Ei pri quaerendum intellegebat, ut vel consequuntur voluptatibus. Et volumus sententiae adversarium duo......
                </p>
                <p>
                    Ludus albucius adversarium eam eu. Sit eu reque tation aliquip. Quo no dolorum albucius lucilius, hinc eligendi ut sed. Ex nam quot ferri suscipit, mea ne legere alterum repudiandae. Ei pri quaerendum intellegebat, ut vel consequuntur voluptatibus. Et volumus sententiae adversarium duo......
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