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

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<header class="entry-header">

		<div class="entry-meta">

			<?php pvtl_posted_on(); ?>

		</div><!-- .entry-meta -->

	</header><!-- .entry-header -->

	<?php /* echo get_the_post_thumbnail( $post->ID, 'large' ); */
	?>

	<?php echo display_excerpt_single_post(); ?>

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
			<a href="<?= $postLink; ?>" class="btn btn-outline-dark btn-lg"><i class="fal fa-lg fa-angle-left"></i> Back to Articles</a>
		</div>
	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
