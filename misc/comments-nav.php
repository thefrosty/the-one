<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>

	<nav id="comment-nav" class="comment-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'the-one' ); ?></h1>
		<div class="nav-links">
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'the-one' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'the-one' ) ); ?></div>
		</div><!-- .nav-links -->
	</nav><!-- #comment-nav -->

<?php endif; // check for comment navigation ?>