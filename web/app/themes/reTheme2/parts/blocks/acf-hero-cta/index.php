<?php
/**
 * The hero with cta block file.
 *
 * @package    WordPress
 * @subpackage re-theme
 * @since      re-theme 1.0
 */
// TODO: fix buttons
$block_object          = new Block( $block );
$name                  = $block_object->block_name();
$hcta_heading          = get_field( 'hcta_heading' );
$hcta_content          = get_field( 'hcta_content' );
$hcta_background_image = get_field( 'hcta_background_image' );
$hcta_small_image      = get_field( 'hcta_small_image' );
$hcta_link             = get_field( 'hcta_link' );

if ( ! empty( $hcta_heading ) && ! empty( $hcta_background_image ) ) : ?>
	<section class="acf-block hero-cta" <?php $block_object->the_block_attributes(); ?>>
		<?php load_styles( __DIR__, $name ); ?>
		<div class="hero-cta__wrapper">
			<div class="hero-cta__image-wrapper">
				<div class="hero-cta__background-image slide-fade-in">
					<?php echo wp_get_attachment_image( $hcta_background_image, 'full' ); ?>
				</div>
				<?php if ( ! empty( $hcta_small_image ) ) : ?>
				<div class="hero-cta__small-image slide-fade-in">
					<?php echo wp_get_attachment_image( $hcta_small_image, 'accent-image' ); ?>
				</div>
				<?php endif; ?>
			</div>
			<div class="hero-cta__content-wrapper">
				<?php if ( ! empty( $hcta_content ) ) : ?>
				<div class="hero-cta__content slide-fade-in">
					<p><?php echo wp_kses_post( $hcta_content ); ?></p>
				</div>
				<?php endif; ?>
				<div class="hero-cta__heading slide-fade-in">
					<h1><?php echo wp_kses_post( $hcta_heading ); ?></h1>
				</div>
				<?php if ( ! empty( $hcta_link ) ) : ?>
					<div class="button-wrapper slide-fade-in">
						<?php get_template_part( 'parts/components/button', null, array( 'button' => $hcta_link ) ); ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</section>
	<?php
endif;
