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
        $title = get_field('title'); // str

    ?>
        <div class="hero-slider flexible-content swiper-container">
            <div class="swiper-wrapper">
            <?php foreach ($slides as $slide) :
                $image = $slide['image']; // str
                $author = $slide['image_author']; // str
                $description = $slide['image_description']; // str
            ?>
                <div class="swiper-slide swiper-lazy" data-background="<?=$image['sizes']['full-width-auto-height']?>">
                    <div class="swiper-lazy-preloader"></div>
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="authorship">
                                    <?php if($description): ?>
                                        <p class="description"><?=$description?></p>
                                    <?php endif; ?>
                                    <?php if($author): ?>
                                        <h5 class="author"><?=$author?></h5>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            </div>
            <div class="swiper-pagination"></div>

            <div class="search-overlay">
                <div class="container">
                    <h1><?= $title; ?></h1>
                    <div class="search-container row">
                        <div class="col-xs-12 col-md-6">
                            <div class="d-flex">
                                <div class="image">
                                    <img src="<?= get_stylesheet_directory_uri(); ?>/images/icons/map-light.svg" alt="Map Icon" />
                                </div>
                                <div class="content">
                                    <h5>
                                        <span class="amount" data-occurrence>74,950,414</span>
                                        Occurrence Records
                                    </h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <div class="d-flex">
                                <div class="image">
                                    <img src="<?= get_stylesheet_directory_uri(); ?>/images/icons/browser-light.svg" alt="Browser Icon" />
                                </div>
                                <div class="content">
                                    <h5>
                                        <span class="amount" data-species>116,724</span>
                                        Species Recorded
                                    </h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <form class="form-inline">
                                <div class="form-group mb-2">
                                    <label for="search" class="sr-only">Search Species Records</label>
                                    <input type="search" class="form-control" id="search" placeholder="Search 116,724 Species Records...">
                                </div>
                                <button type="submit" class="btn btn-primary mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 22 22">
                                        <defs>
                                            <style>
                                                .search-icon {
                                                    fill: #fff;
                                                    fill-rule: evenodd;
                                                }
                                            </style>
                                        </defs>
                                        <path class="search-icon" d="M1524.33,60v1.151a7.183,7.183,0,1,1-2.69.523,7.213,7.213,0,0,1,2.69-.523V60m0,0a8.333,8.333,0,1,0,7.72,5.217A8.323,8.323,0,0,0,1524.33,60h0Zm6.25,13.772-0.82.813,7.25,7.254a0.583,0.583,0,0,0,.82,0,0.583,0.583,0,0,0,0-.812l-7.25-7.254h0Zm-0.69-7.684,0.01,0c0-.006-0.01-0.012-0.01-0.018s-0.01-.015-0.01-0.024a6,6,0,0,0-7.75-3.3l-0.03.009-0.02.006v0a0.6,0.6,0,0,0-.29.293,0.585,0.585,0,0,0,.31.756,0.566,0.566,0,0,0,.41.01V63.83a4.858,4.858,0,0,1,6.32,2.688l0.01,0a0.559,0.559,0,0,0,.29.29,0.57,0.57,0,0,0,.75-0.305A0.534,0.534,0,0,0,1529.89,66.089Z" transform="translate(-1516 -60)"/>
                                    </svg>
                                    Search
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    <?php
    }
}
