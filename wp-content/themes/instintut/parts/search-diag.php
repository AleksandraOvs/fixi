<?php

/**
 * Блок диагностики проблем по устройствам
 */

// Получаем категории устройств
$device_categories = get_posts(array(
    'post_type' => 'device',
    'posts_per_page' => -1,
    'orderby' => 'menu_order',
    'order' => 'ASC',
));

// Собираем проблемы (diagnostics) по категориям устройств
$diagnostics_by_device = [];
$all_diagnostics_data = [];

foreach ($device_categories as $category) {
    $device_id = $category->ID;
    $device_slug = sanitize_title($category->post_title);

    // Получаем все диагностики, привязанные к этому устройству
    $diagnostics = get_posts(array(
        'post_type' => 'diagnostic',
        'posts_per_page' => -1,
        'meta_query' => array(
            array(
                'key' => 'device',
                'value' => $device_id,
                'compare' => '='
            )
        ),
        'orderby' => 'title',
        'order' => 'ASC'
    ));

    $diagnostics_by_device[$device_slug] = [];

    if (!empty($diagnostics)) {
        foreach ($diagnostics as $diagnostic) {
            $diagnostic_data = [
                'id' => $diagnostic->ID,
                'title' => $diagnostic->post_title,
                'slug' => $diagnostic->post_name,
                'url' => get_permalink($diagnostic->ID)
            ];

            $diagnostics_by_device[$device_slug][] = $diagnostic_data;

            // Добавляем в общий массив
            if (!isset($all_diagnostics_data[$diagnostic_data['slug']])) {
                $all_diagnostics_data[$diagnostic_data['slug']] = $diagnostic_data;
            }
        }
    }
}
?>

<section class="hero__search-box _search-diag">
    <div class="container">

        <!-- Блок категорий устройств -->
        <div class="hero__services">
            <h2 class="hero__services-title">
                диагностика поломок
                <br>любой сложности!
            </h2>
            <div class="hero__services-sub">
                выберите тип устройства
            </div>

            <div class="row">
                <?php
                $col_classes = array(
                    0 => 'col-2',
                    1 => 'col-2',
                    2 => 'col-2',
                    3 => 'col-6',
                    4 => 'col-2',
                    5 => 'col-2',
                    6 => 'col-2',
                    7 => 'col-3',
                    8 => 'col-3',
                    9 => 'col-6',
                    10 => 'col-2',
                    11 => 'col-2',
                    12 => 'col-2',
                );

                $first_device = true;
                foreach ($device_categories as $index => $category):
                    $icon = get_field('device-icon', $category->ID);
                    $col_class = isset($col_classes[$index]) ? $col_classes[$index] : 'col-2';
                    $device_slug = sanitize_title($category->post_title);
                ?>
                    <div class="<?php echo esc_attr($col_class); ?>">
                        <a href="#" class="service-item device-diagnostic-filter <?php echo $first_device ? 'active' : ''; ?>"
                            data-device="<?php echo esc_attr($device_slug); ?>">
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

        <!-- Блок проблем устройства -->
        <div class="hero__tags">
            <h2>
                распространенные проблемы
                <br>с устройствами.
                <br><span id="diagnostic-subtitle">выберите вашу проблему</span>
            </h2>

            <div class="tags-list__in">
                <ul class="tags-list" id="diagnostics-list">
                    <?php
                    // Выводим проблемы первой категории
                    $first_device_slug = array_key_first($diagnostics_by_device);

                    if ($first_device_slug && isset($diagnostics_by_device[$first_device_slug]) && !empty($diagnostics_by_device[$first_device_slug])):
                        foreach ($diagnostics_by_device[$first_device_slug] as $diagnostic):
                    ?>
                            <li class="diagnostic-tag" data-device="<?php echo esc_attr($first_device_slug); ?>">
                                <a href="<?php echo esc_url($diagnostic['url']); ?>">
                                    <?php echo esc_html($diagnostic['title']); ?>
                                </a>
                            </li>
                            <?php
                        endforeach;
                    endif;

                    // Остальные проблемы (скрытые)
                    foreach ($diagnostics_by_device as $device_slug => $diagnostics):
                        if ($device_slug === $first_device_slug) continue;

                        if (!empty($diagnostics)):
                            foreach ($diagnostics as $diagnostic):
                            ?>
                                <li class="diagnostic-tag" data-device="<?php echo esc_attr($device_slug); ?>" style="display:none;">
                                    <a href="<?php echo esc_url($diagnostic['url']); ?>">
                                        <?php echo esc_html($diagnostic['title']); ?>
                                    </a>
                                </li>
                    <?php
                            endforeach;
                        endif;
                    endforeach;
                    ?>

                    <li class="diagnostic-tag-none">
                        <a href="<?php echo esc_url(home_url('/diagnostic/')); ?>">Не нашли проблему?</a>
                    </li>
                </ul>
            </div>
        </div>

    </div>
</section>

<script>
    jQuery(document).ready(function($) {
        // Данные из PHP
        const diagnosticsByDevice = <?php echo json_encode($diagnostics_by_device, JSON_UNESCAPED_UNICODE); ?>;

        let currentDevice = '<?php echo esc_js($first_device_slug ?? ''); ?>';

        // === ФИЛЬТРАЦИЯ ПРОБЛЕМ ПО КАТЕГОРИИ ===
        $('.device-diagnostic-filter').on('click', function(e) {
            e.preventDefault();

            // Меняем активный класс
            $('.device-diagnostic-filter').removeClass('active');
            $(this).addClass('active');

            currentDevice = $(this).data('device');

            // Получаем название категории для заголовка
            const deviceName = $(this).find('span').text().trim();
            $('#diagnostic-subtitle').text(deviceName.toLowerCase());

            // Скрываем все проблемы
            $('.diagnostic-tag').hide();

            // Показываем проблемы выбранной категории
            const deviceProblems = $('.diagnostic-tag[data-device="' + currentDevice + '"]');

            if (deviceProblems.length > 0) {
                deviceProblems.show();
            } else {
                // Если нет проблем, можно показать сообщение (опционально)
                // Но по вашему запросу просто не показываем ничего
            }

            // Прокручиваем к проблемам
            $('html, body').animate({
                scrollTop: $('#diagnostics-list').offset().top - 260
            }, 600);
        });
    });
</script>