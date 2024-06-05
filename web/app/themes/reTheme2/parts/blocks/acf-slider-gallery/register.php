<?php
/**
 * Register ACF block.
 *
 * @package    WordPress
 * @subpackage reTheme2
 * @since      reTheme2 1.0
 */

/**
 * Register block slider gallery.
 */
function init_block_slider_gallery() {
	if ( ! function_exists( 'acf_register_block_type' ) ) {
		return;
	}

	acf_register_block_type(
		array(
			'name'            => 'slider-gallery',
			'title'           => __( 'Slider Gallery', 'reTheme2' ),
			'description'     => __( 'Slider Gallery', 'reTheme2' ),
			'category'        => 'custom_blocks',
			'icon'            => 'slides',
			'mode'            => 'edit',
			'keywords'        => array( 'gallery', 'slider', 'images' ),
			'supports'        => array(
				'align'  => array( 'wide', 'full' ),
				'anchor' => true,
			),
			'render_template' => get_template_directory() . '/parts/blocks/acf-slider-gallery/index.php',
			'enqueue_assets'  => function () {
				$js_file = '/parts/blocks/acf-slider-gallery/index.min.js';

				wp_enqueue_script(
					'reTheme2/acf-slider-gallery',
					get_template_directory_uri() . $js_file . '#asyncload',
					array( 'slick_script' ),
					filemtime( get_relative_path( $js_file ) ),
					true
				);
			},
		)
	);
}

add_action( 'acf/init', 'init_block_slider_gallery' );
