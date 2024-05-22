<?php
/**
 * The accordions block file.
 *
 * @package    WordPress
 * @subpackage re-theme
 * @since      re-theme 1.0
 */

$acc_title      = get_field( 'acc_title' );
$acc_accordions = get_field( 'acc_accordions' );

$custom_block_id = get_field( 'block_id' );

$block_id = ! empty( $custom_block_id ) ? ' id="' . $custom_block_id . '"' : '';

if ( ! empty( $acc_accordions ) ) : ?>
	<section class="acf-block accordions"<?php echo $block_id; ?>>
		<?php load_styles( __DIR__, $name ); ?>
		<?php $block_object->pick_block_padding_margin(); ?>
		<div class="container">
			<?php if ( ! empty( $acc_title ) ) : ?>
			<div class="accordions__title">
				<h2><?php echo wp_kses_post( $acc_title ); ?></h2>
			</div>
			<?php endif; ?>
			<div class="accordions__wrapper">
			<?php
			foreach ( $acc_accordions as $item ) :
				$title        = $item['title'];
				$item_content = $item['content'];
				$item_active  = $item['active'];
				?>
				<div class="accordion<?php echo $item_active ? ' active' : ''; ?>">
					<div class="accordion__trigger">
						<h4><?php echo esc_html( $title ); ?></h4>
						<div class="accordion__trigger-icon">
							<span></span>
							<span></span>
						</div>
					</div>
					<div class="accordion__content-wrapper">
						<div class="accordion__content">
							<div>
								<?php echo wp_kses_post( $item_content ); ?>
							</div>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
			</div>
		</div>
	</section>
	<?php
endif;

