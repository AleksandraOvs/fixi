document.addEventListener('DOMContentLoaded', () => {
    jQuery(document).ready(function ($) {
        // Данные из PHP
        const pricingData = <? php echo json_encode($pricing_data, JSON_UNESCAPED_UNICODE); ?>;
        const modelNames = <? php
                                    $model_names_js = [];
        foreach($models_data as $model) {
            $model_names_js[$model['slug']] = $model['title'];
        }
                                    echo json_encode($model_names_js, JSON_UNESCAPED_UNICODE);
                                    ?>;
        const issueNames = <? php echo json_encode($all_problems, JSON_UNESCAPED_UNICODE); ?>;
        const hasPagePrices = <? php echo $has_page_prices ? 'true' : 'false'; ?>;

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
            $issueList.children().each(function (i, el) {
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

                setTimeout(function () {
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
                issueData.forEach(function (item) {
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
        $('#brand-list').on('click', '.tag-link', function (e) {
            e.preventDefault();
            isUserInteracted = true; // Снимаем блокировку перезаписи прайса

            $('#brand-list .tag-link').removeClass('active');
            $(this).addClass('active');

            currentBrand = $(this).data('brand');
            $('#model-subtitle').text($(this).text());

            $('.model-item').hide();

            const $brandModels = $('.model-item[data-brand="' + currentBrand + '"]');

            $brandModels.each(function (index) {
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
        $('#model-list').on('click', '.tag-link', function (e) {
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
        $('#issue-show-more').on('click', function (e) {
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
        $('#issue-list').on('click', '.tag-link', function (e) {
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
        $('#model-show-more').on('click', function (e) {
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

});