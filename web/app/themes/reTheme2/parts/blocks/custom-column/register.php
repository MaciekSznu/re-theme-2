<?php
/**
 * Register block style and scripts.
 *
 * @package    WordPress
 * @subpackage reTheme2
 * @since      reTheme2 1.0
 */

/**
 * Custom block registration column.
 */
function custom_block_registration_column() {
	$js_file = '/parts/blocks/custom-column/admin.min.js';
	wp_register_script(
		'custom/column',
		get_template_directory_uri() . $js_file,
		array( 'wp-blocks', 'wp-element', 'wp-editor', 'wp-i18n' ),
		filemtime( get_relative_path( $js_file ) ),
		false
	);

	register_block_type(
		'custom/column',
		array(
			'editor_script' => 'custom/column',
		)
	);
}
add_action( 'enqueue_block_editor_assets', 'custom_block_registration_column' );
