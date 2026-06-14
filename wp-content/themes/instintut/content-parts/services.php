<?php
$key = isset($args['key']) ? $args['key'] : '';

$items = get_sub_field('items') ? get_sub_field('items') : [];
?>


<div class="card full-width services-block" id="block-<?= $key ?>">
    <div class="container">
        <h2><?= get_sub_field('title') ?></h2>
        
        <div class="services-list row auto-h">
            <?php foreach ($items as $post) : setup_postdata($post); ?>
        
                <div class="col-4">
                    <a class="service-item" href="<?= get_permalink() ?>">
                        <div class="service-item__icon fs">
                            <img src="/img/dec.svg" alt="">
                        </div>
                        <div class="service-item__title">
                            <?= $post->post_title ?>
                        </div>
                    </a>
                </div>
                
        
            <?php endforeach; wp_reset_postdata(); ?>
        </div>
    </div>
</div>