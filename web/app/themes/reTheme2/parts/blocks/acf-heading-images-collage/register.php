<?php
/**
 * Register ACF block.
 *
 * @package    WordPress
 * @subpackage reTheme2
 * @since      reTheme2 1.0
 */

/**
 * Register block heading images collage.
 */
function init_block_heading_images_collage() {
	if ( ! function_exists( 'acf_register_block_type' ) ) {
		return;
	}

	acf_register_block_type(
		array(
			'name'            => 'heading-images-collage',
			'title'           => __( 'Heading with images collage', 'reTheme2' ),
			'description'     => __( 'Block heading with images collage', 'reTheme2' ),
			'category'        => 'custom_blocks',
			'icon'            => 'layout',
			'mode'            => 'edit',
			'keywords'        => array( 'call to action', 'cta' ),
			'align'           => 'wide',
			'supports'        => array(
				'align'  => array( 'wide', 'full' ),
				'anchor' => true,
			),
			'render_template' => get_template_directory() . '/parts/blocks/acf-heading-images-collage/index.php',
		)
	);
}

add_action( 'acf/init', 'init_block_heading_images_collage' );
