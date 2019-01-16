<?php
namespace App\Themes\Pvtl\Blocks;

use App\Themes\Pvtl\Library\RegisterBlocks;

class Testimonials extends RegisterBlocks
{
    protected $title = 'Testimonials';
    protected $icon = 'format-quote'; // https://developer.wordpress.org/resource/dashicons/

    public function render($block = [], $content = '', $is_preview = false)
    {
        $testimonials = get_field('testimonials'); // arr
        $section_colour = get_field('section_colour') ?: 'white'; // str

    ?>
        <div class="flexible-content testimonials-block <?=$section_colour?>">
            <div class="grid-container">
                <div class="grid-x grid-margin-x grid-padding-y">
                <?php foreach ($testimonials as $testimonial) :
                    $name = $testimonial['testimonial_name']; // str
                    $content = $testimonial['testimonial_content']; // str
                    $image = $testimonial['testimonial_image']; // str
                    $rating = $testimonial['star_rating']; // number
                ?>
                    <div class="cell testimonial">
                        <div class="grid-x grid-padding-x testimonial-inner">
                            <?php if ($image) : ?>
                                <div class="small-12 medium-4 cell image-content">
                                    <img src="<?=$image['sizes']['testimonial'] ?>" alt="<?=$image['alt']?>" />
                                </div>
                            <?php endif; ?>
                            <div class="<?=($image) ? 'small-12 medium-8' : 'small-12'; ?> cell text-content">
                                <div class="text-inner">
                                    <p><?=$content?></p>
                                    <h4><?=$name?></h4>

                                    <ul class="rating">
                                        <li>
                                            <i class="fa fa-star<?=($rating < 1) ? '-o' : '' ?>" aria-hidden="true"></i>
                                        </li>
                                        <li>
                                            <i class="fa fa-star<?=($rating < 2) ? '-o' : '' ?>" aria-hidden="true"></i>
                                        </li>
                                        <li>
                                            <i class="fa fa-star<?=($rating < 3) ? '-o' : '' ?>" aria-hidden="true"></i>
                                        </li>
                                        <li>
                                            <i class="fa fa-star<?=($rating < 4) ? '-o' : '' ?>" aria-hidden="true"></i>
                                        </li>
                                        <li>
                                            <i class="fa fa-star<?=($rating < 5) ? '-o' : '' ?>" aria-hidden="true"></i>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                </div>
            </div>
        </div>
    <?php
    }
}
