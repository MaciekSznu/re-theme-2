<?php
/**
 * Register ACF block.
 *
 * @package    WordPress
 * @subpackage reTheme2
 * @since      reTheme2 1.0
 */

/**
 * Register block background content.
 */
function init_block_background_content() {
	if ( ! function_exists( 'acf_register_block_type' ) ) {
		return;
	}

	acf_register_block_type(
		array(
			'name'            => 'background-content',
			'title'           => __( 'Background & content', 'reTheme2' ),
			'description'     => __( 'Block background & content', 'reTheme2' ),
			'category'        => 'custom_blocks',
			'icon'            => 'tagcloud',
			'mode'            => 'edit',
			'keywords'        => array( 'content', 'background', 'image' ),
			'align'           => 'wide',
			'supports'        => array(
				'align'  => array( 'wide', 'full' ),
				'anchor' => true,
			),
			'render_template' => get_template_directory() . '/parts/blocks/acf-background-content/index.php',
		)
	);
}

add_action( 'acf/init', 'init_block_background_content' );
