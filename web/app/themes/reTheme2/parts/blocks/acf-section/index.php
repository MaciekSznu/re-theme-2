<?php
/**
 * Block with section for inner blocks
 *
 * @package WordPress
 * @subpackage reTheme2
 * @since reTheme2 1.0
 */

$block_object = new Block( $block );
?>
<section class="block-acf section section-wrapper" <?php $block_object->the_block_attributes(); ?>>
	<?php $block_object->pick_block_padding_margin(); ?>
	<InnerBlocks />
</section>
