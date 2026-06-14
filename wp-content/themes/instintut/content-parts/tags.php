<?php
$key = isset($args['key']) ? $args['key'] : '';

$items = get_sub_field('items') ? get_sub_field('items') : [];
?>


<div class="card" id="block-<?= $key ?>">
    <?php if (get_sub_field('title')) : ?>
        <h2><?= get_sub_field('title') ?></h2>
    <?php endif ?>

    <ul class="problems-list">
        <?php foreach ($items as $item) : ?>
            <li><a href="<?= $item['link'] ?>"><?= $item['title'] ?></a></li>
        <?php endforeach ?>
    </ul>
</div>