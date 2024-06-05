<?php
/**
 * Register ACF block.
 *
 * @package    WordPress
 * @subpackage reTheme2
 * @since      reTheme2 1.0
 */

/**
 * Register block content image form.
 */
function init_block_content_image_form() {
	if ( ! function_exists( 'acf_register_block_type' ) ) {
		return;
	}

	acf_register_block_type(
		array(
			'name'            => 'content-image-form',
			'title'           => __( 'content image form', 'reTheme2' ),
			'description'     => __( 'Block with content, image & form', 'reTheme2' ),
			'category'        => 'custom_blocks',
			'icon'            => 'forms',
			'mode'            => 'edit',
			'keywords'        => array( 'content', 'image', 'form' ),
			'supports'        => array(
				'align'  => array( 'wide', 'full' ),
				'anchor' => true,
			),
			'render_template' => get_template_directory() . '/parts/blocks/acf-content-image-form/index.php',
		)
	);
}

add_action( 'acf/init', 'init_block_content_image_form' );
