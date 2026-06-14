<?php 
$key = isset($args['key']) ? $args['key'] : '';
$blocks = get_sub_field('items') ? get_sub_field('items') : []; 

$columns = get_sub_field('columns') ? get_sub_field('columns') : 4;

$bg = get_sub_field('image') ? get_sub_field('image')['url'] : '';

?>

<?php if (count($blocks)) : ?>

    <?php if ($bg) : ?>
        <style>
        #block-<?= $key ?> {
            background: url(<?= $bg ?>);
            background-size: cover;
            background-position: center;
        }
        </style>
    <?php endif ?>

    <div class="card gray-block full-width" id="block-<?= $key ?>">

        <div class="container">
            <?php if (get_sub_field('title')) : ?>
                <h2 style="<?= get_sub_field('color_title') ? 'color: ' . get_sub_field('color_title') : '' ?>"><?= get_sub_field('title') ?></h2>
            <?php endif ?>
            
            <?php if (get_sub_field('subtitle')) : ?>
                <div class="text-block subtitle">
                    <?= get_sub_field('subtitle') ?>
                </div>
            <?php endif ?>
            
             <div class="bens-row row auto-h">
                <?php $count = 1; foreach ($blocks as $item) : ?>
                    <div class="col-<?= $columns ?>">
                        <div class="feature-item">
                            <?php if ($item['image']) : ?>
                                <div class="feature-item__img">
                                    <img src="<?= $item['image']['url'] ?>" alt="">
                                </div>
                            <?php endif ?>
            
                            <div class="feature-item__title">
                                <?= $item['title'] ?>
                            </div>
                            <div class="feature-item__text text-block">
                                <?= $item['text'] ?>
                            </div>
                        </div>
                    </div>
                <?php $count++; endforeach ?>
            </div>
        </div>

    </div>

<?php endif ?>