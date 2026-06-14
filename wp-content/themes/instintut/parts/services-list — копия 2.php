<?php
/**
 * Services List Block - Динамический прайс-лист с фильтрами
 * Использует ACF поле models (Relationship) и данные из device_model
 */

// Получаем текущий ID страницы услуги
$current_service_id = get_the_ID();

// Получаем связанные модели через ACF Relationship поле
$related_models = get_field('models', $current_service_id);

if (empty($related_models)) {
    echo '<div class="m-80"><p>Модели устройств пока не добавлены к этой услуге.</p></div>';
    return;
}

// Собираем данные для фильтров и прайсов
$brands_data = [];
$models_data = [];
$pricing_data = [];
$all_problems = [];

foreach ($related_models as $model_post) {
    $model_id = $model_post->ID;
    $model_title = get_the_title($model_id);
    
    // Получаем бренд из taxonomy
    $brand_terms = get_the_terms($model_id, 'brand');
    $brand_name = $brand_terms && !is_wp_error($brand_terms) ? $brand_terms[0]->name : 'Другие';
    $brand_slug = $brand_terms && !is_wp_error($brand_terms) ? $brand_terms[0]->slug : 'other';
    
    // Добавляем бренд в список (если еще нет)
    if (!isset($brands_data[$brand_slug])) {
        $brands_data[$brand_slug] = $brand_name;
    }
    
    // Создаем slug для модели
    $model_slug = sanitize_title($model_title);
    
    // Добавляем модель в список с привязкой к бренду
    $models_data[] = [
        'slug' => $model_slug,
        'title' => $model_title,
        'brand' => $brand_slug
    ];
    
    // Получаем прайс-лист из ACF repeater
    $prices = get_field('prices', $model_id);
    
    if ($prices && is_array($prices)) {
        foreach ($prices as $price_item) {
            $problem = isset($price_item['problem']) ? sanitize_text_field($price_item['problem']) : 'Другая проблема';
            $problem_slug = sanitize_title($problem);
            
            // Собираем уникальные проблемы
            if (!isset($all_problems[$problem_slug])) {
                $all_problems[$problem_slug] = $problem;
            }
            
            // Добавляем в структуру данных
            if (!isset($pricing_data[$model_slug])) {
                $pricing_data[$model_slug] = [];
            }
            
            if (!isset($pricing_data[$model_slug][$problem_slug])) {
                $pricing_data[$model_slug][$problem_slug] = [];
            }
            
            $pricing_data[$model_slug][$problem_slug][] = [
                'service' => isset($price_item['title']) ? $price_item['title'] : 'Услуга',
                'price' => isset($price_item['price']) ? intval($price_item['price']) : 0,
                'time' => isset($price_item['duration']) ? intval($price_item['duration']) : 0
            ];
        }
    }
}

// Группируем модели по брендам
$models_by_brand = [];
foreach ($models_data as $model) {
    if (!isset($models_by_brand[$model['brand']])) {
        $models_by_brand[$model['brand']] = [];
    }
    $models_by_brand[$model['brand']][] = $model;
}

// Получаем город из настроек или метаданных
$city_name = get_field('city_name', 'option') ?: 'вашем городе';
?>

<!-- Секция выбора бренда -->
<div class="card m-40">
    <div class="hero-tags m-80">
        <h2>Выберите марку устройства<br><span class="accent">для ремонта</span></h2>
        <div class="tags-list-in">
            <ul class="tags-list" id="brand-list">
                <?php 
                $first_brand = true;
                foreach ($brands_data as $brand_slug => $brand_name): 
                ?>
                    <li>
                        <a href="#" class="tag-link <?php echo $first_brand ? 'active' : ''; ?>" data-brand="<?php echo esc_attr($brand_slug); ?>">
                            <?php echo esc_html($brand_name); ?>
                        </a>
                    </li>
                <?php 
                $first_brand = false;
                endforeach; 
                ?>
            </ul>
        </div>
    </div>
    
    <!-- Секция выбора модели -->
    <div class="hero-tags m-80">
        <h2>Выберите модель<br><span id="model-subtitle" class="accent"><?php echo esc_html(reset($brands_data)); ?></span></h2>
        <div class="tags-list-in">
            <ul class="tags-list" id="model-list">
                <?php 
                // Выводим модели для первого бренда
                $first_brand_slug = array_key_first($brands_data);
                $first_model = true;
                
                if (isset($models_by_brand[$first_brand_slug])):
                    foreach ($models_by_brand[$first_brand_slug] as $model):
                ?>
                    <li class="model-item" data-brand="<?php echo esc_attr($model['brand']); ?>">
                        <a href="#" class="tag-link <?php echo $first_model ? 'active' : ''; ?>" data-model="<?php echo esc_attr($model['slug']); ?>">
                            <?php echo esc_html($model['title']); ?>
                        </a>
                    </li>
                <?php 
                    $first_model = false;
                    endforeach;
                endif;
                
                // Остальные модели (скрытые)
                foreach ($brands_data as $brand_slug => $brand_name):
                    if ($brand_slug === $first_brand_slug) continue;
                    
                    if (isset($models_by_brand[$brand_slug])):
                        foreach ($models_by_brand[$brand_slug] as $model):
                ?>
                    <li class="model-item" data-brand="<?php echo esc_attr($model['brand']); ?>" style="display:none;">
                        <a href="#" class="tag-link" data-model="<?php echo esc_attr($model['slug']); ?>">
                            <?php echo esc_html($model['title']); ?>
                        </a>
                    </li>
                <?php 
                        endforeach;
                    endif;
                endforeach;
                ?>
                <li style="display: none;">
                    <a href="#" class="tag-link show-all" data-action="show-all">Показать все модели</a>
                </li>
            </ul>
        </div>
    </div>
    
    <!-- Секция выбора неисправности -->
    <div class="hero-tags">
        <h2>Какая проблема с устройством?<br><span class="accent">Выберите неисправность</span></h2>
        <div class="tags-list-in">
            <ul class="tags-list" id="issue-list">
                <?php 
                $first_problem = true;
                foreach ($all_problems as $problem_slug => $problem_name): 
                ?>
                    <li>
                        <a href="#" class="tag-link <?php echo $first_problem ? 'active' : ''; ?>" data-issue="<?php echo esc_attr($problem_slug); ?>">
                            <?php echo esc_html($problem_name); ?>
                        </a>
                    </li>
                <?php 
                $first_problem = false;
                endforeach; 
                ?>
                <li>
                    <a href="#" class="tag-link show-all" data-action="show-all">Показать все проблемы</a>
                </li>
            </ul>
        </div>
    </div>
</div>

<!-- Секция прайс-листа -->
<div class="pricing-section m-80">
    <h2>Цены за ремонт для Омска<br><span id="pricing-title" class="accent">загрузка...</span></h2>
    
    <div class="pricing-table">
        <div class="pricing-table-header">
            <div class="pricing-col">Вид ремонта</div>
            <div class="pricing-col">Стоимость (₽)</div>
            <div class="pricing-col">Время (мин.)</div>
        </div>
        
        <div id="pricing-content">
            <!-- Контент загружается через jQuery -->
        </div>
    </div>
    
    <div class="pricing-note">
        * Цены указаны ориентировочно и зависят от модели устройства. Точную стоимость уточните по телефону или в WhatsApp/Telegram.
    </div>
</div>

<script>
jQuery(document).ready(function($) {
    // Данные из PHP (преобразуем в JSON)
    const pricingData = <?php echo json_encode($pricing_data, JSON_UNESCAPED_UNICODE); ?>;
    
    const modelNames = <?php 
        $model_names_js = [];
        foreach ($models_data as $model) {
            $model_names_js[$model['slug']] = $model['title'];
        }
        echo json_encode($model_names_js, JSON_UNESCAPED_UNICODE); 
    ?>;
    
    const issueNames = <?php echo json_encode($all_problems, JSON_UNESCAPED_UNICODE); ?>;
    
    const modelsByBrand = <?php echo json_encode($models_by_brand, JSON_UNESCAPED_UNICODE); ?>;
    
    // Текущее состояние фильтров
    let currentBrand = '<?php echo esc_js(array_key_first($brands_data)); ?>';
    let currentModel = '<?php echo esc_js($models_data[0]['slug'] ?? ''); ?>';
    let currentIssue = '<?php echo esc_js(array_key_first($all_problems)); ?>';
    
    // Функция обновления прайса
    function updatePricing() {
        const modelData = pricingData[currentModel];
        const issueData = modelData ? modelData[currentIssue] : null;
        const modelName = modelNames[currentModel] || currentModel;
        const issueName = issueNames[currentIssue] || currentIssue;
        
        $('#pricing-title').text(issueName + ' — ' + modelName);
        
        if (issueData && issueData.length > 0) {
            let html = '';
            issueData.forEach(function(item) {
                html += '<div class="pricing-table-row">';
                html += '<div class="pricing-col" data-label="Услуга:">' + item.service + '</div>';
                html += '<div class="pricing-col" data-label="Цена:">' + item.price.toLocaleString('ru-RU') + ' ₽</div>';
                html += '<div class="pricing-col" data-label="Время:">от ' + item.time + ' мин.</div>';
                html += '</div>';
            });
            $('#pricing-content').html(html);
        } else {
            $('#pricing-content').html('<div class="no-results">К сожалению, для данной комбинации пока нет данных о ценах. Уточните стоимость по телефону.</div>');
        }
    }
    
    // Обработчик выбора бренда
    $('#brand-list').on('click', '.tag-link', function(e) {
        e.preventDefault();
        
        $('#brand-list .tag-link').removeClass('active');
        $(this).addClass('active');
        
        currentBrand = $(this).data('brand');
        
        // Обновляем subtitle
        $('#model-subtitle').text($(this).text());
        
        // Показываем модели этого бренда
        $('.model-item').hide();
        $('.model-item[data-brand="' + currentBrand + '"]').show();
        
        // Активируем первую видимую модель
        const firstModel = $('.model-item[data-brand="' + currentBrand + '"]:first .tag-link');
        $('#model-list .tag-link').removeClass('active');
        firstModel.addClass('active');
        currentModel = firstModel.data('model');
        
        updatePricing();
    });
    
    // Обработчик выбора модели
    $('#model-list').on('click', '.tag-link', function(e) {
        e.preventDefault();
        
        if ($(this).data('action') === 'show-all') {
            // Показываем все модели
            $('.model-item').show();
            return;
        }
        
        $('#model-list .tag-link').removeClass('active');
        $(this).addClass('active');
        
        currentModel = $(this).data('model');
        updatePricing();
    });
    
    // Обработчик выбора проблемы
    $('#issue-list').on('click', '.tag-link', function(e) {
        e.preventDefault();
        
        if ($(this).data('action') === 'show-all') {
            // Можно добавить логику показа всех проблем
            return;
        }
        
        $('#issue-list .tag-link').removeClass('active');
        $(this).addClass('active');
        
        currentIssue = $(this).data('issue');
        updatePricing();
    });
    
    // Инициализация при загрузке
    updatePricing();
});
</script>
