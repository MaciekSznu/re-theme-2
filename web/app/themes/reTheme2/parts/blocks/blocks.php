<?php
/**
 * The register acf blocks file.
 *
 * @package    WordPress
 * @subpackage re-theme
 * @since      re-theme 1.0
 */

add_action( 'acf/init', 'my_acf_blocks_init' );
function my_acf_blocks_init() {

	// Check function exists.
	if ( function_exists( 'acf_register_block_type' ) ) {

		// Register a hero block.
		acf_register_block_type(
			array(
				'name'            => 'hero',
				'title'           => __( 'Hero' ),
				'description'     => __( 'A custom Hero block.' ),
				'render_template' => 'template-parts/blocks/acf-hero/index.php',
				'category'        => 'layout',
				'icon'            => 'slides',
				'keywords'        => array( 'hero', 'slider' ),
				'mode'            => 'auto',
				'align'           => 'wide',
			)
		);

		// Register a content image block.
		acf_register_block_type(
			array(
				'name'            => 'content-image',
				'title'           => __( 'Content image' ),
				'description'     => __( 'Block with content and image.' ),
				'render_template' => 'template-parts/blocks/acf-content-image/index.php',
				'category'        => 'layout',
				'icon'            => 'align-pull-right',
				'keywords'        => array( 'content', 'image' ),
				'mode'            => 'auto',
				'align'           => 'wide',
			)
		);

		// Register a content icons list block.
		acf_register_block_type(
			array(
				'name'            => 'content-icons-list',
				'title'           => __( 'Content icons list' ),
				'description'     => __( 'Block with content & icons list.' ),
				'render_template' => 'template-parts/blocks/acf-content-icons-list/index.php',
				'category'        => 'layout',
				'icon'            => 'editor-table',
				'keywords'        => array( 'content', 'list', 'icons' ),
				'mode'            => 'auto',
				'align'           => 'wide',
			)
		);

		// Register a background content block.
		acf_register_block_type(
			array(
				'name'            => 'background-content',
				'title'           => __( 'Background & content' ),
				'description'     => __( 'Block background & content.' ),
				'render_template' => 'template-parts/blocks/acf-background-content/index.php',
				'category'        => 'layout',
				'icon'            => 'tagcloud',
				'keywords'        => array( 'content', 'background', 'image' ),
				'mode'            => 'auto',
				'align'           => 'wide',
			)
		);

		// Register a apartments list block.
		acf_register_block_type(
			array(
				'name'            => 'apartments-table',
				'title'           => __( 'Apartments table' ),
				'description'     => __( 'Block apartments table.' ),
				'render_template' => 'template-parts/blocks/acf-apartments-table/index.php',
				'category'        => 'layout',
				'icon'            => 'editor-table',
				'keywords'        => array( 'apartments', 'table' ),
				'mode'            => 'auto',
				'align'           => 'wide',
			)
		);

		// Register a call to action block.
		acf_register_block_type(
			array(
				'name'            => 'cta',
				'title'           => __( 'Call to action' ),
				'description'     => __( 'Block call to action.' ),
				'render_template' => 'template-parts/blocks/acf-cta/index.php',
				'category'        => 'layout',
				'icon'            => 'align-wide',
				'keywords'        => array( 'call to action', 'cta' ),
				'mode'            => 'auto',
				'align'           => 'wide',
			)
		);

		// Register a hero with cta block.
		acf_register_block_type(
			array(
				'name'            => 'hero-cta',
				'title'           => __( 'Hero with call to action' ),
				'description'     => __( 'Block hero with call to action.' ),
				'render_template' => 'template-parts/blocks/acf-hero-cta/index.php',
				'category'        => 'layout',
				'icon'            => 'welcome-widgets-menus',
				'keywords'        => array( 'call to action', 'hero' ),
				'mode'            => 'auto',
				'align'           => 'wide',
			)
		);

		// Register a heading with images collage block.
		acf_register_block_type(
			array(
				'name'            => 'heading-images-collage',
				'title'           => __( 'Heading with images collage' ),
				'description'     => __( 'Block heading with images collage.' ),
				'render_template' => 'template-parts/blocks/acf-heading-images-collage/index.php',
				'category'        => 'layout',
				'icon'            => 'layout',
				'keywords'        => array( 'heading', 'images', 'collage', 'hero' ),
				'mode'            => 'auto',
				'align'           => 'wide',
			)
		);

		// Register a slider gallery block.
		acf_register_block_type(
			array(
				'name'            => 'slider-gallery',
				'title'           => __( 'Slider gallery' ),
				'description'     => __( 'Block slider gallery.' ),
				'render_template' => 'template-parts/blocks/acf-slider-gallery/index.php',
				'category'        => 'layout',
				'icon'            => 'format-gallery',
				'keywords'        => array( 'slider', 'images', 'gallery' ),
				'mode'            => 'auto',
				'align'           => 'wide',
			)
		);

		// Register a accordion block.
		acf_register_block_type(
			array(
				'name'            => 'accordion',
				'title'           => __( 'Accordion' ),
				'description'     => __( 'Block accordion.' ),
				'render_template' => 'template-parts/blocks/acf-accordion/index.php',
				'category'        => 'layout',
				'icon'            => 'editor-justify',
				'keywords'        => array( 'accordion' ),
				'mode'            => 'auto',
				'align'           => 'wide',
			)
		);

		// Register a content marks list  block.
		acf_register_block_type(
			array(
				'name'            => 'content-marks-list',
				'title'           => __( 'Content marks list' ),
				'description'     => __( 'Block content with marks list.' ),
				'render_template' => 'template-parts/blocks/acf-content-marks-list/index.php',
				'category'        => 'layout',
				'icon'            => 'list-view',
				'keywords'        => array( 'content', 'list', 'marks' ),
				'mode'            => 'auto',
				'align'           => 'wide',
			)
		);

		// Register an animated numbers block.
		acf_register_block_type(
			array(
				'name'            => 'animated-numbers',
				'title'           => __( 'Animated numbers' ),
				'description'     => __( 'An animated numbers block.' ),
				'render_template' => 'template-parts/blocks/acf-animated-numbers/index.php',
				'category'        => 'layout',
				'icon'            => 'calculator',
				'keywords'        => array( 'animated', 'numbers' ),
				'mode'            => 'auto',
				'align'           => 'wide',
			)
		);

		// Register an big numbers list block.
		acf_register_block_type(
			array(
				'name'            => 'big-numbers-list',
				'title'           => __( 'Big numbers list' ),
				'description'     => __( 'An big numbers list block.' ),
				'render_template' => 'template-parts/blocks/acf-big-numbers-list/index.php',
				'category'        => 'layout',
				'icon'            => 'grid-view',
				'keywords'        => array( 'big', 'numbers', 'list' ),
				'mode'            => 'auto',
				'align'           => 'wide',
			)
		);

		// Register a content image form block.
		acf_register_block_type(
			array(
				'name'            => 'content-image-form',
				'title'           => __( 'Content image form' ),
				'description'     => __( 'Block with content, image and form.' ),
				'render_template' => 'template-parts/blocks/acf-content-image-form/index.php',
				'category'        => 'layout',
				'icon'            => 'forms',
				'keywords'        => array( 'content', 'image', 'form' ),
				'mode'            => 'auto',
				'align'           => 'wide',
			)
		);

		// Register a developer block.
		// acf_register_block_type(
		// 	array(
		// 		'name'            => 'developer',
		// 		'title'           => __( 'Developer' ),
		// 		'description'     => __( 'A custom Developer block.' ),
		// 		'render_template' => 'template-parts/blocks/acf-developer/index.php',
		// 		'category'        => 'layout',
		// 		'icon'            => 'editor-justify',
		// 		'keywords'        => array( 'developer', 'content' ),
		// 		'mode'            => 'auto',
		// 		'align'           => 'wide',
		// 	)
		// );

		// Register a gallery block.
		// acf_register_block_type(
		// 	array(
		// 		'name'            => 'gallery',
		// 		'title'           => __( 'Gallery' ),
		// 		'description'     => __( 'A custom Gallery block.' ),
		// 		'render_template' => 'template-parts/blocks/acf-gallery/index.php',
		// 		'category'        => 'layout',
		// 		'icon'            => 'format-gallery',
		// 		'keywords'        => array( 'gallery' ),
		// 		'mode'            => 'auto',
		// 		'align'           => 'wide',
		// 	)
		// );

		// Register a localization block.
		// acf_register_block_type(
		// 	array(
		// 		'name'            => 'localization',
		// 		'title'           => __( 'Localization' ),
		// 		'description'     => __( 'A custom Localization block.' ),
		// 		'render_template' => 'template-parts/blocks/acf-localization/index.php',
		// 		'category'        => 'layout',
		// 		'icon'            => 'editor-insertmore',
		// 		'keywords'        => array( 'localization', 'list', 'icons', 'content' ),
		// 		'mode'            => 'auto',
		// 		'align'           => 'wide',
		// 	)
		// );

		// Register a apartments block.
		// acf_register_block_type(
		// 	array(
		// 		'name'            => 'apartments',
		// 		'title'           => __( 'Apartments' ),
		// 		'description'     => __( 'A custom Apartments block.' ),
		// 		'render_template' => 'template-parts/blocks/acf-apartments/index.php',
		// 		'category'        => 'layout',
		// 		'icon'            => 'editor-insertmore',
		// 		'keywords'        => array( 'apartments', 'table', 'icons', 'content' ),
		// 		'mode'            => 'auto',
		// 		'align'           => 'wide',
		// 	)
		// );
	}
}
