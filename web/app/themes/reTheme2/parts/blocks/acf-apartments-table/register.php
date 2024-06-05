<?php
/**
 * Register ACF block.
 *
 * @package    WordPress
 * @subpackage reTheme2
 * @since      reTheme2 1.0
 */

/**
 * Register block apartments table.
 */
function init_block_apartments_table() {
	if ( ! function_exists( 'acf_register_block_type' ) ) {
		return;
	}

	acf_register_block_type(
		array(
			'name'            => 'apartments-table',
			'title'           => __( 'Apartments table', 'reTheme2' ),
			'description'     => __( 'Block apartments table', 'reTheme2' ),
			'category'        => 'custom_blocks',
			'icon'            => 'editor-table',
			'mode'            => 'edit',
			'keywords'        => array( 'apartments', 'table' ),
			'supports'        => array(
				'align'  => array( 'wide', 'full' ),
				'anchor' => true,
			),
			'render_template' => get_template_directory() . '/parts/blocks/acf-apartments-table/index.php',
		)
	);
}

add_action( 'acf/init', 'init_block_apartments_table' );
