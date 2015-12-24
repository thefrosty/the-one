<article <?php hybrid_attr( 'post' ); ?>>

	<?php if ( is_singular( get_post_type() ) ) : // If viewing a single post. ?>

		<header class="entry-header">

			<h1 <?php hybrid_attr( 'entry-title' ); ?>><?php single_post_title(); ?></h1>

			<?php if ( 'post' == get_post_type() ) : ?>
				<div class="entry-meta">
					<?php TheOne\Inc\Functions\posted_on(); ?>
				</div><!-- .entry-meta -->
			<?php endif; ?>

		</header><!-- .entry-header -->

		<div <?php hybrid_attr( 'entry-content' ); ?>>
			<?php the_content(); ?>
			<?php wp_link_pages(); ?>
		</div><!-- .entry-content -->

		<?php if ( 'post' == get_post_type() ) : ?>
			<!-- Entry footer -->
			<footer class="entry-footer">
				<?php TheOne\Inc\Functions\entry_footer(); ?>
			</footer><!-- .entry-footer -->
		<?php endif ?>

		<?php edit_post_link( __( 'Edit', 'the-one' ), '<span class="edit-content">', '</span>' ); ?>

	<?php else : // If not viewing a single post. ?>
	<?php $has_medium_large = false !== TheOne\Inc\Functions\get_image_size( 'medium_large' ) ? true : false; ?>
	<?php $image_size = $has_medium_large ? 'medium_large' : 'large'; ?>
	<?php $image_size = apply_filters( 'theone_featured_image_size', $image_size ); ?>

	<div class="preview" <?php post_class(); ?>>

		<!-- Featured media ======================================== -->
		<a href="<?php echo esc_url( get_permalink() ); ?>" class="featured-media">
			<?php $post_thumbnail = get_the_image( array( 'size' => (string) $image_size, 'scan_raw' => true, 'scan' => true, 'link' => false, 'echo' => false ) ); ?>

			<?php if ( !empty( $post_thumbnail ) ) : ?>

				<?php echo $post_thumbnail; ?>

			<?php else: ?>

				<!-- SVG 16:10 ratio http://codepen.io/shshaw/post/responsive-placeholder-image -->
				<img src="data:image/svg+xml;charset=utf-8,%3Csvg xmlns%3D'http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg' viewBox%3D'0 0 16 10'%2F%3E" alt="<?php the_title(); ?>">

			<?php endif; ?>
		</a><!-- .featured-media -->

		<div class="overlay">

			<header class="entry-header">

				<?php the_title( '<h2 ' . hybrid_get_attr( 'entry-title' ) . '><a href="' . get_permalink() . '" rel="bookmark" itemprop="url">', '</a></h2>' ); ?>

				<?php if ( 'post' == get_post_type() ) : ?>
					<div class="entry-meta">
						<?php TheOne\Inc\Functions\posted_on(); ?>
					</div><!-- .entry-meta -->
				<?php endif; ?>

			</header><!-- .entry-header -->

			<?php if ( get_theme_mod( 'theone_display_excerpt' ) && get_the_excerpt() ) : ?>
				<div <?php hybrid_attr( 'entry-summary' ); ?>>
					<?php the_excerpt(); ?>
				</div><!-- .entry-summary -->
			<?php endif; ?>

		</div><!-- .overlay -->

		<!-- Edit link ======================================== -->
		<?php edit_post_link( __( 'Edit', 'the-one' ), '<span class="edit-content">', '</span>' ); ?>

	</div><!-- .preview -->

	<?php endif; // End single post check. ?>

</article><!-- .entry -->