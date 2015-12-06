<?php if ( '1c' !== hybrid_get_theme_layout() ) : // If not a one-column layout. ?>

	<?php $is_any_sidebar_active = is_active_sidebar( 'sidebar-1' ) || is_active_sidebar( 'sidebar-2' ) || is_active_sidebar( 'sidebar-3' ) || is_active_sidebar( 'sidebar-4' ); ?>

	<?php if ( $is_any_sidebar_active ) : // If any sidebar is active ?>

		<div id="secondary" class="widget-area" role="complementary">

	<?php endif; // End check for active sidebar. ?>

		<?php if ( is_active_sidebar( 'sidebar-1' ) ) : // If the sidebar has widgets. ?>

			<aside <?php hybrid_attr( 'sidebar', '1' ); ?>>

				<?php dynamic_sidebar( 'sidebar-1' ); // Displays the sidebar. ?>

			</aside><!-- #sidebar-1 -->

		<?php endif; // End widgets check. ?>

		<?php if ( is_active_sidebar( 'sidebar-2' ) ) : // If the sidebar has widgets. ?>

			<aside <?php hybrid_attr( 'sidebar', '2' ); ?>>

				<?php dynamic_sidebar( 'sidebar-2' ); // Displays the sidebar. ?>

			</aside><!-- #sidebar-2 -->

		<?php endif; // End widgets check. ?>

		<?php if ( is_active_sidebar( 'sidebar-3' ) ) : // If the sidebar has widgets. ?>

			<aside <?php hybrid_attr( 'sidebar', '3' ); ?>>

				<?php dynamic_sidebar( 'sidebar-3' ); // Displays the sidebar. ?>

			</aside><!-- #sidebar-3 -->

		<?php endif; // End widgets check. ?>

		<?php if ( is_active_sidebar( 'sidebar-4' ) ) : // If the sidebar has widgets. ?>

			<aside <?php hybrid_attr( 'sidebar', '4' ); ?>>

				<?php dynamic_sidebar( 'sidebar-4' ); // Displays the sidebar. ?>

			</aside><!-- #sidebar-4 -->

		<?php endif; // End widgets check. ?>

		<?php if ( is_active_sidebar( 'sidebar-5' ) ) : // If the sidebar has widgets. ?>

			<aside <?php hybrid_attr( 'sidebar', '5' ); ?>>

				<?php dynamic_sidebar( 'sidebar-5' ); // Displays the sidebar. ?>

			</aside><!-- #sidebar-5 -->

		<?php endif; // End widgets check. ?>

	<?php if ( $is_any_sidebar_active ) : // If any sidebar is active ?>

		</div><!-- #secondary -->

	<?php endif; // End check for active sidebar. ?>

<?php endif; // End layout check. ?>
