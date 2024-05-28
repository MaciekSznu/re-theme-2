<?php
/**
 * The call to action block file.
 *
 * @package    WordPress
 * @subpackage re-theme
 * @since      re-theme 1.0
 */

// TODO: fix buttons
$block_object         = new Block( $block );
$name                 = $block_object->block_name();
$cta_content          = get_field( 'cta_content' );
$cta_button           = get_field( 'cta_button' );
$cta_button_position  = get_field( 'cta_button_position' );
$cta_width            = get_field( 'cta_width' );
$cta_background_color = get_field( 'cta_background_color' );

$block_class  = $cta_button_position ? 'acf-block cta cta--button-' . $cta_button_position . '' : 'acf-block cta cta--button-center';
$block_class .= $cta_width ? ' cta--full' : ' cta--container';

$block_background = ! empty( $cta_background_color ) ? ' style="background: ' . $cta_background_color . ';"' : '';

if ( ! empty( $cta_button ) && ! empty( $cta_content ) ) : ?>
	<section class="<?php echo esc_attr( $block_class ); ?>" <?php $block_object->the_block_attributes(); ?><?php echo $cta_width ? $block_background : ''; ?>>
		<?php load_styles( __DIR__, $name ); ?>
		<div class="container">
			<div class="cta__wrapper"<?php echo ! $cta_width ? $block_background : ''; ?>>
				<div class="cta__content-wrapper">
					<div class="cta__content slide-fade-in">
						<?php echo wp_kses_post( $cta_content ); ?>
					</div>
					<?php if ( ! empty( $cta_button ) ) : ?>
						<div class="button-wrapper slide-fade-in">
							<?php get_template_part( 'parts/components/button', null, array( 'button' => $cta_button ) ); ?>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</section>
	<?php
endif;

