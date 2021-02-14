<?php
/**
 * Post rendering content according to caller of get_template_part.
 *
 * @package understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<a href="<?= get_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>">

	<?php if (has_post_thumbnail( $post->ID ) ): ?>
    <?php   echo get_the_post_thumbnail( $post->ID, 'post' ); ?>
	<?php else: ?>
		<img src="/app/themes/pvtl/images/ALA-post-default.png" class="attachment-post size-post wp-post-image" alt="" loading="lazy" />
	<?php endif; ?>

	<div class="post-splayed">

		<header class="entry-header">

			<?php
			the_title('<h2 class="entry-title">','</h2>' );
			?>

		</header><!-- .entry-header -->

		<div class="entry-content">

			<?php if ( 'post' == get_post_type() ) : ?>

			<div class="entry-meta">
				<?php pvtl_posted_on(); ?>
			</div>

			<?php endif; ?>

			<?php echo pvtl_get_excerpt(150); ?>

		</div><!-- .entry-content -->

	</div><!-- .overlay -->

	</a>

</article><!-- #post-## -->
