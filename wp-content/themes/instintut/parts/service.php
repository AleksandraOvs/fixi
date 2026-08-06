<?php
$prices = get_field('prices') ?: [];
$phone2 = get_field('phone_2', 'option') ?: [];
$tg = get_field('tg', 'option') ?: [];
$max = get_field('wa', 'option') ?: [];
?>

<?php if (count($prices)) : ?>
    <div class="prices p-100">
        <div class="container">
            <div class="row auto-h">
                <div class="col-8">

                    <div class="card">
                        <div class="price-container">
                            <!-- Header -->
                            <div class="price-header">
                                <div class="price-header-cell">Услуга</div>
                                <div class="price-header-cell">Цена (₽)</div>
                                <div class="price-header-cell">Время (мин.)</div>
                            </div>

                            <!-- Rows -->

                            <?php foreach ($prices as $item) : ?>
                                <div class="price-row">
                                    <div class="price-cell"><?= $item['title'] ?></div>
                                    <div class="price-cell"><?= $item['price'] ?></div>
                                    <div class="price-cell"><?= $item['duration'] ?></div>
                                </div>
                            <?php endforeach ?>

                            <!-- Show More Button -->
                            <?php if (1 == 2) : ?>
                                <button class="show-more-btn">
                                    Смотреть все модели
                                    <svg width="22" height="19" viewBox="0 0 22 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M17.7539 8.03981L17.7539 4L15.3253 4L10.8765 8.04727L10.8765 14.0565L17.7539 8.03981Z" fill="#008EE9" />
                                        <path d="M4 8.03981L4 4L6.42865 4L10.8774 8.04727L10.8774 14.0565L4 8.03981Z" fill="#008EE9" />
                                    </svg>
                                </button>
                            <?php endif ?>

                            <!-- Contact Info -->
                            <div class="contact-info">
                                * Уточняйте стоимость по телефону

                                <?php if ($phone2) : ?>
                                    <?php $phone_link = preg_replace('/[^\d+]/', '', $phone2); ?>
                                    <a href="tel:<?= esc_attr($phone_link); ?>">
                                        <?= esc_html($phone2); ?>
                                    </a>
                                <?php else : ?>
                                    <a href="tel:+73812478180">47-81-80</a>
                                <?php endif; ?>

                                или в

                                <?php if ($max) : ?>
                                    <a href="<?= esc_url($max); ?>" target="_blank" rel="noopener noreferrer">MAX</a>
                                <?php else : ?>
                                    MAX
                                <?php endif; ?>

                                /

                                <?php if ($tg) : ?>
                                    <a href="<?= esc_url($tg); ?>" target="_blank" rel="noopener noreferrer">Telegram</a>
                                <?php else : ?>
                                    Telegram
                                <?php endif; ?>

                                +7 (908) 119-13-74.
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-4">
                    <div class="card_blue prices__include">
                        <div class="prices__include-title">
                            Что входит в стоимость?
                        </div>
                        <ul>
                            <li>
                                Оригинальный дисплей и все необходимые компоненты.
                            </li>
                            <li>
                                Полная замена дисплейного модуля (экран, сенсор, стекло).
                            </li>
                            <li>
                                Диагностика и тестирование после ремонта.
                            </li>
                            <li>
                                Гарантия на работу и запчасти.
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif ?>

<?php get_template_part('parts/reviews'); ?>

<?php get_template_part('parts/callback'); ?>

<?php get_template_part('parts/prob-service'); ?>

<div class="white-wrapper">
    <?php get_template_part('parts/faq'); ?>
    <?php get_template_part('parts/team-block'); ?>

    <?php get_template_part('parts/steps'); ?>
</div>

<?php get_template_part('parts/contacts'); ?>

<?php get_template_part('parts/cta'); ?>