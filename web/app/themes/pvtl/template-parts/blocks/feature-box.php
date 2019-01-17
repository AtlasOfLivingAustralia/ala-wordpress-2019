<?php
namespace App\Themes\Pvtl\Blocks;

use App\Themes\Pvtl\Library\RegisterBlocks;

class FeatureBox extends RegisterBlocks
{
    protected $title = 'Feature Box';
    protected $icon = 'id'; // https://developer.wordpress.org/resource/dashicons/

    public function render($block = [], $content = '', $is_preview = false)
    {
        $box_shadows = get_field('box_shadows') ? 'box-shadows' : ''; // bool > str
        $section_colour = get_field('section_colour') ?: 'white'; // str
        $image = get_field('image') ?: 'white'; // str
        $title = get_field('title'); // str
        $link = get_field('link'); // str
        $button_text = get_field('button') ?: 'Learn More'; // str

    ?>
        <div class="flexible-content three-feature <?=$box_shadows?> <?=$section_colour?>">
            <div class="grid-container">
                <div class="grid-x grid-padding-x grid-padding-y">
                    <div class="cell small-12 medium-4">
                        <div
                            class="feature-box"
                            style="background-image: url('<?=$image['sizes']['half-width-auto-height']?>');"
                        >
                            <h2><?=$title?></h2>
                            <?php if ($link) : ?>
                                <a href="<?=$link?>" class="button"><?=$button_text?></a>
                            <?php endif; ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    <?php
    }
}
