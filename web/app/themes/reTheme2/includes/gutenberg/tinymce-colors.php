<?php
/**
 * TinyMCE colors.
 *
 * @package WordPress
 * @subpackage reTheme2
 * @since reTheme2 1.0
 */

/**
 * The function adds custom color options to the TinyMCE editor in WordPress.
 *
 * @param array $init the configuration settings for the TinyMCE editor.
 */
function tinymce_colors( $init ) {

	$supported_colors = get_supported_colors();
	$colors           = '';

	foreach ( $supported_colors as $color ) {
		$colors .= '"' . str_replace( '#', '', $color['color'] ) . '", "' . $color['name'] . '", ';
	}

	$init['textcolor_map'] = '[' . $colors . ']';

	return $init;
}
add_filter( 'tiny_mce_before_init', 'tinymce_colors' );
