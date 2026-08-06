<?php

/**
 * Services List Block - Динамический прайс-лист с фильтрами и базовыми ценами
 * Использует ACF поле models (Relationship), get_field('prices') текущей страницы и данные из device_model
 */

// Получаем текущий ID страницы услуги
$current_service_id = get_the_ID();

// 1. Получаем общие цены для текущей страницы (выводятся по умолчанию)
$page_prices = get_field('prices', $current_service_id) ?: [];
$has_page_prices = !empty($page_prices);

// 2. Получаем связанные модели через ACF Relationship поле
$related_models = get_field('models', $current_service_id);
// echo '<pre>';
// print_r($related_models);
// echo '</pre>';

// echo 'Current ID: ' . get_the_ID();
// echo '<br>';
// echo 'Queried ID: ' . get_queried_object_id();

// echo '<pre>';
// print_r($related_models);
// echo '</pre>';

if (empty($related_models) && !$has_page_prices) {
    echo '<div class="m-80"><p>Цены и модели устройств пока не добавлены к этой услуге.</p></div>';
    return;
}


// Собираем данные для фильтров и прайсов
$brands_data = [];
$models_data = [];
$pricing_data = [];
$all_problems = [];
$default_issue_model = ''; // slug модели-источника данных для issue selector (без плитки)

if (!empty($related_models)) {
    foreach ($related_models as $model_post) {
        $model_id = $model_post->ID;
        $model_title = get_the_title($model_id);

        // Получаем бренд из taxonomy
        $brand_terms = get_the_terms($model_id, 'brand');
        $brand_name = $brand_terms && !is_wp_error($brand_terms) ? $brand_terms[0]->name : 'Другие';
        $brand_slug = $brand_terms && !is_wp_error($brand_terms) ? $brand_terms[0]->slug : 'other';

        // Создаем slug для модели
        $model_slug = sanitize_title($model_title);

        $model_url = get_permalink($current_service_id);

        // echo '<pre>';
        // echo $model_title . ' → ' . $model_slug;
        // echo '</pre>';

        // Модели без URL — источники данных для issue selector, не показываются как плитки
        $brands_data[$brand_slug] = $brand_name;

        $models_data[] = [
            'slug'  => $model_slug,
            'title' => $model_title,
            'brand' => $brand_slug,
            'url'   => get_permalink($current_service_id),
        ];

        // Получаем прайс-лист из ACF repeater
        $prices = get_field('prices', $model_id);

        if ($prices && is_array($prices)) {
            foreach ($prices as $price_item) {
                $problem = isset($price_item['problem']) && !empty($price_item['problem']) ? sanitize_text_field($price_item['problem']) : 'Другая проблема';
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
                    'time' => isset($price_item['duration']) ? intval($price_item['duration']) : 0,
                    'service_link' => isset($price_item['service_link']) ? $price_item['service_link'] : '',
                ];
            }
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

$main_hidden = false;
if (count($brands_data) <= 1) {
    $main_hidden = true;
}
?>

<section class="services-list">
    <div class="container">
        <?php if (!empty($related_models)): ?>

            <div class="card">
                <div class="hero-tags" style="<?= $main_hidden ? 'display: none;' : '' ?>">
                    <h2>
                        Выберите марку устройства<br> <span class="accent">для ремонта</span>
                    </h2>
                    <div class="tags-list-in">
                        <ul class="tags-list" id="brand-list">
                            <?php
                            $first_brand = true;
                            foreach ($brands_data as $brand_slug => $brand_name):
                            ?>
                                <li>
                                    <a href="#" class="tag-link" data-brand="<?php echo esc_attr($brand_slug); ?>">
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

                <?php
                $h2_model = get_field('h2_model') ?: 'Выберите модель';
                ?>

                <div class="hero-tags">
                    <h2>Выберите модель<br> <span id="model-subtitle" class="accent"><?php echo esc_html(reset($brands_data) ?: ''); ?></span></h2>
                    <div class="tags-list-in">

                        <?php
                        // Популярные модели — показываются по умолчанию (индексируются)
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
                        $has_extra_models = false;
                        ?>
                        <ul class="tags-list" id="model-list">
                            <?php
                            if (!empty($brands_data)):
                                $first_brand_slug = array_key_first($brands_data);
                                $first_model = true;

                                if (isset($models_by_brand[$first_brand_slug])):

                                    $index = 0;

                                    foreach ($models_by_brand[$first_brand_slug] as $model):

                                        $is_hidden = $index >= 10;

                                        if ($is_hidden) {
                                            $has_extra_models = true;
                                        }
                            ?>
                                        <li class="model-item<?php echo $is_hidden ? ' model-item--extra' : ''; ?>"
                                            data-brand="<?php echo esc_attr($model['brand']); ?>"
                                            <?php echo $is_hidden ? ' style="display:none;"' : ''; ?>>

                                            <a href="#"
                                                class="tag-link"
                                                data-model="<?php echo esc_attr($model['slug']); ?>"
                                                <?php if (!empty($model['url'])): ?>
                                                data-url="<?php echo esc_url($model['url']); ?>"
                                                <?php endif; ?>>

                                                <span style="position:absolute;width:1px;height:1px;overflow:hidden;clip:rect(0,0,0,0);">Ремонт </span>
                                                <?php echo esc_html($model['title']); ?>
                                            </a>

                                        </li>
                                        <?php
                                        $index++;
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
                                                    <span style="position:absolute;width:1px;height:1px;overflow:hidden;clip:rect(0,0,0,0);">Ремонт </span><?php echo esc_html($model['title']); ?>
                                                </a>
                                            </li>
                            <?php
                                        endforeach;
                                    endif;
                                endforeach;
                            endif;
                            ?>
                        </ul>
                        <?php if ($has_extra_models): ?>
                            <a href="#" class="tag-link show-all tags-show-more" id="model-show-more">
                                Показать все модели ↓
                            </a>
                        <?php endif; ?>
                    </div>
                </div>

                <?php
                $h2_problem = get_field('h2_problem') ?: 'Какая проблема с устройством?<br> <span class="accent">Выберите неисправность</span>';
                ?>

                <div class="hero-tags">
                    <h2><?= $h2_problem ?></h2>
                    <div class="tags-list-in">
                        <ul class="tags-list" id="issue-list">
                        </ul>
                        <a href="#" class="tag-link show-all tags-show-more" id="issue-show-more" style="display:none;">
                            Показать все неисправности ↓
                        </a>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php
        $h2_prices = get_field('h2_price') ?: 'Цены за ремонт';
        ?>

        <div class="pricing-section">
            <h2><?= $h2_prices ?> для <?= esc_html($city_name) ?><br>
                <span id="pricing-title" class="accent">
                    <?= $has_page_prices ? 'Общий прайс' : 'Выберите неисправность...' ?>
                </span>

            </h2>

            <div class="pricing-table">
                <div class="pricing-table-header">
                    <div class="pricing-col">Вид ремонта</div>
                    <div class="pricing-col">Стоимость (₽)</div>
                    <div class="pricing-col">Время (мин.)</div>
                </div>

                <div id="pricing-content">
                    <!--noindex-->
                    <?php if ($has_page_prices) : ?>
                        <?php foreach ($page_prices as $item) : ?>
                            <div class="pricing-table-row">
                                <div class="pricing-col" data-label="Услуга:"><?= esc_html($item['title'] ?? '') ?></div>
                                <div class="pricing-col" data-label="Цена:"><?= esc_html($item['price'] ?? '0') ?> ₽</div>
                                <div class="pricing-col" data-label="Время:">от <?= esc_html($item['duration'] ?? '0') ?></div>
                            </div>
                        <?php endforeach; ?>
                    <?php elseif (empty($related_models)): ?>
                        <div class="no-results" style="padding: 20px; text-align: center;">Прайс-лист находится в стадии заполнения.</div>
                    <?php endif; ?>
                    <!--/noindex-->
                </div>
            </div>

            <div class="pricing-note">
                <?php
                $phone2 = get_field('phone_2', 'option') ?: [];
                $tg = get_field('tg', 'option') ?: [];
                $max = get_field('wa', 'option') ?: [];
                ?>
                <!-- Contact Info -->

                * Уточняйте стоимость по телефону

                <?php if ($phone2) : ?>
                    <?php $phone_link = preg_replace('/[^\d+]/', '', $phone2); ?>
                    <a href="tel:<?= esc_attr($phone_link); ?>">
                        <?= esc_html($phone2); ?>
                    </a>
                <?php else : ?>
                    <a href="tel:+73812478180">47-81-80</a>
                <?php endif; ?>

                или в

                <?php if ($max) : ?>
                    <a href="<?= esc_url($max); ?>" target="_blank" rel="noopener noreferrer">MAX</a>
                <?php else : ?>
                    MAX
                <?php endif; ?>

                /

                <?php if ($tg) : ?>
                    <a href="<?= esc_url($tg); ?>" target="_blank" rel="noopener noreferrer">Телеграм</a>
                <?php else : ?>
                    Telegram
                <?php endif; ?>

                +7 (908) 119-13-74.

            </div>
        </div>

        <!--noindex-->
        <script>
            jQuery(document).ready(function($) {
                // Данные из PHP
                const pricingData = <?php echo json_encode($pricing_data, JSON_UNESCAPED_UNICODE); ?>;
                const modelNames = <?php
                                    $model_names_js = [];
                                    foreach ($models_data as $model) {
                                        $model_names_js[$model['slug']] = $model['title'];
                                    }
                                    echo json_encode($model_names_js, JSON_UNESCAPED_UNICODE);
                                    ?>;
                const issueNames = <?php echo json_encode($all_problems, JSON_UNESCAPED_UNICODE); ?>;
                const hasPagePrices = <?php echo $has_page_prices ? 'true' : 'false'; ?>;

                // Текущее состояние
                let currentBrand = '<?php echo esc_js(!empty($brands_data) ? array_key_first($brands_data) : ''); ?>';
                // По умолчанию используем модель-источник данных (без плитки) для заполнения issue selector
                let currentModel = '<?php echo esc_js(!empty($default_issue_model) ? $default_issue_model : (!empty($models_data) ? $models_data[0]['slug'] : '')); ?>';
                let currentIssue = '';
                let isUserInteracted = false; // Флаг, чтобы понимать, трогал ли пользователь фильтры

                // Функция обновления списка доступных проблем
                function updateAvailableIssues() {
                    if (!currentModel) return;

                    const modelData = pricingData[currentModel];
                    const $issueList = $('#issue-list');
                    $issueList.empty();

                    if (!modelData || Object.keys(modelData).length === 0) {
                        $issueList.html('<li><span class="tag-link">Нет данных по поломкам</span></li>');
                        currentIssue = '';
                        return;
                    }

                    let isFirst = true;
                    let firstAvailableIssue = '';

                    for (const [issueSlug, issueLabel] of Object.entries(issueNames)) {
                        if (modelData.hasOwnProperty(issueSlug)) {

                            const activeClass = (isFirst && isUserInteracted) ? 'active' : '';

                            const li = `<li>
                    <a href="#" class="tag-link ${activeClass}" data-issue="${issueSlug}">
                        ${issueLabel}
                    </a>
                </li>`;

                            $issueList.append(li);

                            if (isFirst) {
                                firstAvailableIssue = issueSlug;
                                isFirst = false;
                            }
                        }
                    }

                    currentIssue = firstAvailableIssue; // ← currentIssue уже актуален когда придёт updatePricing

                    // Hide extra items after limit, reset button state
                    var _limit = 5;
                    var _btn = document.getElementById('issue-show-more');
                    $issueList.children().each(function(i, el) {
                        $(el).removeClass('tag-extra');
                        if (i >= _limit) {
                            $(el).addClass('tag-extra').hide();
                        } else {
                            $(el).show();
                        }
                    });
                    if (_btn) {
                        if ($issueList.children().length > _limit) {
                            _btn.textContent = 'Показать все неисправности ↓';
                            _btn.style.display = 'flex';
                        } else {
                            _btn.style.display = 'none';
                        }
                    }
                }

                // Функция обновления таблицы прайса
                function updatePricing() {
                    // Если есть общие цены и юзер еще ничего не кликал - ничего не перезаписываем
                    if (hasPagePrices && !isUserInteracted) {
                        return;
                    }

                    if (!currentModel) return;

                    const modelData = pricingData[currentModel];
                    if (modelData && !modelData[currentIssue]) {
                        currentIssue = Object.keys(modelData)[0] || '';

                        setTimeout(function() {
                            $('#issue-list .tag-link').removeClass('active');
                            $('#issue-list .tag-link').first().addClass('active');
                        }, 0);
                    }

                    const issueData = (modelData && currentIssue) ? modelData[currentIssue] : null;
                    const modelName = modelNames[currentModel] || currentModel;
                    const issueName = issueNames[currentIssue] || 'Услуги для ' + modelName;

                    $('#pricing-title').text(issueName);

                    if (issueData && issueData.length > 0) {
                        let html = '';
                        issueData.forEach(function(item) {
                            html += '<div class="pricing-table-row">';

                            // Проверяем наличие service_link
                            if (item.service_link && item.service_link.trim() !== '') {
                                html += '<div class="pricing-col" data-label="Услуга:"><a href="' + item.service_link + '">' + item.service + '</a></div>';
                            } else {
                                html += '<div class="pricing-col" data-label="Услуга:">' + item.service + '</div>';
                            }

                            html += '<div class="pricing-col" data-label="Цена:">' + item.price.toLocaleString('ru-RU') + ' ₽</div>';
                            html += '<div class="pricing-col" data-label="Время:">от ' + item.time + '</div>';
                            html += '</div>';
                        });
                        $('#pricing-content').html(html);
                    } else {
                        $('#pricing-content').html('<div class="no-results" style="padding: 20px; text-align: center;">Для выбранной модели и неисправности цены уточняются.</div>');
                    }
                }

                // --- ОБРАБОТЧИКИ СОБЫТИЙ ---

                // 1. Выбор БРЕНДА
                $('#brand-list').on('click', '.tag-link', function(e) {
                    e.preventDefault();
                    isUserInteracted = true; // Снимаем блокировку перезаписи прайса

                    $('#brand-list .tag-link').removeClass('active');
                    $(this).addClass('active');

                    currentBrand = $(this).data('brand');
                    $('#model-subtitle').text($(this).text());

                    $('.model-item').hide();

                    const $brandModels = $('.model-item[data-brand="' + currentBrand + '"]');

                    $brandModels.each(function(index) {
                        if (index < 10) {
                            $(this).show();
                        } else {
                            $(this).hide().addClass('model-item--extra');
                        }
                    });

                    $('#model-show-more')
                        .text('Показать все модели ↓')
                        .toggle($brandModels.length > 10);

                    if ($brandModels.length > 0) {
                        const $firstModelLink = $brandModels.first().find('.tag-link');
                        $('#model-list .tag-link').removeClass('active');
                        $firstModelLink.addClass('active');
                        currentModel = $firstModelLink.data('model');
                    }

                    updateAvailableIssues();
                    updatePricing();
                });

                // 2. Выбор МОДЕЛИ
                $('#model-list').on('click', '.tag-link', function(e) {
                    e.preventDefault();
                    if ($(this).data('action') === 'show-all') return;

                    const targetUrl = $(this).data('url');
                    if (targetUrl) {
                        window.location.href = targetUrl;
                        return;
                    }

                    isUserInteracted = true;

                    $('#model-list .tag-link').removeClass('active');
                    $(this).addClass('active');

                    currentModel = $(this).data('model');

                    updateAvailableIssues();
                    updatePricing();
                });

                // Кнопка "Показать все неисправности"
                $('#issue-show-more').on('click', function(e) {
                    e.preventDefault();
                    var extras = $('#issue-list .tag-extra');
                    if (extras.first().is(':hidden')) {
                        extras.show();
                        $(this).text('Свернуть ↑');
                    } else {
                        extras.hide();
                        $(this).text('Показать все неисправности ↓');
                    }
                });

                // 3. Выбор ПРОБЛЕМЫ
                $('#issue-list').on('click', '.tag-link', function(e) {
                    e.preventDefault();

                    isUserInteracted = true;

                    $('#issue-list .tag-link').removeClass('active');
                    $(this).addClass('active');

                    currentIssue = $(this).data('issue');
                    updatePricing();
                });

                // Инициализация при первой загрузке
                updateAvailableIssues();

                // Показать все модели
                $('#model-show-more').on('click', function(e) {
                    e.preventDefault();
                    var brand = '<?php echo esc_js(!empty($brands_data) ? array_key_first($brands_data) : ''); ?>';
                    var $extras = $('.model-item--extra[data-brand="' + (currentBrand || brand) + '"]');
                    if ($extras.first().is(':hidden')) {
                        $extras.show();
                        $(this).text('Свернуть ↑');
                    } else {
                        $extras.hide();
                        $(this).text('Показать все модели ↓');
                    }
                });

                updatePricing();
            });
        </script><!--/noindex-->
    </div>
</section>