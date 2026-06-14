<?php
$key = isset($args['key']) ? $args['key'] : '';

$items = get_posts([
    'post_type' => 'equip',
    'posts_per_page' => -1,
    'include' => get_sub_field('items'),
    'orderby' => 'menu_order',
    'order' => 'DESC',
]);
?>


<div class="card" id="block-<?= $key ?>">
    <h2><?= get_sub_field('title') ?></h2>

    <div class="equip-list">
        <?php foreach ($items as $post) : ?>

            <?php
            $chars = get_field('chars') ? get_field('chars') : [];
            ?>
            <div class="equip-item">
                <div class="row">
                    <div class="col-6">
                        <div class="equip-item__image">
                            <a href="<?= get_permalink() ?>">
                                <img src="<?= get_field('image')['url'] ?>" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="equip-item__title">
                            <a href="<?= get_permalink() ?>">
                                <?= $post->post_title ?>
                            </a>
                        </div>
                        <div class="equip-item__text">
                            <?= get_field('text') ?>
                        </div>
                        <div class="equip-item__chars">
                            <?php if (count($chars)) : ?>
                                <div class="product__short">
                                    <?php foreach ($chars as $char) : ?>
                                        <div class="product-attribute">
                                            <span class="attribute-name"><?= $char['title'] ?></span> 
                                            <span class="attribute-value"><?= $char['value'] ?></span>
                                        </div>
                                    <?php endforeach ?>
                                </div>
                            <?php endif ?>
                        </div>  
                    </div>
                </div>
            </div>
        <?php endforeach; wp_reset_postdata(); ?>
    </div>
</div>