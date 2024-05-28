<?php
/**
 * The content image form block file.
 *
 * @package    WordPress
 * @subpackage re-theme
 * @since      re-theme 1.0
 */
// TODO: add slide classes & scripts, add form styles
$block_object       = new Block( $block );
$name               = $block_object->block_name();
$cif_img            = get_field( 'cif_img' );
$cif_heading        = get_field( 'cif_heading' );
$cif_text           = get_field( 'cif_text' );
$cif_form_shortcode = get_field( 'cif_form_shortcode' );
$cif_form_position  = get_field( 'cif_form_position' );

$block_class = $cif_form_position ? 'acf-block content-image-form content-image-form--form-left' : 'acf-block content-image-form content-image-form--form-right';

if ( ! empty( $cif_form_shortcode ) ) : ?>
	<section class="<?php echo esc_attr( $block_class ); ?>" <?php $block_object->the_block_attributes(); ?>>
		<?php load_styles( __DIR__, $name ); ?>
		<div class="container">
			<div class="content-image-form__wrapper">
				<div class="content-image-form__form-wrapper slide-fade-in">
					<div class="content-image-form__form re-form__wrapper">
						<?php echo do_shortcode( $cif_form_shortcode ); ?>
					</div>
				</div>
				<div class="content-image-form__content-wrapper">
					<div class="content-image-form__content slide-fade-in">
						<?php if ( ! empty( $cif_heading ) ) : ?>
							<h2 class="content-image-form__heading h1"><?php echo wp_kses_post( $cif_heading ); ?></h2>
						<?php endif; ?>
						<?php if ( ! empty( $cif_text ) ) : ?>
							<p class="content-image-form__text"><?php echo wp_kses_post( $cif_text ); ?></p>
						<?php endif; ?>
					</div>
					<div class="content-image-form__image-wrapper slide-fade-in">
						<?php if ( ! empty( $cif_img ) ) : ?>
							<div class="content-image-form__image">
								<?php echo wp_get_attachment_image( $cif_img, 'accent-image' ); ?>
							</div>
						<?php endif; ?>
					</div>
					<div class="content-image-form__color-wrapper slide-fade-in"></div>
				</div>
			</div>
		</div>
	</section>
	<?php
endif;

