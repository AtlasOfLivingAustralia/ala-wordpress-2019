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
        $number_of_posts = get_field('number_of_posts') ?: 4;
        $section_colour = get_field('section_colour') ?: 'white'; // str

        if ($is_preview) {
            echo $title;
            exit;
        }

        $wp_query = new \WP_Query([
            'post_type' => 'post',
            'posts_per_page' => $number_of_posts,
        ]);
    ?>
        <div class="flexible-content latest-posts-widget <?=$section_colour?>">
            <div class="grid-container">
                <div class="grid-x grid-padding-y">
                    <div class="cell block block-latest-posts">
                        <div class="block-title">
                            <strong role="heading" aria-level="2">
                                <?=$title?><a href="/blog" class="va">View All »</a>
                            </strong>
                        </div>

                        <div class="block-content">
                        <?php if ($wp_query->have_posts()) :
                            $counter = 0;
                        ?>
                            <ol class="post-list no-feature-style grid-x grid-padding-x grid-padding-y small-up-2 large-up-4">
                            <?php while ($wp_query->have_posts()) :
                                $wp_query->the_post();
                            ?>
                                <li class="item item-<?=$counter++?> cell">
                                    <div class="post-image">
                                        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                            <?php echo the_post_thumbnail('post-thumb'); ?>
                                        </a>
                                    </div>
                                    <div class="post-entry">
                                        <h2 class="post-name">
                                            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                                <?php the_title(); ?>
                                            </a>
                                        </h2>
                                        <div class="post-meta">
                                            <div class="post-meta">
                                                <?php foundationpress_entry_meta(); ?>
                                            </div>
                                        </div>

                                        <div class="post-excerpt"><?php the_excerpt(); ?></div>

                                        <div class="post-readmore">
                                            <a
                                                href="<?php the_permalink(); ?>"
                                                title="<?php the_title(); ?>"
                                                class="button"
                                            >
                                                Read more »
                                            </a>
                                        </div>
                                    </div>
                                </li>
                            <?php endwhile; ?>
                            </ol>
                            <?php wp_reset_postdata(); ?>
                        <?php else : ?>
                            <p><?php esc_html_e('Sorry, no posts matched your criteria.'); ?></p>
                        <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }
}
