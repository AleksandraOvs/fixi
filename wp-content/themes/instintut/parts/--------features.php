<?php

/**
 * Блок "Почему нам доверяют" - Features
 * Выводит преимущества из ACF repeater поля 'features'
 */

// Получаем данные из ACF repeater
$features = get_field('features');
?>

<?php
// Если нет данных - не показываем блок
if (!$features || !is_array($features)) {
    return;
}

// Разбиваем features на строки для desktop версии (по 3-4 элемента)
$total_features = count($features);
$first_row_count = min(3, $total_features);
$second_row_items = array_slice($features, $first_row_count);
?>


<div class="features p-100">

    <div class="features__list">
        <div class="container">
            <h2 class="h2_center">
                Почему
                <br>жители Омска доверяют Fixibot?
                <br><span>Наши преимущества</span>
            </h2>

            <?php if (wp_is_mobile()): ?>

                <!-- Мобильная версия: все элементы в одной строке -->
                <div class="features__row row m-2">
                    <?php
                    foreach ($features as $index => $feature):
                        $title = isset($feature['title']) ? $feature['title'] : '';
                        $text = isset($feature['text']) ? $feature['text'] : '';
                        $image = isset($feature['image']['url']) ? $feature['image']['url'] : '';

                        // Последний элемент получает дополнительный класс
                        $is_last = ($index === $total_features - 1);
                    ?>
                        <div class="col-3">
                            <div class="feature-item">
                                <div class="feature-item__icon <?php echo $is_last ? 'feature-item__icon-last' : ''; ?>">
                                    <?php if ($image): ?>
                                        <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($title); ?>">
                                    <?php endif; ?>
                                </div>
                                <div class="feature-item__content">
                                    <?php if ($title): ?>
                                        <div class="feature-item__title">
                                            <?php echo esc_html($title); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($text): ?>
                                        <div class="feature-item__sub">
                                            <?php echo ($text); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

            <?php else: ?>

                <!-- Desktop версия: две строки -->

                <!-- Первая строка: первые 3 элемента -->
                <div class="features__row row m-2">
                    <?php
                    for ($i = 0; $i < $first_row_count; $i++):
                        $feature = $features[$i];
                        $title = isset($feature['title']) ? $feature['title'] : '';
                        $text = isset($feature['text']) ? $feature['text'] : '';
                        $image = isset($feature['image']['url']) ? $feature['image']['url'] : '';
                    ?>
                        <div class="col-3">
                            <div class="feature-item">
                                <div class="feature-item__icon">
                                    <?php if ($image): ?>
                                        <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($title); ?>">
                                    <?php endif; ?>
                                </div>
                                <div class="feature-item__content">
                                    <?php if ($title): ?>
                                        <div class="feature-item__title">
                                            <?php echo esc_html($title); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($text): ?>
                                        <div class="feature-item__sub">
                                            <?php echo ($text); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endfor; ?>
                </div>

                <!-- Вторая строка: остальные элементы -->
                <?php if (!empty($second_row_items)): ?>
                    <div class="features__row m-2 row">
                        <?php
                        foreach ($second_row_items as $index => $feature):
                            $title = isset($feature['title']) ? $feature['title'] : '';
                            $text = isset($feature['text']) ? $feature['text'] : '';
                            $image = isset($feature['image']['url']) ? $feature['image']['url'] : '';

                            // Последний элемент получает дополнительный класс
                            $is_last = ($index === count($second_row_items) - 1);
                        ?>
                            <div class="col-3">
                                <div class="feature-item">
                                    <div class="feature-item__icon <?php echo $is_last ? 'feature-item__icon-last' : ''; ?>">
                                        <?php if ($image): ?>
                                            <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($title); ?>">
                                        <?php endif; ?>
                                    </div>
                                    <div class="feature-item__content">
                                        <?php if ($title): ?>
                                            <div class="feature-item__title">
                                                <?php echo esc_html($title); ?>
                                            </div>
                                        <?php endif; ?>
                                        <?php if ($text): ?>
                                            <div class="feature-item__sub">
                                                <?php echo ($text); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

            <?php endif; ?>

        </div>
    </div>
</div>