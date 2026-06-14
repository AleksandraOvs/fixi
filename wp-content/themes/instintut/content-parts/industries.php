<?php
$key = isset($args['key']) ? $args['key'] : '';

$items = get_sub_field('items') ? get_sub_field('items') : [];
?>


<div class="card" id="block-<?= $key ?>">
    <div class="title-block">
        <h2><?= get_sub_field('title') ?></h2>
        <div class="title-block__btn">
            <button class="btn js-show-ind">Показать все</button>
        </div>
    </div>
    
    <div class="industries-list row auto-h">
        <?php foreach ($items as $post) : setup_postdata($post); ?>
    
            <div class="col-4">
                <a class="industry-item" href="<?= get_permalink() ?>">
                    <div class="industry-item__icon fs">
                        <img src="<?= get_field('icon')['url'] ?>" alt="">
                    </div>
                    <div class="industry-item__title">
                        <?= $post->post_title ?>
                    </div>
                </a>
            </div>
    
        <?php endforeach; wp_reset_postdata(); ?>
    </div>
</div>