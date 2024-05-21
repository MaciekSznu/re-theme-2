<?php
/**
 * Add styles to the dashboard.
 *
 * @package WordPress
 * @subpackage reTheme2
 * @since reTheme2 1.0
 */

/**
 * Enqueue style
 */
function admin_style() {
	$css_file = '/css/style-admin.css';
	wp_enqueue_style(
		'admin-styles',
		get_template_directory_uri() . $css_file,
		array(),
		filemtime( get_relative_path( $css_file ) )
	);
}

add_action( 'admin_enqueue_scripts', 'admin_style' );
