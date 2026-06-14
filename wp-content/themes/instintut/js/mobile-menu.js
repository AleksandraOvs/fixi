document.addEventListener('DOMContentLoaded', function () {

    // ========================================
    // АККОРДЕОН МОБИЛЬНОГО МЕНЮ
    // ========================================

    // Главные пункты с dropdown
    const mainToggles = document.querySelectorAll('.mobile-nav__toggle');

    mainToggles.forEach(toggle => {
        toggle.addEventListener('click', function (e) {
            e.preventDefault();

            const targetId = this.getAttribute('data-target');
            const dropdown = document.getElementById(targetId);

            if (!dropdown) return;

            const isOpen = dropdown.classList.contains('is-open');

            // Закрываем все другие dropdown на том же уровне
            document.querySelectorAll('.mobile-nav__dropdown.is-open').forEach(item => {
                if (item !== dropdown) {
                    item.classList.remove('is-open');
                    const otherToggle = document.querySelector(`[data-target="${item.id}"].mobile-nav__toggle`);
                    if (otherToggle) otherToggle.setAttribute('aria-expanded', 'false');
                }
            });

            // Переключаем текущий dropdown
            if (isOpen) {
                dropdown.classList.remove('is-open');
                this.setAttribute('aria-expanded', 'false');
            } else {
                dropdown.classList.add('is-open');
                this.setAttribute('aria-expanded', 'true');
            }
        });
    });

    // Табы внутри dropdown
    const tabToggles = document.querySelectorAll('.mobile-nav__tab-title');

    tabToggles.forEach(toggle => {
        toggle.addEventListener('click', function (e) {
            e.preventDefault();

            const targetId = this.getAttribute('data-target');
            const content = document.getElementById(targetId);

            if (!content) return;

            const isOpen = content.classList.contains('is-open');

            // Находим родительский dropdown
            const parentDropdown = this.closest('.mobile-nav__dropdown');

            // Закрываем другие табы в этом dropdown
            if (parentDropdown) {
                parentDropdown.querySelectorAll('.mobile-nav__tab-content.is-open').forEach(item => {
                    if (item !== content) {
                        item.classList.remove('is-open');
                        const otherToggle = document.querySelector(`[data-target="${item.id}"].mobile-nav__tab-title`);
                        if (otherToggle) otherToggle.setAttribute('aria-expanded', 'false');
                    }
                });
            }

            // Переключаем текущий таб
            if (isOpen) {
                content.classList.remove('is-open');
                this.setAttribute('aria-expanded', 'false');
            } else {
                content.classList.add('is-open');
                this.setAttribute('aria-expanded', 'true');
            }
        });
    });

    // Закрытие всех аккордеонов при клике на ссылку
    const brandLinks = document.querySelectorAll('.mobile-nav__brands a');

    brandLinks.forEach(link => {
        link.addEventListener('click', function () {
            // Закрываем все dropdown (опционально)
            document.querySelectorAll('.mobile-nav__dropdown.is-open').forEach(dropdown => {
                dropdown.classList.remove('is-open');
            });

            document.querySelectorAll('.mobile-nav__tab-content.is-open').forEach(content => {
                content.classList.remove('is-open');
            });
        });
    });
});