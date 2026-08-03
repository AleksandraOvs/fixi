<?php
get_header();

$h1 = get_field('h1') ? get_field('h1') : $post->post_title;
?>

<div class="content p-100">

    <div class="services-hero__in">
        <div class="container">
            <div class="services-hero">
        
                <div class="services-hero__content">
                    <h1>
                        <span>
                            Fixibot в Омске
                        </span>
                        <br><?= $h1 ?>
                    </h1>
                    
                    <div class="services-hero__sub">
                        Свой склад  с компонентами
                    </div>
                    
                    <div class="services-hero__action">
                        <a href="#" data-toggle="modal" data-target="#lead-modal" class="btn">Забронировать время</a>
                    </div>
                </div>
        
                <div class="services-hero__img">
        
                    <div class="services-hero__img-dec">
                        <img src="/img/dec.svg" alt="">
                    </div>
        
                    <img src="/img/bot-serv.png" alt="" class="services__img">
                </div>
        
            </div>
        </div>
    </div>

    <div class="container">
        <?php get_template_part('parts/services-list'); ?>
    </div>

    <div class="prices p-100">
        <div class="container">
            <div class="row auto-h">
                <div class="col-8">
                    <div class="card">
                        <div class="price-container">
                            <!-- Header -->
                            <div class="price-header">
                                <div class="price-header-cell">Модель Iphone</div>
                                <div class="price-header-cell">Цена (₽)</div>
                                <div class="price-header-cell">Время (мин.)</div>
                            </div>

                            <!-- Rows -->
                            <div class="price-row">
                                <div class="price-cell">Iphone 11</div>
                                <div class="price-cell">2 500</div>
                                <div class="price-cell">от 90</div>
                            </div>

                            <div class="price-row">
                                <div class="price-cell">Iphone 16 Pro Max</div>
                                <div class="price-cell">15 400</div>
                                <div class="price-cell">от 180</div>
                            </div>

                            <div class="price-row">
                                <div class="price-cell">Iphone 13 Pro Max</div>
                                <div class="price-cell">2 500</div>
                                <div class="price-cell">от 90</div>
                            </div>

                            <div class="price-row">
                                <div class="price-cell">Iphone 14 Pro Max</div>
                                <div class="price-cell">16 400</div>
                                <div class="price-cell">от 90</div>
                            </div>

                            <div class="price-row">
                                <div class="price-cell">Iphone SE</div>
                                <div class="price-cell">3 500</div>
                                <div class="price-cell">от 90</div>
                            </div>

                            <!-- Show More Button -->
                            <button class="show-more-btn">
                                Смотреть все модели
                                <svg width="22" height="19" viewBox="0 0 22 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                  <path d="M17.7539 8.03981L17.7539 4L15.3253 4L10.8765 8.04727L10.8765 14.0565L17.7539 8.03981Z" fill="#008EE9" />
                                  <path d="M4 8.03981L4 4L6.42865 4L10.8774 8.04727L10.8774 14.0565L4 8.03981Z" fill="#008EE9" />
                                </svg>
                            </button>

                            <!-- Contact Info -->
                            <div class="contact-info">
                                * Уточняйте стоимость по телефону 47-81-80 или в WhatsApp/Telegram +7 (908) 119-13-74.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card_blue prices__include">
                        <div class="prices__include-title">
                            Что входит в стоимость?
                        </div>
                        <ul>
                            <li>
                                Оригинальный дисплей и все необходимые компоненты.
                            </li>
                            <li>
                                Полная замена дисплейного модуля (экран, сенсор, стекло).
                            </li>
                            <li>
                                Диагностика и тестирование после ремонта.
                            </li>
                            <li>
                                Гарантия на работу и запчасти.
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="problems m-100">
        <div class="container">
            <div class="card">
                <div class="h2__sub">
                    типовые неисправности
                </div>
                <h2>
                    <span>какая неисправность у вашего телефона?</span>
                </h2>
                
                <div class="problems__text text-block">
                    <p>Экран iPhone — сложный дисплейный модуль, который может выйти из строя по разным причинам. В Fixibot мы устраняем любые неисправности дисплея. Вот основные проблемы, требующие замены экрана</p>
                </div>
                
                <div class="problems__list" style="background: url(/img/problems-bg.jpg); background-size: cover; background-position: center;">
                    <div class="problem-item">
                        <div class="problem-item__title">
                            Трещины и сколы
                        </div>
                        <div class="problem-item__text">
                            Даже мелкие повреждения могут нарушить работу сенсора.
                        </div>
                    </div>
                    <div class="problem-item">
                        <div class="problem-item__title">
                            Полосы или пятна
                        </div>
                        <div class="problem-item__text">
                            Дефекты изображения из-за поломки дисплея
                        </div>
                    </div>
                    <div class="problem-item">
                        <div class="problem-item__title">
                            Нерабочий сенсор
                        </div>
                        <div class="problem-item__text">
                            Сенсор не реагирует или работает с перебоями.
                        </div>
                    </div>
                    <div class="problem-item">
                        <div class="problem-item__title">
                            Чёрный экран
                        </div>
                        <div class="problem-item__text">
                            Телефон включается, но дисплей не показывает изображение.
                        </div>
                    </div>
                    <div class="problem-item">
                        <div class="problem-item__title">
                            Проблемы с Face ID
                        </div>
                        <div class="problem-item__text">
                            Повреждение дисплея может повлиять на распознавание лица.
                        </div>
                    </div>
                    <div class="problem-item">
                        <div class="problem-item__title">
                            Тусклость или неравномерная подсветка
                        </div>
                        <div class="problem-item__text">
                            Проблемы с яркостью экрана.
                        </div>
                    </div>
                    <div class="problem-item">
                        <div class="problem-item__title">
                            Механические повреждения
                        </div>
                        <div class="problem-item__text">
                            Падения, влияющие на дисплей или материнскую плату.
                        </div>
                    </div>
                </div>

                <div class="problems__sub">
                    <p>
                        Заметили одну из этих проблем?
                        <br> Обратитесь в Fixibot для диагностики и замены экрана!
                    </p>
                    <div class="problems__sub-img">
                        <img src="/img/bot-2.png" alt="">
                    </div>
                </div>
            </div>

        </div>
    </div>

    <?php get_template_part('parts/steps'); ?>

    <?php get_template_part('parts/callback'); ?>

    <?php get_template_part('parts/faq'); ?>

    <?php get_template_part('parts/features'); ?>

    <?php get_template_part('parts/team'); ?>

    <?php get_template_part('parts/reviews'); ?>

    <?php get_template_part('parts/diagnostic'); ?>

    <?php get_template_part('parts/contacts'); ?>

    <?php get_template_part('parts/cta'); ?>

</div>

<?php get_footer(); ?>