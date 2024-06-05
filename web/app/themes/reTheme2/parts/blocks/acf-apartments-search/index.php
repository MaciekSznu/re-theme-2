<?php
/**
 * The apartments search block file.
 *
 * @package    WordPress
 * @subpackage re-theme
 * @since      re-theme 1.0
 */
$block_object     = new Block( $block );
$name             = $block_object->block_name();
$as_content       = get_field( 'as_content' );
$as_visualization = get_field( 'as_visualization' );
$as_apartments    = get_field( 'as_apartments' );
$as_decorator     = get_field( 'as_decorator' );

if ( ! empty( $as_visualization ) && ! empty( $as_apartments ) ) : ?>
	<section class="acf-block apartments-search" <?php $block_object->the_block_attributes(); ?>>
		<?php load_styles( __DIR__, $name ); ?>
		<?php $block_object->pick_block_padding_margin(); ?>
		<!-- TODO: add decorator? or remove from the fields -->
		<div class="container">
			<?php if ( ! empty( $as_content ) ) : ?>
			<div class="apartments-search__content-wrapper">
				<?php echo wp_kses_post( $as_content ); ?>
			</div>
			<?php endif; ?>
			<div class="apartments-search__visualization-wrapper">
				<figure class="apartments-search__visualization">
					<?php echo wp_get_attachment_image( $as_visualization, 'container-image' ); ?>
				</figure>
				<div class="apartments-search__dots-wrapper">
					<?php
					foreach ( $as_apartments as $dot ) :
						$dot_x            = $dot['as_coord_x'];
						$dot_y            = $dot['as_coord_y'];
						$dot_apartment_id = $dot['as_apartment'][0];
						$ap_status        = get_field( 'ap_status', $dot_apartment_id );
						$ap_number        = get_field( 'ap_number', $dot_apartment_id );
						$ap_floor_number  = get_field( 'ap_floor_number', $dot_apartment_id );
						$ap_rooms_number  = get_field( 'ap_rooms_number', $dot_apartment_id );
						$ap_baths_number  = get_field( 'ap_baths_number', $dot_apartment_id );
						$ap_area          = get_field( 'ap_area', $dot_apartment_id );
						$ap_price         = get_field( 'ap_price', $dot_apartment_id );
						$color;
						$status_string;
						switch ( $ap_status ) {
							case 1:
								$color         = '#ffc100';
								$status_string = 'zarezerwowany';
								break;
							case 2:
								$color         = '#ff0000';
								$status_string = 'sprzedany';
								break;
							default:
								$color         = '#b5e550';
								$status_string = 'dostępny';
						}
						if ( isset( $dot_x ) && isset( $dot_y ) ) {
							$coords = "top: $dot_y%; left: $dot_x%; color: $color;"
							?>
						<div class="apartments-search__dot"
							style="<?php echo $coords; ?>"
							data-ap-status="<?php echo esc_attr( $status_string ); ?>"
							data-ap-number="<?php echo esc_attr( $ap_number ); ?>"
							data-ap-floor-number="<?php echo esc_attr( $ap_floor_number ); ?>"
							data-ap-rooms-number="<?php echo esc_attr( $ap_rooms_number ); ?>"
							data-ap-baths-number="<?php echo esc_attr( $ap_baths_number ); ?>"
							data-ap-area="<?php echo esc_attr( $ap_area ); ?>"
							data-ap-price="<?php echo esc_attr( $ap_price ); ?>"
						></div>
							<?php
						}
						endforeach;
					?>
				</div>
				<div class="apartments-search__modal">
					<div class="apartments-search__modal-row">
						<p class="apartments-search__modal-col">Status</p>
						<p class="apartments-search__modal-col" data-ap-status=""></p>
					</div>
					<div class="apartments-search__modal-row">
						<p class="apartments-search__modal-col">Numer</p>
						<p class="apartments-search__modal-col" data-ap-number=""></p>
					</div>
					<div class="apartments-search__modal-row">
						<p class="apartments-search__modal-col">Piętro</p>
						<p class="apartments-search__modal-col" data-ap-floor-number=""></p>
					</div>
					<div class="apartments-search__modal-row">
						<p class="apartments-search__modal-col">Pokoje</p>
						<p class="apartments-search__modal-col" data-ap-rooms-number=""></p>
					</div>
					<div class="apartments-search__modal-row">
						<p class="apartments-search__modal-col">Łazienki</p>
						<p class="apartments-search__modal-col" data-ap-baths-number=""></p>
					</div>
					<div class="apartments-search__modal-row">
						<p class="apartments-search__modal-col">Powierzchnia</p>
						<p class="apartments-search__modal-col"><span data-ap-area=""></span> m<sup>2</sup></p>
					</div>
					<div class="apartments-search__modal-row">
						<p class="apartments-search__modal-col">Cena</p>
						<p class="apartments-search__modal-col"><span data-ap-price=""></span> zł</p>
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php
endif;
