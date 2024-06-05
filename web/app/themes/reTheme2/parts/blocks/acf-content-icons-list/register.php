<?php
/**
 * Register ACF block.
 *
 * @package    WordPress
 * @subpackage reTheme2
 * @since      reTheme2 1.0
 */

/**
 * Register block content icons list.
 */
function init_block_content_icons_list() {
	if ( ! function_exists( 'acf_register_block_type' ) ) {
		return;
	}

	acf_register_block_type(
		array(
			'name'            => 'content-icons-list',
			'title'           => __( 'Content icons list', 'reTheme2' ),
			'description'     => __( 'Block with content & icons list', 'reTheme2' ),
			'category'        => 'custom_blocks',
			'icon'            => 'editor-table',
			'mode'            => 'edit',
			'keywords'        => array( 'content', 'list', 'icons' ),
			'supports'        => array(
				'align'  => array( 'wide', 'full' ),
				'anchor' => true,
			),
			'render_template' => get_template_directory() . '/parts/blocks/acf-content-icons-list/index.php',
		)
	);
}

add_action( 'acf/init', 'init_block_content_icons_list' );
