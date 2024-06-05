<?php
/**
 * Change core block
 *
 * @package    WordPress
 * @subpackage reTheme2
 * @since      reTheme2 1.0
 */

/**
 * Change core embed block
 *
 * @param string $block_content The block content about to be appended.
 * @param array  $block The full block, including name and attributes.
 */
function wrap_embed_block( $block_content, $block ) {
	if ( 'core/embed' === $block['blockName'] || 'core-embed/wordpress' === $block['blockName'] ) {
		$block_content = '<div data-styles-id="core-embed"></div>' . $block_content;
	}
	return $block_content;
}
add_filter( 'render_block', 'wrap_embed_block', 10, 2 );

/**
 * Add block editor style
 */
function core_block_registration_embed() {
	if ( is_admin() ) {
		$css_file = '/parts/blocks/core-embed/style-editor.css';

		wp_enqueue_style(
			'core/embed',
			get_template_directory_uri() . $css_file,
			array( 'wp-edit-blocks' ),
			filemtime( get_relative_path( $css_file ) )
		);
	}
}
add_action( 'enqueue_block_editor_assets', 'core_block_registration_embed' );

/**
 * Add block scripts.
 */
function register_block_embed_scripts() {
	if ( Block::if_block_exists( 'wp-block-embed' ) ) {
		$js_file = '/parts/blocks/core-embed/index.min.js';

		wp_enqueue_script(
			'reTheme2/block_embed_script',
			get_template_directory_uri() . $js_file . '#asyncload',
			array(),
			filemtime( get_relative_path( $js_file ) ),
			true
		);
	}
}
add_action( 'enqueue_block_assets', 'register_block_embed_scripts' );
