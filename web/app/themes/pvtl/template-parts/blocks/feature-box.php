<?php
namespace App\Themes\Pvtl\Blocks;

use App\Themes\Pvtl\Library\RegisterBlocks;

class FeatureBox extends RegisterBlocks
{
    protected $title = 'Feature Box';
    protected $icon = 'id'; // https://developer.wordpress.org/resource/dashicons/

    public function render($block = [], $content = '', $is_preview = false)
    {

        $title = get_field('title'); // str

		$title1 = get_field('title_1'); // str
		$link1 = get_field('link_1'); // str
		$date1 = get_field('date_1'); // str
		$author1 = get_field('author_1'); // date (jS F Y)
		$image1 = get_field('image_1'); // array

		$title2 = get_field('title_2'); // str
		$link2 = get_field('link_2'); // str
		$date2 = get_field('date_2'); // str
		$author2 = get_field('author_2'); // date (jS F Y)
		$image2 = get_field('image_2'); // array

		$title3 = get_field('title_3'); // str
		$link3 = get_field('link_3'); // str
		$date3 = get_field('date_3'); // str
		$author3 = get_field('author_3'); // date (jS F Y)
		$image3 = get_field('image_3'); // array


    ?>
        <div class="pt pb feature-box align<?= $block['align']; ?>">
           <div class="container">
			   <div class="row">
				   <div class="col-md-12">
					   <h3 role="heading" aria-level="2"><?= $title; ?></h3>
				   </div>
			   </div>
			   <div class="featured-swiper">
				   <div class="row swiper-wrapper">
					   <div class="col-xs-12 col-md-4 swiper-slide">
						   <a href="<?= $link1; ?>" title="<?= $title1; ?>" class="link-box">
							   <img src="<?= $image1['sizes']['featured'] ?>" alt="<?= $title1; ?>" />
							   <div class="overlay">
								   <?= ($date1) ? '<time class="date" title="' .$date1 . '"><i class="fal fa-calendar-alt"></i> ' . $date1 . '</time>' : '' ?>
								   <?= ($author1) ? '<p class="author"><img src="' . get_stylesheet_directory_uri() . '/images/icons/camera-light-shadow.svg" alt="author icon" />' . $author1 . '</p>' : '' ?>
								   <h4 class="title"><?= $title1; ?> <span class="arrow"><i class="far fa-long-arrow-right"></i></span></h4>
							   </div>
						   </a>
					   </div>
					   <div class="col-xs-12 col-md-4 swiper-slide">
						   <a href="<?= $link2; ?>" title="<?= $title2; ?>" class="link-box">
							   <img src="<?= $image2['sizes']['featured'] ?>" alt="<?= $title2; ?>" />
							   <div class="overlay">
								   <?= ($date2) ? '<time class="date" title="' .$date2 . '"><i class="fal fa-calendar-alt"></i> ' . $date2 . '</time>' : '' ?>
								   <?= ($author2) ? '<p class="author"><img src="' . get_stylesheet_directory_uri() . '/images/icons/camera-light-shadow.svg" alt="author icon" />' . $author2 . '</p>' : '' ?>
								   <h4 class="title"><?= $title2; ?> <span class="arrow"><i class="far fa-long-arrow-right"></i></span></h4>
							   </div>
						   </a>
					   </div>
					   <div class="col-xs-12 col-md-4 swiper-slide">
						   <a href="<?= $link3; ?>" title="<?= $title3; ?>" class="link-box">
							   <img src="<?= $image3['sizes']['featured'] ?>" alt="<?= $title3; ?>" />
							   <div class="overlay">
								   <?= ($date3) ? '<time class="date" title="' .$date3 . '"><i class="fal fa-calendar-alt"></i> ' . $date3 . '</time>' : '' ?>
								   <?= ($author3) ? '<p class="author"><img src="' . get_stylesheet_directory_uri() . '/images/icons/camera-light-shadow.svg" alt="author icon" />' . $author3 . '</p>' : '' ?>
								   <h4 class="title"><?= $title3; ?> <span class="arrow"><i class="far fa-long-arrow-right"></i></span></h4>
							   </div>
						   </a>
					   </div>
				   </div>
				   <div class="featured-button-next"><i class="fal fa-angle-right"></i></div>
				   <div class="featured-button-prev"><i class="fal fa-angle-left"></i></div>
			   </div>
		   </div>
        </div>

    <?php
    }
}
