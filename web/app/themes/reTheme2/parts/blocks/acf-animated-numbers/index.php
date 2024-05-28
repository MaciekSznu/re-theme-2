<?php
/**
 * The animated numbers block file.
 *
 * @package    WordPress
 * @subpackage re-theme
 * @since      re-theme 1.0
 */
$block_object = new Block( $block );
$name         = $block_object->block_name();
$an_title     = get_field( 'an_title' );
$an_numbers   = get_field( 'an_numbers' );

if ( ! empty( $an_numbers ) ) : ?>
	<section class="acf-block animated-numbers" <?php $block_object->the_block_attributes(); ?>>
		<?php load_styles( __DIR__, $name ); ?>
		<?php $block_object->pick_block_padding_margin(); ?>
		<?php get_template_part( 'parts/components/decorator' ); ?>
		<?php get_template_part( 'parts/components/decorator' ); ?>
		<div class="container">
			<div class="animated-numbers__wrapper">
				<?php if ( ! empty( $an_title ) ) : ?>
				<div class="animated-numbers__title slide-fade-in">
					<h2><?php echo wp_kses_post( $an_title ); ?></h2>
				</div>
				<?php endif; ?>
				<div class="animated-numbers__numbers-wrapper">
				<?php
				foreach ( $an_numbers as $item ) :
					$item_title = $item['title'];
					$item_value = $item['value'];
					?>
					<div class="animated-numbers__item">
						<p class="animated-numbers__item-value"><?php echo esc_html( $item_value ); ?></p>
						<p class="animated-numbers__item-title slide-fade-in"><?php echo esc_html( $item_title ); ?></p>
					</div>
				<?php endforeach; ?>
				</div>
			</div>
		</div>
	</section>
	<?php
endif;

