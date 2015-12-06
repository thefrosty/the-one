
	<?php hybrid_get_sidebar( 'footer' ); // Loads the sidebar/1.php template. ?>

	</div><!-- #content -->

	<footer class="site-footer" <?php hybrid_attr( 'footer' ); ?>>
		<div class="wrap">
		
			<?php do_action( 'theone_footer_top' ); ?>

			<?php hybrid_get_menu( 'social' ); // Loads the menu/social.php template. ?>

			<div class="site-info">
				<p class="copyright">
					<?php printf(
					// Translators: 1 is current year, 2 is site name/link.
							esc_html__( 'Copyright &#169; %1$s %2$s.', 'the-one' ),
							date_i18n( 'Y' ), hybrid_get_site_link()
					); ?>
				</p><!-- .copyright -->
				<p class="credit">
					<?php printf(
					// Translators: 1 is WordPress name/link and 2 is theme name/link.
						esc_html__( 'Powered by %1$s and %2$s.', 'the-one' ),
						hybrid_get_wp_link(), hybrid_get_theme_link()
					); ?>
				</p><!-- .credit -->
			</div><!-- .site-info -->

		</div><!-- .wrap -->
	</footer><!-- #colophon -->

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>