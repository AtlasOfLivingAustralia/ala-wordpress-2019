<?php
namespace App\Themes\Pvtl\Blocks;

use App\Themes\Pvtl\Library\RegisterBlocks;

class IconWithText extends RegisterBlocks
{
    protected $title = 'Icon with Text';
    protected $icon = 'excerpt-view'; // https://developer.wordpress.org/resource/dashicons/

    public function render($block = [], $content = '', $is_preview = false)
    {

        $icon = get_field('icon'); // array
        $text = get_field('text'); // str


    ?>

		<div class="d-flex icon-text">
			<div class="image">
				<img src="<?= $icon['sizes']['medium']; ?>"
					 alt="<?= $icon['alt']; ?>"/>
			</div>
			<div class="content">
				<?= $text ?>
			</div>
		</div>

    <?php
    }
}
