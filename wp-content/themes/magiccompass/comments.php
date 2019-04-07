<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div class="comments-area">

	<?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) : ?>
		<h4 class="comments-title">
			<?php
			$comments_number = get_comments_number();
			if ( '1' === $comments_number ) {
				/* translators: %s: post title */
				printf( _x( 'One Reply to &ldquo;%s&rdquo;', 'comments title', 'twentyseventeen' ), get_the_title() );
			} else {
				printf(
					/* translators: 1: number of comments, 2: post title */
					_nx(
						'%1$s Reply to &ldquo;%2$s&rdquo;',
						'%1$s Replies to &ldquo;%2$s&rdquo;',
						$comments_number,
						'comments title',
						'twentyseventeen'
					),
					number_format_i18n( $comments_number ),
					get_the_title()
				);
			}
			?>
		</h4>


        <div id="comments">
            <ol class="comment-list">
                <?php
                wp_list_comments( array(
                    'max_depth'         => 4,
                    'callback'          => 'snth_comments_cb_end',
//                    'end-callback'      => 'snth_comments_cb_end',
                    'avatar_size' => 100,
                    'style'       => 'ol',
//                    'short_ping'  => true,
                ) );
                ?>
            </ol>
        </div>

		<?php the_comments_pagination(  );

	endif; // Check for have_comments().

	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>

		<p class="no-comments"><?php _e( 'Comments are closed.', 'twentyseventeen' ); ?></p>
	<?php
	endif;

	ob_start();
    snth_show_template('content/comments-fields-comment_field.php');
	$comment_field = ob_get_clean();

	ob_start();
    snth_show_template('content/comments-fields-author_field.php');
	$author_field = ob_get_clean();

	ob_start();
    snth_show_template('content/comments-fields-email_field.php');
	$email_field = ob_get_clean();

	ob_start();
    snth_show_template('content/comments-fields-url_field.php');
	$url_field = ob_get_clean();

	comment_form(array(
        'fields' => array(
            'author' => $author_field,
            'email' => $email_field,
            // 'url' => $url_field,
        ),
        'comment_field' => $comment_field,
        'class_submit' => 'btn_1'
    ));
	?>

</div><!-- #comments -->
