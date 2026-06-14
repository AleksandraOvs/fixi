<?php
$key = isset($args['key']) ? $args['key'] : '';

$items = get_posts([
    'post_type' => 'specs',
    'posts_per_page' => -1,
    'include' => get_sub_field('items'),
    'orderby' => 'menu_order',
    'order' => 'DESC',
]);
?>


<div class="card" id="block-<?= $key ?>">
    <h2><?= get_sub_field('title') ?></h2>

    <div class="row auto-h">
        <?php foreach ($items as $post) : setup_postdata($post); ?>
            <div class="col-4">
                <div class="team-item">
                    <div class="team-item__header">
                        <div class="team-item__img">
                            <img src="<?= get_field('image')['url'] ?>" alt="">
                        </div>
                        <div class="team-item__title">
                            <?= $post->post_title ?>
                        </div>
                    </div>
                    <div class="team-item__post">
                        Должность: <?= get_field('post') ?>
                    </div>
                    <div class="team-item__post">
                        Стаж: <?= get_field('exp') ?>
                    </div>
                    <div class="team-item__text">
                        <?= get_field('text') ?>
                    </div>
                </div>
            </div>
        <?php endforeach; wp_reset_postdata(); ?>
    </div>
</div>