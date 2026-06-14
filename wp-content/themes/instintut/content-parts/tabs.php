<?php 
$key = isset($args['key']) ? $args['key'] : '';
$tabs = get_sub_field('items') ? get_sub_field('items') : []; 
?>

<div class="card block-<?= get_sub_field('bg-color') ?>" id="block-<?= $key ?>">

    <?php if (get_sub_field('title')) : ?>
        <h2><?= get_sub_field('title') ?></h2>
    <?php endif ?>
    
    <?php if (get_sub_field('subtitle')) : ?>
        <div class="text-block subtitle">
            <?= get_sub_field('subtitle') ?>
        </div>
    <?php endif ?>
    
    <?php if (count($tabs)) : ?>

        <div class="service-tabs">
            <div class="row">
                <div class="col-4">
                    <ul class="service-tab__nav">
                        <?php $first = 0; foreach ($tabs as $key => $item) : ?>
                            <li><a href="#" class="<?= $first == 0 ? 'active' : '' ?>" data-tab="<?= $key ?>"><?= $item['title'] ?></a></li>
                        <?php $first++; endforeach ?>
                    </ul>
                </div>
                <div class="col-8">
                    <div class="service-tab__content">
                        <?php $first = 0; foreach ($tabs as $key => $item) : ?>
                            <div class="service-tab service-tab-<?= $key ?> <?= $first == 0 ? 'active' : '' ?>">
                                <div class="text-block"><?= $item['content'] ?></div>
                            </div>
                        <?php $first++; endforeach ?>
                    </div>
                </div>
            </div>
        </div>

    <?php endif ?>

</div>
