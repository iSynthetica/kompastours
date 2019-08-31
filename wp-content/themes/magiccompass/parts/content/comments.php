<?php
/**
 * Created by PhpStorm.
 * User: snth
 * Date: 05.04.19
 * Time: 19:22
 */

if ( ! defined( 'ABSPATH' ) ) exit;
?>

<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
    <div class="avatar">
        <?php echo get_avatar( $comment, apply_filters( 'woocommerce_review_gravatar_size', '60' ), '' ); ?>
    </div>

    <div class="comment_right clearfix">
        <div class="comment_info">
            <?php echo __('Posted by', 'snthwp'); ?> <?php comment_author(); ?>
            <span>|</span>
            <time datetime="<?php echo esc_attr( get_comment_date( 'c' ) ); ?>"><?php echo esc_html( get_comment_date(  ) ); ?></time>
            <span>|</span>
            <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
        </div>

        <?php
        echo '<div class="description">';
        comment_text();
        echo '</div>';
        ?>
    </div>