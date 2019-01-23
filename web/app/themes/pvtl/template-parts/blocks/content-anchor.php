<?php
namespace App\Themes\Pvtl\Blocks;

use App\Themes\Pvtl\Library\RegisterBlocks;

class ContentAnchor extends RegisterBlocks
{
    protected $title = 'Content Anchor';
    protected $icon = 'admin-links'; // https://developer.wordpress.org/resource/dashicons/

    public function render($block = [], $content = '', $is_preview = false)
    {

        $title = get_field('section_title'); // str

		$name = str_replace(' ', '_', $title);

    ?>
		<a name="<?= $name; ?>" id="<?= $name; ?>" title="<?= $title; ?>" class="sr-only">$title</a>

    <?php
    }
}
