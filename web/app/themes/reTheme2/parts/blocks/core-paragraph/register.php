<?php
/**
 * Change core block
 *
 * @package    WordPress
 * @subpackage reTheme2
 * @since      reTheme2 1.0
 */

/**
 * Core block paragraph script.
 */
function extend_block_paragraph_script() {
	$js_file = '/parts/blocks/core-paragraph/admin.min.js';

	wp_enqueue_script(
		'core/paragraph',
		get_template_directory_uri() . $js_file,
		array( 'wp-i18n', 'wp-dom-ready', 'wp-editor', 'wp-blocks', 'wp-compose', 'wp-element', 'wp-hooks' ),
		filemtime( get_relative_path( $js_file ) ),
		false
	);
}
add_action( 'enqueue_block_editor_assets', 'extend_block_paragraph_script' );
