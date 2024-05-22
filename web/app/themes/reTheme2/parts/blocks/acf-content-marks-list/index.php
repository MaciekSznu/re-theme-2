<?php
/**
 * The content marks list block file.
 *
 * @package    WordPress
 * @subpackage re-theme
 * @since      re-theme 1.0
 */

$cml_content          = get_field( 'cml_content' );
$cml_list             = get_field( 'cml_list' );
$cml_list_position    = get_field( 'cml_list_position' );
$cml_background_color = get_field( 'cml_background_color' );
$cml_icon             = get_field( 'cml_icon' );

$custom_block_id = get_field( 'block_id' );

$block_class      = $cml_list_position ? 'acf-block cml cml--list-' . $cml_list_position . '' : 'acf-block cml cml--list-center';
$block_background = ! empty( $cml_background_color ) ? ' style="background: ' . $cml_background_color . ';"' : '';

$block_id = ! empty( $custom_block_id ) ? ' id="' . $custom_block_id . '"' : '';

if ( ! empty( $cml_list ) && ! empty( $cml_content ) ) : ?>
	<section class="<?php echo esc_attr( $block_class ); ?>"<?php echo $block_id; ?><?php echo $block_background; ?>>
		<?php echo set_custom_block_styles( 'cml' ); ?>
		<div class="container">
			<div class="cml__wrapper">
				<div class="cml__content slide-fade-in">
					<?php echo wp_kses_post( $cml_content ); ?>
				</div>
				<div class="cml__list-wrapper slide-fade-in">
				<?php foreach ( $cml_list as $item ) : ?>
					<div class="cml__list-item">
						<?php if ( ! empty( $cml_icon ) ) : ?>
							<div class="cml__list-item-icon style-svg">
								<?php echo wp_get_attachment_image( $cml_icon, 'icon' ); ?>
							</div>
						<?php endif; ?>
						<p class="cml__list-item-content">
							<?php echo esc_html( $item['item'] ); ?>
						</p>
					</div>
				<?php endforeach; ?>
				</div>
			</div>
		</div>
	</section>
	<?php
endif;

