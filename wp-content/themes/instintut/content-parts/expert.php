<?php
$key = isset($args['key']) ? $args['key'] : '';

$expert_id = get_sub_field('expert');
$expert = get_post($expert_id);

if (!$expert) {
    return;
}

// Получаем все поля эксперта за один запрос
$expert_fields = get_fields($expert->ID);
?>


<div class="card" id="block-<?= $key ?>">

    <div class="expert__title">
        <?= (get_sub_field('title')) ? get_sub_field('title') : 'Мнение эксперта' ?>
    </div>

    <div class="expert__header">
        <div class="expert__image">
            <a href="<?= get_permalink($expert->ID) ?>">
                <img src="<?= esc_url($expert_fields['image']['sizes']['large']) ?>" alt="">
            </a>
        </div>
        <div class="expert__info">
            <div class="expert__name">
                <a href="<?= get_permalink($expert->ID) ?>">
                    <?= esc_html($expert->post_title) ?>
                </a>
            </div>
            <div class="team-item__post"><?= esc_html($expert_fields['post']) ?></div>

            <?php if (!empty($expert_fields['exp'])) : ?>
                <div class="team-item__exp">
                    <?= esc_html($expert_fields['exp']) ?>
                </div>
            <?php endif ?>
        </div>
        <div class="expert__btn">
            <a href="#" data-toggle="modal" data-target="#lead-modal" class="btn">Записаться на консультацию</a>
        </div>
    </div>

    <div class="expert__text text-block text-quote">
        <div class="expert__text-in"><?= get_sub_field('text') ?></div>
    </div>
</div>