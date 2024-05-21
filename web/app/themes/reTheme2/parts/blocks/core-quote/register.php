<?php
/**
 * Change core block
 *
 * @package    WordPress
 * @subpackage reTheme2
 * @since      reTheme2 1.0
 */

/**
 * Change core quote block
 *
 * @param string $block_content The block content about to be appended.
 * @param array  $block The full block, including name and attributes.
 */
function wrap_quote_block( $block_content, $block ) {
	if ( 'core/quote' === $block['blockName'] ) {
		$block_content = '<div data-styles-id="core-quote"></div>' . $block_content;
	}
	return $block_content;
}
add_filter( 'render_block', 'wrap_quote_block', 10, 2 );

/**
 * Core block registration quote.
 */
function core_block_registration_quote() {
	if ( is_admin() ) {
		$css_file = '/parts/blocks/core-quote/style-editor.css';

		wp_enqueue_style(
			'core/quote',
			get_template_directory_uri() . $css_file,
			array( 'wp-edit-blocks' ),
			filemtime( get_relative_path( $css_file ) )
		);
	}
}
add_action( 'enqueue_block_editor_assets', 'core_block_registration_quote' );
