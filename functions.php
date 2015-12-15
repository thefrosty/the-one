<?php

namespace TheOne;

// Load the Hybrid Core framework and theme files.
require_once( trailingslashit( get_template_directory() ) . 'core/hybrid.php' );
require_once( trailingslashit( get_template_directory() ) . 'inc/Core.php' );

// Launch the Hybrid Core framework.
new \Hybrid();

// Do theme setup on the 'after_setup_theme' hook.
add_action( 'after_setup_theme', __NAMESPACE__ . '\\theme_support', 6 );
add_action( 'after_setup_theme', array( 'TheOne\Inc\Core', 'setup' ), 8 );

defined( 'ONE__FILE__' ) || define( 'ONE__FILE__', __FILE__ );

/**
 * Theme support setup. This function adds support for theme features.
 *
 * @access public
 * @return void
 */
function theme_support() {

	// Theme layouts.
	add_theme_support( 'theme-layouts', array( 'default' => is_rtl() ? '2c-r' :'2c-l' ) );

	// Enable custom template hierarchy.
	add_theme_support( 'hybrid-core-template-hierarchy' );

	// The best thumbnail/image script ever.
	add_theme_support( 'get-the-image' );

	// Breadcrumbs. Yay!
	add_theme_support( 'breadcrumb-trail' );

	// Nicer [gallery] shortcode implementation.
	if ( get_theme_mod( 'theone_cleaner_gallery' ) ) {
		add_theme_support( 'cleaner-gallery' );
	}

	// Automatically add feed links to <head>.
	add_theme_support( 'automatic-feed-links' );

	// Add support for custom-background
	add_theme_support( 'custom-background', apply_filters( 'theone_custom_background_args', array( 'default-color' => 'fafafa', ) ) );

	// Post formats.
	add_theme_support(
		'post-formats',
		array( 'aside', 'audio', 'chat', 'image', 'gallery', 'link', 'quote', 'status', 'video' )
	);

	// Handle content width for embeds and images.
	hybrid_set_content_width( 1152 );
}
