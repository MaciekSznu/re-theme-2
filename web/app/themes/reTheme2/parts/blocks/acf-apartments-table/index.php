<?php
/**
 * The apartments table block file.
 *
 * @package    WordPress
 * @subpackage re-theme
 * @since      re-theme 1.0
 */

$at_content        = get_field( 'at_content' );
$at_table          = get_field( 'at_table' );
$at_table_headings = get_field( 'at_table_headings' );
$at_table_options  = get_field( 'at_table_options' );
$at_decorator      = get_field( 'at_decorator' );
$at_icons_position = get_field( 'at_icons_position' );
$at_icons_style    = get_field( 'at_icons_style' );
$custom_block_id   = get_field( 'block_id' );

$block_class = 'acf-block apartments-table';

$block_id = ! empty( $custom_block_id ) ? ' id="' . $custom_block_id . '"' : '';

if ( ! empty( $at_content ) ) : ?>
	<section class="<?php echo esc_attr( $block_class ); ?>"<?php echo $block_id; ?>>
		<?php load_styles( __DIR__, $name ); ?>
		<?php $block_object->pick_block_padding_margin(); ?>
		<?php
		if ( $at_decorator ) {
			get_template_part( 'parts/components/decorator' );}
		?>
		<div class="container">
			<div class="apartments-table__wrapper">
				<div class="apartments-table__content-wrapper">
					<div class="apartments-table__content slide-fade-in">
						<?php echo wp_kses_post( $at_content ); ?>
					</div>
				</div>
				<?php if ( ! empty( $at_table ) && ! empty( $at_table_headings ) ) : ?>
				<div class="apartments-table__table-wrapper slide-fade-in">
					<div class="apartments-table__table-heading">
					<?php
					foreach ( $at_table_headings[0] as $item => $value ) :
						if ( $value ) :
							?>
							<div class="apartments-table__table-heading-item">
								<span><?php echo esc_html__( $value ); ?></span>
							</div>
							<?php
						endif;
					endforeach;
					?>
					</div>
					<?php
					foreach ( $at_table as $row ) :
						?>
						<div class="apartments-table__table-row" 
							data-area="<?php echo sanitize_table_data( $row['area'] ); ?>"
							data-price="<?php echo sanitize_table_data( $row['price'] ); ?>"
							data-status="<?php echo strtolower( $row['status'] ); ?>">
						<?php
						foreach ( $row as $item => $value ) :
							if ( $value ) :
								?>
								<div class="apartments-table__table-row-item">
									<?php if ( $item == 'card' ) : ?>
										<a href="<?php echo esc_url( $value ); ?>" title="Karta mieszkania">Karta</a>
									<?php elseif ( $item == 'price' ) : ?>
										<span class="price"><?php echo esc_html__( $value ); ?> zł</span>
									<?php elseif ( $item == 'area' || $item == 'plot_area' ) : ?>
										<span class="area"><?php echo esc_html__( $value ); ?> m<sup>2</sup></span>
									<?php else : ?>
										<span><?php echo esc_html__( $value ); ?></span>
									<?php endif; ?>
								</div>
								<?php
							endif;
						endforeach;
						?>
						</div>
					<?php endforeach; ?>
				</div>
				<?php endif; ?>
			</div>
		</div>
	</section>
	<?php
endif;

