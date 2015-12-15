<?php

namespace TheOne\Inc\Functions;

/**
 * Display navigation to next/previous set of posts when applicable.
 */
function paging_nav() {
	global $wp_query;

	// Don't print empty markup if there's only one page.
	if ( $wp_query->max_num_pages < 2 ) {
		return;
	}
	?>
	<nav class="navigation paging-navigation" role="navigation">
		<h4 class="screen-reader-text"><?php _e( 'Posts navigation', 'the-one' ); ?></h4>

		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
				<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'the-one' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
				<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'the-one' ) ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}

/**
 * Display navigation to next/previous post when applicable.
 */
function post_nav() {

	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next = get_adjacent_post( false, '', false );

	if ( ( !$next && !$previous ) || is_singular( 'page' ) ) {
		return;
	}

	$_previous_post_link = get_previous_post_link( '<div class="nav-previous">%link</div>', _x( '<span class="meta-nav">&larr;</span>&nbsp;%title', 'Previous post link', 'the-one' ) );
	$_next_post_link = get_next_post_link( '<div class="nav-next">%link</div>', _x( '%title&nbsp;<span class="meta-nav">&rarr;</span>', 'Next post link', 'the-one' ) );
	?>
	<nav class="navigation post-navigation" role="navigation">
		<h4 class="screen-reader-text"><?php _e( 'Post navigation', 'the-one' ); ?></h4>

		<div class="nav-links">
			<?php
			if ( !empty( $_previous_post_link ) && !empty( $_next_post_link ) ) {
				echo $_previous_post_link . $_next_post_link;
			} elseif ( !empty( $_previous_post_link ) ) {
				echo $_previous_post_link;
			} elseif ( !empty( $_next_post_link ) ) {
				echo '<div class="nav-previous"></div>' . $_next_post_link;
			}
			?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}

/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function posted_on() {

	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string, esc_attr( get_the_date( 'c' ) ), esc_html( get_the_date() ), esc_attr( get_the_modified_date( 'c' ) ), esc_html( get_the_modified_date() ) );

	$posted_on = sprintf( _x( 'Posted on %s', 'post date', 'the-one' ), '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>' );

	$byline = sprintf( _x( 'by %s', 'post author', 'the-one' ), '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>' );

	echo '<span class="posted-on">' . $posted_on . '</span> <span class="byline">' . $byline . '</span>';
}

/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function entry_footer() {

	// Hide category and tag text for pages.
	if ( 'post' == get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( __( ', ', 'the-one' ) );
		if ( $categories_list && categorized_blog() ) {
			printf( '<span class="cat-links">' . __( 'Posted in %1$s', 'the-one' ) . '</span>', $categories_list );
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', __( ', ', 'the-one' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . __( 'Tagged %1$s', 'the-one' ) . '</span>', $tags_list );
		}

		/* translators: used between list items, there is a space after the comma */
		if ( taxonomy_exists( 'series' ) ) {
			$series_list = get_the_term_list( get_the_ID(), 'series', '', __( ', ', 'the-one' ) );
			if ( $series_list && !is_wp_error( $series_list ) ) {
				printf( '<span class="cat-links">' . __( 'Series %1$s', 'the-one' ) . '</span>', $series_list );
			}
		}
	}

	if ( !is_single() && !post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link( __( 'Leave a comment', 'the-one' ), __( '1 Comment', 'the-one' ), __( '% Comments', 'the-one' ) );
		echo '</span>';
	}
}

/**
 * Display the archive title based on the queried object.
 *
 * @param string    $before Optional. Content to prepend to the title. Default empty.
 * @param string    $after  Optional. Content to append to the title. Default empty.
 * @param bool|true $display
 *
 * @return string
 */
function archive_title( $before = '', $after = '', $display = true ) {
	if ( is_category() ) {
		$title = sprintf( __( 'Category: %s', 'the-one' ), single_cat_title( '', false ) );
	} elseif ( is_tag() ) {
		$title = sprintf( __( 'Tag: %s', 'the-one' ), single_tag_title( '', false ) );
	} elseif ( is_author() ) {
		$title = sprintf( __( 'Author: %s', 'the-one' ), '<span class="vcard">' . get_the_author() . '</span>' );
	} elseif ( is_year() ) {
		$title = sprintf( __( 'Year: %s', 'the-one' ), get_the_date( _x( 'Y', 'yearly archives date format', 'the-one' ) ) );
	} elseif ( is_month() ) {
		$title = sprintf( __( 'Month: %s', 'the-one' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'the-one' ) ) );
	} elseif ( is_day() ) {
		$title = sprintf( __( 'Day: %s', 'the-one' ), get_the_date( _x( 'F j, Y', 'daily archives date format', 'the-one' ) ) );
	} elseif ( is_post_type_archive() ) {
		$title = sprintf( __( 'Archives: %s', 'the-one' ), post_type_archive_title( '', false ) );
	} elseif ( is_tax() ) {
		$tax = get_taxonomy( get_queried_object()->taxonomy );
		/* translators: 1: Taxonomy singular name, 2: Current taxonomy term */
		$title = sprintf( __( '%1$s: %2$s', 'the-one' ), $tax->labels->singular_name, single_term_title( '', false ) );
	} else {
		$title = __( 'Archives', 'the-one' );
	}

	/**
	 * Filter the archive title.
	 *
	 * @param string $title Archive title to be displayed.
	 */
	$title = apply_filters( 'get_the_archive_title', $title );

	if ( !empty( $title ) && true === $display ) {
		echo $before . $title . $after;
	}

	return $title;
}

/**
 * Display category, tag, or term description.
 *
 * @param string $before Optional. Content to prepend to the description. Default empty.
 * @param string $after  Optional. Content to append to the description. Default empty.
 */
function archive_description( $before = '', $after = '' ) {

	$description = apply_filters( 'get_the_archive_description', term_description() );

	if ( !empty( $description ) ) {
		echo $before . $description . $after;
	}
}

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function categorized_blog() {

	if ( false === ( $all_the_cool_cats = get_transient( 'theone_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields' => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number' => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'theone_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so theone_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so theone_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in theone_categorized_blog.
 */
function category_transient_flusher() {
	delete_transient( 'theone_categories' );
}
add_action( 'edit_category', __NAMESPACE__ . '\\category_transient_flusher' );
add_action( 'save_post', __NAMESPACE__ . '\\category_transient_flusher' );