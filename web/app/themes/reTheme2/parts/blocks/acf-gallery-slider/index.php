<?php
/**
 * Block with content slider
 *
 * @package WordPress
 * @subpackage reTheme2
 * @since reTheme2 1.0
 */

$block_object  = new Block( $block );
$block_title   = get_field( 'gs_section_title' );
$gallery       = get_field( 'gs_gallery_slider' );
$wrapper_class = 'block-gallery-slider__wrapper';
if ( ! empty( $gallery ) ) {
	$wrapper_class .= ' block-gallery-slider__wrapper--slider';
	$layout_counter = $block['id'];
}
$name = $block_object->block_name();
if ( ! empty( $gallery ) ) :
	?>
<section class="block-acf block-gallery-slider" <?php $block_object->the_block_attributes(); ?>>
	<?php load_styles( __DIR__, $name ); ?>
	<?php load_styles_components( 'sliders' ); ?>
	<?php load_styles_third( 'slick' ); ?>
	<?php $block_object->pick_block_padding_margin(); ?>
	<div class="<?php echo esc_attr( $block_object->container_class() ); ?>">
	<?php if ( ! empty( $block_title ) ) : ?>
		<h2><?php echo esc_html( $block_title ); ?></h2>
	<?php endif; ?>
		<div class="row justify-content-center">
			<div class="col-12">
				<div class="<?php echo esc_attr( $wrapper_class ); ?>" data-slider="<?php echo esc_attr( $layout_counter ); ?>">
				<?php
				foreach ( $gallery as $slide ) :
					if ( $slide['image'] ) :
						$slide_img     = wp_get_attachment_image( $slide['image']['ID'], 'slider-image-full' );
						$slide_caption = $slide['image']['caption'];
						if ( ! empty( $slide_img ) ) :
							?>
					<div class="gallery-slide">
						<figure class="gallery-slide__image">
							<?php echo wp_kses_post( $slide_img ); ?>
							<figcaption class="gallery-slide__caption"><?php echo esc_html( $slide_caption ); ?></figcaption>
						</figure>
					</div>
							<?php
					endif;
				endif;
				endforeach;
				?>
				</div>
			</div>
		</div>
	</div>
</section>
	<?php
endif;
