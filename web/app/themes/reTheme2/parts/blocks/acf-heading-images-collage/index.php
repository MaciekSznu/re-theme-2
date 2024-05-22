<?php
/**
 * The heading with images collage block file.
 *
 * @package    WordPress
 * @subpackage re-theme
 * @since      re-theme 1.0
 */

$hic_hero             = get_field( 'hic_hero' );
$hic_heading          = get_field( 'hic_heading' );
$hic_content          = get_field( 'hic_content' );
$hic_background_image = get_field( 'hic_background_image' );
$hic_small_images     = get_field( 'hic_small_images' );
$custom_block_id      = get_field( 'block_id' );

$block_id = ! empty( $custom_block_id ) ? ' id="' . $custom_block_id . '"' : '';

if ( ! empty( $hic_heading ) && ! empty( $hic_background_image ) ) : ?>
	<section class="acf-block heading-img-coll"<?php echo $block_id; ?>>
		<?php echo set_custom_block_styles( 'heading-img-coll' ); ?>
		<div class="container">
			<div class="heading-img-coll__wrapper">
				<div class="heading-img-coll__content-wrapper">
					<div class="heading-img-coll__heading">
						<h2 class="lead-heading<?php echo $hic_hero ? ' slide-fade-in' : ''; ?>"><?php echo wp_kses_post( $hic_heading ); ?></h2>
						<?php if ( ! empty( $hic_content ) ) : ?>
							<p class="heading-img-coll__content slide-fade-in"><?php echo wp_kses_post( $hic_content ); ?></p>
						<?php endif; ?>
					</div>
				</div>
				<div class="heading-img-coll__image-wrapper">
					<div class="heading-img-coll__background-image slide-fade-in">
						<?php echo wp_get_attachment_image( $hic_background_image, 'container-image' ); ?>
					</div>
					<?php if ( ! empty( $hic_small_images ) ) : ?>
					<div class="heading-img-coll__small-images">
						<?php foreach ( $hic_small_images as $image ) : ?>
							<div class="heading-img-coll__small-image slide-fade-in">
								<?php echo wp_get_attachment_image( $image, 'tile-image' ); ?>
							</div>
						<?php endforeach; ?>
					</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</section>
	<?php
endif;
