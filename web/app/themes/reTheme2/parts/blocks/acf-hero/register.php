<?php
/**
 * Register ACF block.
 *
 * @package    WordPress
 * @subpackage reTheme2
 * @since      reTheme2 1.0
 */

/**
 * Register block hero.
 */
function init_block_hero() {
	if ( ! function_exists( 'acf_register_block_type' ) ) {
		return;
	}

	acf_register_block_type(
		array(
			'name'            => 'hero',
			'title'           => __( 'Hero', 'reTheme2' ),
			'description'     => __( 'Block hero', 'reTheme2' ),
			'category'        => 'custom_blocks',
			'icon'            => 'calculator',
			'mode'            => 'edit',
			'keywords'        => array( 'hero', 'slider' ),
			'align'           => 'wide',
			'supports'        => array(
				'align'  => array( 'wide', 'full' ),
				'anchor' => true,
			),
			'render_template' => get_template_directory() . '/parts/blocks/acf-hero/index.php',
			'enqueue_assets'  => function () {
				$js_file = '/parts/blocks/acf-hero/index.min.js';

				wp_enqueue_script(
					'reTheme2/acf-hero',
					get_template_directory_uri() . $js_file . '#asyncload',
					array( 'slick_script' ),
					filemtime( get_relative_path( $js_file ) ),
					true
				);
			},
		)
	);
}

add_action( 'acf/init', 'init_block_hero' );
