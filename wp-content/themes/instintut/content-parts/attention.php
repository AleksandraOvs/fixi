<?php
$key = isset($args['key']) ? $args['key'] : '';

?>

<div class="card full-width alert-text " id="block-<?= $key ?>">

    <?php if (get_sub_field('image')) : ?>
        <div class="attention__image">
            <img src="<?= get_sub_field('image')['url'] ?>" alt="">
        </div>
    <?php endif ?>

    <div class="container">
        <?php if (get_sub_field('title')) : ?>
            <h2><?= get_sub_field('title') ?></h2>
        <?php endif ?>
        
        <?= get_sub_field('text') ?>
    </div>

</div>