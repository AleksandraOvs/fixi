<?php
/* Template Name: Главная */
get_header();
?>

<div class="main">
    <?php get_template_part('parts/front-page/hero') ?>
    <?php get_template_part('parts/front-page/search-box'); ?>
    <?php get_template_part('parts/features'); ?>
    <div class="front-wrapper">
        <?php get_template_part('parts/front-page/about-us'); ?>
        <?php get_template_part('parts/front-page/reviews'); ?>
        <?php get_template_part('parts/front-page/faq-block'); ?>

    </div>

    <?php get_template_part('parts/front-page/team-block'); ?>
    <?php get_template_part('parts/front-page/cta-block'); ?>

    <script>
        document.addEventListener('DOMContentLoaded', function() {


            // === ЛОГИКА ФОРМЫ ДИАГНОСТИКИ ===

            const diagnosticsByDevice = <?php echo json_encode($diagnostics_by_device ?? [], JSON_UNESCAPED_UNICODE); ?>;
            if (!isset($diagnostics_by_device)) {
                $diagnostics_by_device = [];
            }
            const ctaDeviceTypeSelect = document.getElementById('cta-device-type');
            const ctaDiagnosticSelect = document.getElementById('cta-device-diagnostic');
            const ctaForm = document.getElementById('cta-diagnostic-form');

            // Функция обновления диагностик
            function updateCtaDiagnostics(deviceSlug) {
                const diagnostics = diagnosticsByDevice[deviceSlug] || [];

                ctaDiagnosticSelect.innerHTML = '<option value="" selected>Выберите неисправность</option>';

                if (diagnostics.length > 0) {
                    diagnostics.forEach(function(diagnostic) {
                        const option = document.createElement('option');
                        option.value = diagnostic.slug;
                        option.textContent = diagnostic.title;
                        option.setAttribute('data-device', deviceSlug);
                        option.setAttribute('data-url', diagnostic.url);
                        ctaDiagnosticSelect.appendChild(option);
                    });
                } else {
                    const option = document.createElement('option');
                    option.value = '';
                    option.textContent = 'Диагностики не найдены';
                    option.disabled = true;
                    ctaDiagnosticSelect.appendChild(option);
                }
            }

            // При смене типа устройства
            if (ctaDeviceTypeSelect) {
                ctaDeviceTypeSelect.addEventListener('change', function() {
                    const selectedDevice = this.value;
                    if (selectedDevice) {
                        updateCtaDiagnostics(selectedDevice);
                    }
                });
            }

            // Отправка формы
            if (ctaForm) {
                ctaForm.addEventListener('submit', function(e) {
                    e.preventDefault();

                    const deviceType = ctaDeviceTypeSelect.value;
                    const diagnosticSlug = ctaDiagnosticSelect.value;

                    if (!deviceType || !diagnosticSlug) {
                        alert('Пожалуйста, выберите устройство и неисправность');
                        return false;
                    }

                    // Получаем URL из выбранной опции
                    const selectedOption = ctaDiagnosticSelect.options[ctaDiagnosticSelect.selectedIndex];
                    const diagnosticUrl = selectedOption.getAttribute('data-url');

                    if (diagnosticUrl) {
                        // Переход на страницу диагностики
                        window.location.href = diagnosticUrl;
                    } else {
                        alert('Ошибка: URL диагностики не найден');
                    }

                    return false;
                });
            }
        });
    </script>

    <?php get_template_part('parts/callback'); ?>
    <?php get_template_part('parts/front-page/video-block'); ?>
    <?php get_template_part('parts/cta2'); ?>
    <?php get_template_part('parts/front-page/map-block'); ?>

</div>

<?php get_footer(); ?>