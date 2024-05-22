<?php
/**
 * The slider gallery block file.
 *
 * @package    WordPress
 * @subpackage re-theme
 * @since      re-theme 1.0
 */

$sg_heading     = get_field( 'sg_heading' );
$sg_title_g_01  = get_field( 'sg_title_g_01' );
$sg_images_g_01 = get_field( 'sg_images_g_01' );
$sg_title_g_02  = get_field( 'sg_title_g_02' );
$sg_images_g_02 = get_field( 'sg_images_g_02' );

$custom_block_id = get_field( 'block_id' );

$block_id = ! empty( $custom_block_id ) ? ' id="' . $custom_block_id . '"' : '';

if ( ! empty( $sg_images_g_01 ) ) : ?>
	<section class="acf-block slider-gallery"<?php echo $block_id; ?>>
		<?php load_styles( __DIR__, $name ); ?>
		<?php load_styles_components( 'sliders' ); ?>
		<?php load_styles_third( 'slick' ); ?>
		<div class="slider-gallery__wrapper">
			<?php if ( ! empty( $sg_heading ) ) : ?>
			<div class="container">
				<div class="slider-gallery__title-wrapper slide-fade-in">
					<h2 class="slider-gallery__title h1"><?php echo esc_html( $sg_heading ); ?></h2>
				</div>
			</div>
			<?php endif; ?>
			<div class="slider-gallery__row-wrapper slide-fade-in">
				<?php if ( ! empty( $sg_title_g_01 ) ) : ?>
				<div class="container">
					<div class="slider-gallery__row-title-wrapper">
						<h4 class="slider-gallery__row-title"><?php echo esc_html( $sg_title_g_01 ); ?></h3>
					</div>
				</div>
				<?php endif; ?>
				<div class="slider-gallery__slider-wrapper slider-gallery__slider-wrapper-01">
				<?php foreach ( $sg_images_g_01 as $item ) : ?>
					<div class="slider-gallery__item">
						<figure>
							<?php echo wp_get_attachment_image( $item, 'gallery' ); ?>
						</figure>
					</div>
				<?php endforeach; ?>
				</div>
			</div>
			<?php if ( ! empty( $sg_images_g_02 ) ) : ?>
			<div class="slider-gallery__row-wrapper slide-fade-in">
				<?php if ( ! empty( $sg_title_g_02 ) ) : ?>
				<div class="container">
					<div class="slider-gallery__row-title-wrapper">
						<h4 class="slider-gallery__row-title"><?php echo esc_html( $sg_title_g_02 ); ?></h3>
					</div>
				</div>
				<?php endif; ?>
				<div class="slider-gallery__slider-wrapper slider-gallery__slider-wrapper-02">
				<?php foreach ( $sg_images_g_02 as $item ) : ?>
					<div class="slider-gallery__item">
						<figure>
							<?php echo wp_get_attachment_image( $item, 'gallery' ); ?>
						</figure>
					</div>
				<?php endforeach; ?>
				</div>
			</div>
			<?php endif; ?>
		</div>
	</section>
	<?php
endif;
