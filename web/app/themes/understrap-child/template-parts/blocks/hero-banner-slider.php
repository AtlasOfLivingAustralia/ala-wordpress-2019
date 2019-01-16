<?php
namespace App\Themes\Pvtl\Blocks;

use App\Themes\Pvtl\Library\RegisterBlocks;

class HeroBannerSlider extends RegisterBlocks
{
    protected $title = 'Hero Banner Slider';
    protected $icon = 'images-alt2'; // https://developer.wordpress.org/resource/dashicons/

    public function render($block = [], $content = '', $is_preview = false)
    {
        $slides  = get_field('slides'); // arr
        $overlap = get_field('overlap') ? 'overlap-bottom' : ''; // str

    ?>
        <div class="slider flexible-content no-padding swiper-container <?=$overlap?>">
            <div class="swiper-wrapper">
            <?php foreach ($slides as $slide) :
                $image = $slide['image']; // str
                $title = $slide['slide_title']; // str
                $subtitle = $slide['slide_subtitle']; // str
                $link = $slide['button_link']; // str
                $button_text = $slide['button_text']; // str
            ?>
                <div class="swiper-slide swiper-lazy" data-background="<?=$image['sizes']['full-width-auto-height']?>">
                    <div class="swiper-lazy-preloader"></div>
                    <div class="grid-container">
                        <div class="grid-x grid-padding-x grid-padding-y">
                            <div class="small-12 medium-6 cell">
                                <h2><?=$title?></h2>
                                <p><?=$subtitle?></p>

                                <?php if ($button_text) : ?>
                                    <a href="<?=$link?>" class="button button-white"><?=$button_text?></a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            </div>
            <div class="swiper-pagination"></div>

            <div class="swiper-button-prev swiper-button-white slider-prev"></div>
            <div class="swiper-button-next swiper-button-white slider-next"></div>
        </div>
    <?php
    }
}
