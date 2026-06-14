(function( root, $, undefined ) {
"use strict";

$(function() {

    $(".hamburger").click(function(e) {
        if ($(this).hasClass("is-active")) {
            $(".panel-adaptive").removeClass("panel-right");
            $(this).removeClass("is-active");
            $('body').css({'overflow-y' : 'scroll'});
            $('header').removeClass('animate');
        } else {
            $(".panel-adaptive").addClass("panel-right");
            $(this).addClass("is-active");
            $('body').css({'overflow-y' : 'hidden'});
            $('header').addClass('animate');
        }
    });

    $('.js-menu').click(function(e) {
        e.preventDefault();
        $('.header__menu__content').toggleClass('active');
    });

    $('.js-menu-close').click(function(e) {
        e.preventDefault();
        $('.header__menu__content').removeClass('active');
    });

    var brandsSlider = $('.js-brands');
    brandsSlider.slick({
        slidesToShow: 3,
        slidesToScroll: 3,
        arrows: false,
        dots: false,
        responsive: [
            {
                breakpoint: 991,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    dots: false
                }
            }
        ]
    });

    $('.brands__nav .slick-arrow-left').click(function(){
      brandsSlider.slick('slickPrev');
    });

    $('.brands__nav .slick-arrow-right').click(function(){
      brandsSlider.slick('slickNext');
    });

    var testimonialsSlider = $('.js-test-slider');
    testimonialsSlider.slick({
        slidesToShow: 2,
        slidesToScroll: 2,
        arrows: false,
        dots: true,
        responsive: [
            {
                breakpoint: 991,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    dots: true
                }
            }
        ]
    });

    $('.test__nav .slick-arrow-left').click(function(){
      testimonialsSlider.slick('slickPrev');
    });

    $('.test__nav .slick-arrow-right').click(function(){
      testimonialsSlider.slick('slickNext');
    });

    $('.faq__question').click(function() {
        
        var cont = $(this).closest('.faq__item');
        var classActive = cont.hasClass("active");

        if (!classActive) {
            cont.addClass("active");
            var panel = cont.find('.faq__answer');
            panel.css('padding-bottom', '35px');
            panel.css('max-height', panel.prop('scrollHeight') + 35);

        } else {
            cont.removeClass('active');
            cont.find('.faq__answer').css('max-height', 0);
            cont.find('.faq__answer').css('padding-bottom', 0);
        }
    });

    /*
    var teamSlider = $('.team-slider');
    teamSlider.slick({
        slidesToShow: 4,
        slidesToScroll: 4,
        arrows: false,
        dots: false,
        responsive: [
            {
                breakpoint: 991,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    dots: false
                }
            }
        ]
    });

    teamSlider.on('init reInit afterChange', function(event, slick, currentSlide, nextSlide){
        //currentSlide is undefined on init -- set it to 0 in this case (currentSlide is 0 based)
        var i = (currentSlide ? currentSlide : 0) + 1;
        $('.team__nav .head__nav__counter').text(i + ' из ' + slick.slideCount);
    });

    $('.team__nav .arrow-left').click(function(){
      teamSlider.slick('slickPrev');
    });

    $('.team__nav .arrow-right').click(function(){
      teamSlider.slick('slickNext');
    });

    $('.service__title').click(function() {
        
        var servCont = $(this).closest('.service');
        var classActive = servCont.hasClass("active");
        var img = servCont.data('img');
        $('.services__image').removeClass('active');

        $('.services__list .service').each(function() {
            $(this).removeClass('active');
            $(this).find('.service__text').css('max-height', 0);
        });

        if (!classActive) {

            setTimeout(function() {
                $('.services__image').addClass('active');
            }, 100);

            $('.services__image img').attr("src", "/img/services/" + img + ".png");

            servCont.addClass("active");
            var panel = servCont.find('.service__text');
            panel.css('max-height', panel.prop('scrollHeight'));
        } else {
            servCont.removeClass("active");
            servCont.find('.service__text').css('max-height', 0);
        }
    });
    */

    var sertSlider = $('.js-docs-slider');
    sertSlider.slick({
        slidesToShow: 3,
        slidesToScroll: 3,
        arrows: false,
        dots: false,
        responsive: [
            {
                breakpoint: 991,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    dots: true
                }
            }
        ]
    });


    /*
    var sertSlider = $('.js-sert-slider');
    sertSlider.slick({
        slidesToShow: 3,
        slidesToScroll: 3,
        arrows: false,
        dots: false,
        responsive: [
            {
                breakpoint: 991,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    dots: true
                }
            }
        ]
    });

    $("form").submit(function(e) {
        e.preventDefault();

        $(this).find("input").each(function() {
            var val = $(this).val();
            
            if (val.length == 0) {
                $(this).closest('.form-group').addClass('has-error');
            } else {
                $(this).closest('.form-group').removeClass('has-error');
            }

        });
    });
    */

    $('img.svg').each(function() {
        var $img = jQuery(this);
        var imgID = $img.attr('id');
        var imgClass = $img.attr('class');
        var imgURL = $img.attr('src');

        jQuery.get(imgURL, function(data) {
            // Get the SVG tag, ignore the rest
            var $svg = jQuery(data).find('svg');

            // Add replaced image's ID to the new SVG
            if(typeof imgID !== 'undefined') {
              $svg = $svg.attr('id', imgID);
            }
            // Add replaced image's classes to the new SVG
            if(typeof imgClass !== 'undefined') {
              $svg = $svg.attr('class', imgClass+' replaced-svg');
            }

            // Remove any invalid XML tags as per http://validator.w3.org
            $svg = $svg.removeAttr('xmlns:a');

            // Replace image with new SVG
            $img.replaceWith($svg);

        }, 'xml');

    });

    $(".tabs li a").click(function(e) {
        e.preventDefault();

        var tab = $(this).data("tab");
        $(".tabs li a").removeClass("active");

        $(this).addClass("active");

        $(".tab-content .tab-item").removeClass("active");
        $(".tab-content .tab-item-" + tab).addClass("active");

    });

    AOS.init();

    $("body").on("click", ".js-like", function(e) {
        e.preventDefault();

        var id = $(this).data('id');
        var favorites = [];

        if (Cookies.get('fav')) {
            favorites = JSON.parse(Cookies.get('fav'));
        }

        var index = favorites.indexOf(id);

        var count = parseInt($('.nav-favorites .nav-favorites-count').text());

        console.log(count);

        if (index === -1) {
            favorites.push(id);
            $(this).addClass('active');

            count++;

            $('.nav-favorites .nav-favorites-count').text(count);

        } else {
            favorites.splice(index, 1);
            $(this).removeClass('active');

            count--;

            $('.nav-favorites .nav-favorites-count').text(count);
        }

        Cookies.set('fav', JSON.stringify(favorites));

    });

    var top_show = 150;
    var delay = 1000; 
    $(document).ready(function() {
        $(window).scroll(function () { 
          
          if ($(this).scrollTop() > top_show) $(".top-btn").fadeIn();
          else $(".top-btn").fadeOut();
        });
        $(".top-btn").click(function () {
          $("body, html").animate({
            scrollTop: 0
          }, delay);
        });
    });

    $(".panel-adaptive .with-childs").click(function(e) {

        $(this).toggleClass("active");
    });
    
});

} ( this, jQuery ));