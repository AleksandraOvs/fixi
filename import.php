<?php
/**
 * Скрипт для импорта иерархической структуры услуг в CPT services
 * Запустить один раз: добавить в functions.php и открыть страницу /?import_services=1
 * После импорта удалить код!
 */

function import_services_structure() {
    // Проверка для запуска импорта
    if (!isset($_GET['import_services']) || $_GET['import_services'] != '1') {
        return;
    }

    // Проверка прав доступа
    if (!current_user_can('manage_options')) {
        wp_die('Недостаточно прав для импорта');
    }

    // Структура данных из HTML
    $services_structure = array(
        'Ремонт техники Apple' => array(
            'slug' => 'remont-apple',
            'children' => array(
                'Ремонт iPhone' => array(
                    'slug' => 'remont-iphone',
                    'children' => array(
                        'iPhone 17, 17 Pro, 17 Pro Max, Air' => 'remont-iphone-17-17pro-17promax-air',
                        'iPhone 16, 16 Plus, 16 Pro, 16 Pro Max, 16e' => 'remont-iphone-16-16plus-16pro-16promax-16e',
                        'iPhone 15, 15 Plus, 15 Pro, 15 Pro Max' => 'remont-iphone-15-15plus-15pro-15promax',
                        'iPhone 14, 14 Plus, 14 Pro, 14 Pro Max' => 'remont-iphone-14-14plus-14pro-14promax',
                        'iPhone 13, 13 mini, 13 Pro, 13 Pro Max' => 'remont-iphone-13-13mini-13pro-13promax',
                        'iPhone 12, 12 mini, 12 Pro, 12 Pro Max' => 'remont-iphone-12-12mini-12pro-12promax',
                        'iPhone 11, 11 Pro, 11 Pro Max' => 'remont-iphone-11-11pro-11promax',
                        'iPhone X, XS, XS Max, XR' => 'remont-iphone-x-xs-xsmax-xr',
                        'iPhone SE, SE 2' => 'remont-iphone-se-se2',
                        'iPhone 8, 8 Plus' => 'remont-iphone-8-8plus',
                        'iPhone 7, 7 Plus' => 'remont-iphone-7-7plus',
                        'iPhone 6s, 6s Plus' => 'remont-iphone-6s-6splus',
                    )
                ),
                'Ремонт iPad' => array(
                    'slug' => 'remont-ipad',
                    'children' => array(
                        'iPad 3, 4' => 'remont-ipad-3-4',
                        'iPad 5, 6, 7, 8' => 'remont-ipad-5-6-7-8',
                        'iPad 9, 10' => 'remont-ipad-9-10',
                        'iPad Air, Air 2' => 'remont-ipad-air-air2',
                        'iPad Air 3, Air 4, Air 5' => 'remont-ipad-air3-air4-air5',
                        'iPad Mini, Mini 2, Mini 3, Mini 4, Mini 5, Mini 6' => 'remont-ipad-mini-mini2-mini3-mini4-mini5-mini6',
                        'iPad Pro' => 'remont-ipad-pro',
                    )
                ),
                'Ремонт Apple Watch' => array(
                    'slug' => 'remont-apple-watch',
                    'children' => array(
                        'Apple Watch Series 2' => 'remont-apple-watch-series-2',
                        'Apple Watch Series 3' => 'remont-apple-watch-series-3',
                        'Apple Watch Series 4' => 'remont-apple-watch-series-4',
                        'Apple Watch Series 5' => 'remont-apple-watch-series-5',
                        'Apple Watch Series 6' => 'remont-apple-watch-series-6',
                        'Apple Watch Series SE, SE 2' => 'remont-apple-watch-series-se-se2',
                        'Apple Watch Series 7' => 'remont-apple-watch-series-7',
                        'Apple Watch Series 8, 9' => 'remont-apple-watch-series-8-9',
                        'Apple Watch Series Ultra, Ultra 2' => 'remont-apple-watch-ultra-ultra2',
                    )
                ),
                'Ремонт MacBook' => 'remont-macbook',
                'Ремонт iMac' => 'remont-imac',
            )
        ),
        'Ремонт телефонов' => array(
            'slug' => 'remont-telefonov',
            'children' => array(
                'Ремонт Samsung' => array(
                    'slug' => 'remont-smsng',
                    'children' => array(
                        'Galaxy A73' => 'remont-smsng-galaxy-a73',
                        'Galaxy S23, S23 Plus, S23 Ultra' => 'remont-smsng-galaxy-s23-s23plus-s23ultra',
                        'Galaxy A33' => 'remont-smsng-galaxy-a33',
                        'Galaxy A10, A20, A30' => 'remont-smsng-galaxy-a10-20-a30',
                        'Galaxy A30s' => 'remont-smsng-galaxy-a30s',
                        'Galaxy A22' => 'remont-smsng-galaxy-a22',
                        'Galaxy S21, Galaxy S21+, Galaxy S21 Ultra' => 'remont-smsng-galaxy-s21-s21plus-s21ultra',
                        'Galaxy M12' => 'remont-smsng-galaxy-m12',
                        'Galaxy S20 FE, S21 FE' => 'remont-smsng-galaxy-s20fe-s21fe',
                        'Galaxy S22, Galaxy S22 Ultra' => 'remont-smsng-galaxy-s22-s22ultra',
                        'Galaxy A23' => 'remont-smsng-galaxy-a23',
                        'Galaxy A02' => 'remont-smsng-galaxy-a02',
                        'Galaxy A32, A52, A72' => 'remont-smsng-galaxy-a32-a52-a72',
                        'Galaxy A21s' => 'remont-smsng-galaxy-a21s',
                        'Galaxy A31, A51' => 'remont-smsng-galaxy-a31-a51',
                        'Galaxy A40, A50, A70' => 'remont-smsng-galaxy-a40-a50-a70',
                        'Galaxy Note 9, 10' => 'remont-smsng-galaxy-note-9-10',
                        'Galaxy Note20, Note20 Ultra' => 'remont-smsng-galaxy-note20-note20ultra',
                        'Galaxy S10, S10 Plus' => 'remont-smsng-galaxy-s10-s10plus',
                        'Galaxy S10e' => 'remont-smsng-galaxy-s10e',
                        'Galaxy S20 Ultra, S20 Plus' => 'remont-smsng-galaxy-s20plus-s20ultra',
                        'Galaxy S21 5G' => 'remont-smsng-galaxy-s21',
                        'Galaxy S6 Edge Plus' => 'remont-smsng-galaxy-s6edgeplus',
                        'Galaxy S7 Edge' => 'remont-smsng-galaxy-s7edge',
                        'Galaxy S8, S8 Plus' => 'remont-smsng-galaxy-s8-s8plus',
                        'Galaxy S9, S9 Plus' => 'remont-smsng-galaxy-s9-s9plus',
                        'Galaxy Z Flip, Z Fold 4' => 'remont-smsng-galaxy-zflip-zfold4',
                        'Galaxy S20 FE' => 'remont-smsng-galaxy-s20fe',
                        'Galaxy A32 5G' => 'remont-smsng-galaxy-a325g',
                        'Galaxy A54' => 'remont-smsng-galaxy-a54',
                        'Galaxy A13' => 'remont-smsng-galaxy-a13',
                        'Galaxy A15, A13' => 'remont-smsng-galaxy-a13-a15',
                        'Galaxy M31s' => 'remont-smsng-galaxy-m31s',
                    )
                ),
                'Ремонт Honor' => array(
                    'slug' => 'remont-xonor',
                    'children' => array(
                        '50, 50 lite' => 'remont-xonor-50-50lite',
                        '20E' => 'remont-xonor-20e',
                        '10, 10 Lite' => 'remont-xonor-10-10lite',
                        '70, 70 Pro, 70 Pro Plus' => 'remont-xonor-70-70pro-70proplus',
                        'X7, X8' => 'remont-xonor-x7-x8',
                        'X9a' => 'remont-xonor-x9a',
                        '10i, 20i, 30i' => 'remont-xonor-10i-20i-30i',
                        '7C, 7C Lite' => 'remont-xonor-7c-7clite',
                        '20, 20 Lite, 20 Pro' => 'remont-xonor-20-20pro-20lite',
                        '20S, 30S' => 'remont-xonor-20s-30s',
                        '30, 30 Pro, 30 Pro Plus' => 'remont-xonor-30-30pro-30proplus',
                        '6X' => 'remont-xonor-6x',
                        '6' => 'remont-xonor-6',
                        '7, 7 Lite, 7 Pro' => 'remont-xonor-7-7lite-7pro',
                        '7A' => 'remont-xonor-7a',
                        '8S, 9S' => 'remont-xonor-8s-9s',
                        '7X, 9X, 10X Lite' => 'remont-xonor-7x-9x-10xlite',
                        '8' => 'remont-xonor-8',
                        '8A, 8A Lite' => 'remont-xonor-8a-8alite',
                        '8C, 9C' => 'remont-xonor-8c-9c',
                        '8X' => 'remont-xonor-8x',
                        '9, 9 Lite' => 'remont-xonor-9-9lite',
                        '9A' => 'remont-xonor-9a',
                        'View 20, View 40' => 'remont-xonor-view20-view40',
                        'X7' => 'x7',
                    )
                ),
                'Ремонт Xiaomi' => array(
                    'slug' => 'remont-xiaomi',
                    'children' => array(
                        '12, 12 Pro' => 'remont-xiaomi-12-12pro',
                        '11T, 11T Pro' => 'remont-xiaomi-11t-11tpro',
                        '12X' => 'remont-xiaomi-redmi-12x',
                        '13, 13 Lite' => 'remont-xiaomi-13-13lite',
                        'Mi 11 Pro, Mi 11 Lite , 11 Lite NE' => 'remont-xiaomi-mi-11pro-11lite-11litene',
                        'MI 9T, MI 9T Pro' => 'remont-xiaomi-mi9t-mi9tpro',
                        'Mi Note 10, Mi Note 10 Lite' => 'remont-xiaomi-mi-note10-note10lite',
                        'Mi Note 2' => 'remont-xiaomi-mi-note2',
                        'Poco X5, X5 Pro' => 'remont-xiaomi-poco-x5-x5pro',
                        'Redmi 5 Plus' => 'remont-xiaomi-redmi-5-5plus',
                        'Redmi 7, 7A' => 'remont-xiaomi-redmi-7-7a',
                        'Redmi 8, 9' => 'remont-xiaomi-redmi8-redmi9',
                        'Redmi 9C, 10C, 12C' => 'remont-xiaomi-redmi-9c-10c-12c',
                        'Redmi Note 4' => 'remont-xiaomi-redmi-note4',
                        'Redmi Note 5' => 'remont-xiaomi-redmi-note5',
                        'Redmi Note 7, 9' => 'remont-xiaomi-redmi-note7-note9',
                        'Redmi Note 8 , Note 8 Pro' => 'remont-xiaomi-note8-note8pro',
                        'Redmi Note 8T, Note 9T' => 'remont-xiaomi-redmi-note8t-note9t',
                        'Redmi 10, 12' => 'remont-xiaomi-redmi-10-12',
                        'Redmi 10c' => 'remont-xiaomi-redmi-10c',
                        'Redmi 12c' => 'remont-xiaomi-redmi-12c',
                        'Redmi 12' => 'remont-xiaomi-redmi-12',
                        'Redmi Note 10S' => 'remont-xiaomi-redmi-note10s',
                        'Redmi Note 11 Pro' => 'remont-xiaomi-redmi-note11pro',
                        'Redmi Note 11S' => 'remont-xiaomi-redmi-note11s',
                        'Poco M3' => 'remont-xiaomi-poco-m3',
                        'Poco F3' => 'remont-xiaomi-poco-f3',
                        'Redmi Note 11, 11 Pro, 11S' => 'remont-xiaomi-redmi-note11-11s-11pro',
                        'Redmi Note 12, 12S, 12 Pro' => 'remont-xiaomi-redmi-note12-12s-12pro',
                        'Poco X3, X3 Pro' => 'remont-xiaomi-poco-x3-x3pro',
                        'Poco M4 Pro' => 'remont-xiaomi-poco-m4pro',
                    )
                ),
                'Ремонт Huawei' => array(
                    'slug' => 'remont-huavej',
                    'children' => array(
                        'Ascend P7' => 'remont-huavej-ascend-p7',
                        'Mate 20 Pro' => 'remont-huavej-mate-20pro',
                        'Mate 40 Pro' => 'remont-huawei-mate40pro',
                        'Nova 8, Nova 8i' => 'remont-huavej-nova-8-8i',
                        'P30 lite New Edition' => 'remont-huavej-p30litenewedition',
                        'Y5p, Y6p' => 'remont-huavej-y5p-y6p',
                        'Mate Xs' => 'remont-huavej-mate-xs',
                        'Y6s' => 'remont-huavej-y6s',
                        'P50 Pro' => 'remont-huavej-p50pro',
                        'Nova 9' => 'remont-huavej-nova-9',
                        'Nova 10 Pro' => 'remont-huawei-nova-10pro',
                        'Nova Y90' => 'remont-huawei-nova-y90',
                        'Nova 2s' => 'remont-huavej-nova2s',
                        'Nova, Nova 3' => 'remont-huavej-nova-nova3',
                        'P Smart' => 'remont-huavej-p-smart',
                        'P20, P20 Lite, P20 Pro' => 'remont-huavej-p20-p20lite-p20pro',
                        'P30, P30 Lite, P30 Pro' => 'remont-huavej-p30-p30lite-p30pro',
                        'P40, P40 Lite, P40 Pro' => 'remont-huavej-p40-p40lite-p40pro',
                        'P9 Pro' => 'remont-huavej-p9pro',
                        'Y5' => 'remont-huavej-y5',
                        'Mate X3' => 'remont-huavej-mate-x3',
                    )
                ),
                'Ремонт Meizu' => array(
                    'slug' => 'remont-meizu',
                    'children' => array(
                        '16xs' => 'remont-meizu-16xs',
                        'MX2' => 'remont-meizu-mx2',
                        'MX4' => 'remont-meizu-mx4',
                    )
                ),
                'Ремонт ASUS' => array(
                    'slug' => 'remont-asus',
                    'children' => array(
                        'ROG Phone 5s' => 'remont-asus-rogphone5s',
                        'Zenfone 7, Zenfone 8' => 'remont-asus-zenfone-7-8',
                        'Zenfone Go' => 'remont-asus-zenfone-go',
                        'ZenFone 7 Pro' => 'remont-asus-zenfone-7pro',
                        'ZenFone 8 Flip' => 'remont-asus-zenfone-8flip',
                    )
                ),
                'Ремонт Blackview' => 'remont-blackview',
                'Ремонт Digma' => 'remont-digma',
                'Ремонт Highscreen' => 'remont-highscreen',
                'Ремонт HTC' => 'remont-htc',
                'Ремонт Lenovo' => array(
                    'slug' => 'remont-lenovo',
                    'children' => array(
                        'K12 Pro' => 'remont-lenovo-k12pro',
                        'K910 Vibe Z' => 'remont-lenovo-k910-vibe-z',
                        'Vibe Z2' => 'remont-lenovo-vibe-z2',
                    )
                ),
                'Ремонт Motorola' => 'remont-motorola',
                'Ремонт Nokia' => array(
                    'slug' => 'remont-nokia',
                    'children' => array(
                        'G21' => 'remont-nokia-g21',
                    )
                ),
                'Ремонт OnePlus' => array(
                    'slug' => 'remont-oneplus',
                    'children' => array(
                        'OnePlus 9 Pro' => 'remont-oneplus-9pro',
                        '9RT' => 'remont-oneplus-9rt',
                    )
                ),
                'Ремонт OPPO' => array(
                    'slug' => 'remont-oppo',
                    'children' => array(
                        'Reno 6' => 'remont-oppo-reno-6',
                        'A1K' => 'remont-oppo-a1k',
                        'A52, A53' => 'remont-oppo-a52-a53',
                        'A5s, A5' => 'remont-oppo-a5-a5s',
                        'A7, A9' => 'remont-oppo-a7-a9',
                        'A71, A72' => 'remont-oppo-a71-a72',
                        'A91' => 'remont-oppo-a91',
                    )
                ),
            )
        ),
        'Ремонт компьютерной техники' => array(
            'slug' => 'remont-komputerov',
            'children' => array(
                'Ремонт ноутбуков' => array(
                    'slug' => 'remont-noutbukov',
                    'children' => array(
                        'Ремонт ноутбуков Acer' => 'remont-noutbukov-acer',
                        'Ремонт ноутбуков Apple' => 'remont-noutbukov-apple',
                        'Ремонт ноутбуков Asus' => 'remont-noutbukov-asus',
                        'Ремонт ноутбуков Dell' => 'remont-noutbukov-dell',
                        'Ремонт ноутбуков HP' => 'remont-noutbukov-hp',
                        'Ремонт ноутбуков Lenovo' => 'remont-noutbukov-lenovo',
                        'Ремонт ноутбуков MSI' => 'remont-noutbukov-msi',
                        'Ремонт ноутбуков Samsung' => 'remont-noutbukov-samsung',
                        'Ремонт ноутбуков Sony' => 'remont-noutbukov-sony',
                        'Ремонт ноутбуков Toshiba' => 'remont-noutbukov-toshiba',
                        'Ремонт ноутбуков Xiaomi' => 'remont-noutbukov-xiaomi',
                        'Ремонт ноутбуков Huawei' => 'remont-noutbukov-huavej',
                    )
                ),
            )
        ),
        'Ремонт планшетов' => array(
            'slug' => 'remont-planshetov',
            'children' => array(
                'Ремонт планшетов Asus' => 'remont-planshetov-asus',
                'Ремонт планшетов Huawei' => 'remont-planshetov-huavej',
                'Ремонт планшетов Lenovo' => 'remont-planshetov-lenovo',
                'Ремонт планшетов LG' => 'remont-planshetov-lg',
                'Ремонт планшетов Nokia' => 'remont-planshetov-nokia',
                'Ремонт планшетов Samsung' => 'remont-planshetov-samsung',
                'Ремонт планшетов Sony' => 'remont-planshetov-sony',
                'Ремонт планшетов Xiaomi' => 'remont-planshetov-xiaomi',
            )
        ),
        'Ремонт других устройств' => array(
            'slug' => 'remont-drugix-ustrojstv',
            'children' => array(
                'Ремонт компьютеров' => 'remont-computerov',
                'Ремонт игровых приставок' => 'remont-igrovykh-pristavok',
            )
        ),
    );

    // Рекурсивная функция для создания записей
    function create_service_posts($structure, $parent_id = 0, $level = 0) {
        $created_count = 0;
        
        foreach ($structure as $title => $data) {
            $slug = '';
            $children = array();
            
            // Определяем slug и дочерние элементы
            if (is_array($data)) {
                $slug = isset($data['slug']) ? $data['slug'] : sanitize_title($title);
                $children = isset($data['children']) ? $data['children'] : array();
            } else {
                $slug = $data;
            }
            
            // Проверяем, существует ли уже запись с таким slug
            $existing = get_page_by_path($slug, OBJECT, 'services');
            
            if ($existing) {
                echo "<p style='color: orange;'>Пропущено (уже существует): {$title} (ID: {$existing->ID})</p>";
                $post_id = $existing->ID;
            } else {
                // Создаем запись
                $post_data = array(
                    'post_title'    => $title,
                    'post_name'     => $slug,
                    'post_type'     => 'services',
                    'post_status'   => 'publish',
                    'post_parent'   => $parent_id,
                    'post_content'  => '', // Контент можно добавить позже
                    'menu_order'    => 0,
                );
                
                $post_id = wp_insert_post($post_data);
                
                if ($post_id && !is_wp_error($post_id)) {
                    $created_count++;
                    $indent = str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', $level);
                    echo "<p style='color: green;'>{$indent}✓ Создано: {$title} (ID: {$post_id}, Parent: {$parent_id})</p>";
                } else {
                    $indent = str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', $level);
                    echo "<p style='color: red;'>{$indent}✗ Ошибка при создании: {$title}</p>";
                    continue;
                }
            }
            
            // Рекурсивно создаем дочерние записи
            if (!empty($children)) {
                $created_count += create_service_posts($children, $post_id, $level + 1);
            }
        }
        
        return $created_count;
    }
    
    // Запускаем импорт
    echo '<div style="padding: 20px; font-family: Arial, sans-serif;">';
    echo '<h1>Импорт структуры услуг</h1>';
    echo '<hr>';
    
    $start_time = microtime(true);
    $total_created = create_service_posts($services_structure);
    $end_time = microtime(true);
    $execution_time = round($end_time - $start_time, 2);
    
    echo '<hr>';
    echo "<h2 style='color: #2271b1;'>Импорт завершен!</h2>";
    echo "<p><strong>Создано записей:</strong> {$total_created}</p>";
    echo "<p><strong>Время выполнения:</strong> {$execution_time} сек.</p>";
    echo "<p style='color: red;'><strong>ВАЖНО:</strong> Удалите этот код из functions.php после импорта!</p>";
    echo "<p><a href='/wp-admin/edit.php?post_type=services' style='text-decoration: none; background: #2271b1; color: white; padding: 10px 20px; border-radius: 3px; display: inline-block; margin-top: 10px;'>Посмотреть все услуги</a></p>";
    echo '</div>';
    
    // Сбрасываем rewrite rules
    flush_rewrite_rules();
    
    exit;
}
add_action('init', 'import_services_structure');
