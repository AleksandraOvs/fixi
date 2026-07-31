jQuery(document).ready(function ($) {

    /* new */
    const reviewsSlider = new Swiper('.reviews-slider', {
        slidesPerView: 1.2,
        spaceBetween: 20,

        pagination: {
            el: '.swiper-pagination',
            clickable: true,
            type: 'bullets'
        },

        navigation: {
            nextEl: '.title-btns .swiper-next',
            prevEl: '.title-btns .swiper-prev'
        },

        // Адаптивность
        breakpoints: {

            // Десктоп
            1024: {
                slidesPerView: 3,
                spaceBetween: 20,
            }

        },
    });

    // Инициализация слайдера процесса
    const catsSlider = new Swiper('.cats-slider', {
        slidesPerView: 2,
        spaceBetween: 20,

        pagination: {
            el: '.swiper-pagination',
            clickable: true,
            type: 'bullets'
        },

        navigation: {
            nextEl: '.title-btns .swiper-next',
            prevEl: '.title-btns .swiper-prev'
        },

        // Адаптивность
        breakpoints: {

            // Десктоп
            1024: {
                slidesPerView: 6,
                spaceBetween: 20,
            }

        },
    });

    const chatSlider = new Swiper('.chat-slider', {
        slidesPerView: 1,
        spaceBetween: 16,

        navigation: false,

        pagination: {
            el: '.swiper-pagination',
            clickable: true,
            type: 'bullets'
        },

        // Адаптивность
        breakpoints: {
            // Десктоп
            992: {
                slidesPerView: 3,
                spaceBetween: 16,
                navigation: {
                    nextEl: '.chat-slider__nav .swiper-next',
                    prevEl: '.chat-slider__nav .swiper-prev'
                },
                pagination: false
            }
        },
    });

    const casesSlider = new Swiper('.cases-slider', {
        slidesPerView: 1,
        spaceBetween: 16,

        // Навигация
        navigation: {
            nextEl: '.cases-slider__inner .swiper-next',
            prevEl: '.cases-slider__inner .swiper-prev',
        }
    });

    function checkHeader() {
        winScrolled = window.pageYOffset || document.documentElement.scrollTop;
        if (winScrolled > 50) {
            $("header").addClass("bg");
        } else {
            $("header").removeClass("bg");
        }
    }

    checkHeader();

    var winScrolled = 0;
    $(window).on("scroll", function () {
        checkHeader();
    });

    $(".js-show-menu").click(function (e) {
        if ($(this).hasClass("active")) {
            $(".panel-adaptive").removeClass("panel-right");
            $(this).removeClass("active");
            $('body').css({ 'overflow-y': 'scroll' });
            $('header').removeClass('animate');
        } else {
            $(".panel-adaptive").addClass("panel-right");
            $(this).addClass("active");
            $('body').css({ 'overflow-y': 'hidden' });
            $('header').addClass('animate');
        }
    });

    // $('.panel-adaptive ul li a').click(function() {

    //     $(".panel-adaptive").removeClass("panel-right");
    //     $('.hamburger').removeClass("active");
    //     $('body').css({'overflow-y' : 'scroll'});
    //     $('header').removeClass('animate');

    // });

    $('*[data-toggle="modal"]').click(function (e) {
        e.preventDefault();
        var target = $(this).data('target');
        $(target).css('display', 'flex');
    });

    window.onclick = function (event) {
        if (event.target.className == 'modal') {
            $('.modal').hide();
        }
    }

    $('.modal .close').click(function (e) {
        e.preventDefault();

        $('.modal').hide();
    });

    $('.form').submit(function (e) {
        e.preventDefault();

        var telInput = $(this).find('input[name="tel"]');
        var telValue = telInput.val();

        console.log(telValue.length);
        if (telValue.length < 16) {
            telInput.css('border', '1px solid red');
            return;
        }

        var btnText = $(this).find(':submit').html();

        var that = $(this).find(':submit');

        $(this).find(':submit').text('Отправляю...')
        $(this).find(':submit').attr('disabled', 'disabled');

        var datastring = $(this).serialize();
        $.ajax({
            type: "POST",
            url: "/lead.php",
            data: datastring,
            complete: function (data) {
                that.html(btnText);
                that.attr('disabled', false);

                $('.modal').hide();
                $('#success-modal').css('display', 'flex');

                $(this).trigger('reset');

                /* window.location.href = '/spasibo/'; */

            }
        });
    });

    /* маска телефона */
    let element = document.querySelectorAll('input[name="tel"]');
    let maskOptions = {
        mask: '+{7}(000)000-00-00',
        prepare: (appended, masked) => {
            if (appended === '8' && masked.value === '') {
                return '+7';
            }
            return appended;
        }
    };
    for (let i = 0; i < element.length; i++) {
        let mask = IMask(element[i], maskOptions);

        element[i].addEventListener('focus', function () {
            if (element[i].value.trim() === '') {
                setTimeout(function () {
                    element[i].value = '+7';
                    element[i].setSelectionRange(3, 3);
                }, 100);
            }
        });

        element[i].addEventListener('blur', function () {
            if (element[i].value === '+7') {
                element[i].value = '';
            }
        });
    }

    $(".faq-item.active").each(function () {
        var panel = $(this).find('.faq-answer');
        panel.css('max-height', panel.prop('scrollHeight'));
    });

    $('.faq-question').click(function () {

        var cont = $(this).closest(".faq-item");
        var classActive = cont.hasClass("active");

        if (!classActive) {
            cont.addClass("active");
            var panel = cont.find('.faq-answer');
            panel.css('max-height', panel.prop('scrollHeight'));
        } else {
            cont.removeClass("active");
            cont.find('.faq-answer').css('max-height', 0);
        }
    });

});