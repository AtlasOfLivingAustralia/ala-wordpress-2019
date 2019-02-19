<?php
/**
 * The right sidebar containing the main widget area.
 *
 * @package understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


// when both sidebars turned on reduce col size to 3 from 4.
$sidebar_pos = get_theme_mod( 'understrap_sidebar_position' );

//Get current page ID
$post = get_post();

?>

<div class="col-md-3 order-0 order-md-1 widget-area" id="right-sidebar" role="complementary">

		<aside class="sidebar-anchors">
			<div class="scrollable" data-sticky>
				<h3 class="widget-title">Jump to section...</h3>
				<div class="anchors list-group" id="anchorList">
				<?php //Check if any gutenberg blocks are on page
					if ( has_blocks( $post->post_content ) ) :
						$blocks = parse_blocks( $post->post_content );
						//Loop through all available blocks
						foreach ($blocks as $block) :
							if ($block['blockName'] == 'acf/content-anchor') :

								$title = reset($block['attrs']['data']);
								$name = str_replace(' ', '-', $title); ?>
					<a href="#<?= $name; ?>" title="<?= $title; ?>" class="list-group-item list-group-item-action"><span><?= $title; ?></span></a>
							<?php endif;
						endforeach;
					endif; ?>
				</div>
				<a href="#page" title="Back to Top" class="back"><i class="fas fa-arrow-to-top"></i> Back to Top</a>
			</div>
		</aside>

</div><!-- #right-sidebar -->
