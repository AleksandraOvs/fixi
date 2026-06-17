<?php

/**
 * Блок "Почему нам доверяют" - Features
 */

$features = get_field('features');
?>
<script>
    console.log('FEATURES:', <?php echo json_encode($features, JSON_UNESCAPED_UNICODE); ?>);
</script>
<?php
if ($features && is_array($features)) :
    $total_features = count($features);
?>

    <div class="features p-100">
        <div class="features__circle"></div>

        <div class="features__list">
            <div class="container">
                <h2 class="h2_center">
                    Почему
                    <br>жители Омска доверяют Fixibot?
                    <br><span>Наши преимущества</span>
                </h2>

                <ul class="features__row row m-2">
                    <?php foreach ($features as $index => $feature) :

                        $title = $feature['title'] ?? '';
                        $text  = $feature['text'] ?? '';
                        $image = $feature['image']['url'] ?? '';

                        $is_last = ($index === $total_features - 1);
                    ?>
                        <li class="col-3">
                            <div class="feature-item">
                                <div class="feature-item__icon <?php echo $is_last ? 'feature-item__icon-last' : ''; ?>">
                                    <?php if ($image): ?>
                                        <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($title); ?>" loading="lazy">
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
                                            <?php echo esc_html(wp_strip_all_tags($text)); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>

            </div>
        </div>
    </div>

<?php endif; ?>