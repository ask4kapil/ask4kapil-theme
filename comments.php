<?php
/**
 * The template for displaying comments
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
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

<div id="comments" class="comment-section clearfix">

	<?php if ( have_comments() ) : ?>
		<h3 class="title">
			<?php
				$comments_number = get_comments_number();
				if ( 1 === $comments_number ) {
					/* translators: %s: post title */
					printf( _x( 'One thought on &ldquo;%s&rdquo;', 'comments title', 'ask4kapil' ), get_the_title() );
				} else {
					printf(
						/* translators: 1: number of comments, 2: post title */
						_nx(
							'%1$s thought on &ldquo;%2$s&rdquo;',
							'%1$s thoughts on &ldquo;%2$s&rdquo;',
							$comments_number,
							'comments title',
							'ask4kapil'
						),
						number_format_i18n( $comments_number ),
						get_the_title()
					);
				}
			?>
		</h3>

		<?php the_comments_navigation(); ?>

		<ol class="commentlist">
			<?php
				wp_list_comments( array(
					'style'       => 'ol',
					'short_ping'  => true,
					'avatar_size' => 42,
				) );
			?>
		</ol><!-- .comment-list -->

		<?php the_comments_navigation(); ?>

	<?php endif; // Check for have_comments(). ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php _e( 'Comments are closed.', 'ask4kapil' ); ?></p>
	<?php endif; ?>

	<div id="" class="form-input-group clearfix">
		<?php
		$fields =  array(
				'author' =>
					'<input class="col-md-6" id="author" name="author" type="text" placeholder="Name" size="30" aria-required="true">',

				'email' =>
					'<input class="col-md-6" id="email" name="email" type="email" placeholder="Email" size="30" aria-required="true"> '


			);
			comment_form( array(
				'title_reply' => 'Leave a comment',
				'title_reply_to'    => 'Leave a comment to %s',
  				'cancel_reply_link' => 'Cancel comment',
				'comment_notes_before' => '',
				'title_reply_before' => '<h2 id="reply-title" class="comment-reply-title">',
				'title_reply_after'  => '</h2>',
				'class_submit' => 'btn',
				'comment_field' =>  '<textarea class="form-control" id="comment" name="comment" placeholder="Message" rows="8" required=""></textarea>',
				'fields' => apply_filters( 'comment_form_default_fields', $fields )
			) );
		?>
	</div>
</div><!-- .comments-area -->
