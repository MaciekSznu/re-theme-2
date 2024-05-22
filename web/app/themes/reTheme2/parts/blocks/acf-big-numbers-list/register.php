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
function init_block_big_numbers_list() {
	if ( ! function_exists( 'acf_register_block_type' ) ) {
		return;
	}

	acf_register_block_type(
		array(
			'name'            => 'big-numbers-list',
			'title'           => __( 'Big numbers list', 'reTheme2' ),
			'description'     => __( 'Block big numbers list', 'reTheme2' ),
			'category'        => 'custom_blocks',
			'icon'            => 'grid-view',
			'mode'            => 'edit',
			'keywords'        => array( 'big', 'numbers', 'list' ),
			'align'           => 'wide',
			'supports'        => array(
				'align'  => array( 'wide', 'full' ),
				'anchor' => true,
			),
			'render_template' => get_template_directory() . '/parts/blocks/acf-big-numbers-list/index.php',
		)
	);
}

add_action( 'acf/init', 'init_block_big_numbers_list' );
