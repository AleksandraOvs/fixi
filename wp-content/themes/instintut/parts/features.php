<?php

/**
 * Блок "Почему нам доверяют" - Features
 */

$features = get_field('features', 'option');

if ($features && is_array($features)) :

    $total_features = count($features);

    // первые 3 элемента
    $first_row = array_slice($features, 0, 3);

    // остальные 4
    $second_row = array_slice($features, 3);

?>

    <div class="features p-100">
        <?php
        if (is_front_page()) {
            echo '<div class="features__circle"></div>';
        }
        ?>

        <div class="features__list">
            <div class="<?= !is_front_page() ? 'container block-background' : 'container'; ?>">
                <h2 class="h2_center">
                    Почему
                    <br>жители Омска доверяют Fixibot?
                    <br><span>Наши преимущества</span>
                </h2>

                <?php
                $first_row  = array_slice($features, 0, 3);
                $second_row = array_slice($features, 3);
                ?>

                <!-- Первый ряд -->
                <ul class="features__row row m-2">
                    <?php foreach ($first_row as $feature) :

                        $title = $feature['title'] ?? '';
                        $text  = $feature['text'] ?? '';
                        $image = $feature['image']['url'] ?? '';
                    ?>
                        <li class="col-3">
                            <div class="feature-item">
                                <div class="feature-item__icon">
                                    <?php if ($image): ?>
                                        <img src="<?= esc_url($image); ?>" alt="<?= esc_attr($title); ?>" loading="lazy">
                                    <?php endif; ?>
                                </div>

                                <div class="feature-item__content">
                                    <?php if ($title): ?>
                                        <div class="feature-item__title">
                                            <?= esc_html($title); ?>
                                        </div>
                                    <?php endif; ?>

                                    <?php if ($text): ?>
                                        <div class="feature-item__sub">
                                            <?= esc_html(wp_strip_all_tags($text)); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>

                <?php if (!empty($second_row)) : ?>
                    <!-- Остальные ряды -->
                    <ul class="features__row row m-2">
                        <?php foreach ($second_row as $index => $feature) :

                            $title = $feature['title'] ?? '';
                            $text  = $feature['text'] ?? '';
                            $image = $feature['image']['url'] ?? '';

                            $is_last = ($index === count($second_row) - 1);
                        ?>
                            <li class="col-3">
                                <div class="feature-item">
                                    <div class="feature-item__icon <?= $is_last ? 'feature-item__icon-last' : ''; ?>">
                                        <?php if ($image): ?>
                                            <img src="<?= esc_url($image); ?>" alt="<?= esc_attr($title); ?>" loading="lazy">
                                        <?php endif; ?>
                                    </div>

                                    <div class="feature-item__content">
                                        <?php if ($title): ?>
                                            <div class="feature-item__title">
                                                <?= esc_html($title); ?>
                                            </div>
                                        <?php endif; ?>

                                        <?php if ($text): ?>
                                            <div class="feature-item__sub">
                                                <?= esc_html(wp_strip_all_tags($text)); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>

            </div>
        </div>
    </div>

<?php endif; ?>