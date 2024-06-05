<?php
/**
 * Register ACF block.
 *
 * @package    WordPress
 * @subpackage reTheme2
 * @since      reTheme2 1.0
 */

/**
 * Register block apartments search.
 */
function init_block_apartments_search() {
	if ( ! function_exists( 'acf_register_block_type' ) ) {
		return;
	}

	acf_register_block_type(
		array(
			'name'            => 'apartments-search',
			'title'           => __( 'Apartments search', 'reTheme2' ),
			'description'     => __( 'Block apartments search', 'reTheme2' ),
			'category'        => 'custom_blocks',
			'icon'            => 'editor-table',
			'mode'            => 'edit',
			'keywords'        => array( 'apartments', 'search' ),
			'supports'        => array(
				'align'  => array( 'wide', 'full' ),
				'anchor' => true,
			),
			'render_template' => get_template_directory() . '/parts/blocks/acf-apartments-search/index.php',
			'enqueue_assets'  => function () {
				$js_file = '/parts/blocks/acf-apartments-search/index.min.js';

				wp_enqueue_script(
					'reTheme2/acf-apartments-search',
					get_template_directory_uri() . $js_file . '#asyncload',
					array(),
					filemtime( get_relative_path( $js_file ) ),
					true
				);
			},
		)
	);
}

add_action( 'acf/init', 'init_block_apartments_search' );
