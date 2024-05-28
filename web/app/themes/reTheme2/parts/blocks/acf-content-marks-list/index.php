<?php
/**
 * The content marks list block file.
 *
 * @package    WordPress
 * @subpackage re-theme
 * @since      re-theme 1.0
 */
// TODO: fix icon image to icon picker
$block_object         = new Block( $block );
$name                 = $block_object->block_name();
$cml_content          = get_field( 'cml_content' );
$cml_list             = get_field( 'cml_list' );
$cml_list_position    = get_field( 'cml_list_position' );
$cml_background_color = get_field( 'cml_background_color' );
$cml_icon             = get_field( 'cml_icon' );

$block_class      = $cml_list_position ? 'acf-block cml cml--list-' . $cml_list_position . '' : 'acf-block cml cml--list-center';
$block_background = ! empty( $cml_background_color ) ? ' style="background: ' . $cml_background_color . ';"' : '';

if ( ! empty( $cml_list ) && ! empty( $cml_content ) ) : ?>
	<section class="<?php echo esc_attr( $block_class ); ?>" <?php $block_object->the_block_attributes(); ?><?php echo $block_background; ?>>
		<?php load_styles( __DIR__, $name ); ?>
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

