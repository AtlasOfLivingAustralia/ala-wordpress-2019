<?php $currentPost = get_the_ID(); ?>
	<h3 class="widget-title">Latest Posts</h3>
	<div class="post-list">
		<?php
		$args = array(
			'posts_per_page' => '3',
			'post__not_in' => [$currentPost]
		);
		$recents = new WP_Query( $args );
		if ( $recents->have_posts() ) :
		while ( $recents->have_posts() ) :
			$recents->the_post();
			?>
			<article class="recent-post" id="post-<?= get_the_ID(); ?>">
				<a href="<?= get_the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>">
					<header class="recent-header">
						<?php if ( 'post' == get_post_type() ) : ?>
							<div class="recent-meta">
								<?php pvtl_posted_on(); ?>
							</div><!-- .entry-meta -->
						<?php endif; ?>
						<h2 class="recent-title">
							<?php the_title(); ?>
						</h2>
					</header><!-- .entry-header -->
					<div class="recent-content">
						<?= pvtl_get_excerpt(150); ?>
					</div><!-- .entry-content -->
				</a>
			</article><!-- #post-## -->
		<?php endwhile;
		wp_reset_query(); wp_reset_postdata();
		endif;
		?>
	</div>
