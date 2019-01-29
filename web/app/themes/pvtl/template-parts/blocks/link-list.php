<?php
namespace App\Themes\Pvtl\Blocks;

use App\Themes\Pvtl\Library\RegisterBlocks;

class LinkList extends RegisterBlocks
{
    protected $title = 'Link List';
    protected $icon = 'editor-ul'; // https://developer.wordpress.org/resource/dashicons/

    public function render($block = [], $content = '', $is_preview = false)
    {

        $links = get_field('links'); // array

		if ($links) : ?>
			<ul class="links">
				<?php foreach ($links as $link) : ?>
					<li><a href="<?= $link['link_path'] ?>"
						   title="<?= $link['link_title']; ?>"><?= $link['link_title']; ?>
							<i class="fal fa-long-arrow-right" aria-hidden="true"></i></a></li>
				<?php endforeach; ?>
			</ul>
		<?php endif; ?>

    <?php
    }
}
