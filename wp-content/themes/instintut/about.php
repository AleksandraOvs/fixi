<?php 
/* Template Name: О нас */
get_header();

$gallery = get_field('gallery') ? get_field('gallery') : [];

$homeId = 16;
$docs = get_field('docs', $homeId) ? get_field('docs', $homeId) : [];
?>

<div class="about-page content">

    <?php breadcrumbs($post->post_title) ?>

    <div class="container">
        <div class="card">
            <h1><?= $post->post_title ?></h1>

            <div class="text-block">
                <div class="about-page__top row">
                    <div class="col-6">
                        <div class="about__text">
                            <?= get_field('text_1') ?>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="app__img">
                            <img src="<?= get_field('image_1')['url'] ?>" alt="">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="app__img">
                            <img src="<?= get_field('image_2')['url'] ?>" alt="">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="about__text">
                            <?= get_field('text_2') ?>
                        </div>
                    </div>
                </div>
                <?= get_field('text_bottom') ?>
            </div>

        </div>

        <?php if (count($gallery)) : ?>

            <div class="card photos-clinic">
                <h2><span>Фотогалерея</span> медицинского<br> центра «ЭКОМЕД» </h2>

                <div class="h2__sub">
                    Многопрофильная клиника “Экомед” оснащена современным медицинским оборудованием эспертного класса. Медицинский центр Экомед, это современная многопрофильная клиника, предоставляющая полный спектр поликлинических медицинских услуг.
                </div>

                <div class="photos-clinic__btns">
                    <div class="gallery-slider__nav slider-nav">
                        <button class="swiper-arrow swiper-prev">
                            <svg width="14" height="24" viewBox="0 0 14 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path d="M0.93934 13.0607C0.353553 12.4749 0.353553 11.5251 0.93934 10.9393L10.4853 1.3934C11.0711 0.807611 12.0208 0.807611 12.6066 1.3934C13.1924 1.97919 13.1924 2.92893 12.6066 3.51472L4.12132 12L12.6066 20.4853C13.1924 21.0711 13.1924 22.0208 12.6066 22.6066C12.0208 23.1924 11.0711 23.1924 10.4853 22.6066L0.93934 13.0607ZM3 13.5H2V10.5H3V13.5Z" fill="#31A8F7" />
                            </svg>
                        </button>
                        <button class="swiper-arrow swiper-next">
                            <svg width="14" height="24" viewBox="0 0 14 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path d="M13.0607 13.0607C13.6464 12.4749 13.6464 11.5251 13.0607 10.9393L3.51472 1.3934C2.92893 0.807611 1.97919 0.807611 1.3934 1.3934C0.807611 1.97919 0.807611 2.92893 1.3934 3.51472L9.87868 12L1.3934 20.4853C0.807611 21.0711 0.807611 22.0208 1.3934 22.6066C1.97919 23.1924 2.92893 23.1924 3.51472 22.6066L13.0607 13.0607ZM11 13.5H12V10.5H11V13.5Z" fill="#31A8F7" />
                            </svg>
                        </button>
                    </div>
                </div>

                <?php if (count($gallery)) : ?>
                    <div class="swiper gallery-slider">
                        <div class="swiper-wrapper">
                            <?php foreach ($gallery as $item) : ?>
                                <div class="swiper-slide">
                                    <div class="gallery-item">
                                        <a href="<?= $item['url'] ?>" data-fancybox="gallery">
                                            <img src="<?= $item['sizes']['large'] ?>" alt="">
                                        </a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif ?>
            </div>

        <?php endif ?>

        <div class="card">
            <div class="docs__content cont-in">
                <div class="title-block">
                    <h2><span>Лицензии</span></h2>
                    <div class="doc-slider-nav slider-nav">
                        <button class="swiper-arrow swiper-prev">
                            <svg width="14" height="24" viewBox="0 0 14 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path d="M0.93934 13.0607C0.353553 12.4749 0.353553 11.5251 0.93934 10.9393L10.4853 1.3934C11.0711 0.807611 12.0208 0.807611 12.6066 1.3934C13.1924 1.97919 13.1924 2.92893 12.6066 3.51472L4.12132 12L12.6066 20.4853C13.1924 21.0711 13.1924 22.0208 12.6066 22.6066C12.0208 23.1924 11.0711 23.1924 10.4853 22.6066L0.93934 13.0607ZM3 13.5H2V10.5H3V13.5Z" fill="#31A8F7" />
                            </svg>
                        </button>
                        <button class="swiper-arrow swiper-next">
                            <svg width="14" height="24" viewBox="0 0 14 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path d="M13.0607 13.0607C13.6464 12.4749 13.6464 11.5251 13.0607 10.9393L3.51472 1.3934C2.92893 0.807611 1.97919 0.807611 1.3934 1.3934C0.807611 1.97919 0.807611 2.92893 1.3934 3.51472L9.87868 12L1.3934 20.4853C0.807611 21.0711 0.807611 22.0208 1.3934 22.6066C1.97919 23.1924 2.92893 23.1924 3.51472 22.6066L13.0607 13.0607ZM11 13.5H12V10.5H11V13.5Z" fill="#31A8F7" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <?php if (count($docs)) : ?>
                <div class="docs-slider swiper">
                    <div class="swiper-wrapper">
                        <?php foreach ($docs as $item) : ?>
                            <div class="swiper-slide">
                                <div class="doc-item">
                                    <a href="<?= $item['url'] ?>" data-fancybox="gallery">
                                        <img src="<?= $item['sizes']['large'] ?>" alt="" title="" loading="lazy">
                                    </a>
                                </div>
                            </div>
                        <?php endforeach ?>
                    </div>
                </div>
            <?php endif ?>
        </div>

    </div>
</div>

<?php get_footer(); ?>