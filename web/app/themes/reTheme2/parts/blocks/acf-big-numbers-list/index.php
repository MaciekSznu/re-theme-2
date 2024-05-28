<?php
/**
 * The big numbers list block file.
 *
 * @package    WordPress
 * @subpackage re-theme
 * @since      re-theme 1.0
 */
$block_object = new Block( $block );
$name         = $block_object->block_name();
$bnl_title    = get_field( 'bnl_title' );
$bnl_numbers  = get_field( 'bnl_numbers' );

if ( ! empty( $bnl_numbers ) ) : ?>
	<section class="acf-block big-numbers-list" <?php $block_object->the_block_attributes(); ?>>
		<?php load_styles( __DIR__, $name ); ?>
		<?php get_template_part( 'parts/components/decorator' ); ?>
		<?php get_template_part( 'parts/components/decorator' ); ?>
		<div class="container">
			<div class="big-numbers-list__wrapper">
				<?php if ( ! empty( $bnl_title ) ) : ?>
				<div class="big-numbers-list__title slide-fade-in">
					<h2><?php echo wp_kses_post( $bnl_title ); ?></h2>
				</div>
				<?php endif; ?>
				<div class="big-numbers-list__numbers-wrapper">
				<?php
				foreach ( $bnl_numbers as $key => $item ) :
					$item_title = $item['title'];
					?>
					<div class="big-numbers-list__item slide-fade-in">
						<p class="big-numbers-list__item-value"><?php echo esc_html( $key + 1 ); ?>.</p>
						<p class="big-numbers-list__item-title"><?php echo esc_html( $item_title ); ?></p>
					</div>
				<?php endforeach; ?>
				</div>
			</div>
		</div>
	</section>
	<?php
endif;

