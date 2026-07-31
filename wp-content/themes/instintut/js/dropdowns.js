document.addEventListener('DOMContentLoaded', function () {

    // ========================================
    // 1. ОТКРЫТИЕ/ЗАКРЫТИЕ DROPDOWN МЕНЮ
    // ========================================

    const menuParents = document.querySelectorAll('.js-dropdown-parent');

    menuParents.forEach(parent => {
        const toggleBtn = parent.querySelector('.js-dropdown-toggle');

        if (!toggleBtn) return;

        toggleBtn.addEventListener('click', function (e) {



            const isOpen = parent.classList.contains('is-open');

            console.log('click', isOpen, this.href);
            // Если меню уже открыто — разрешаем переход по ссылке
            if (isOpen) {
                return;
            }

            if (isOpen) {
                console.log('GO');
                return;
            }

            console.log('OPEN');

            // Первый клик: только открываем меню
            e.preventDefault();
            e.stopPropagation();

            // Закрываем остальные
            menuParents.forEach(item => {
                item.classList.remove('is-open');
            });

            // Открываем текущее
            parent.classList.add('is-open');
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

            const isActive = this.classList.contains('is-active');

            // Если таб уже активен — разрешаем переход по ссылке
            if (isActive) {
                return;
            }

            // Первый клик — только открываем таб
            e.preventDefault();
            e.stopPropagation();

            const parentId = this.getAttribute('data-parent');
            const targetTabId = this.getAttribute('data-tab');

            const menuContainer = this.closest('.dropdown-menu');

            if (!menuContainer) return;

            // Убираем активность у всех табов
            menuContainer.querySelectorAll('.dropdown-tab').forEach(t => {
                t.classList.remove('is-active');
            });

            // Убираем активность у контента
            menuContainer.querySelectorAll('.dropdown-content').forEach(c => {
                c.classList.remove('is-active');
            });

            // Активируем текущий таб
            this.classList.add('is-active');

            // Показываем контент
            const targetContent = menuContainer.querySelector(
                `#${targetTabId}[data-parent="${parentId}"]`
            );

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

