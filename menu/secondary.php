<?php if ( has_nav_menu( 'secondary' ) ) : // Check if there's a menu assigned to the 'secondary' location. ?>

	<nav class="nav dropdown" <?php hybrid_attr( 'menu', 'secondary' ); ?>>
	
		<button class="open-button" data-action="toggle-menu"><?php _e( 'Browse', 'the-one' ); ?></button>

		<div class="wrap">
		
			<?php do_action( 'theone_menu_secondary_top' ); ?>

			<?php wp_nav_menu(
				array(
					'theme_location'  => 'secondary',
					'container'       => '',
					'menu_id'         => 'menu-secondary-items',
					'menu_class'      => 'menu-items',
					'fallback_cb'     => '',
					'items_wrap'      => '<ul id="%s" class="%s">%s</ul>'
				)
			); ?>
		
			<?php do_action( 'theone_menu_secondary_bottom' ); ?>
		
		</div><!-- .wrap -->

	</nav><!-- #menu-secondary -->

<?php endif; // End check for menu. ?>