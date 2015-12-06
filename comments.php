<?php
// If a post password is required or no comments are given and comments/pings are closed, return.
if ( post_password_required() || ( !have_comments() && !comments_open() && !pings_open() ) ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>

		<h2 class="comments-title">
			<?php
			printf( _nx( 'One comment on &ldquo;%2$s&rdquo;', '%1$s comments on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'the-one' ), number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
			?>
		</h2><!-- .comments-title -->

		<ol class="comment-list">
			<?php wp_list_comments( array(
				'style' => 'ol',
				'avatar_size' => 80,
				'short_ping' => true,
				'callback' => 'hybrid_comments_callback',
				'end-callback' => 'hybrid_comments_end_callback',
			) ); ?>
		</ol><!-- .comment-list -->
		
		<?php locate_template( array( 'misc/comments-nav.php' ), true ); // Loads the misc/comments-nav.php template. ?>

	<?php endif; // have_comments() ?>

	<?php locate_template( array( 'misc/comments-error.php' ), true ); // Loads the misc/comments-error.php template. ?>

	<?php comment_form(); // Loads the comment form. ?>

</div><!-- #comments -->
