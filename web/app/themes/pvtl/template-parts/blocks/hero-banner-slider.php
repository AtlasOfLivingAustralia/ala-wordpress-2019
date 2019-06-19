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

		$visibility = get_field('visibility');
		$xp = get_experience_group();

		if(!$visibility || in_array($xp, $visibility)) :
    ?>
        <div class="hero-slider flexible-content swiper-container align<?= $block['align']; ?>">
            <div class="swiper-wrapper">
            <?php foreach ($slides as $slide) :
                $image = $slide['image']; // str
                $author = $slide['image_author']; // str
                $description = $slide['image_description']; // str
            ?>
                <div class="swiper-slide swiper-lazy" data-background="<?=$image['sizes']['full-width-auto-height']?>">
                    <div class="swiper-lazy-preloader"></div>
                    <div class="authorship">
                        <?php if($description): ?>
                            <p class="description"><?=$description?></p>
                        <?php endif; ?>
                        <?php if($author): ?>
                            <p class="author"><img src="<?= get_stylesheet_directory_uri(); ?>/images/icons/camera-light.svg" alt="Camera Icon" width="20px" /> by <?=$author?></p>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
            </div>
            <div class="swiper-pagination"></div>

            <div class="search-overlay">
                <div class="container">
                    <h1><?= $title; ?></h1>
                    <div class="search-container row">
                        <div class="col-6 text-center">
                            <div class="d-inline-flex align-items-center">
                                <div class="image">
                                    <a href="https://biocache.ala.org.au/occurrences/search?q=*%3A*">
                                    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                         viewBox="0 0 141.7 141.7" style="enable-background:new 0 0 141.7 141.7;" xml:space="preserve" width="60" height="60">
                                    <defs>
                                        <style>
                                            path, rect {
                                                fill: #fff;
                                                fill-rule: evenodd;
                                            }
                                        </style>
                                        <filter xmlns="http://www.w3.org/2000/svg" id="dropshadowMap" height="130%">
                                            <feGaussianBlur in="SourceAlpha" stdDeviation="3"/>
                                            <feOffset dx="1" dy="1" result="offsetblur"/>
                                            <feMerge>
                                                <feMergeNode/>
                                                <feMergeNode in="SourceGraphic"/>
                                            </feMerge>
                                        </filter>
                                    </defs>
                                    <g filter="url(#dropshadowMap)">
                                        <g>
                                            <g>
                                                <g>
                                                    <path d="M23.2,70.9c0,27,21.3,48.9,47.6,48.9s47.5-21.9,47.6-48.9S97.1,22,70.8,22S23.3,43.9,23.2,70.9 M18.4,70.9
                                                        C18.4,41.1,41.9,17,70.8,17s52.4,24.1,52.4,53.9s-23.4,53.8-52.4,53.8S18.4,100.6,18.4,70.9"/>
                                                    <path d="M42,70.9c0-20.1,6.4-38.4,16.9-51.7l3.6,3c-9.8,12.4-15.9,29.6-15.9,48.7s6.1,36.4,15.9,48.7l0,0l-3.6,3
                                                        C48.4,109.3,42,91,42,70.9"/>
                                                    <path d="M78,119.6c9.7-12.4,15.8-29.6,15.8-48.7S87.7,34.5,78,22.2l3.6-3c10.4,13.3,16.8,31.6,16.8,51.7s-6.4,38.4-16.9,51.7
                                                        L78,119.6z"/>
                                                </g>
                                            </g>
                                            <rect x="68.4" y="18.9" width="4.8" height="103.3"/>
                                            <rect x="20.8" y="68.4" width="99.9" height="4.9"/>
                                            <rect x="27.8" y="42.4" width="85.3" height="4.8"/>
                                            <rect x="27.3" y="94.5" width="85.3" height="4.8"/>
                                            <g>
                                                <g>
                                                    <path d="M70.9,50.5c3.5,0,6.4-2.9,6.4-6.4s-2.9-6.4-6.4-6.4c-3.5,0-6.4,2.9-6.4,6.4c0,0,0,0,0,0C64.5,47.6,67.3,50.5,70.9,50.5"
                                                        />
                                                    <path d="M95,64.6c3.5,0,6.4-2.9,6.4-6.4s-2.9-6.4-6.4-6.4c-3.5,0-6.4,2.9-6.4,6.4c0,0,0,0,0,0C88.6,61.8,91.5,64.6,95,64.6"/>
                                                    <path d="M57.1,77.4c3.5,0,6.4-2.9,6.4-6.4c0-3.5-2.9-6.4-6.4-6.4c-3.5,0-6.4,2.9-6.4,6.4C50.7,74.5,53.6,77.4,57.1,77.4"/>
                                                    <path d="M102.1,103.5c3.5,0,6.4-2.9,6.4-6.4c0-3.5-2.9-6.4-6.4-6.4c-3.5,0-6.4,2.9-6.4,6.4c0,0,0,0,0,0
                                                        C95.7,100.6,98.5,103.5,102.1,103.5"/>
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                    </svg>
                                    </a>
								</div>
                                <div class="content text-left">
                                    <p class="h5">
                                        <a href="https://biocache.ala.org.au/occurrences/search?q=*%3A*">
                                        <span class="amount" data-occurrence data-count="84958352">84,958,352</span>
                                        occurrence records</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 text-center">
                            <div class="d-inline-flex align-items-center">
                                <div class="image">
                                    <a href="https://collections.ala.org.au/datasets">
                                    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                         viewBox="0 0 141.7 141.7" style="enable-background:new 0 0 141.7 141.7;" xml:space="preserve" width="60" height="60">
                                    <defs>
                                        <style>
                                            path, rect {
                                                fill: #fff;
                                                fill-rule: evenodd;
                                            }
                                        </style>
                                        <filter xmlns="http://www.w3.org/2000/svg" id="dropshadowMap" height="130%">
                                            <feGaussianBlur in="SourceAlpha" stdDeviation="3"/>
                                            <feOffset dx="1" dy="1" result="offsetblur"/>
                                            <feMerge>
                                                <feMergeNode/>
                                                <feMergeNode in="SourceGraphic"/>
                                            </feMerge>
                                        </filter>
                                    </defs>
                                    <g filter="url(#dropshadowMap)">
                                        <g>
                                            <g>
                                                <g>
                                                    <path d="M48.6,38.2c16-0.3,28.5-4.9,28.5-10.4c0-5.9-12.5-10.4-28.5-10.8c-16,0.4-28.8,4.9-28.8,10.8
                                                        C19.8,33.3,32.6,37.9,48.6,38.2 M77.1,59.4V57c-7,4.9-18.4,7.3-29.5,7.3C36.8,64,26.4,61.5,19.8,57v13.9
                                                        c0,6.6,13.9,10.4,28.1,10.4c2.9,0.1,5.8-0.1,8.7-0.3c1.1-5.3,3.8-10.2,7.6-14C67.9,63.5,72.3,60.8,77.1,59.4 M56.3,85.5
                                                        c-2.9,0.3-5.8,0.4-8.7,0.3c-10.8-0.3-21.2-2.8-27.8-7.3v13.9c0,6.6,13.9,10.4,28.1,10.4c4.3,0.3,8.6,0.1,12.9-0.7
                                                        C57.5,97.2,55.9,91.4,56.3,85.5 M77.1,114v-0.3c-4.9-1.2-9.3-3.7-12.9-7.3l-0.7-0.7c-5.2,1.3-10.6,1.9-16,1.7
                                                        c-10.8,0-21.2-2.4-27.8-7.3V114c0,6.6,13.9,10.8,28.1,10.8C62.5,124.8,77.1,121,77.1,114 M77.1,49.4V35.1
                                                        c-7,5.2-18.4,7.6-29.5,7.3c-10.8,0-21.2-2.4-27.8-7.3v14.2c0,6.3,13.9,10.4,28.1,10.4C62.5,59.8,77.1,55.9,77.1,49.4"/>
                                                    <path d="M76.8,94.2c0.8,1.2,0.6,2.8-0.6,3.6c-1,0.7-2.3,0.6-3.2-0.1c-5.9-6.1-5.9-15.8,0-21.9c1-1,2.7-1,3.7,0.1
                                                        c0.9,0.9,1,2.4,0.2,3.4c-0.7,0.3-1,1-1.7,1.7c-2.5,4.1-2.1,9.2,1,12.9C76.4,93.8,76.4,94.2,76.8,94.2"/>
                                                    <path d="M97.3,99.7c-7.2,7.2-18.9,7.2-26.1,0c-7.2-7.2-7.2-18.9,0-26.1c7.2-7.2,18.9-7.2,26.1,0c0,0,0,0,0,0
                                                        C104.2,80.9,104.2,92.4,97.3,99.7 M120.9,117.8L103.2,100c6.3-9,5.6-21.9-2.4-29.9c-9.1-9-23.9-9-33,0
                                                        c-9.1,8.8-9.4,23.2-0.6,32.4c0.2,0.2,0.4,0.4,0.6,0.6c7.9,7.9,20.3,9.1,29.5,2.8l17.7,17.3c1.5,1.6,4,1.7,5.7,0.2
                                                        c0.1-0.1,0.2-0.2,0.2-0.2C122.3,121.7,122.3,119.4,120.9,117.8"/>
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                    </svg>
                                </a>
								</div>
                                <div class="content text-left">
                                    <p class="h5">
                                        <a href="https://collections.ala.org.au/datasets">
                                        <span class="amount" data-species data-count="10633">10,633</span>
                                        data sets</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <form class="form-inline" method="get" action="https://bie.ala.org.au/search" >
                                <div class="form-group flex-grow-1">
                                    <label for="search" class="sr-only">Search species, data sets, and more</label>
                                    <input type="search" name="q" class="form-control flex-grow-1 autocompleteHome" id="search" placeholder="Search species, data sets, and more..." autocomplete="off">
                                </div>
                                <button type="submit" class="btn btn-primary-dark">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22">
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
    <?php endif;
    }
}
