<?php
/**
 * Register ACF block.
 *
 * @package    WordPress
 * @subpackage reTheme2
 * @since      reTheme2 1.0
 */

/**
 * Register block call to action.
 */
function init_block_cta() {
	if ( ! function_exists( 'acf_register_block_type' ) ) {
		return;
	}

	acf_register_block_type(
		array(
			'name'            => 'cta',
			'title'           => __( 'Call to action', 'reTheme2' ),
			'description'     => __( 'Block call to action', 'reTheme2' ),
			'category'        => 'custom_blocks',
			'icon'            => 'align-wide',
			'mode'            => 'edit',
			'keywords'        => array( 'call to action', 'cta' ),
			'supports'        => array(
				'align'  => array( 'wide', 'full' ),
				'anchor' => true,
			),
			'render_template' => get_template_directory() . '/parts/blocks/acf-cta/index.php',
		)
	);
}

add_action( 'acf/init', 'init_block_cta' );
