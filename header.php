<!DOCTYPE html>
<html <?php language_attributes( 'html' ); ?>>

<head <?php hybrid_attr( 'head' ); ?>>
<?php wp_head(); // Hook required for scripts, styles, and other <head> items. ?>
</head>

<body <?php hybrid_attr( 'body' ); ?>>

<div id="page" class="hfeed site">

	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'the-one' ); ?></a>

	<header class="site-header" <?php hybrid_attr( 'header' ); ?>>

		<div class="header-overlay"></div><!-- a mask over the background image -->

		<div class="site-branding" <?php hybrid_attr( 'branding' ); ?>>

			<?php if ( get_theme_mod( 'theone_logo_image' ) ) : // If logo image exists. ?>
				<h1 class="site-title" <?php hybrid_attr( 'site-title' ); ?>>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="logo-link">
						<img src="<?php echo esc_url( get_theme_mod( 'theone_logo_image' ) ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
					</a>
				</h1><!-- .site-title -->
			<?php else : // If logo doesn't exist, display normal site title. ?>
				<?php hybrid_site_title(); ?>
			<?php endif; // End check for logo.?>

			<?php if ( get_theme_mod( 'theone_site_description_toggle' ) ) : ?>
				<?php hybrid_site_description(); ?>
			<?php endif; // End check for blog description display setting ?>

		</div><!-- .site-branding -->

		<?php hybrid_get_menu( 'primary' ); // Loads the menu/primary.php template. ?>

	</header><!-- #masthead -->

	<div id="site-content" class="site-content">
