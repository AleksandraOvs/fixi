jQuery(document).ready(function ($) {
    // Данные из PHP
    const diagnosticsByDevice = <? php echo json_encode($diagnostics_by_device, JSON_UNESCAPED_UNICODE); ?>;

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

    $('.device-category-filter.active').each(function () {
        toggleIconOnActive($(this));
    });

    // === ОБНОВЛЕНИЕ SELECT С ДИАГНОСТИКАМИ ===
    function updateDiagnosticsSelect(deviceSlug) {
        const $diagnosticSelect = $('#device-diagnostic');
        const diagnostics = diagnosticsByDevice[deviceSlug] || [];

        $diagnosticSelect.html('<option value="" selected>Выберите неисправность</option>');

        if (diagnostics.length > 0) {
            diagnostics.forEach(function (diagnostic) {
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
    $('.device-category-filter').on('click', function (e) {
        e.preventDefault();

        $('.device-category-filter').each(function () {
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
    $('#device-type').on('change', function () {
        const selectedDevice = $(this).val();

        if (selectedDevice) {
            currentDevice = selectedDevice;

            updateDiagnosticsSelect(selectedDevice);
            updateVisualModels(selectedDevice);

            $('.device-category-filter').each(function () {
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
    $('.model-tag a').on('click', function (e) {
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
    $('#diagnostic-search-form').on('submit', function (e) {
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

    $(document).on('click', '.show-all-models', function (e) {
        e.preventDefault();
        $('.model-tag').show();
        $('#device-subtitle').text('все варианты');
    });
});