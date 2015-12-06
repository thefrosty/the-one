<?php get_header(); // Loads the header.php template. ?>

	<div id="primary" class="content-area">

		<main class="site-main" <?php hybrid_attr( 'content' ); ?>>

		<?php hybrid_get_menu( 'secondary' ); // Loads the menu/secondary.php template. ?>

		<?php if ( ! is_front_page() && hybrid_is_plural() ) : // If viewing a multi-post page ?>

			<?php locate_template( array( 'misc/archive-header.php' ), true ); // Loads the misc/archive-header.php template. ?>

		<?php endif; // End check for multi-post page. ?>

		<?php do_action( 'theone_content_top' ); // add content top hook. ?>

		<?php if ( have_posts() ) : // Checks if any posts were found. ?>

			<?php while ( have_posts() ) : // Begins the loop through found posts. ?>

				<?php the_post(); // Loads the post data. ?>

				<?php hybrid_get_content_template(); // Loads the content/*.php template. ?>

				<?php if ( is_singular() ) : // If viewing a single post/page/CPT. ?>

					<?php TheOne\Inc\Functions\post_nav(); ?>

					<?php comments_template( '', true ); // Loads the comments.php template. ?>

				<?php endif; // End check for single post. ?>

			<?php endwhile; // End found posts loop. ?>

			<?php do_action( 'theone_content_bottom' ); // add content bottom hook. ?>

			<?php locate_template( array( 'misc/loop-nav.php' ), true ); // Loads the misc/loop-nav.php template. ?>

		<?php else : // If no posts were found. ?>

			<?php locate_template( array( 'content/error.php' ), true ); // Loads the content/error.php template. ?>

		<?php endif; // End check for posts. ?>

		</main><!-- #main -->

	</div><!-- #primary -->

<?php get_footer(); ?>