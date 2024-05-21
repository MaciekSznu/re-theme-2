<?php
/**
 * Get relative path to file
 *
 * @package    WordPress
 * @subpackage reTheme2
 * @since      reTheme2 1.0
 */

/**
 * Get relative path
 *
 * @param string $src path to file.
 */
function get_relative_path( $src ) {
	if ( preg_match( '@\/\/@', $src ) ) {
		return $src;
	}

	return get_template_directory() . '/' . $src;
}
