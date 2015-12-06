<li <?php hybrid_attr( 'comment' ); ?>>

	<article id="div-comment-<?php comment_ID(); ?>" class="comment-body">

		<footer class="comment-meta">

			<span class="comment-author vcard">
				<!-- Avatar -->
				<?php echo get_avatar( $comment ); ?>

				<!-- Author name and link -->
				<cite <?php hybrid_attr( 'comment-author' ); ?>><?php comment_author_link(); ?></cite>
			</span><!-- .comment-author -->

			<span class="comment-metadata">
				<!-- Time stamp -->
				<span class="comment-time">
					<a <?php hybrid_attr( 'comment-permalink' ); ?>>
						<time <?php hybrid_attr( 'comment-published' ); ?>><?php printf( esc_html__( '%s ago', 'the-one' ), human_time_diff( get_comment_time( 'U' ), current_time( 'timestamp' ) ) ); ?></time>
					</a>
				</span><!-- .comment-time -->

				<!-- Edit comment link -->
				<?php edit_comment_link( __( 'Edit', 'the-one' ), '<span class="edit-comment">', '</span>' ); ?>
			</span><!-- .comment-metadata -->

			<?php hybrid_comment_reply_link(); ?>

		</footer><!-- .comment-meta -->

		<div class="comment-content" <?php hybrid_attr( 'comment-content' ); ?>>
			<!-- Comment awaiting moderation message -->
			<?php if ( '0' == $comment->comment_approved ) : ?>
				<p class="comment-moderation"><?php _e( 'Your comment is awaiting moderation.', 'the-one' ); ?></p>
			<?php endif; ?>

			<!-- Comment text -->
			<?php comment_text(); ?>
		</div><!-- .comment-content -->

	</article><!-- .comment-body -->

	<!-- The <li> is closed by WordPress -->