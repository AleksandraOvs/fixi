<?php
$models = get_field('models');
$has_extra_models = false;

$popular_slugs = [
    'iphone-13',
    'iphone-13-mini',
    'iphone-13-pro',
    'iphone-13-pro-max',
    'iphone-14',
    'iphone-14-plus',
    'iphone-14-pro',
    'iphone-14-pro-max',
    'iphone-15',
    'iphone-15-plus',
    'iphone-15-pro',
    'iphone-15-pro-max',
    'iphone-16',
    'iphone-16e',
    'iphone-16-plus',
    'iphone-16-pro',
    'iphone-16-pro-max',
    'iphone-17',
    'iphone-17-air',
    'iphone-17-pro',
    'iphone-17-pro-max',
];
?>

<ul class="tags-list" id="model-list">
    <?php if ($models): ?>
        <?php foreach ($models as $model): ?>
            <?php
            $slug = $model->post_name;
            $is_popular = empty($popular_slugs) || in_array($slug, $popular_slugs, true);

            if (!$is_popular) {
                $has_extra_models = true;
            }
            ?>
            <li class="model-item<?php echo !$is_popular ? ' model-item--extra' : ''; ?>" <?php echo !$is_popular ? 'style="display:none;"' : ''; ?>>
                <a href="#"
                    class="tag-link"
                    data-model="<?php echo esc_attr($slug); ?>"
                    data-url="<?php echo esc_url(get_permalink($model)); ?>">
                    <span style="position:absolute;width:1px;height:1px;overflow:hidden;clip:rect(0,0,0,0);">Ремонт </span><?php echo esc_html(get_the_title($model)); ?>
                </a>
            </li>
        <?php endforeach; ?>
    <?php endif; ?>
</ul>

<?php if ($has_extra_models): ?>
    <a href="#" class="tag-link show-all tags-show-more" id="model-show-more">
        Показать все модели ↓
    </a>
<?php endif; ?>