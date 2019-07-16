<?php
/**
 * Single post partial template.
 *
 * @package understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$postType = get_post_type();
$postLink = get_post_type_archive_link($postType);
?>

<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5c46ac35a988136c"></script>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<header class="entry-header">

		<div class="entry-meta">

			<?php pvtl_posted_on(); ?>

		</div><!-- .entry-meta -->

		<div class="addthis_inline_share_toolbox"></div>

	</header><!-- .entry-header -->

	<?php /* echo get_the_post_thumbnail( $post->ID, 'large' ); */
	?>

	<div class="entry-content">

		<?php the_content(); ?>

		<?php
		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'understrap' ),
				'after'  => '</div>',
			)
		);
		?>

	</div><!-- .entry-content -->

	<footer class="entry-footer">

		<?php
		wp_link_pages(
			array(
				'before' => '<nav id="page-nav"><p>' . __( 'Pages:', 'foundationpress' ),
				'after'  => '</p></nav>',
			)
		);
		?>
		<?php $tag = get_the_tags(); if ( $tag ) { ?><div class="tags"><?php the_tags(); ?></div><?php } ?>

		<div class="post-footer">
			<div class="addthis_inline_share_toolbox"></div>
			<a href="<?= $postLink; ?>" class="btn btn-outline-dark btn-lg"><i class="fal fa-lg fa-angle-left"></i> Back to Articles</a>
		</div>
	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
