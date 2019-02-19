<?php
namespace App\Themes\Pvtl\Blocks;

use App\Themes\Pvtl\Library\RegisterBlocks;

class LinkBox extends RegisterBlocks
{
    protected $title = 'Link Box';
    protected $icon = 'tablet'; // https://developer.wordpress.org/resource/dashicons/

    public function render($block = [], $content = '', $is_preview = false)
    {

		$title = get_field('title'); // str
		$link = get_field('link'); // str
		$date = get_field('date'); // str
		$author = get_field('author'); // date (jS F Y)
		$image = get_field('image'); // array

	 ?>
		<a href="<?= $link; ?>" title="<?= $title; ?>" class="link-box">
			<img src="<?= $image['sizes']['featured'] ?>" alt="<?= $title; ?>" />
			<div class="overlay">
				<?= ($date) ? '<time class="date" title="' .$date . '"><i class="fal fa-calendar-alt"></i> ' . $date . '</time>' : '' ?>
				<?= ($author) ? '<p class="author"><img src="' . get_stylesheet_directory_uri() . '/images/icons/camera-light-shadow.svg" alt="author icon" />' . $author . '</p>' : '' ?>
				<h4 class="title"><?= $title; ?> <span class="arrow"><i class="far fa-long-arrow-right"></i></span></h4>
			</div>
		</a>

    <?php
    }
}
