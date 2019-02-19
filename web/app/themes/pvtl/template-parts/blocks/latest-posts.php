<?php
namespace App\Themes\Pvtl\Blocks;

use App\Themes\Pvtl\Library\RegisterBlocks;

class LatestPosts extends RegisterBlocks
{
    protected $title = 'Latest Blog Posts';
    protected $icon = 'welcome-write-blog'; // https://developer.wordpress.org/resource/dashicons/

    public function render($block = [], $content = '', $is_preview = false)
    {
        $title = get_field('block_title');

        if ($is_preview) {
            echo $title;
            exit;
        }

        $wp_query = new \WP_Query([
            'post_type' => 'post',
            'posts_per_page' => 3,
        ]);

		$visibility = get_field('visibility');
		$xp = get_experience_group();

		if(!$visibility || in_array($xp, $visibility)) :
    ?>
        <div class="pt pb latest-posts-block align<?= $block['align']; ?>">
			<div class="row">
				<div class="col-md-12">
					<h3 role="heading" aria-level="2"><?= $title; ?></h3>
				</div>
			</div>

			<div class="row post-list justify-content-center">
			<?php if ($wp_query->have_posts()) :
				$counter = 0;
			?>

				<?php while ($wp_query->have_posts()) :
					$wp_query->the_post();
				if ($counter == 0) {
					echo '<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 mb-4 mb-md-0">';
				}
				?>

					<?php

					/*
					 * Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'loop-templates/content', get_post_format() );
					?>

				<?php
				if($counter == 0) {
					echo '</div><div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 text-only">';
				}
				if($counter == 2) {
					echo '</div>';
				}
					$counter++;
					endwhile; ?>

				<?php wp_reset_postdata(); wp_reset_query(); ?>
			<?php else : ?>
				<div class="col-xs-12 col-sm-12 col-md-8">
					<p><?php esc_html_e('Sorry, no posts matched your criteria.'); ?></p>
				</div>
			<?php endif; ?>
				<div class="col-xs-12 col-sm-8 col-md-6 col-lg-4  mt-4 mt-lg-0">

					<div class="social-tabs">
						<ul  class="nav nav-pills">
							<li>
								<a class="active" href="#twitter" data-toggle="tab">Twitter</a>
							</li>
							<li>
								<a href="#facebook" data-toggle="tab">Facebook</a>
							</li>
						</ul>

						<div class="tab-content clearfix">
							<div class="tab-pane fade active show" id="twitter">
								<a class="twitter-timeline" data-height="246" href="https://twitter.com/atlaslivingaust?ref_src=twsrc%5Etfw">Tweets by atlaslivingaust</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
							</div>
							<div class="tab-pane fade" id="facebook">
								<div id="fb-root"></div>
								<script>(function(d, s, id) {
										var js, fjs = d.getElementsByTagName(s)[0];
										if (d.getElementById(id)) return;
										js = d.createElement(s); js.id = id;
										js.src = 'https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v3.2';
										fjs.parentNode.insertBefore(js, fjs);
									}(document, 'script', 'facebook-jssdk'));</script>
								<div class="fb-page" data-href="https://www.facebook.com/atlasoflivingaustralia/" data-tabs="timeline" data-height="253" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/atlasoflivingaustralia/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/atlasoflivingaustralia/">Atlas of Living Australia</a></blockquote></div>
							</div>
						</div>
					</div>


				</div>
			</div>
        </div>
    <?php endif;
    }
}
