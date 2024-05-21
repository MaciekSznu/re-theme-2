<?php
/**
 * Styles Preloader Filter
 * Excluded for IE & Firefox
 *
 * @package WordPress
 * @subpackage reTheme2
 * @since reTheme2 1.0
 */

/**
 * Filters the HTML link tag of an enqueued style
 *
 * @param string $html   The link tag for the enqueued style.
 * @param string $handle The style's registered handle.
 * @param string $href   The stylesheet's source URL.
 * @param string $media  The stylesheet's media attribute.
 */
function add_rel_preload( $html, $handle, $href, $media ) {

	if ( is_admin() || is_ie() || is_firefox() ) {
		return $html;
	}

	$html = "<link rel='preload' as='style' onload='this.onload=null;this.rel=\"stylesheet\"' media='$media' id='$handle' href='$href' type='text/css' media='all' />";

	return $html;

}
add_filter( 'style_loader_tag', 'add_rel_preload', 10, 4 );

/**
 * Parse inline style and add template direcotry uri to
 * all url() paths
 *
 * @param string $style All styles.
 */
function parse_styles_urls_to_images( $style ) {
	$images_uri = get_template_directory_uri() . '/images/';

	// capture all paths inside url().
	$re = '/url\s*\(["|\']?\/?(?:[^\/]+\/)*?([^\/]+?.[^\"\'\)\/]+)["|\']?\)/i';

	$subst = 'url("' . $images_uri . '$1")';

	$result = preg_replace( $re, $subst, $style );

	return $result;
}

global $blocks_loaded;
$blocks_loaded = array();

/**
 * Load local styles for PHP parts
 * Example:
 * load_styles(__DIR__, 'block-name')
 *
 * @param string $path      Block path.
 * @param string $name      Block name.
 * @param string $file_name Block File name.
 * @param bool   $echo      Display or return html.
 */
function load_styles( $path, $name, $file_name = 'style', $echo = true ) {
	global $blocks_loaded;
	// phpcs:ignore WordPress.PHP.StrictInArray.MissingTrueStrict
	if ( ! in_array( $name, $blocks_loaded ) ) {

		$html = '';
		$file = "$path/$file_name.css";

		if ( file_exists( $file ) ) {
			// phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents
			$style_content = file_get_contents( $file );

			if ( '' !== $style_content ) {
				if ( defined( 'WP_ENV' ) && WP_ENV === 'development' ) {
					$file            = str_replace( '\\', '/', $file );
					$template_string = 'themes\/' . get_template();
					$file_match      = preg_match( '/' . $template_string . '/', $file, $match, PREG_OFFSET_CAPTURE );
					$file_path       = substr( $file, $match[0][1] + strlen( $template_string ) - 1, strlen( $file ) );
					$style_content   = '@import url("' . get_template_directory_uri() . $file_path . '");';
				} else {
					$style_content = parse_styles_urls_to_images( $style_content );
				}

				$html = '<style>' . $style_content . '</style>';

				array_push( $blocks_loaded, $name );

				if ( $echo ) {
					// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					echo $html;
				} else {
					return $html;
				}
			}
		}
	}
}

/**
 * Load styles from other block / component
 * Path based is `app/themes/reTheme2/parts`
 * Example:
 * load_styles_dep('components/tile', 'tile-card');
 *
 * @param string $path      Component path.
 * @param string $name      Component name.
 * @param string $base      Component base.
 * @param string $file_name Component file name.
 * @param bool   $echo      Display or return html.
 */
function load_styles_dep( $path, $name, $base = 'parts', $file_name = 'style', $echo = true ) {
	load_styles( get_template_directory() . '/' . $base . '/' . $path, $name, $file_name, $echo );
}


global $blocks_loaded_thirdy;
$blocks_loaded_thirdy = array();

/**
 * Load local Third Part (vendor) styles styles for PHP parts
 * Example:
 * loadSylesThird('slick')
 *
 * @param string $name File name.
 */
function load_styles_third( $name ) {
	global $blocks_loaded_thirdy;
	// phpcs:ignore WordPress.PHP.StrictInArray.MissingTrueStrict
	if ( ! in_array( $name, $blocks_loaded_thirdy ) ) {

		$html = '';
		$path = get_template_directory() . '/css/vendor';
		$file = "$path/$name.css";

		if ( file_exists( $file ) ) {
			// phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents
			$style_content = file_get_contents( $file );

			if ( '' !== $style_content ) {

				$html = '<style>' . $style_content . '</style>';
				// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				echo $html;

				array_push( $blocks_loaded_thirdy, $name );

			}
		}
	}
}

global $blocks_loaded_components;
$blocks_loaded_components = array();

/**
 * Load local Reusable css components styles
 * Example:
 * load_styles_components('slick-arrow')
 *
 * @param string $name Component name.
 */
function load_styles_components( $name ) {
	global $blocks_loaded_components;
	// phpcs:ignore WordPress.PHP.StrictInArray.MissingTrueStrict
	if ( ! in_array( $name, $blocks_loaded_components ) ) {

		$html = '';
		$path = get_template_directory() . "/css/components/$name";
		$file = "$path/style.css";

		if ( file_exists( $file ) ) {
			// phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents
			$style_content = file_get_contents( $file );

			if ( '' !== $style_content ) {

				if ( defined( 'WP_ENV' ) && WP_ENV === 'development' ) {
					$style_content = '@import url("' . get_template_directory_uri() . '/css/components/' . $name . '/style.css");';
				} else {
					$style_content = parse_styles_urls_to_images( $style_content );
				}

				$html = '<style>' . $style_content . '</style>';
				// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				echo $html;

				array_push( $blocks_loaded_components, $name );

			}
		}
	}
}


/**
 * Automatically load local styles for custom gutenberg blocks (w/o ACF blocks)
 *
 * Put in a block save() method:
 * <div data-styles-id="folder-name" />
 * Where attribute value is folder name inside parts/blocks
 *
 * @param string $content Content of the current post.
 */
function load_styles_custom_blocks( $content ) {
	global $blocks_loaded;

	preg_match_all( '<div data-styles-id="(.+?)".+?\/div>', $content, $matches );
	$id_array = $matches[1];
	$id_array = array_unique( $id_array );

	$path = get_template_directory() . '/parts/blocks';

	foreach ( $id_array as $name ) {

		$pattern = '/<div data-styles-id="' . $name . '".+?\/div>/';

		if (
			// phpcs:ignore WordPress.PHP.StrictInArray.MissingTrueStrict
			! in_array( $name, $blocks_loaded ) &&
			file_exists( "$path/$name/style.css" )
		) {
			// phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents
			$style_content = file_get_contents( "$path/$name/style.css" );

			if ( '' !== $style_content ) {
				if ( defined( 'WP_ENV' ) && WP_ENV === 'development' ) {
					$style_content = '@import url("' . get_template_directory_uri() . '/parts/blocks/' . $name . '/style.css");';
				}

				$style_tags = '<style>' . $style_content . '</style>';

				// Insert block styles only for the first match in the content.
				$content = preg_replace( $pattern, $style_tags, $content, 1 );

				array_push( $blocks_loaded, $name );

			}
		}

		// Delete all remaining matches from the content.
		$content = preg_replace( $pattern, '', $content );

	}

	return $content;
}
add_filter( 'the_content', 'load_styles_custom_blocks' );
