 <?php
    /**
     * CTA блок "Узнать цену за 1 минуту"
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
    $models_by_device = [];

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

 <div class="cta">
     <div class="container">
         <div class="cta__in">
             <h2>Узнать цену за 1 минуту</h2>
             <div class="cta__form">
                 <form class="cta-search" method="GET" id="cta-diagnostic-form">

                     <!-- Вид устройства -->
                     <select class="search-form__input" id="cta-device-type" name="device" required>
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
                     <select class="search-form__input" id="cta-device-diagnostic" name="diagnostic" required>
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
                         Узнать цену
                     </button>
                 </form>
             </div>
         </div>
         <div class="cta__bot">
             <img src="/img/bot2.png" alt="Fixibot">
         </div>
     </div>
 </div>