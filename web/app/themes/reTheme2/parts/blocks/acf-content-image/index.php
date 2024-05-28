<?php
/**
 * The content image block file.
 *
 * @package    WordPress
 * @subpackage re-theme
 * @since      re-theme 1.0
 */
$block_object    = new Block( $block );
$name            = $block_object->block_name();
$ci_img          = get_field( 'ci_img' );
$ci_content      = get_field( 'ci_content' );
$ci_button       = get_field( 'ci_button' );
$ci_img_position = get_field( 'ci_img_position' );
$ci_width        = get_field( 'ci_width' );

$block_class = $ci_img_position ? 'acf-block content-image content-image--image-left' : 'acf-block content-image content-image--image-right';

if ( ! empty( $ci_img ) && ! empty( $ci_content ) ) : ?>
	<section class="<?php echo esc_attr( $block_class ); ?>" <?php $block_object->the_block_attributes(); ?>>
		<?php load_styles( __DIR__, $name ); ?>
		<?php if ( ! $ci_width ) : ?>
		<div class="container">
		<?php endif; ?>
			<div class="content-image__wrapper">
				<div class="content-image__image-wrapper slide-fade-in">
					<figure class="content-image__image">
						<?php echo wp_get_attachment_image( $ci_img, 'content-image' ); ?>
					</figure>
				</div>
				<div class="content-image__content-wrapper">
					<div class="content-image__content slide-fade-in">
						<?php echo wp_kses_post( $ci_content ); ?>
						<?php if ( ! empty( $ci_button ) ) : ?>
							<div class="button-wrapper slide-fade-in">
								<?php get_template_part( 'parts/components/button', null, array( 'button' => $ci_button ) ); ?>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		<?php if ( ! $ci_width ) : ?>
		</div>
		<?php endif; ?>
	</section>
	<?php
endif;

