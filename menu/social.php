<?php if ( has_nav_menu( 'social' ) ) : // Check if there's a menu assigned to the 'social' location. ?>

	<nav class="nav social" <?php hybrid_attr( 'menu', 'social' ); ?>>

		<div class="wrap">

			<?php do_action( 'theone_menu_social_top' ); ?>

			<?php wp_nav_menu(
				array(
					'theme_location'  => 'social',
					'depth'           => '1',
					'container'       => '',
					'menu_id'         => 'menu-social-items',
					'menu_class'      => 'menu-items',
					'fallback_cb'     => '',
					'items_wrap'      => '<ul id="%s" class="%s">%s</ul>'
				)
			); ?>

			<?php do_action( 'theone_menu_social_bottom' ); ?>

		</div><!-- .wrap -->

	</nav><!-- #menu-social -->

<?php endif; // End check for menu. ?>