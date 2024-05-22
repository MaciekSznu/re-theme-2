<?php
/**
 * Register ACF block.
 *
 * @package    WordPress
 * @subpackage reTheme2
 * @since      reTheme2 1.0
 */

/**
 * Register block accordion.
 */
function init_block_accordion() {
	if ( ! function_exists( 'acf_register_block_type' ) ) {
		return;
	}

	acf_register_block_type(
		array(
			'name'            => 'accordion',
			'title'           => __( 'Accordion', 'reTheme2' ),
			'description'     => __( 'Block accordion', 'reTheme2' ),
			'category'        => 'custom_blocks',
			'icon'            => 'editor-justify',
			'mode'            => 'edit',
			'keywords'        => array( 'accordion' ),
			'align'           => 'wide',
			'supports'        => array(
				'align' => array( 'wide', 'full' ),
				'anchor' => true,
			),
			'render_template' => get_template_directory() . '/parts/blocks/acf-accordion/index.php',
			'enqueue_assets'  => function () {
				$js_file = '/parts/blocks/acf-accordion/index.min.js';

				wp_enqueue_script(
					'reTheme2/acf-accordion',
					get_template_directory_uri() . $js_file . '#asyncload',
					array(),
					filemtime( get_relative_path( $js_file ) ),
					true
				);
			},
		)
	);
}

add_action( 'acf/init', 'init_block_accordion' );
