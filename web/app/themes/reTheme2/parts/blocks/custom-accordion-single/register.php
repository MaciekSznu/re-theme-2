<?php
/**
 * Register block style and scripts.
 *
 * @package    WordPress
 * @subpackage reTheme2
 * @since      reTheme2 1.0
 */

/**
 * Custom block registration accordion single.
 */
function custom_block_registration_accordion_single() {
	$js_file = '/parts/blocks/custom-accordion-single/admin.min.js';

	wp_register_script(
		'custom/accordion-single',
		get_template_directory_uri() . $js_file,
		array( 'wp-blocks', 'wp-element', 'wp-editor' ),
		filemtime( get_relative_path( $js_file ) ),
		false
	);

	register_block_type(
		'custom/accordion-single',
		array(
			'editor_script' => 'custom/accordion-single',
		)
	);
}
add_action( 'enqueue_block_editor_assets', 'custom_block_registration_accordion_single' );
