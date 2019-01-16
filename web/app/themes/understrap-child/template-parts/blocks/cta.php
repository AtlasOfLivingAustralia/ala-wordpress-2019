<?php
namespace App\Themes\Pvtl\Blocks;

use App\Themes\Pvtl\Library\RegisterBlocks;

class Cta extends RegisterBlocks
{
    protected $title = 'Call To Action';
    protected $icon = 'megaphone'; // https://developer.wordpress.org/resource/dashicons/

    public function render($block = [], $content = '', $is_preview = false)
    {
        $title = get_field('title'); // str
        $style = get_field('style'); // str
        $text = get_field('text'); // str
        $button_link = get_field('button_link'); // str
        $button_text = get_field('button_text') ?: 'Learn More'; // str
        $section_colour = get_field('section_colour') ?: 'white'; // str

    ?>
        <div class="flexible-content full-width-text-banner <?=$style?>_style <?=$section_colour?>">
            <div class="grid-container">
                <div class="grid-x grid-padding-y">
                    <div class="cell">
                        <h2><?=$title?></h2>
                        <?php if ($style != 'slim') : ?>
                            <p><?=$text?></p>
                        <?php endif;?>
                        <?php if ($button_link) : ?>
                            <a href="<?=$button_link?>" class="button"><?=$button_text?></a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }
}
