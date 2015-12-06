<?php if ( has_nav_menu( 'primary' ) ) : // Check if there's a menu assigned to the 'primary' location. ?>

	<nav class="nav offcanvas" <?php hybrid_attr( 'menu', 'primary' ); ?>>

		<button class="open-button" data-action="toggle-menu"><?php esc_html_e( 'Open Primary Menu', 'the-one' ); ?></button>
		
		<div class="wrap">
		
			<?php do_action( 'theone_menu_primary_top' ); ?>
		
			<?php wp_nav_menu(
				array(
					'theme_location'  => 'primary',
					'container'       => '',
					'menu_id'         => 'menu-primary-items',
					'menu_class'      => 'menu-items',
					'fallback_cb'     => '',
					'items_wrap'      => '<ul id="%s" class="%s">%s</ul>',
				)
			); ?>
			
			<?php do_action( 'theone_menu_primary_bottom' ); ?>

		</div><!-- .wrap -->

		<button class="close-button" data-action="toggle-menu"><?php esc_html_e( 'Close Primary Menu', 'the-one' ); ?></button>

	</nav><!-- #menu-primary -->

<?php endif; // End check for menu. ?>