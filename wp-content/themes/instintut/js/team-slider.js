document.addEventListener('DOMContentLoaded', function () {

    let teamSlider = null;

    function initTeamSlider() {

        //  if (window.innerWidth <= 992 && teamSlider === null) {

        teamSlider = new Swiper('.team-list-slider', {
            slidesPerView: 1,
            spaceBetween: 40,
            centeredSlides: true,
            //loop: true,

            breakpoints: {
                640: {
                    slidesPerView: 1
                },
                992: {
                    slidesPerView: 3
                }
            },
        });

        // } else if (window.innerWidth > 992 && teamSlider !== null) {

        //     teamSlider.destroy(true, true);
        //     teamSlider = null;

        // }
    }

    initTeamSlider();
    window.addEventListener('resize', initTeamSlider);


});