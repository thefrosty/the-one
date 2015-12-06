<?php

namespace TheOne\Inc;

/* Filter the body class */
add_filter( 'body_class', __NAMESPACE__ . '\\share_body_class', 4 );

/* Add scripts for sharing feature */
add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\\share_scripts', 4 );

/* Add social network share hook to wp_head */
add_action( 'wp_head', __NAMESPACE__ . '\\share_hook', 4 );

/**
 * Filter the body class.
 */
function share_body_class( $classes ) {

	if ( get_theme_mod( 'theone_share_status' ) ) {
		$classes[] = 'sharing-on';
	}

	return $classes;
}

/**
 * Enqueue scripts for this theme's social media sharing feature.
 *
 * @since 1.0.0
 */
function share_scripts() {

	if ( get_theme_mod( 'theone_share_status' ) ) {

		/* Sharing feature CSS */
		wp_enqueue_style( 'theone-sharing', get_template_directory_uri() . '/inc/sharing/sharing.css' );

		/* Sharing feature scripts */
		wp_enqueue_script( 'theone-sharing', get_template_directory_uri() . '/inc/sharing/sharing.js', array( 'jquery' ), '20141203', true );
		
	}

}

/**
 * Hook share links to selected position.
 */
function share_hook() {
	
	/* If social network sharing feature is not turned on, quit. */
	if ( !get_theme_mod( 'theone_share_status' ) ) {
		return;
	}

	/* Get position: top, bottom, side, or fixed */
	$position = get_theme_mod( 'theone_share_position', 'fixed' );

	if ( 'top' == $position ) {
		add_action( 'theone_content_top', __NAMESPACE__ . '\\share_links' );
	} elseif ( 'bottom' == $position || 'side' == $position ) {
		add_action( 'theone_content_bottom', __NAMESPACE__ . '\\share_links' );
	} else {
		add_action( 'wp_footer', __NAMESPACE__ . '\\share_links' );
	}
}

/**
 * Prints HTML for sharing links list on selected pages.
 */
function share_links() {
	
	/* Get array of pages for which sharing links are to be displayed */
	$conditionals = get_theme_mod( 'theone_share_conditionals', array( 'is_home', 'is_archive', 'is_singular' ) );
	
	/* If array contains `none`, quit */
	if ( in_array( 'none', $conditionals ) ) return;
	
	/* Get position: top, bottom, side, or fixed */
	$position = get_theme_mod( 'theone_share_position', 'fixed' );
	
	/* If position is not "fixed", add a `base` prefix. */
	if ( 'fixed' !== $position ) {
		$position = 'base ' . $position;
	}

	/* Get selected pages to display links on */
	if ( share_conditionals() ) {
		echo get_share_links( $position );
	}

}

/**
 * Outputs social network sharing links/bookmarks.
 *
 * @return string
 */
function get_share_links( $position = 'base' ) {

	/* If share scripts and CSS are not turned on, don't allow manual use of the theone_get_share_links() template tag. */
	if ( !get_theme_mod( 'theone_share_status' ) ) {
		return null;
	}

	global $wp; // need this to grab current URL.
	
	/**
	 * Current URL
	 */

	$url = esc_url_raw( add_query_arg( $wp->query_string, '', home_url( $wp->request ) ) );
	/* by Konstantin Kovshenin (http://kovshenin.com/2012/current-url-in-wordpress/) */

	$url = rawurlencode( $url );
	
	/**
	 * Current Title
	 */

	$title = '';

	if ( is_home() && !is_front_page() ) $title = get_post_field( 'post_title', get_queried_object_id() );

	elseif ( is_archive() ) $title = Functions\archive_title( '', '', false );

	elseif ( is_singular() ) $title = get_the_title( get_the_ID() );

	elseif ( is_search() ) $title = sprintf( __( 'Search Results for "%s"', 'the-one' ), get_search_query() );

	elseif ( is_404() ) $title = __( 'Not Found', 'the-one' );

	/* Encode the page title */
	$title = rawurlencode( $title );
	
	/*
	===========================================
	Return share links based on available and saved choices.
	===========================================
	*/
	
	/**
	 * Available Choices
	 */
	$sites = array(
		'facebook' => sprintf( '<a href="%1$s" rel="nofollow" class="share-facebook" target="_blank" title="%2$s"><span class="share-title">%2$s</span></a>', esc_url( 'https://www.facebook.com/sharer/sharer.php?u=' . $url . '&t=' . $title ), __( 'Share on Facebook', 'the-one' ) ),
		'pinterest' => sprintf( '<a href="%1$s" rel="nofollow" class="share-pinterest" target="_blank" title="%2$s"><span class="share-title">%2$s</span></a>', esc_url( '#' ), __( 'Add to Pinterest', 'the-one' ) ),
		'twitter' => sprintf( '<a href="%1$s" rel="nofollow" class="share-twitter" target="_blank" title="%2$s"><span class="share-title">%2$s</span></a>', esc_url( 'https://twitter.com/intent/tweet?source=' . $url . '&text=' . $title . '%20' . $url ), __( 'Share on Twitter', 'the-one' ) ),
		'googleplus' => sprintf( '<a href="%1$s" rel="nofollow" class="share-googleplus" target="_blank" title="%2$s"><span class="share-title">%2$s</span></a>', esc_url( 'https://plus.google.com/share?url=' . $url ), __( 'Share on Google Plus', 'the-one' ) ),
		'tumblr' => sprintf( '<a href="%1$s" rel="nofollow" class="share-tumblr" target="_blank" title="%2$s"><span class="share-title">%2$s</span></a>', esc_url( 'http://www.tumblr.com/share?v=3&u=' . $url . '&t=' . $title ), __( 'Share on Tumblr', 'the-one' ) ),
		'stumbleupon' => sprintf( '<a href="%1$s" rel="nofollow" class="share-stumbleupon" target="_blank" title="%2$s"><span class="share-title">%2$s</span></a>', esc_url( 'http://www.stumbleupon.com/submit?url=' . $url . '&title=' . $title ), __( 'Add to StumbleUpon', 'the-one' ) ),
		'email' => sprintf( '<a href="%1$s" rel="nofollow" class="share-email" title="%2$s"><span class="share-title">%2$s</span></a>', esc_url( 'mailto:?subject=' . $title . '&body=' . $url ), __( 'Share by Email', 'the-one' ) ),
		'reddit' => sprintf( '<a href="%1$s" rel="nofollow" class="share-reddit" target="_blank" title="%2$s"><span class="share-title">%2$s</span></a>', esc_url( 'http://www.reddit.com/submit?url=' . $url . '&title=' . $title ), __( 'Submit to  Reddit', 'the-one' ) ),
		'linkedin' => sprintf( '<a href="%1$s" rel="nofollow" class="share-linkedin" target="_blank" title="%2$s"><span class="share-title">%2$s</span></a>', esc_url( 'http://www.linkedin.com/shareArticle?mini=true&url=' . $url . '&title=' . $title ), __( 'Share on LinkedIn', 'the-one' ) ),
	);
	
	/* Get Saved sites from customizer */
	$chosen_sites = get_theme_mod( 'theone_share_links', array( 'facebook', 'twitter', 'googleplus' ) );

	/**
	 * Flip chosen sites array so its new key/value order
	 * matches the other array we're trying to compare it with.
	 */
	$chosen_sites = array_flip( $chosen_sites );

	/* Compare Available and Saved sites then continue with whatever matches. */
	$matched_sites = array_intersect_key( $sites, $chosen_sites );

	/* Set variable to nothing at first */
	$out = '';

	/**
	 * If share list is not empty.
	 */
	if ( !empty( $matched_sites ) ) {

		$out .= '<div class="share ' . $position . '" data-position="sharing-' . $position . '">' . "\n";
		$out .= '<button class="open-button">' . __( 'Share this', 'the-one' ) . '</button>' . "\n";
		$out .= '<div class="wrap">' . "\n";
		$out .= '<ul class="share-items">' . "\n";

		/* For each matching set of available and saved choices, do the following */
		foreach( $matched_sites as $site_name => $link ) {
			$out .= '<li class="share-item share-item-' . esc_attr( $site_name ) . '">' . $link . '</li>' . "\n";
		}

		$out .= '</ul>' . "\n";
		$out .= '</div>' . "\n";
		$out .= '<button class="close-button">' . __( 'Close share menu', 'the-one' ) . '</button>' . "\n";
		$out .= '</div>' . "\n";

	} /* End check for un-empty list */

	return $out;
}

/**
 * Set page conditionals for social-network-sharing links display.
 *
 * @see theone_share_links()
 * @return mixed|null
 */
function share_conditionals() {

	/* Get array of pages for which sharing links are to be displayed */
	$conditionals = get_theme_mod( 'theone_share_conditionals', array( 'is_home', 'is_archive', 'is_singular' ) );
	
	/**
	 * If array contains 'none', return null, else return first true conditional.
	 * For example, is_front_page() and is_page() are the same. Use
	 * just one of them.
	 */
	if ( in_array( 'none', $conditionals ) ) return null;
	
	/**
	 * Execute array elements as valid callbacks. Stop when the first
	 * result returns true. Thanks to Andrey “Rarst” Savchenko, https://twitter.com/rarst .
	 */
	$first_true_condition = array_reduce( $conditionals, function ( $carry, $condition ) {
		return $carry ? $carry : (boolean) call_user_func( $condition );
	}, false );

	return $first_true_condition;
}
