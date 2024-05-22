<?php
/**
 * The background content block file.
 *
 * @package    WordPress
 * @subpackage re-theme
 * @since      re-theme 1.0
 */

$bc_content          = get_field( 'bc_content' );
$bc_background       = get_field( 'bc_background' );
$bc_background_color = get_field( 'bc_background_color' );
$bc_background_image = get_field( 'bc_background_image' );
$bc_text_position    = get_field( 'bc_text_position' );
$bc_text_color       = get_field( 'bc_text_color' );
$custom_block_id     = get_field( 'block_id' );

// $bc_decorator      = get_field( 'bc_decorator' );

$block_class      = 'acf-block background-content';
$block_class     .= $bc_text_position ? ' background-content--text-' . $bc_text_position . '' : '';
$block_class     .= $bc_text_color ? ' background-content--text-' . $bc_text_color . '' : '';
$block_background = ! $bc_background && ! empty( $bc_background_color ) ? ' style="background: ' . $bc_background_color . ';"' : '';

$block_id = ! empty( $custom_block_id ) ? ' id="' . $custom_block_id . '"' : '';

if ( ! empty( $bc_content ) ) : ?>
	<section class="<?php echo esc_attr( $block_class ); ?>"<?php echo $block_id; ?><?php echo $block_background; ?>>
		<?php load_styles( __DIR__, $name ); ?>
		<?php $block_object->pick_block_padding_margin(); ?>
		<?php get_template_part( 'parts/components/decorator' ); ?>
		<?php get_template_part( 'parts/components/decorator' ); ?>
		<?php if ( ! empty( $bc_background_image ) ) : ?>
			<div class="background-content__image slide-opacity">
				<?php echo wp_get_attachment_image( $bc_background_image, 'hero' ); ?>
			</div>
		<?php endif; ?>
		<div class="container">
			<div class="background-content__wrapper">
				<div class="background-content__content-wrapper">
					<div class="background-content__content slide-fade-in">
						<?php echo wp_kses_post( $bc_content ); ?>
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php
endif;

