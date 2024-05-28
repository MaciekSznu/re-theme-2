<?php
/**
 * The content icons list block file.
 *
 * @package    WordPress
 * @subpackage re-theme
 * @since      re-theme 1.0
 */
$block_object       = new Block( $block );
$name               = $block_object->block_name();
$cil_content        = get_field( 'cil_content' );
$cil_icons          = get_field( 'cil_icons' );
$cil_decorator      = get_field( 'cil_decorator' );
$cil_icons_position = get_field( 'cil_icons_position' );
$cil_icons_style    = get_field( 'cil_icons_style' );

$block_class  = 'acf-block content-icons-list';
$block_class .= $cil_icons_position ? ' content-icons-list--icons-' . $cil_icons_position . '' : '';
$block_class .= $cil_icons_style ? ' content-icons-list--' . $cil_icons_style . '' : '';

if ( ! empty( $cil_content ) ) : ?>
	<section class="<?php echo esc_attr( $block_class ); ?>" <?php $block_object->the_block_attributes(); ?>>
		<?php load_styles( __DIR__, $name ); ?>
		<?php
		if ( $cil_decorator ) {
			get_template_part( 'parts/components/decorator' );}
		?>
		<div class="container">
			<div class="content-icons-list__wrapper">
				<div class="content-icons-list__content-wrapper">
					<div class="content-icons-list__content slide-fade-in">
						<?php echo wp_kses_post( $cil_content ); ?>
					</div>
				</div>
				<?php
				if ( ! empty( $cil_icons ) ) :
					$items_count = count( $cil_icons );
					?>
				<div class="content-icons-list__list-wrapper" data-items="<?php echo esc_attr( $items_count ); ?>">
					<?php
					foreach ( $cil_icons as $item ) :
						$icon = $item['icon'];
						$text = $item['text'];
						?>
					<div class="content-icons-list__list-item slide-fade-in">
						<div class="content-icons-list__list-item-text">
							<p><?php echo esc_html( $text ); ?></p>
						</div>
						<div class="content-icons-list__list-item-icon style-svg">
							<?php echo wp_get_attachment_image( $icon, 'content-image' ); ?>
						</div>
					</div>
					<?php endforeach; ?>
				</div>
				<?php endif; ?>
			</div>
		</div>
	</section>
	<?php
endif;

