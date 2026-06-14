<?php 
$key = isset($args['key']) ? $args['key'] : '';
$blocks = get_sub_field('blocks') ? get_sub_field('blocks') : []; 

$type = get_sub_field('type') ? get_sub_field('type') : 1;

$vert_center = get_sub_field('vert_center') ? 'vert-center' : '';
$autoh = get_sub_field('block_equal_height') ? 'auto-h' : '';

$lines = get_sub_field('lines') ? 'with-lines' : '';

$bgClass = '';

if (get_sub_field('bg')) {
    $bgClass = 'bg_' . get_sub_field('bg') . ' full-width';
}
?>

<?php if (count($blocks)) : ?>

    <div class="card block-<?= get_sub_field('bg-color') ?> <?= $lines ?> <?= $bgClass ?>" id="block-<?= $key ?>">

        <?php if (get_sub_field('bg')) : ?>
            <div class="container">
        <?php endif ?>

        <?php if (get_sub_field('title')) : ?>
            <h2><?= get_sub_field('title') ?></h2>
        <?php endif ?>
        
        <?php if (get_sub_field('subtitle')) : ?>
            <div class="text-block subtitle">
                <?= get_sub_field('subtitle') ?>
            </div>
        <?php endif ?>
        
         <div class="row <?= $vert_center ?> <?= $autoh ?>">
            <?php $count = 1; foreach ($blocks as $item) : ?>
                <div class="col-<?= $item['block_width'] ?>">

                    <div class="block tb-<?= $item['bg_color'] ?>">
                        <?php if ($item['image']) : ?>
                        
                            <?php if ($item['url']) : ?>
                                <div class="block__img app__img">
                                    <a href="<?= $item['url'] ?>" data-fancybox="">
                                        <img src="<?= $item['image']['url'] ?>" alt="" title="" loading="lazy">
                                        <div class="video-btn">
                                            <i class="svg"><svg width="70" height="70"><use xlink:href="/img/icons.svg?v=22#play"></use></svg></i>
                                        </div>
                                    </a>
                                </div>
                            <?php else : ?>
                                <div class="block__img">
                                    <img src="<?= $item['image']['url'] ?>" alt="" title="" loading="lazy">
                                </div>
                            <?php endif ?>
                        
                        <?php else : ?>
                        

                            <?php if ($type == 2) : ?>
                                <div class="block__numb">
                                    <?php
                                    if ($count < 10) {
                                        echo '0' . $count;
                                    } else {
                                        echo $count;
                                    }
                                    ?>
                                </div>
                            <?php endif ?>
                        
                            <div class="text-block">
                                <?= wpautop($item['text']) ?>
                            </div>
                        
                        <?php endif ?>
                    </div>
                </div>
            <?php $count++; endforeach ?>
        </div>

        <?php if (get_sub_field('bg')) : ?>
            </div>
        <?php endif ?>

    </div>

<?php endif ?>