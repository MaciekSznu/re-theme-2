<?php
/**
 * Theme building functions.
 *
 * @package    WordPress
 * @subpackage reTheme2
 * @since      reTheme2 1.0
 */

/**
 * Retrieve part of the template.
 * Uses template engine build into theme to grab the file (relative to "parts" directory),
 * and pass variables to this files local scope.
 *
 * @param string $part   The theme template file (without .php extension).
 * @param array  $data   Data to be passed to the template. Variables will be made of the array's keys.
 * @param string $folder The folder the partial is located in.
 */
function get_theme_part( $part, $data = array(), $folder = 'parts' ) {
	$engine = Theme_Template_Engine::create( $folder );
	$engine->render( $part, $data );
}

/**
 * Begin generating a theme part layout.
 *
 * @param string $layout Template name containing a layout.
 * @param array  $data   Data to pass to the layout file.
 * @param string $folder The folder the partial is located in.
 */
function start_layout( $layout, $data = array(), $folder = 'parts' ) {
	$engine = Theme_Template_Engine::create( $folder );
	$engine->start_layout( $layout, $data );
}

/**
 * Begin outputting to the next layout part.
 *
 * @param string $folder The folder the partial is located in.
 */
function next_layout_part( $folder = 'parts' ) {
	$engine = Theme_Template_Engine::create( $folder );
	$engine->next_layout_part();
}

/**
 * Finalize (print) generated layout.
 *
 * @param string $folder The folder the partial is located in.
 */
function close_layout( $folder = 'parts' ) {
	$engine = Theme_Template_Engine::create( $folder );
	$engine->close_layout();
}

/**
 * Clean SVG function - helper for get_svg() function
 *
 * @param string $img (required) - File source.
 */
function get_clean_svg( $img ) {
	// phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents
	$img_svg = file_get_contents( $img );
	preg_match( '/<svg[\s\S]*\/svg>/m', $img_svg, $matches );

	if ( isset( $matches[0] ) ) {
		return $matches[0];
	}

	return $img_svg;
}

/**
 * Retrieve an image or an svg to represent an attachment - based on file name or WP Image ID.
 *
 * @param string|int   $attachment (required) - File name or WP image ID.
 * @param string|array $thumbnail (optional) - WP thumbnail size - usable only with image ID and NOT SVG files.
 * @param string       $path (optional) - Path to file.
 * @param string       $ext (optional) - File extension.
 */
function get_svg( $attachment, $thumbnail = 'full-size', $path = '/images/svg/', $ext = '.svg' ) {
	if ( is_int( $attachment ) ) {
		$src = wp_get_attachment_image_src( $attachment, $thumbnail );

		if ( ! $src ) {
			return '';
		}

		$ext = pathinfo( $src[0], PATHINFO_EXTENSION );

		if ( 'svg' !== $ext ) {
			return wp_get_attachment_image( $attachment, $thumbnail );
		}

		$file = get_attached_file( $attachment, true );
		$img  = realpath( $file );

		if ( $img ) {
			return get_clean_svg( $img );
		}
	} else {
		$filename = strpos( $attachment, $ext ) !== false ? $attachment : $attachment . $ext;
		$file     = get_template_directory() . $path . $filename;

		if ( ! file_exists( $file ) ) {
			return '';
		}

		return get_clean_svg( $file );
	}
}
