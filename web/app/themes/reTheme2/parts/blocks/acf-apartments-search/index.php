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

$args = array(
	'post_type'   => 'apartment',
	'numberposts' => -1,
	'meta_key'    => 'ap_number',
	'orderby'     => 'meta_value_num',
	'order'       => 'ASC',

);
$all_apartments = get_posts( $args );
// echo '<pre>';
// print_r( $all_apartments );
// echo '</pre>';

$floors   = array();
$rooms    = array();
$areas    = array();
$prices   = array();
$statuses = array();

foreach ( $all_apartments as $apartment ) {
	$apartment_id = $apartment->ID;
	$ap_floors    = get_field( 'ap_floor_number', $apartment_id );
	if ( ! in_array( $ap_floors, $floors ) ) {
		$floors[] = $ap_floors;
	}
	$ap_rooms = get_field( 'ap_rooms_number', $apartment_id );
	if ( ! in_array( $ap_rooms, $rooms ) ) {
		$rooms[] = $ap_rooms;
	}
	$ap_area = get_field( 'ap_area', $apartment_id );
	if ( ! in_array( $ap_area, $areas ) ) {
		$areas[] = $ap_area;
	}
	$ap_price = get_field( 'ap_price', $apartment_id );
	if ( ! in_array( $ap_price, $prices ) ) {
		$prices[] = $ap_price;
	}
	$ap_status = get_field( 'ap_status', $apartment_id );
	if ( ! in_array( $ap_status, $statuses ) ) {
		$statuses[] = $ap_status;
	}
}

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
				<div class="apartments-search__visualization">
					<?php echo wp_get_attachment_image( $as_visualization, 'container-image' ); ?>
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
							$ap_url           = get_permalink( $dot_apartment_id );
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
								data-ap-url="<?php echo esc_attr( $ap_url ); ?>"
							></div>
								<?php
							}
							endforeach;
						?>
					</div>
				</div>
				<div class="apartments-search__modal">
					<div class="apartments-search__modal-row">
						<p class="apartments-search__modal-col">Status</p>
						<p class="apartments-search__modal-col" data-ap-status="">&nbsp;</p>
					</div>
					<div class="apartments-search__modal-row">
						<p class="apartments-search__modal-col">Numer</p>
						<p class="apartments-search__modal-col" data-ap-number="">&nbsp;</p>
					</div>
					<div class="apartments-search__modal-row">
						<p class="apartments-search__modal-col">Piętro</p>
						<p class="apartments-search__modal-col" data-ap-floor-number="">&nbsp;</p>
					</div>
					<div class="apartments-search__modal-row">
						<p class="apartments-search__modal-col">Pokoje</p>
						<p class="apartments-search__modal-col" data-ap-rooms-number="">&nbsp;</p>
					</div>
					<div class="apartments-search__modal-row">
						<p class="apartments-search__modal-col">Łazienki</p>
						<p class="apartments-search__modal-col" data-ap-baths-number="">&nbsp;</p>
					</div>
					<div class="apartments-search__modal-row">
						<p class="apartments-search__modal-col">Powierzchnia</p>
						<p class="apartments-search__modal-col"><span data-ap-area=""></span><span> m<sup>2</sup></span></p>
					</div>
					<div class="apartments-search__modal-row price">
						<p class="apartments-search__modal-col">Cena</p>
						<p class="apartments-search__modal-col"><span data-ap-price=""></span><span> zł</span></p>
					</div>
					<div class="apartments-search__modal-row link">
						<a class="apartments-search__modal-col link" data-ap-url="" href=""><span>Zobacz apartament</span></a>
					</div>
				</div>
			</div>
			<div class="apartments-search__table-wrapper">
				<div class="apartments-search__table-filters">
					<?php if ( isset( $rooms ) ) : ?>
						<div class="filter">
							<h5 class="filter__heading">Pokoje</h5>
							<div class="filter__buttons">
							<?php foreach ( $rooms as $room ) : ?>
								<button type="button" class="filter-button" data-ap-rooms-number="<?php echo esc_attr( $room ); ?>"><?php echo esc_html( $room ); ?></button>
							<?php endforeach; ?>
							</div>
						</div>
					<?php endif; ?>
					<?php if ( isset( $floors ) ) : ?>
						<div class="filter">
							<h5 class="filter__heading">Piętro</h5>
							<div class="filter__buttons">
							<?php foreach ( $floors as $floor ) : ?>
								<button type="button" class="filter-button" data-ap-floor-number="<?php echo esc_attr( $floor ); ?>"><?php echo esc_html( $floor ); ?></button>
							<?php endforeach; ?>
							</div>
						</div>
					<?php endif; ?>
					<?php if ( isset( $statuses ) ) : ?>
						<div class="filter">
							<h5 class="filter__heading">Status</h5>
							<div class="filter__buttons">
							<?php foreach ( $statuses as $status ) : ?>
								<button type="button" class="filter-button" data-ap-status="<?php echo esc_attr( $status ); ?>"><?php echo esc_html( $status ); ?></button>
							<?php endforeach; ?>
							</div>
						</div>
					<?php endif; ?>
					<?php if ( isset( $areas ) ) : ?>
						<div class="filter">
							<h5 class="filter__heading">Powierzchnia</h5>
							<div class="filter__buttons">
								<button type="button" class="filter-button" data-ap-area=""><?php echo esc_html( min($areas) ); ?></button>
								<button type="button" class="filter-button" data-ap-area=""><?php echo esc_html( max($areas) ); ?></button>
							</div>
						</div>
					<?php endif; ?>
					<?php if ( isset( $prices ) ) : ?>
						<div class="filter">
							<h5 class="filter__heading">Cena</h5>
							<div class="filter__buttons">
								<button type="button" class="filter-button" data-ap-price=""><?php echo esc_html( min($prices) ); ?></button>
								<button type="button" class="filter-button" data-ap-price=""><?php echo esc_html( max($prices) ); ?></button>
							</div>
						</div>
					<?php endif; ?>
				</div>
				<div class="apartments-search__table-header">
					<div class="apartments-search__table-col">Numer</div>
					<div class="apartments-search__table-col">Piętro</div>
					<div class="apartments-search__table-col">Pokoje</div>
					<div class="apartments-search__table-col">Łazienki</div>
					<div class="apartments-search__table-col">Powierzchnia</div>
					<div class="apartments-search__table-col">Cena</div>
					<div class="apartments-search__table-col">Status</div>
					<div class="apartments-search__table-col">Szczegóły</div>
				</div>
						<?php
						foreach ( $all_apartments as $row ) :
							$row_apartment_id = $row->ID;
							$ap_status        = get_field( 'ap_status', $row_apartment_id );
							$ap_number        = get_field( 'ap_number', $row_apartment_id );
							$ap_floor_number  = get_field( 'ap_floor_number', $row_apartment_id );
							$ap_rooms_number  = get_field( 'ap_rooms_number', $row_apartment_id );
							$ap_baths_number  = get_field( 'ap_baths_number', $row_apartment_id );
							$ap_area          = get_field( 'ap_area', $row_apartment_id );
							$ap_price         = get_field( 'ap_price', $row_apartment_id );
							$ap_url           = get_permalink( $row_apartment_id );
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
							$style = "color: $color;"
							?>
					<div class="apartments-search__table-row"
						data-ap-number="<?php echo esc_attr( $ap_number ); ?>"
						data-ap-floor-number="<?php echo esc_attr( $ap_floor_number ); ?>"
						data-ap-rooms-number="<?php echo esc_attr( $ap_rooms_number ); ?>"
						data-ap-baths-number="<?php echo esc_attr( $ap_baths_number ); ?>"
						data-ap-area="<?php echo esc_attr( $ap_area ); ?>"
						data-ap-price="<?php echo esc_attr( $ap_price ); ?>"
						data-ap-status="<?php echo esc_attr( $ap_status ); ?>"
					>
						<div class="apartments-search__table-cols-wrapper">
							<div class="apartments-search__table-col"><?php echo esc_attr( $ap_number ); ?></div>
							<div class="apartments-search__table-col"><?php echo esc_attr( $ap_floor_number ); ?></div>
							<div class="apartments-search__table-col"><?php echo esc_attr( $ap_rooms_number ); ?></div>
							<div class="apartments-search__table-col"><?php echo esc_attr( $ap_baths_number ); ?></div>
							<div class="apartments-search__table-col"><?php echo esc_attr( $ap_area ); ?> m<sup>2</sup></div>
							<div class="apartments-search__table-col"><?php echo esc_attr( $ap_price ); ?> zł</div>
							<div class="apartments-search__table-col" style="<?php echo $style; ?>"><?php echo esc_attr( $status_string ); ?></div>
							<div class="apartments-search__table-col"><a href="<?php echo esc_url( $ap_url ); ?>">Zobacz</a></div>
						</div>
					</div>
							<?php
				endforeach;
						?>
			</div>
		</div>
	</section>
						<?php
endif;
