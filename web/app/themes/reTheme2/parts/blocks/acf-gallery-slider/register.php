<?php
/**
 * Register ACF block.
 *
 * @package    WordPress
 * @subpackage reTheme2
 * @since      reTheme2 1.0
 */

/**
 * Register block gallery slider.
 */
function init_block_gallery_slider() {
	if ( ! function_exists( 'acf_register_block_type' ) ) {
		return;
	}

	acf_register_block_type(
		array(
			'name'            => 'gallery-slider',
			'title'           => __( 'Gallery Slider', 'reTheme2' ),
			'description'     => __( 'Gallery Slider', 'reTheme2' ),
			'category'        => 'custom_blocks',
			'icon'            => 'slides',
			'mode'            => 'edit',
			'keywords'        => array( 'gallery', 'slider', 'images' ),
			'align'           => 'full',
			'supports'        => array(
				'align'  => array( 'full' ),
				'anchor' => true,
			),
			'render_template' => get_template_directory() . '/parts/blocks/acf-gallery-slider/index.php',
			'enqueue_assets'  => function () {
				$js_file = '/parts/blocks/acf-gallery-slider/index.min.js';

				wp_enqueue_script(
					'reTheme2/acf-gallery-slider',
					get_template_directory_uri() . $js_file . '#asyncload',
					array( 'slick_script' ),
					filemtime( get_relative_path( $js_file ) ),
					true
				);
			},
		)
	);
}

add_action( 'acf/init', 'init_block_gallery_slider' );
