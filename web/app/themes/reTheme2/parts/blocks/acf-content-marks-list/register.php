<?php
/**
 * Register ACF block.
 *
 * @package    WordPress
 * @subpackage reTheme2
 * @since      reTheme2 1.0
 */

/**
 * Register block content marks list.
 */
function init_block_content_marks_list() {
	if ( ! function_exists( 'acf_register_block_type' ) ) {
		return;
	}

	acf_register_block_type(
		array(
			'name'            => 'content-marks-list',
			'title'           => __( 'Content marks list', 'reTheme2' ),
			'description'     => __( 'Block content marks list', 'reTheme2' ),
			'category'        => 'custom_blocks',
			'icon'            => 'list-view',
			'mode'            => 'edit',
			'keywords'        => array( 'content', 'list', 'marks' ),
			'supports'        => array(
				'align'  => array( 'wide', 'full' ),
				'anchor' => true,
			),
			'render_template' => get_template_directory() . '/parts/blocks/acf-content-marks-list/index.php',
		)
	);
}

add_action( 'acf/init', 'init_block_content_marks_list' );
