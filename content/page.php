<article <?php hybrid_attr( 'post' ); ?>>

	<?php if ( is_page() ) : // If viewing a single page. ?>

		<header class="entry-header">
			<h1 <?php hybrid_attr( 'entry-title' ); ?>><?php single_post_title(); ?></h1>
		</header><!-- .entry-header -->

		<div <?php hybrid_attr( 'entry-content' ); ?>>
			<?php the_content(); ?>
			<?php wp_link_pages( array(
					'before' => '<div class="page-links">' . __( 'Pages:', 'the-one' ),
					'after'  => '</div>',
			) ); ?>
		</div><!-- .entry-content -->

	<?php else : // If not viewing a single page. ?>

		<?php get_the_image(); ?>

		<header class="entry-header">
			<?php the_title( '<h2 ' . hybrid_get_attr( 'entry-title' ) . '><a href="' . get_permalink() . '" rel="bookmark" itemprop="url">', '</a></h2>' ); ?>
		</header><!-- .entry-header -->

		<div <?php hybrid_attr( 'entry-summary' ); ?>>
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->

	<?php endif; // End single page check. ?>

	<?php edit_post_link( __( 'Edit', 'the-one' ), '<span class="edit-content">', '</span>' ); ?>

</article><!-- .entry -->