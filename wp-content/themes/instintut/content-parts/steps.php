<?php 
$key = isset($args['key']) ? $args['key'] : '';
$blocks = get_sub_field('items') ? get_sub_field('items') : []; 

$columns = get_sub_field('columns') ? get_sub_field('columns') : 4;
?>

<?php if (count($blocks)) : ?>

    <div class="card gray-block full-width" id="block-<?= $key ?>">

        <div class="container">
            <?php if (get_sub_field('title')) : ?>
                <h2><?= get_sub_field('title') ?></h2>
            <?php endif ?>
            
            <?php if (get_sub_field('subtitle')) : ?>
                <div class="text-block subtitle">
                    <?= get_sub_field('subtitle') ?>
                </div>
            <?php endif ?>
            
             <div class="steps-list features-row bens-row row auto-h">
                <?php $count = 1; foreach ($blocks as $item) : ?>

                    <div class="col-<?= $columns ?>">
                        <div class="feature-item">
                            <div class="feature-item__in">
                                <div class="feature-item__title">
                                    # <?= $item['title'] ?>
                                </div>
                                <div class="feature-item__text text-block">
                                    <?= $item['text'] ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php $count++; endforeach ?>
            </div>
        </div>

    </div>

<?php endif ?>