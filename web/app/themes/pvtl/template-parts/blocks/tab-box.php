<?php

namespace App\Themes\Pvtl\Blocks;

use App\Themes\Pvtl\Library\RegisterBlocks;

class TabBox extends RegisterBlocks
{
    protected $title = 'Tab Box';
    protected $icon = 'editor-table'; // https://developer.wordpress.org/resource/dashicons/

    public function render($block = [], $content = '', $is_preview = false)
    {
        $slides = get_field('slides'); // arr
        $title = get_field('title'); // str


        ?>
        <div class="tab-box flexible-content align<?= $block['align']; ?>">
            <div class="container">
                <div class="tab-wrap">
                    <div class="tab-section-title">
                        Explore the Atlas for:
                    </div>
                    <ul id="tabs" class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a id="tab-A" href="#pane-A" class="nav-link active" data-toggle="tab" role="tab">Researchers</a>
                        </li>
                        <li class="nav-item">
                            <a id="tab-B" href="#pane-B" class="nav-link" data-toggle="tab" role="tab">Managers/Consultants</a>
                        </li>
                        <li class="nav-item">
                            <a id="tab-C" href="#pane-C" class="nav-link" data-toggle="tab" role="tab">Community and
                                Schools</a>
                        </li>
                    </ul>
                </div>


                <div id="content" class="tab-content" role="tablist">
                    <div id="pane-A" class="card tab-pane fade show active" role="tabpanel" aria-labelledby="tab-A">
                        <div class="card-header" role="tab" id="heading-A">
                            <h5 class="mb-0">
                                <a data-toggle="collapse" href="#collapse-A" data-parent="#content" aria-expanded="true"
                                   aria-controls="collapse-A">
                                    Researchers
                                </a>
                            </h5>
                        </div>
                        <div id="collapse-A" class="collapse show" role="tabpanel" aria-labelledby="heading-A">
                            <div class="row">
                                <div class="col-xs-12 col-ms-12 col-md-4">
                                    <h3><?= get_field('column_title_1') ?></h3>
                                    <?php $contentRepeater1 = get_field('text_with_icon');
                                    foreach ($contentRepeater1 as $item) : ?>
                                        <div class="d-flex">
                                            <div class="image">
                                                <img src="<?= $item['icon']['sizes']['medium']; ?>"
                                                     alt="<?= $item['icon']['alt']; ?>"/>
                                            </div>
                                            <div class="content">
                                                <?= $item['text'] ?>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <div class="col-xs-12 col-ms-12 col-md-4">
                                    <h3><?= get_field('column_title_2') ?></h3>
                                    <?php $contentRepeater2 = get_field('text_with_icon_2');
                                    foreach ($contentRepeater2 as $item) :

                                        echo '<pre>' . print_r($item, 1) . '</pre>';?>
                                        <div class="d-flex">
                                            <div class="image">
                                                <img src="<?= $item['icon']['sizes']['medium']; ?>"
                                                     alt="<?= $item['icon']['alt']; ?>"/>
                                            </div>
                                            <div class="content">
                                                <?= $item['text'] ?>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <div class="col-xs-12 col-ms-12 col-md-4">
                                    <h3><?= get_field('column_title_3') ?></h3>
                                    <?php $links = get_field('links');
                                    if ($links) : ?>
                                        <ul class="links">
                                            <?php foreach ($links as $link) : ?>
                                                <li><a href="<?= $link['link_path'] ?>"
                                                       title="<?= $link['link_title']; ?>"><?= $link['link_title']; ?>
                                                        <i class="fal fa-long-arrow-right"></i></a></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="pane-B" class="card tab-pane fade" role="tabpanel" aria-labelledby="tab-B">
                        <div class="card-header" role="tab" id="heading-B">
                            <h5 class="mb-0">
                                <a class="collapsed" data-toggle="collapse" href="#collapse-B" data-parent="#content"
                                   aria-expanded="false"
                                   aria-controls="collapse-B">
                                    Managers/Consultants
                                </a>
                            </h5>
                        </div>
                        <div id="collapse-B" class="collapse" role="tabpanel" aria-labelledby="heading-B">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-xs-12 col-ms-12 col-md-4">
                                        <h3><?= get_field('column_title_4') ?></h3>
                                        <?php $contentRepeater3 = get_field('text_with_icon_3');
                                        foreach ($contentRepeater3 as $item) : ?>
                                            <div class="d-flex">
                                                <div class="image">
                                                    <img src="<?= $item['icon']['sizes']['medium']; ?>"
                                                         alt="<?= $item['icon']['alt']; ?>"/>
                                                </div>
                                                <div class="content">
                                                    <?= $item['text'] ?>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                    <div class="col-xs-12 col-ms-12 col-md-4">
                                        <h3><?= get_field('column_title_5') ?></h3>
                                        <?php $contentRepeater4 = get_field('text_with_icon_4');
                                        foreach ($contentRepeater4 as $item) : ?>
                                            <div class="d-flex">
                                                <div class="image">
                                                    <img src="<?= $item['icon']['sizes']['medium']; ?>"
                                                         alt="<?= $item['icon']['alt']; ?>"/>
                                                </div>
                                                <div class="content">
                                                    <?= $item['text'] ?>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                    <div class="col-xs-12 col-ms-12 col-md-4">
                                        <h3><?= get_field('column_title_6') ?></h3>
                                        <?php $links2 = get_field('links_2');
                                        if ($links2) : ?>
                                            <ul class="links">
                                                <?php foreach ($links2 as $link) : ?>
                                                    <li><a href="<?= $link['link_path'] ?>"
                                                           title="<?= $link['link_title']; ?>"><?= $link['link_title']; ?>
                                                            <i class="fal fa-long-arrow-right"></i></a></li>
                                                <?php endforeach; ?>
                                            </ul>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="pane-C" class="card tab-pane fade" role="tabpanel" aria-labelledby="tab-C">
                        <div class="card-header" role="tab" id="heading-C">
                            <h5 class="mb-0">
                                <a class="collapsed" data-toggle="collapse" href="#collapse-C" data-parent="#content"
                                   aria-expanded="false"
                                   aria-controls="collapse-C">
                                    Community and Schools
                                </a>
                            </h5>
                        </div>
                        <div id="collapse-C" class="collapse" role="tabpanel" aria-labelledby="heading-C">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-xs-12 col-ms-12 col-md-4">
                                        <h3><?= get_field('column_title_7') ?></h3>
                                        <?php $contentRepeater5 = get_field('text_with_icon_5');
                                        foreach ($contentRepeater5 as $item) : ?>
                                            <div class="d-flex">
                                                <div class="image">
                                                    <img src="<?= $item['icon']['sizes']['medium']; ?>"
                                                         alt="<?= $item['icon']['alt']; ?>"/>
                                                </div>
                                                <div class="content">
                                                    <?= $item['text'] ?>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                    <div class="col-xs-12 col-ms-12 col-md-4">
                                        <h3><?= get_field('column_title_8') ?></h3>
                                        <?php $contentRepeater6 = get_field('text_with_icon_6');
                                        foreach ($contentRepeater6 as $item) : ?>
                                            <div class="d-flex">
                                                <div class="image">
                                                    <img src="<?= $item['icon']['sizes']['medium']; ?>"
                                                         alt="<?= $item['icon']['alt']; ?>"/>
                                                </div>
                                                <div class="content">
                                                    <?= $item['text'] ?>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                    <div class="col-xs-12 col-ms-12 col-md-4">
                                        <h3><?= get_field('column_title_9') ?></h3>
                                        <?php $links3 = get_field('links_3');
                                        if ($links3) : ?>
                                            <ul class="links">
                                                <?php foreach ($links3 as $link) : ?>
                                                    <li><a href="<?= $link['link_path'] ?>"
                                                           title="<?= $link['link_title']; ?>"><?= $link['link_title']; ?>
                                                            <i class="fal fa-long-arrow-right"></i></a></li>
                                                <?php endforeach; ?>
                                            </ul>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}
