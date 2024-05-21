<?php
/**
 * Register block style and scripts.
 *
 * @package    WordPress
 * @subpackage reTheme2
 * @since      reTheme2 1.0
 */

/**
 * Custom block registration accordion.
 */
function custom_block_registration_accordion() {
	$js_file = '/parts/blocks/custom-accordion/admin.min.js';

	wp_register_script(
		'custom/accordion',
		get_template_directory_uri() . $js_file,
		array( 'wp-blocks', 'wp-element', 'wp-editor' ),
		filemtime( get_relative_path( $js_file ) ),
		false
	);

	if ( is_admin() ) {
		$css_file = '/parts/blocks/custom-accordion/style-editor.css';

		wp_register_style(
			'custom/accordion-style-editor',
			get_template_directory_uri() . $css_file,
			array( 'wp-edit-blocks' ),
			filemtime( get_relative_path( $css_file ) )
		);
	}

	register_block_type(
		'custom/accordion',
		array(
			'editor_script' => 'custom/accordion',
			'editor_style'  => 'custom/accordion-style-editor',
		)
	);
}
add_action( 'enqueue_block_editor_assets', 'custom_block_registration_accordion' );

/**
 * Add block scripts.
 */
function register_block_accordion_scripts() {
	if ( Block::if_block_exists( 'wp-block-custom-accordion' ) ) {
		$js_file = '/parts/blocks/custom-accordion/index.min.js';
		wp_enqueue_script(
			'reTheme2/block_accordion_script',
			get_template_directory_uri() . $js_file . '#asyncload',
			array(),
			filemtime( get_relative_path( $js_file ) ),
			true
		);
	}
}
add_action( 'enqueue_block_assets', 'register_block_accordion_scripts' );
