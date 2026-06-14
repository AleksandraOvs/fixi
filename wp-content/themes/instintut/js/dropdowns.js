document.addEventListener('DOMContentLoaded', function () {

    // ========================================
    // 1. ОТКРЫТИЕ/ЗАКРЫТИЕ DROPDOWN МЕНЮ
    // ========================================

    const menuParents = document.querySelectorAll('.js-dropdown-parent');

    menuParents.forEach(parent => {
        const toggleBtn = parent.querySelector('.js-dropdown-toggle');

        if (!toggleBtn) return; // Защита от ошибок

        // Клик по кнопке открытия меню
        toggleBtn.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();

            const isOpen = parent.classList.contains('is-open');

            // Закрываем все другие открытые меню
            menuParents.forEach(item => {
                if (item !== parent) {
                    item.classList.remove('is-open');
                }
            });

            // Переключаем текущее меню
            if (isOpen) {
                parent.classList.remove('is-open');
            } else {
                parent.classList.add('is-open');
            }
        });
    });

    // Закрытие при клике вне меню
    document.addEventListener('click', function (e) {
        // Проверяем, был ли клик вне всех dropdown меню
        if (!e.target.closest('.js-dropdown-parent')) {
            menuParents.forEach(parent => {
                parent.classList.remove('is-open');
            });
        }
    });

    // Закрытие при нажатии ESC
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            menuParents.forEach(parent => {
                parent.classList.remove('is-open');
            });
        }
    });


    // ========================================
    // 2. ПЕРЕКЛЮЧЕНИЕ ТАБОВ ВНУТРИ DROPDOWN
    // ========================================

    const tabs = document.querySelectorAll('.dropdown-tab');

    tabs.forEach(tab => {
        tab.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();

            // Получаем ID родительского dropdown
            const parentId = this.getAttribute('data-parent');
            const targetTabId = this.getAttribute('data-tab');

            // Находим родительский контейнер dropdown
            const menuContainer = this.closest('.dropdown-menu');

            if (!menuContainer) return;

            // Убираем активность у всех табов в ЭТОМ dropdown
            menuContainer.querySelectorAll('.dropdown-tab').forEach(t => {
                t.classList.remove('is-active');
            });

            // Убираем активность у всего контента в ЭТОМ dropdown
            menuContainer.querySelectorAll('.dropdown-content').forEach(c => {
                c.classList.remove('is-active');
            });

            // Активируем нажатый таб
            this.classList.add('is-active');

            // Активируем соответствующий контент
            const targetContent = menuContainer.querySelector(`#${targetTabId}[data-parent="${parentId}"]`);
            if (targetContent) {
                targetContent.classList.add('is-active');
            }
        });
    });


    // ========================================
    // 3. ЗАКРЫТИЕ ПРИ КЛИКЕ НА ССЫЛКУ ВНУТРИ
    // ========================================

    const dropdownLinks = document.querySelectorAll('.dropdown-content a');

    dropdownLinks.forEach(link => {
        link.addEventListener('click', function () {
            // Закрываем все dropdown при переходе по ссылке
            menuParents.forEach(parent => {
                parent.classList.remove('is-open');
            });
        });
    });


    // ========================================
    // 4. АДАПТИВНОСТЬ (опционально)
    // ========================================

    // Если нужно закрывать меню при изменении размера экрана
    let resizeTimer;
    window.addEventListener('resize', function () {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(function () {
            menuParents.forEach(parent => {
                parent.classList.remove('is-open');
            });
        }, 250);
    });
});

