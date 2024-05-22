<?php
/**
 * Register ACF block.
 *
 * @package    WordPress
 * @subpackage reTheme2
 * @since      reTheme2 1.0
 */

/**
 * Register block content image.
 */
function init_block_content_image() {
	if ( ! function_exists( 'acf_register_block_type' ) ) {
		return;
	}

	acf_register_block_type(
		array(
			'name'            => 'content-image',
			'title'           => __( 'Content image', 'reTheme2' ),
			'description'     => __( 'Block with content & image', 'reTheme2' ),
			'category'        => 'custom_blocks',
			'icon'            => 'align-pull-right',
			'mode'            => 'edit',
			'keywords'        => array( 'content', 'image' ),
			'align'           => 'wide',
			'supports'        => array(
				'align'  => array( 'wide', 'full' ),
				'anchor' => true,
			),
			'render_template' => get_template_directory() . '/parts/blocks/acf-content-image/index.php',
		)
	);
}

add_action( 'acf/init', 'init_block_content_image' );
