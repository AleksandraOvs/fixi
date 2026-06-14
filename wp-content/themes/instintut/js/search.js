document.addEventListener('DOMContentLoaded', () => {
    const searchTrigger = document.querySelector('.js-search');
    const searchPanel = document.querySelector('.js-search-panel');
    const searchInput = document.querySelector('.js-search-input');
    const closeBtn = document.querySelector('.js-search-close');

    // Функция открытия
    const openSearch = (e) => {
        e.preventDefault();
        searchPanel.classList.add('is-active');
        // Небольшая задержка, чтобы анимация CSS успела отработать перед фокусом
        setTimeout(() => {
            searchInput.focus();
        }, 100);
    };

    // Функция закрытия
    const closeSearch = () => {
        searchPanel.classList.remove('is-active');
    };

    // События
    if (searchTrigger && searchPanel) {

        // 1. Клик по кнопке "Поиск" в шапке
        searchTrigger.addEventListener('click', openSearch);

        // 2. Клик по кнопке "Закрыть" (крестик)
        closeBtn.addEventListener('click', closeSearch);

        // 3. Закрытие при клике вне области формы (Body click)
        document.addEventListener('click', (e) => {
            const isClickInsideSearch = searchPanel.contains(e.target);
            const isClickOnTrigger = searchTrigger.contains(e.target);

            // Если клик не внутри панели И не по кнопке открытия — закрываем
            if (!isClickInsideSearch && !isClickOnTrigger && searchPanel.classList.contains('is-active')) {
                closeSearch();
            }
        });

        // 4. Закрытие по клавише Esc (UX best practice)
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && searchPanel.classList.contains('is-active')) {
                closeSearch();
            }
        });
    }
});