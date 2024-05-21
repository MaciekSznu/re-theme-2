<?php
/**
 * Change core block
 *
 * @package    WordPress
 * @subpackage reTheme2
 * @since      reTheme2 1.0
 */

/**
 * Change core button block
 *
 * @param string $block_content The block content about to be appended.
 * @param array  $block The full block, including name and attributes.
 */
function insert_button_styles( $block_content, $block ) {
	if ( 'core/button' === $block['blockName'] ) {
		$block_content = '<div data-styles-id="core-button"></div>' . $block_content;
	}
	return $block_content;
}
add_filter( 'render_block', 'insert_button_styles', 10, 2 );


/**
 * Core block button script.
 */
function extend_block_button_script() {
	$js_file = '/parts/blocks/core-button/admin.min.js';

	wp_enqueue_script(
		'core/button',
		get_template_directory_uri() . $js_file,
		array( 'wp-i18n', 'wp-dom-ready', 'wp-editor', 'wp-blocks', 'wp-compose', 'wp-element', 'wp-hooks' ),
		filemtime( get_relative_path( $js_file ) ),
		false
	);

	wp_localize_script(
		'core/button',
		'iconpicker',
		array(
			'stylesheetUrl' => get_stylesheet_directory_uri(),
		)
	);

	if ( is_admin() ) {
		$css_file = '/parts/blocks/core-button/style-editor.css';

		wp_enqueue_style(
			'core/button',
			get_template_directory_uri() . $css_file,
			array( 'wp-edit-blocks' ),
			filemtime( get_relative_path( $css_file ) )
		);
	}
}
add_action( 'enqueue_block_editor_assets', 'extend_block_button_script' );
