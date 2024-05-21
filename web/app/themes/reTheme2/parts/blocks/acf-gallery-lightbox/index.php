<?php
/**
 * Block with lightbox gallery slider
 *
 * @package WordPress
 * @subpackage reTheme2
 * @since reTheme2 1.0
 */

$block_object = new Block( $block );
$name         = $block_object->block_name();
$block_title  = get_field( 'gl_section_title' );
$gallery      = get_field( 'gl_gallery' );
if ( ! empty( $gallery ) ) {
	$gallery_length = count( $gallery );
	$layout_counter = $block['id'];
}
$wrapper_class = 'block-gallery-lightbox__wrapper';
if ( ! empty( $gallery ) ) {
	$wrapper_class .= ' block-gallery-lightbox__wrapper--slider';
	$layout_counter = $block['id'];
}
if ( ! empty( $gallery ) ) :
	?>
<section class="block-acf block-gallery-lightbox" <?php $block_object->the_block_attributes(); ?>>
	<?php load_styles( __DIR__, $name ); ?>
	<?php load_styles_components( 'sliders' ); ?>
	<?php load_styles_third( 'slick' ); ?>
	<?php $block_object->pick_block_padding_margin(); ?>
	<div class="<?php echo esc_attr( $block_object->container_class() ); ?>">
	<?php if ( ! empty( $block_title ) ) : ?>
		<h2><?php echo esc_html( $block_title ); ?></h2>
	<?php endif; ?>
		<div class="gallery-lightbox-thumbnails">
			<div class="row">
			<?php for ( $i = 0; $i < $gallery_length; $i++ ) : ?>
				<?php if ( ! empty( $gallery[ $i ]['image'] ) ) : ?>
					<a href="<?php echo esc_attr( '#' . $i ); ?>"  class="gallery-lightbox-thumb col-12 col-md-6 col-lg-4" aria-label="<?php esc_html_e( 'thumb trigger open lightbox', 'reTheme2' ); ?>">
						<?php
						echo wp_get_attachment_image( $gallery[ $i ]['image']['ID'], 'thumbnail-image' );
						?>
					</a>
				<?php endif; ?>
			<?php endfor; ?>
			</div>
		</div>
		<div class="gallery-lightbox">
			<button class="gallery-lightbox__close">
				<span class="icon-close"></span>
				<span class="screen-reader-text">
					<?php esc_html_e( 'close lightbox', 'reTheme2' ); ?>
				</span>
			</button>
			<div class="container container--full">
				<div class="gallery-lightbox__slider-wrapper">
					<div class="gallery-lightbox__slider" data-slider="<?php echo esc_attr( $layout_counter ); ?>">
					<?php
					for ( $i = 0; $i < $gallery_length; $i++ ) :
						if ( $gallery[ $i ]['image'] ) :
							$slide         = wp_get_attachment_image( $gallery[ $i ]['image']['ID'], 'slider-image-lightbox' );
							$slide_caption = $gallery[ $i ]['image']['caption'];
							if ( ! empty( $slide ) ) :
								?>
					<div class="gallery-lightbox__slide
								<?php
								if ( ! empty( $caption ) ) {
									echo ' has-caption';}
								?>
					"">
						<figure class="gallery-lightbox__slide-image">
								<?php
								echo wp_kses_post( $slide );
								if ( ! empty( $slide_caption ) ) :
									?>
							<figcaption class="gallery-lightbox__caption"><?php echo esc_html( $slide_caption ); ?></figcaption>
									<?php
								endif;
								?>
						</figure>
					</div>
								<?php
							endif;
						endif;
					endfor;
					?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
	<?php
endif;
