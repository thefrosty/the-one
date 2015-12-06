<?php

namespace TheOne\Inc;

/* Set up custom header feature */
add_action( 'after_setup_theme', __NAMESPACE__ . '\\custom_header_setup' );

/**
 * Set up the WordPress core custom header feature.
 *
 * @since 1.0.0
 * @uses  header_style()
 */
function custom_header_setup() {

	add_theme_support( 'custom-header', apply_filters( 'theone_custom_header_args', array(
		'random-default' => true,
		'width' => 1600,
		'height' => 500,
		'flex-width' => true,
		'flex-height' => true,
		'header-text' => false,
		'wp-head-callback' => __NAMESPACE__ . '\\header_style',
	) ) );
	
}

/**
 * Styles the header image and text displayed on the blog
 *
 * @since 1.0.0
 * @see   custom_header_setup().
 */
function header_style() {
	if ( get_header_image() ) : ?>
		<style type="text/css">
			.site-header {
				background-image: url('<?php header_image(); ?>');
				background-repeat: no-repeat;
				background-size: cover;
			}
		</style>
	<?php endif;
}

/**
 * Register default header images.
 */
register_default_headers( array(
	'steam' => array(
		'url' => '%s/images/header.jpg',
		'thumbnail_url' => '%s/images/header.jpg',
	),
) );