<?php if ( is_home() || is_archive() || is_search() ) : // If viewing the blog, an archive, or search results. ?>

	<?php the_posts_pagination(
		array( 
			'prev_text' => esc_html_x( '&larr; Previous', 'posts navigation', 'the-one' ),
			'next_text' => esc_html_x( 'Next &rarr;',     'posts navigation', 'the-one' )
		) 
	); ?>

<?php endif; // End check for type of page being viewed. ?>

<?php TheOne\Inc\Functions\paging_nav(); ?>
