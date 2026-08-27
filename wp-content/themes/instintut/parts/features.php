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

    <section class="features <?php if (is_front_page()) : echo 'p-100';
                                endif; ?>">
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
                // $first_row  = array_slice($features, 0, 3);
                // $second_row = array_slice($features, 3);
                ?>

                <ul class="features__row">
                    <?php foreach ($features as $index => $feature) :

                        $title = $feature['title'] ?? '';
                        $text  = $feature['text'] ?? '';
                        $image = $feature['image']['url'] ?? '';

                        $is_top    = ($index < 3);
                        $is_bottom = ($index >= 3);
                        $is_last   = ($index === count($features) - 1);

                        $item_class = $is_top
                            ? 'features__item features__item--top'
                            : 'features__item features__item--bottom';

                    ?>

                        <li class="<?= esc_attr($item_class); ?>">

                            <div class="feature-item">

                                <div class="feature-item__icon <?= $is_last ? 'feature-item__icon-last' : ''; ?>">

                                    <?php if ($image): ?>
                                        <img
                                            src="<?= esc_url($image); ?>"
                                            alt="<?= esc_attr($title); ?>"
                                            loading="lazy">
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
                                            <?= wp_kses($text, ['br' => []]); ?>
                                        </div>
                                    <?php endif; ?>

                                </div>

                            </div>

                        </li>

                    <?php endforeach; ?>
                </ul>

            </div>
        </div>
    </section>

<?php endif; ?>