document.addEventListener('DOMContentLoaded', function () {

    let teamSlider = null;

    function initTeamSlider() {

        const slider = document.querySelector('.team-list-slider');

        if (!slider) return;

        const slides = slider.querySelectorAll('.swiper-slide');
        const slidesCount = slides.length;
        const isDesktop = window.innerWidth >= 1400;

        // Если 4 слайда или меньше и экран >= 1400px —
        // уничтожаем слайдер
        if (slidesCount <= 4 && isDesktop) {

            if (teamSlider !== null) {
                teamSlider.destroy(true, true);
                teamSlider = null;
            }

            return;
        }

        // Если слайдер уже создан — ничего не делаем
        if (teamSlider !== null) {
            return;
        }

        teamSlider = new Swiper('.team-list-slider', {

            slidesPerView: 'auto',
            spaceBetween: 20,

            breakpoints: {

                // Мобильные
                0: {
                    slidesPerView: 'auto',
                    spaceBetween: 20,
                    slidesOffsetBefore: -30,
                    slidesOffsetAfter: -30
                },

                // Планшет
                640: {
                    slidesPerView: 2,
                    spaceBetween: 20,
                    slidesOffsetBefore: 0,
                    slidesOffsetAfter: 0
                },

                // Десктоп
                992: {
                    slidesPerView: 2,
                    spaceBetween: 40,
                    slidesOffsetBefore: 0,
                    slidesOffsetAfter: 0
                }
            }
        });
    }

    initTeamSlider();

    let resizeTimer;

    window.addEventListener('resize', function () {

        clearTimeout(resizeTimer);

        resizeTimer = setTimeout(function () {

            if (teamSlider !== null) {
                teamSlider.destroy(true, true);
                teamSlider = null;
            }

            initTeamSlider();

        }, 150);

    });

});

