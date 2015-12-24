<?php

namespace TheOne\Inc;

use WP_Query;

add_action( 'after_setup_theme', function() {

	add_filter( 'wp_page_menu_args', __NAMESPACE__ . '\\page_menu_args' );
	add_action( 'wp', __NAMESPACE__ . '\\setup_author' );
	add_filter( 'comments_open', __NAMESPACE__ . '\\close_attachment_comments', 10, 2 );
});

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * @param array $args Configuration arguments.
 * @return array
 */
function page_menu_args( $args ) {

	$args['show_home'] = true;

	return $args;
}

/**
 * Sets the authordata global when viewing an author archive.
 *
 * This provides backwards compatibility with
 * http://core.trac.wordpress.org/changeset/25574
 *
 * It removes the need to call the_post() and rewind_posts() in an author
 * template to print information about the author.
 *
 * @global WP_Query $wp_query WordPress Query object.
 * @return void
 */
function setup_author() {
	global $wp_query;

	if ( $wp_query instanceof WP_Query ) {

		if ( $wp_query->is_author() && isset( $wp_query->post ) ) {
			$GLOBALS['authordata'] = get_userdata( $wp_query->post->post_author );
		}
	}
}

/**
 * Close comments on 'attachment' posts after `30` days.
 *
 * @param bool $open
 * @param int $post_id
 *
 * @return bool
 */
function close_attachment_comments( $open, $post_id ) {

	$post = get_post( $post_id );

	if ( !$post || is_wp_error( $post ) ) {
		return $open;
	}

	if ( 'attachment' === $post->post_type ) {

		/**
		 * @param string $days The number of days to count from the attachments
		 *                      published date to auto-close comments
		 */
		$days = apply_filters( 'theone_close_attachment_comments_days', '30' );
		$days = (string) absint( $days );

		if ( strtotime( $post->post_date_gmt ) < strtotime( "-{$days} days" ) ) {
			$open = false;
		}
	}

	return $open;
}
