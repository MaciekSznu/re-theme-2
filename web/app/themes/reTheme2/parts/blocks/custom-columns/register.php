<?php
/**
 * Register block style and scripts.
 *
 * @package    WordPress
 * @subpackage reTheme2
 * @since      reTheme2 1.0
 */

/**
 * Custom block registration columns.
 */
function custom_block_registration_columns() {
	$js_file = '/parts/blocks/custom-columns/admin.min.js';

	wp_register_script(
		'custom/columns',
		get_template_directory_uri() . $js_file,
		array( 'wp-blocks', 'wp-element', 'wp-editor', 'wp-i18n' ),
		filemtime( get_relative_path( $js_file ) ),
		false
	);

	if ( is_admin() ) :
		$css_file = '/parts/blocks/custom-columns/style-editor.css';
		wp_register_style(
			'custom/columns-editor-styles',
			get_template_directory_uri() . $css_file,
			array( 'wp-edit-blocks' ),
			filemtime( get_relative_path( $css_file ) )
		);
	endif;

	register_block_type(
		'custom/columns',
		array(
			'editor_script' => 'custom/columns',
			'editor_style'  => 'custom/columns-editor-styles',
		)
	);
}
add_action( 'enqueue_block_editor_assets', 'custom_block_registration_columns' );
