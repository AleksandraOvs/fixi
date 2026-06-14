<?php
/**
 * Блок выбора устройств и формы на главной странице
 * Форма: Device Type → Diagnostic (проблема)
 */

// Получаем категории устройств
$device_categories = get_posts(array(
    'post_type' => 'device',
    'posts_per_page' => -1,
    'orderby' => 'menu_order',
    'order' => 'ASC',
));

// Собираем данные по устройствам
$diagnostics_by_device = [];
$models_by_device = [];
$brands_by_device = [];

foreach ($device_categories as $category) {
    $device_id = $category->ID;
    $device_slug = sanitize_title($category->post_title);
    
    // 1. Получаем все диагностики
    $diagnostics_query = new WP_Query([
        'post_type' => 'diagnostic',
        'posts_per_page' => -1,
        'meta_query' => [
            [
                'key' => 'device',
                'value' => $device_id,
                'compare' => '='
            ]
        ],
        'orderby' => 'title',
        'order' => 'ASC'
    ]);
    
    if ($diagnostics_query->have_posts()) {
        $diagnostics_by_device[$device_slug] = [];
        
        while ($diagnostics_query->have_posts()) {
            $diagnostics_query->the_post();
            $diagnostic_id = get_the_ID();
            
            $diagnostics_by_device[$device_slug][] = [
                'id' => $diagnostic_id,
                'title' => get_the_title(),
                'url' => get_permalink($diagnostic_id),
                'slug' => get_post_field('post_name', $diagnostic_id)
            ];
        }
        wp_reset_postdata();
    }

    // 2. Проверяем наличие брендов (ACF repeater)
    $device_brands = get_field('brands', $device_id);
    if ($device_brands && is_array($device_brands)) {
        $brands_by_device[$device_slug] = [];
        foreach ($device_brands as $brand) {
            // Учитываем, что поле link может отдавать как строку, так и массив (в зависимости от настроек ACF)
            $brand_link = '#';
            if (!empty($brand['link'])) {
                $brand_link = is_array($brand['link']) ? $brand['link']['url'] : $brand['link'];
            }
            
            $brands_by_device[$device_slug][] = [
                'title' => $brand['title'],
                'url' => $brand_link
            ];
        }
    }
    
    // 3. Получаем модели, если они есть
    $related_models = get_field('models', $device_id);
    if ($related_models && is_array($related_models)) {
        $models_by_device[$device_slug] = [];
        
        foreach ($related_models as $model_post) {
            $models_by_device[$device_slug][] = [
                'id' => $model_post->ID,
                'title' => get_the_title($model_post->ID),
                'slug' => sanitize_title(get_the_title($model_post->ID)),
                'url' => get_permalink($model_post->ID)
            ];
        }
    }
}

// Первая категория по умолчанию
$first_device_slug = array_key_first($diagnostics_by_device);
?>

<div class="hero__search-box m-100">
    <div class="container">
        
        <form class="search-form" method="GET" id="diagnostic-search-form">
            
            <select class="search-form__input" id="device-type" name="device" required>
                <option value="" disabled selected>Вид устройства</option>
                <?php foreach ($device_categories as $category): 
                    $device_slug = sanitize_title($category->post_title);
                    if (!empty($diagnostics_by_device[$device_slug])):
                ?>
                    <option value="<?php echo esc_attr($device_slug); ?>" data-id="<?php echo esc_attr($category->ID); ?>">
                        <?php echo esc_html($category->post_title); ?>
                    </option>
                <?php 
                    endif;
                endforeach; 
                ?>
            </select>

            <select class="search-form__input" id="device-diagnostic" name="diagnostic" required>
                <option value="" selected>Выберите неисправность</option>
                <?php 
                if ($first_device_slug && isset($diagnostics_by_device[$first_device_slug])):
                    foreach ($diagnostics_by_device[$first_device_slug] as $diagnostic):
                ?>
                    <option 
                        value="<?php echo esc_attr($diagnostic['slug']); ?>" 
                        data-device="<?php echo esc_attr($first_device_slug); ?>"
                        data-url="<?php echo esc_url($diagnostic['url']); ?>">
                        <?php echo esc_html($diagnostic['title']); ?>
                    </option>
                <?php 
                    endforeach;
                endif;
                ?>
            </select>

            <button type="submit" class="btn btn--orange search-form__btn">
                Провести диагностику
            </button>
        </form>

        <div class="hero__services">
            <h2 class="hero__services-title">
                мы ремонтируем технику
                <br>любой сложности!
            </h2>
            <div class="hero__services-sub">
                выберите тип устройства
            </div>
        
            <div class="row">
                <?php 
                $col_classes = array(
                    0 => 'col-2',  1 => 'col-2',  2 => 'col-2',  3 => 'col-6',
                    4 => 'col-2',  5 => 'col-2',  6 => 'col-2',  7 => 'col-3',
                    8 => 'col-3',  9 => 'col-6', 10 => 'col-2', 11 => 'col-2', 12 => 'col-2',
                );
                
                $first_device = true;
                foreach ($device_categories as $index => $category):
                    $device_slug = sanitize_title($category->post_title);
                    
                    if (empty($diagnostics_by_device[$device_slug])) continue;
                    
                    $icon = get_field('device-icon', $category->ID);
                    $icon_hover = get_field('icon-hover', $category->ID);
                    $col_class = isset($col_classes[$index]) ? $col_classes[$index] : 'col-2';
                ?>
                <div class="<?php echo esc_attr($col_class); ?>">
                    <a href="#" class="service-item device-category-filter <?php echo $first_device ? 'active' : ''; ?>" 
                       data-device="<?php echo esc_attr($device_slug); ?>" 
                       data-hover="<?php echo $icon_hover ? esc_url($icon_hover['url']) : ''; ?>"
                       data-original="<?php echo $icon ? esc_url($icon['url']) : ''; ?>">
                        <div class="service-item__img">
                            <?php if ($icon): ?>
                                <img src="<?php echo esc_url($icon['url']); ?>" 
                                     alt="<?php echo esc_attr($category->post_title); ?>">
                            <?php else: ?>
                                <img src="<?php echo get_template_directory_uri(); ?>/img/service/default.png" 
                                     alt="">
                            <?php endif; ?>
                        </div>
                        <span><?php echo nl2br(esc_html($category->post_title)); ?></span>
                    </a>
                </div>
                <?php 
                $first_device = false;
                endforeach; 
                ?>
            </div>
        </div>

        <div class="hero__tags">
            <h2>
                ремонтируем популярные 
                <br>бренды и модели техники.
                <br><span id="device-subtitle">выберите ваш вариант</span>
            </h2>

            <div class="tags-list__in">
                <ul class="tags-list" id="models-list">
                    <?php 
                    // Проходим по всем устройствам, чтобы сразу вывести все теги (скрытые и видимые)
                    foreach ($device_categories as $category):
                        $device_slug = sanitize_title($category->post_title);
                        $is_first = ($device_slug === $first_device_slug);
                        $display_style = $is_first ? '' : 'display:none;';
                        
                        // Логика: если есть бренды, выводим их
                        if (!empty($brands_by_device[$device_slug])) {
                            foreach ($brands_by_device[$device_slug] as $brand):
                            ?>
                                <li class="model-tag" data-device="<?php echo esc_attr($device_slug); ?>" style="<?php echo $display_style; ?>">
                                    <a href="<?php echo esc_url($brand['url']); ?>">
                                        <?php echo esc_html($brand['title']); ?>
                                    </a>
                                </li>
                            <?php
                            endforeach;
                        } 
                        // Иначе, если брендов нет, выводим модели
                        elseif (!empty($models_by_device[$device_slug])) {
                            foreach ($models_by_device[$device_slug] as $model):
                            ?>
                                <li class="model-tag" data-device="<?php echo esc_attr($device_slug); ?>" style="<?php echo $display_style; ?>">
                                    <?php if (get_field('page_link', $model['id'])) : ?>
                                        <a href="<?= get_field('page_link', $model['id']) ?>">
                                            <?php echo esc_html($model['title']); ?>
                                        </a>
                                    <?php else : ?>
                                        <a href="#" data-toggle="modal" data-target="#lead-modal">
                                            <?php echo esc_html($model['title']); ?>
                                        </a>
                                    <?php endif ?>
                                </li>
                            <?php 
                            endforeach;
                        }
                    endforeach;
                    ?>
                    
                    <li class="model-tag-none">
                        <a href="#" data-toggle="modal" data-target="#question-modal">Нет нужного</a>
                    </li>
                </ul>
            </div>
        </div>

    </div>
</div>

<script>
jQuery(document).ready(function($) {
    // Данные из PHP
    const diagnosticsByDevice = <?php echo json_encode($diagnostics_by_device, JSON_UNESCAPED_UNICODE); ?>;
    
    let currentDevice = '<?php echo esc_js($first_device_slug ?? ''); ?>';

    // === ПЕРЕКЛЮЧЕНИЕ ИКОНОК ===
    function toggleIconOnActive($element) {
        const $img = $element.find('.service-item__img img');
        const hoverIcon = $element.data('hover');
        const originalIcon = $element.data('original');
        
        if ($element.hasClass('active') && hoverIcon) {
            $img.attr('src', hoverIcon);
        } else if (originalIcon) {
            $img.attr('src', originalIcon);
        }
    }
    
    $('.device-category-filter.active').each(function() {
        toggleIconOnActive($(this));
    });
    
    // === ОБНОВЛЕНИЕ SELECT С ДИАГНОСТИКАМИ ===
    function updateDiagnosticsSelect(deviceSlug) {
        const $diagnosticSelect = $('#device-diagnostic');
        const diagnostics = diagnosticsByDevice[deviceSlug] || [];
        
        $diagnosticSelect.html('<option value="" selected>Выберите неисправность</option>');
        
        if (diagnostics.length > 0) {
            diagnostics.forEach(function(diagnostic) {
                const option = $('<option>')
                    .val(diagnostic.slug)
                    .text(diagnostic.title)
                    .attr('data-device', deviceSlug)
                    .attr('data-url', diagnostic.url);
                $diagnosticSelect.append(option);
            });
        } else {
            $diagnosticSelect.html('<option value="" disabled>Диагностики не найдены</option>');
        }
    }
    
    // === ОБНОВЛЕНИЕ ВИЗУАЛЬНЫХ МОДЕЛЕЙ И БРЕНДОВ ===
    function updateVisualModels(deviceSlug) {
        $('.model-tag').hide(); // Скрываем и бренды, и модели других устройств
        $('.model-tag[data-device="' + deviceSlug + '"]').show();
    }
    
    // === КЛИК ПО КАТЕГОРИИ УСТРОЙСТВА (.service-item) ===
    $('.device-category-filter').on('click', function(e) {
        e.preventDefault();
        
        $('.device-category-filter').each(function() {
            $(this).removeClass('active');
            toggleIconOnActive($(this));
        });
        
        $(this).addClass('active');
        toggleIconOnActive($(this));
        
        currentDevice = $(this).data('device');
        
        const deviceName = $(this).find('span').text().trim();
        $('#device-subtitle').text(deviceName.toLowerCase());
        
        updateDiagnosticsSelect(currentDevice);
        $('#device-type').val(currentDevice);
        updateVisualModels(currentDevice);
        
        $('html, body').animate({
            scrollTop: $('#models-list').offset().top - 260
        }, 600);
    });
    
    // === ФОРМА ПОИСКА: выбор типа устройства ===
    $('#device-type').on('change', function() {
        const selectedDevice = $(this).val();
        
        if (selectedDevice) {
            currentDevice = selectedDevice;
            
            updateDiagnosticsSelect(selectedDevice);
            updateVisualModels(selectedDevice);
            
            $('.device-category-filter').each(function() {
                $(this).removeClass('active');
                toggleIconOnActive($(this));
            });
            
            const $activeCategory = $('.device-category-filter[data-device="' + selectedDevice + '"]');
            $activeCategory.addClass('active');
            toggleIconOnActive($activeCategory);
            
            const deviceName = $activeCategory.find('span').text().trim();
            if (deviceName) {
                $('#device-subtitle').text(deviceName.toLowerCase());
            }
        }
    });
    
    // === КЛИК ПО МОДЕЛИ ИЛИ БРЕНДУ ===
    $('.model-tag a').on('click', function(e) {
        const href = $(this).attr('href');
        if (href && href !== '#' && !$(this).data('toggle')) {
            return true; // Переход по ссылке работает штатно
        }
        
        e.preventDefault();
        
        if ($(this).data('toggle') === 'modal') {
            const target = $(this).data('target');
            $(target).modal('show');
        }
    });
    
    // === ОТПРАВКА ФОРМЫ - ПЕРЕХОД НА СТРАНИЦУ ДИАГНОСТИКИ ===
    $('#diagnostic-search-form').on('submit', function(e) {
        e.preventDefault();
        
        const deviceType = $('#device-type').val();
        const diagnosticSlug = $('#device-diagnostic').val();
        
        if (!deviceType || !diagnosticSlug) {
            alert('Пожалуйста, выберите устройство и неисправность');
            return false;
        }
        
        const selectedOption = $('#device-diagnostic option:selected');
        const diagnosticUrl = selectedOption.data('url');
        
        if (diagnosticUrl) {
            window.location.href = diagnosticUrl;
        } else {
            alert('Ошибка: URL диагностики не найден');
        }
        
        return false;
    });
    
    $(document).on('click', '.show-all-models', function(e) {
        e.preventDefault();
        $('.model-tag').show();
        $('#device-subtitle').text('все варианты');
    });
});
</script>