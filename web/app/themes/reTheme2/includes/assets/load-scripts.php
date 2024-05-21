<?php
/**
 * Load scripts.
 *
 * @package WordPress
 * @subpackage reTheme2
 * @since reTheme2 1.0
 */

// phpcs:disable
/*
TODO Try disabling jquery globally and only enqueue when necesary
function remove_jquery_enqueue() {
if (!is_admin()) {
wp_dequeue_script('jquery');
}
}
add_action("wp_enqueue_scripts", "remove_jquery_enqueue", 11);
*/

/**
 * Check if an url exists.
 *
 * @param string $url Url.
 */
function does_url_exists( $url ) {
	$ch = curl_init( $url );
	curl_setopt( $ch, CURLOPT_NOBODY, true );
	curl_exec( $ch );
	$code = curl_getinfo( $ch, CURLINFO_HTTP_CODE );

	if ( 200 === $code ) {
		$status = true;
	} else {
		$status = false;
	}
	curl_close( $ch );
	return $status;
}
// phpcs:enable

/**
 * Load Theme Global Scripts
 */
function load_theme_scripts() {
		$js_file = '/js/bundle.min.js';
		wp_enqueue_script(
			'script',
			get_template_directory_uri() . $js_file . '#asyncload',
			array(),
			filemtime( get_relative_path( $js_file ) ),
			true
		);

}
add_action( 'wp_enqueue_scripts', 'load_theme_scripts' );


/**
 * It adds a variable to the admin area that contains the URL of the theme's stylesheet.
 */
function add_admin_var() {
	$js_file = '/js/admin-bundle.min.js';
	wp_enqueue_script(
		'admin-script',
		get_template_directory_uri() . $js_file,
		array(),
		filemtime( get_relative_path( $js_file ) ),
		true
	);

	wp_localize_script(
		'admin-script',
		'iconpicker',
		array(
			'stylesheetUrl' => get_stylesheet_directory_uri(),
		)
	);
}
add_action( 'enqueue_block_editor_assets', 'add_admin_var' );


/**
 * Load all scripts with async. Check if is IE and load bundle for IE if exists.
 *
 * @param string $url Url.
 */
function load_async_scripts( $url ) {
	if ( strpos( $url, '#asyncload' ) === false ) {
		return $url;
	} elseif ( is_admin() ) {
		return str_replace( '#asyncload', '', $url );
	} else {

		if ( function_exists( 'is_ie' ) && is_ie() ) {
			$ie_url = str_replace( '.min.', '.ie.', $url );

			if ( does_url_exists( $ie_url ) ) {
				$url = $ie_url;
			}
		}

		return str_replace( '#asyncload', '', $url ) . "' async='async";
	}
}
add_filter( 'clean_url', 'load_async_scripts', 11, 1 );


/**
 * Load JS script from other block / component
 * By default the $path is relative to `app/themes/reTheme2/parts/components` base.
 * $name is a name of a component directory.
 * Example:
 * load_script('box', 'reTheme2/script-handle');
 *
 * @param string $path Component path.
 * @param string $name Component name.
 * @param array  $deps Component deps.
 * @param string $base Component base.
 * @param string $file_name Component file name.
 */
function load_script( $path, $name, $deps = array(), $base = 'parts/components', $file_name = 'index' ) {
	$file = '/' . $base . '/' . $path . '/' . $file_name . '.min.js';

	$args         = array();
	$args['name'] = $name;
	$args['file'] = $file;
	$args['deps'] = $deps;

	add_action(
		'wp_footer',
		function() use ( $args ) {
			wp_enqueue_script(
				$args['name'],
				get_template_directory_uri() . $args['file'] . '#asyncload',
				$args['deps'],
				filemtime( get_relative_path( $args['file'] ) ),
				true
			);
		},
		1
	);
}

/**
 * Register third part scripts.
 * Later load as dependencies.
 * Example, insert when register block scripts
 * wp_enqueue_script(
 * 'acf-gallery',
 * get_template_directory_uri() . '/parts/blocks/acf-gallery/index.min.js#asyncload',
 * [ 'slick_script' ],
 * false,
 * true
 * );
 */
function load_scripts_block_assets() {
	$js_file = '/js/plugins/slick.min.js';

	wp_register_script(
		'slick_script',
		get_template_directory_uri() . $js_file . '#asyncload',
		array(),
		filemtime( get_relative_path( $js_file ) ),
		true
	);
}
add_action( 'enqueue_block_assets', 'load_scripts_block_assets' );
