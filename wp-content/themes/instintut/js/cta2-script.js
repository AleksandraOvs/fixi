jQuery(document).ready(function ($) {
    // Данные из PHP
    const cta2DiagnosticsByDevice = <? php echo json_encode($diagnostics_by_device, JSON_UNESCAPED_UNICODE); ?>;

    // === ФУНКЦИЯ ОБНОВЛЕНИЯ ДИАГНОСТИК ДЛЯ CTA2 ===
    function updateCta2DiagnosticsSelect(deviceSlug) {
        const $diagnosticSelect = $('#cta2-device-diagnostic');
        const diagnostics = cta2DiagnosticsByDevice[deviceSlug] || [];

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

    // === ОБРАБОТЧИК ВЫБОРА УСТРОЙСТВА ===
    $('#cta2-device-type').on('change', function () {
        const selectedDevice = $(this).val();

        if (selectedDevice) {
            updateCta2DiagnosticsSelect(selectedDevice);
        }
    });

    // === ОТПРАВКА ФОРМЫ - ПЕРЕХОД НА СТРАНИЦУ ДИАГНОСТИКИ ===
    $('#cta2-diagnostic-form').on('submit', function (e) {
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