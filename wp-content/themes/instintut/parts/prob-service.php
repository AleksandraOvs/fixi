<?php

/**
 * Блок "Типовые неисправности"
 * Выводит problems_text, problems_list, problems_text_bottom из ACF
 */

$problems_text = get_field('problems_text');
$problems_list = get_field('problems_list');
$problems_text_bottom = get_field('problems_text_bottom');

// Проверяем наличие данных
if ($problems_list || $problems_text): ?>
    <section class="problems">



        <div class="container">
            <div class="card">
                <div class="h2__sub">
                    типовые неисправности
                </div>
                <h2>
                    <span>какая неисправность у вашего <?php
                                                        // Динамический заголовок в зависимости от типа услуги
                                                        $title_lower = mb_strtolower(get_the_title());
                                                        if (strpos($title_lower, 'iphone') !== false) {
                                                            echo 'iPhone';
                                                        } elseif (strpos($title_lower, 'телефон') !== false) {
                                                            echo 'телефона';
                                                        } elseif (strpos($title_lower, 'ноутбук') !== false) {
                                                            echo 'ноутбука';
                                                        } elseif (strpos($title_lower, 'macbook') !== false) {
                                                            echo 'MacBook';
                                                        } elseif (strpos($title_lower, 'ipad') !== false) {
                                                            echo 'iPad';
                                                        } else {
                                                            echo 'устройства';
                                                        }
                                                        ?>?</span>
                </h2>

                <?php if ($problems_text): ?>
                    <div class="problems__text text-block">
                        <p><?php echo esc_html($problems_text); ?></p>
                    </div>
                <?php endif; ?>

                <?php if ($problems_list): ?>
                    <div class="problems__list" style="background: url(/img/problems-bg.jpg); background-size: cover; background-position: center;">
                        <?php foreach ($problems_list as $problem): ?>
                            <div class="problem-item">
                                <div class="problem-item__title">
                                    <?php echo esc_html($problem['title']); ?>
                                </div>
                                <div class="problem-item__text">
                                    <?php echo $problem['text']; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <?php if ($problems_text_bottom): ?>
                    <div class="problems__sub">
                        <p>
                            <?php echo nl2br(esc_html($problems_text_bottom)); ?>
                        </p>
                        <div class="problems__sub-img">
                            <img src="/img/bot-2.png" alt="Fixibot" width="89" height="60">
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>

    </section>
<?php endif; ?>