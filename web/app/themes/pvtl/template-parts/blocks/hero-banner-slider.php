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
									<svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="-5 -5 60 60">
										<defs>
											<style>
												.map {
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
										<path class="map" d="M748.556,392.228a1.009,1.009,0,0,0-.925-0.118l-14.956,5.5-14.956-5.5a1.014,1.014,0,0,0-.442-0.055,1.028,1.028,0,0,0-.384.055l-15.24,5.6a1,1,0,0,0-.659.941V438A1.006,1.006,0,0,0,702,439a1.029,1.029,0,0,0,.35-0.062l14.955-5.5,14.955,5.5a1.033,1.033,0,0,0,.35.062c0.021,0,.043-0.009.064-0.01s0.043,0.01.065,0.01a1.022,1.022,0,0,0,.348-0.062l15.241-5.6a1.006,1.006,0,0,0,.659-0.942V393.051A1,1,0,0,0,748.556,392.228ZM716.234,431.7l-13.224,4.861v-14.41a20.481,20.481,0,0,1,13.224,2.7V431.7Zm0-9.082a23.371,23.371,0,0,0-13.224-2.472V399.352l13.224-4.861v28.122Zm2.144,9.082v-5.37a25.352,25.352,0,0,1,6.429,7.733Zm13.225,4.861-4.078-1.5a0.951,0.951,0,0,0-.08-0.3,27.1,27.1,0,0,0-9.067-10.86v-29.4l13.225,4.861v37.2Zm15.369-4.861-13.225,4.861v-37.2l13.225-4.861v37.2Zm-24.986-14.884a1.01,1.01,0,0,0,1.425,0l1.579-1.572,1.581,1.572A1.005,1.005,0,0,0,728,415.393l-1.581-1.574L728,412.247a1,1,0,0,0,0-1.418,1.01,1.01,0,0,0-1.425,0L724.99,412.4l-1.579-1.572a1.01,1.01,0,0,0-1.425,0,1,1,0,0,0,0,1.418l1.58,1.572-1.58,1.574A1,1,0,0,0,721.986,416.811Z" transform="translate(-701 -391.516)" filter="url(#dropshadowMap)"/>
									</svg>

								</div>
                                <div class="content text-left">
                                    <p class="h5">
                                        <span class="amount" data-occurrence data-count="86035623">86,035,623</span>
                                        occurrence records
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 text-center">
                            <div class="d-inline-flex align-items-center">
                                <div class="image">
									<svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="-5 -5 60 54">
										<defs>
											<style>
												.browser {
													fill: #fff;
													fill-rule: evenodd;
												}
											</style>
											<filter xmlns="http://www.w3.org/2000/svg" id="dropshadowBrowser" height="130%">
												<feGaussianBlur in="SourceAlpha" stdDeviation="3"/>
												<feOffset dx="1" dy="1" result="offsetblur"/>
												<feMerge>
													<feMergeNode/>
													<feMergeNode in="SourceGraphic"/>
												</feMerge>
											</filter>
										</defs>
										<path class="browser" d="M1051,392.966h-38.04a6.016,6.016,0,0,0-5.98,6.041v28.907a6.016,6.016,0,0,0,5.98,6.041H1051a6.024,6.024,0,0,0,5.99-6.041V399.007A6.024,6.024,0,0,0,1051,392.966Zm-41.86,6.041a3.842,3.842,0,0,1,3.82-3.859h3.32v5.867h-7.14v-2.008Zm45.68,28.907a3.842,3.842,0,0,1-3.82,3.859h-38.04a3.842,3.842,0,0,1-3.82-3.859V403.2h45.68v24.716Zm0-26.9h-36.37v-5.867H1051a3.842,3.842,0,0,1,3.82,3.859v2.008Zm-28.05,19.663a1.08,1.08,0,0,0,1.06.927,1.215,1.215,0,0,0,.17-0.012,1.086,1.086,0,0,0,.9-1.244l-0.64-4.249,8.25,8.323a1.063,1.063,0,0,0,1.52,0,1.084,1.084,0,0,0,0-1.543l-8.24-8.323L1034,415.2a1.081,1.081,0,0,0,1.23-.914,1.093,1.093,0,0,0-.91-1.243l-7.46-1.149a1.085,1.085,0,0,0-.93.307,1.112,1.112,0,0,0-.3.937Z" transform="translate(-1006.97 -392.969)" filter="url(#dropshadowBrowser)"/>
									</svg>

								</div>
                                <div class="content text-left">
                                    <p class="h5">
                                        <span class="amount" data-species data-count="10319">10,319</span>
                                        data sets
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <form class="form-inline">
                                <div class="form-group flex-grow-1">
                                    <label for="search" class="sr-only">Search species, data sets, and more</label>
                                    <input type="search" class="form-control flex-grow-1" id="search" placeholder="Search species, data sets, and more...">
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
