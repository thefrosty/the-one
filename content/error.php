<section class="no-results not-found" <?php hybrid_attr( 'post' ); ?>>

	<header class="entry-header">
		<h1 class="entry-title"><?php esc_html_e( 'Nothing Found', 'the-one' ); ?></h1>
	</header><!-- .entry-header -->

	<div class="page-content entry-content error" <?php hybrid_attr( 'entry-content' ); ?>>
		<div class="alert">
			<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

				<p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'the-one' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

			<?php elseif ( is_search() ) : ?>

				<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'the-one' ); ?></p>
				<?php get_search_form(); ?>

			<?php else : ?>

				<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'the-one' ); ?></p>
				<?php get_search_form(); ?>

			<?php endif; ?>
		</div><!-- .alert -->
	</div><!-- .page-content -->
</section><!-- .no-results -->