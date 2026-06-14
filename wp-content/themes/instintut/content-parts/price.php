<?php
$key = isset($args['key']) ? $args['key'] : '';
?>

<div class="card" id="block-<?= $key ?>">
    <?php if (get_sub_field('title')) : ?>
        <h2><?= get_sub_field('title') ?></h2>
    <?php endif ?>
                        
    <?php if (get_sub_field('subtitle')) : ?>
        <div class="text-block">
            <?= get_sub_field('subtitle') ?>
        </div>
    <?php endif ?>
</div>
