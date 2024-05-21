<?php
/**
 * Functions
 * ---------------------------------------------------------------------------------------
 *
 * This file defines all functions that are intended to be used by developers,
 * and therefore are not hidden behind a class for simplicity.
 *
 * @package WordPress
 */

/**
 * Recursively include all files from specified directory (and it's subdirectories).
 *
 * @param string $dir       Directory to include all files from.
 * @param int    $max_depth Maximum depth allowed.
 * @param int    $depth     Number of levels below specified directory current recursive call is on.
 */
function recursive_include( $dir, $max_depth = 5, $depth = 0 ) {
	if ( $depth > $max_depth ) {
		return;
	}

	$scan = glob( $dir . DIRECTORY_SEPARATOR . '*' );
	foreach ( $scan as $path ) {
		if ( preg_match( '/\.php$/', $path ) ) {
			include_once $path;
		} elseif ( is_dir( $path ) ) {
			recursive_include( $path, $max_depth, $depth + 1 );
		}
	}
}

/**
 * Generate the heading for the archive pages based on which type of archive is being displayed.
 *
 * @return string|null Heading, or null if the type of archive is not recognized.
 */
function get_blog_heading() {
	if ( is_day() ) {
		return __( 'Daily Archives:', 'reTheme2' ) . get_the_date();
	} elseif ( is_month() ) {
		return __( 'Monthly Archives:', 'reTheme2' ) . get_the_date( _x( 'F Y', 'monthly archives date format', 'reTheme2' ) );
	} elseif ( is_year() ) {
		return __( 'Yearly Archives:', 'reTheme2' ) . get_the_date( _x( 'Y', 'yearly archives date format', 'reTheme2' ) );
	} elseif ( is_category() ) {
		return __( 'Category:', 'reTheme2' ) . ' ' . single_cat_title( '', false );
	} elseif ( is_author() ) {
		$author_data = get_query_var( 'author_name' ) ? get_user_by( 'slug', get_query_var( 'author_name' ) ) : get_userdata( get_query_var( 'author' ) );
		return __( 'Author:', 'reTheme2' ) . ' ' . $author_data->display_name;
	} elseif ( is_tag() ) {
		return __( 'Tag:', 'reTheme2' ) . ' ' . single_tag_title( '', false );
	} elseif ( is_search() ) {
		return __( 'Search:', 'reTheme2' ) . ' ' . get_search_query();
	} else {
		return __( 'Blog Archives', 'reTheme2' );
	}
	return null;
}
