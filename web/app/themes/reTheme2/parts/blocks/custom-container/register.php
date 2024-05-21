<?php
/**
 * Register block style and scripts.
 *
 * @package    WordPress
 * @subpackage reTheme2
 * @since      reTheme2 1.0
 */

/**
 * Custom block registration container.
 */
function custom_block_registration_container() {
	$js_file = '/parts/blocks/custom-container/admin.min.js';

	wp_register_script(
		'custom/container',
		get_template_directory_uri() . $js_file,
		array( 'wp-blocks', 'wp-element', 'wp-editor', 'wp-i18n' ),
		filemtime( get_relative_path( $js_file ) ),
		false
	);

	if ( is_admin() ) :
		$css_file = '/parts/blocks/custom-container/style-editor.css';

		wp_register_style(
			'custom/container-editor-styles',
			get_template_directory_uri() . $css_file,
			array( 'wp-edit-blocks' ),
			filemtime( get_relative_path( $css_file ) )
		);
	endif;

	register_block_type(
		'custom/container',
		array(
			'editor_script' => 'custom/container',
			'editor_style'  => 'custom/container-editor-styles',
		)
	);
}
add_action( 'enqueue_block_editor_assets', 'custom_block_registration_container' );
