<?php
/**
 * CTA2 блок "Найди неисправность по симптомам"
 * Форма: Device Type → Diagnostic (проблема)
 */

// Получаем категории устройств
$device_categories = get_posts(array(
    'post_type' => 'device',
    'posts_per_page' => -1,
    'orderby' => 'menu_order',
    'order' => 'ASC',
));

// Собираем диагностики по устройствам
$diagnostics_by_device = [];

foreach ($device_categories as $category) {
    $device_id = $category->ID;
    $device_slug = sanitize_title($category->post_title);
    
    // Получаем все диагностики, связанные с этим устройством
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
}

// Первая категория по умолчанию
$first_device_slug = array_key_first($diagnostics_by_device);
?>

<div class="cta2 m-100">
    <div class="container">
        <div class="cta2__in">
            <div class="row">
                <div class="col-4">
                    <h2>
                        Найди 
                        <br>неисправность 
                        <br>по симптомам
                    </h2>
                </div>
                <div class="col-8">
                    <div class="cta__form">
                        <form class="cta2-search-form" method="GET" id="cta2-diagnostic-form">
                            
                            <!-- Вид устройства -->
                            <select class="search-form__input" id="cta2-device-type" name="device" required>
                                <option value="" disabled selected>Вид устройства</option>
                                <?php foreach ($device_categories as $category): 
                                    $device_slug = sanitize_title($category->post_title);
                                    // Показываем только категории с диагностиками
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
                            
                            <!-- Неисправность -->
                            <select class="search-form__input" id="cta2-device-diagnostic" name="diagnostic" required>
                                <option value="" selected>Выберите неисправность</option>
                                <?php 
                                // Выводим диагностики первой категории
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
                                Узнать причину
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
jQuery(document).ready(function($) {
    // Данные из PHP
    const cta2DiagnosticsByDevice = <?php echo json_encode($diagnostics_by_device, JSON_UNESCAPED_UNICODE); ?>;
    
    // === ФУНКЦИЯ ОБНОВЛЕНИЯ ДИАГНОСТИК ДЛЯ CTA2 ===
    function updateCta2DiagnosticsSelect(deviceSlug) {
        const $diagnosticSelect = $('#cta2-device-diagnostic');
        const diagnostics = cta2DiagnosticsByDevice[deviceSlug] || [];
        
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
    
    // === ОБРАБОТЧИК ВЫБОРА УСТРОЙСТВА ===
    $('#cta2-device-type').on('change', function() {
        const selectedDevice = $(this).val();
        
        if (selectedDevice) {
            updateCta2DiagnosticsSelect(selectedDevice);
        }
    });
    
    // === ОТПРАВКА ФОРМЫ - ПЕРЕХОД НА СТРАНИЦУ ДИАГНОСТИКИ ===
    $('#cta2-diagnostic-form').on('submit', function(e) {
        e.preventDefault();
        
        const deviceType = $('#cta2-device-type').val();
        const diagnosticSlug = $('#cta2-device-diagnostic').val();
        
        if (!deviceType || !diagnosticSlug) {
            alert('Пожалуйста, выберите устройство и неисправность');
            return false;
        }
        
        // Получаем URL из выбранной опции
        const selectedOption = $('#cta2-device-diagnostic option:selected');
        const diagnosticUrl = selectedOption.data('url');
        
        if (diagnosticUrl) {
            // Переход на страницу диагностики
            window.location.href = diagnosticUrl;
        } else {
            alert('Ошибка: URL диагностики не найден');
        }
        
        return false;
    });
});
</script>
