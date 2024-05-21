<?php
/**
 * Add support for Gutenberg.
 *
 * @package WordPress
 * @subpackage reTheme2
 * @since reTheme2 1.0
 *
 * @link https://wordpress.org/gutenberg/handbook/reference/theme-support/
 */

/**
 * Setup theme supported features.
 */
function base_theme_setup_theme_supported_features() {

	// Add support for Block Styles.
	add_theme_support( 'wp-block-styles' );

	// Add support for full and wide align images.
	add_theme_support( 'align-wide' );
	add_theme_support( 'align-full' );

	// Add support for editor styles.
	add_theme_support( 'editor-styles' );

	// Enqueue editor styles.
	add_editor_style( 'css/style-editor.css' );

	// Add support for responsive embedded content.
	add_theme_support( 'responsive-embeds' );

	// Register Theme font sizes.
	add_theme_support(
		'editor-font-sizes',
		array(
			array(
				'name' => __( 'Normal', 'reTheme2' ),
				'size' => 16,
				'slug' => 'normal',
			),
			array(
				'name' => __( 'Large', 'reTheme2' ),
				'size' => 20,
				'slug' => 'large',
			),
		)
	);

	// Register Theme colors.
	add_theme_support( 'editor-color-palette', get_supported_colors() );

}
add_action( 'after_setup_theme', 'base_theme_setup_theme_supported_features' );

/**
 * Setup dashboard features.
 */
function base_theme_setup_dashboard_features() {
	get_supported_colors( 'styles' );
}

add_filter('admin_head', 'base_theme_setup_dashboard_features');

/**
 * Function for generate supported colors output in array or styles string
 *
 * @param string $return_format Return format.
 *
 * @return string || array || debug
 */
function get_supported_colors( $return_format = 'support' ) {
	// phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents
	$colors = json_decode( file_get_contents( __DIR__ . '/colors.json' ), true );

	if ( 'support' === $return_format ) {

		$arr = array();

		foreach ( $colors as $key => $color ) {
			$slug  = strtolower( trim( preg_replace( '/[^A-Za-z0-9-]+/', '-', $key ) ) );
			$arr[] = array(
				'name'  => __( $key, 'reTheme2' ),
				'slug'  => $slug,
				'color' => $color,
			);
		}

		return $arr;

	} elseif ( 'styles' === $return_format ) {

		$html = '<style type="text/css">';

		foreach ( $colors as $key => $color ) {
			$slug  = strtolower( trim( preg_replace( '/[^A-Za-z0-9-]+/', '-', $key ) ) );
			$html .= ".has-$slug-color{color:$color;}";
			$html .= ".has-$slug-background-color{background-color:$color;}";
		}

		$html .= '</style>';
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		echo $html;

	} elseif ( 'debug' === $return_format ) {
		// phpcs:ignore WordPress.PHP.DevelopmentFunctions.error_log_var_dump
		var_dump( $colors );
	}
}
