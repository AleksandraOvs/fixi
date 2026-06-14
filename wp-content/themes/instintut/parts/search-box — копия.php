<?php
/**
 * Блок выбора устройств и формы на главной странице
 */

// Получаем категории устройств (уровень 1)
$device_categories = get_posts(array(
    'post_type' => 'device',
    'post_parent' => 0,
    'posts_per_page' => -1,
    'orderby' => 'menu_order',
    'order' => 'ASC',
));

// Получаем популярные модели (уровень 2) - берем из всех категорий
$popular_models = get_posts(array(
    'post_type' => 'device',
    'posts_per_page' => 27, // Ограничиваем количество
    'meta_query' => array(
        array(
            'key' => '_wp_page_template', // Фиктивный запрос для фильтрации
            'compare' => 'NOT EXISTS',
        ),
    ),
    'orderby' => 'rand', // Случайный порядок или 'menu_order'
));

// Фильтруем только модели (уровень 2 - есть родитель, но родитель не имеет родителя)
$filtered_models = array_filter($popular_models, function($post) {
    if ($post->post_parent == 0) return false;
    $parent = get_post($post->post_parent);
    return ($parent && $parent->post_parent == 0);
});

// Генерируем данные для формы
$repair_data = get_device_repair_data();
?>

<div class="hero__search-box m-100">
    <div class="container">
        
        <!-- Форма поиска -->
        <form class="search-form" method="GET" action="<?php echo esc_url(home_url('/device-search/')); ?>">
            
            <!-- 1. Вид устройства -->
            <select class="search-form__input" id="device-type" name="device_type" required>
                <option value="" disabled selected>Вид устройства</option>
                <?php foreach ($device_categories as $category): 
                    $device_slug = get_field('device_slug', $category->ID) ?: sanitize_title($category->post_title);
                ?>
                    <option value="<?php echo esc_attr($device_slug); ?>">
                        <?php echo esc_html($category->post_title); ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <!-- 2. Модель -->
            <select class="search-form__input" id="device-model" name="device_model" disabled>
                <option value="" selected>Модель</option>
            </select>

            <!-- 3. Что сломалось -->
            <select class="search-form__input" id="device-problem" name="device_problem" disabled>
                <option value="" selected>Что сломалось</option>
            </select>

            <button type="submit" class="btn btn--orange search-form__btn">
                Узнать стоимость ремонта
            </button>
        </form>

        <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Данные из WordPress CPT device
            const repairData = <?php echo json_encode($repair_data, JSON_UNESCAPED_UNICODE); ?>;
            
            const typeSelect = document.getElementById('device-type');
            const modelSelect = document.getElementById('device-model');
            const problemSelect = document.getElementById('device-problem');

            function populateSelect(selectElement, options, defaultLabel) {
                selectElement.innerHTML = `<option value="" selected>${defaultLabel}</option>`;
                selectElement.disabled = !options || options.length === 0;
                
                if (options) {
                    options.forEach(opt => {
                        const option = document.createElement('option');
                        option.value = opt;
                        option.textContent = opt;
                        selectElement.appendChild(option);
                    });
                }
            }

            typeSelect.addEventListener('change', function() {
                const selectedType = this.value;
                const data = repairData[selectedType];

                if (data) {
                    populateSelect(modelSelect, data.models, "Выберите модель");
                    populateSelect(problemSelect, data.problems, "Выберите поломку");
                } else {
                    populateSelect(modelSelect, [], "Модель");
                    populateSelect(problemSelect, [], "Что сломалось");
                }
            });
        });
        </script>

        <!-- Блок категорий устройств -->
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
                // Определяем классы колонок для разных категорий
                $col_classes = array(
                    0 => 'col-2',  // iPhone
                    1 => 'col-2',  // Телефоны
                    2 => 'col-2',  // MacBook
                    3 => 'col-6',  // Заправка картриджей
                    4 => 'col-2',  // Ноутбуки
                    5 => 'col-2',  // Планшеты
                    6 => 'col-2',  // Телевизор
                    7 => 'col-3',  // Игровые приставки
                    8 => 'col-3',  // Материнские платы
                    9 => 'col-6',  // Компьютеры
                    10 => 'col-2', // Моноблоки
                    11 => 'col-2', // МФУ
                    12 => 'col-2', // Принтеры
                );
                
                foreach ($device_categories as $index => $category):
                    $icon = get_field('device-icon', $category->ID);
                    $col_class = isset($col_classes[$index]) ? $col_classes[$index] : 'col-2';
                    $permalink = get_permalink($category->ID);
                ?>
                <div class="<?php echo esc_attr($col_class); ?>">
                    <a class="service-item" href="<?php echo esc_url($permalink); ?>">
                        <div class="service-item__img">
                            <?php if ($icon): ?>
                                <img src="<?php echo esc_url($icon['url']); ?>" alt="<?php echo esc_attr($category->post_title); ?>">
                            <?php else: ?>
                                <img src="<?php echo get_template_directory_uri(); ?>/img/service/default.png" alt="">
                            <?php endif; ?>
                        </div>
                        <span><?php echo nl2br(esc_html($category->post_title)); ?></span>
                    </a>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Блок популярных моделей -->
        <div class="hero__tags">
            <h2>
                ремонтируем популярные 
                <br>модели техники.
                <br><span>выберите вашу модель</span>
            </h2>

            <div class="tags-list__in">
                <ul class="tags-list">
                    <?php foreach ($filtered_models as $model): ?>
                    <li>
                        <a href="<?php echo esc_url(get_permalink($model->ID)); ?>">
                            <?php echo esc_html($model->post_title); ?>
                        </a>
                    </li>
                    <?php endforeach; ?>
                    
                    <li><a href="<?php echo esc_url(home_url('/device/')); ?>">Нет нужного</a></li>
                </ul>
            </div>
        </div>

    </div>
</div>