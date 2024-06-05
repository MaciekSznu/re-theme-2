<?php
/**
 * The hero block file.
 *
 * @package    WordPress
 * @subpackage re-theme
 * @since      re-theme 1.0
 */
$block_object = new Block( $block );
$name         = $block_object->block_name();
$slider_hero  = get_field( 'slider_hero' );

if ( ! empty( $slider_hero ) ) : ?>
	<section class="acf-block hero" <?php $block_object->the_block_attributes(); ?>>
		<?php load_styles_components( 'sliders' ); ?>
		<?php load_styles_third( 'slick' ); ?>
		<?php load_styles( __DIR__, $name ); ?>
		<div class="hero__slider-wrapper">
		<?php
		foreach ( $slider_hero as $slide ) :
			$img     = $slide['img'];
			$content = $slide['content'];
			?>
			<div class="hero__slide">
				<figure class="hero__slide-image">
					<?php echo wp_get_attachment_image( $img, 'hero' ); ?>
				</figure>
				<div class="container">
					<div class="hero__slide-content">
						<div class="hero__slide-content-wrapper slide-fade-in">
							<?php echo wp_kses_post( $content ); ?>
						</div>
					</div>
				</div>
			</div>
		<?php endforeach; ?>
		</div>
		<div class='icon-scroll'></div>
	</section>
	<?php
endif;

