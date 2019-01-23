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
?>

<div class="col-md-3 widget-area" id="right-sidebar" role="complementary">

		<aside class="sidebar-anchors">
			<h3 class="widget-title">Jump to section...</h3>
			<ul class="anchors">
				<li><a href="#" title="Page section Title 1"><span>Page Section Title</span></a></li>
				<li><a href="#" title="Page section Title 1"><span>Page Section Title</span></a></li>
				<li><a href="#" title="Page section Title 1"><span>Page Section Title</span></a></li>
				<li><a href="#" title="Page section Title 1"><span>Page Section Title</span></a></li>
				<li><a href="#" title="Page section Title 1"><span>Page Section Title</span></a></li>
			</ul>
			<a href="#top" title="Back to Top" class="back"><i class="fas fa-arrow-to-top"></i> Back to Top</a>
		</aside>

</div><!-- #right-sidebar -->
