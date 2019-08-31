<?php
/**
 * Created by PhpStorm.
 * User: snth
 * Date: 27.01.19
 * Time: 12:56
 */
?>

<div class="box_style_1">
    <div class="post nopadding">
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

        <?php the_content(); ?>
    </div>
</div>

<?php
if ( comments_open() || get_comments_number() ) :
    comments_template();
endif;
?>