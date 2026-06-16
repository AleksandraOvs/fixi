<?php
$css_class = isset($args['css_class']) ? $args['css_class'] : '';

$reviews = get_posts([
    'post_type' => 'testimonials',
    'posts_per_page' => -1,
]);
?>

<div class="reviews <?= $css_class ?>" id="reviews">
    <div class="container">

        <div class="reviews__in">
            <div class="reviews__header">
                <div class="reviews__header-in">
                    <div class="reviews__header-in-content">
                        <h2>
                            Что говорят
                            <br>наши
                            <br>клиенты
                            <br><span>Отзывы</span>
                        </h2>

                        <div class="reviews__count-title">
                            <div class="reviews__rait-title">
                                Отзывы с карт:
                            </div>
                            <div class="reviews__rait-count">
                                <div class="reviews__stars fs">
                                    <img src="/img/stars.svg" alt="">
                                </div>
                                <div class="reviews__count">
                                    4.9
                                </div>
                            </div>
                        </div>
                        <div class="reviews__add-review">
                            <a href="#" class="btn" data-toggle="modal" data-target="#rating-modal">Оценить работу</a>
                        </div>
                    </div>
                </div>
            </div>

            <?php if (count($reviews)) : ?>
                <div class="reviews-slider swiper">
                    <div class="swiper-wrapper">

                        <?php foreach ($reviews as $post) : setup_postdata($post); ?>
                            <div class="swiper-slide">
                                <div class="review-item">
                                    <div class="review-item__header">
                                        <div class="review-item__name">
                                            <?= $post->post_title ?>
                                        </div>
                                        <div class="review-item__logo">
                                            <a href="<?= get_field('source') ?>" target="_blank"><img src="<?= get_field('logo')['url'] ?>" alt=""></a>
                                        </div>
                                    </div>
                                    <div class="review-item__quote-top">
                                        <svg width="46" height="32" viewBox="0 0 46 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M17.8439 2.65806C15.6072 3.70759 9.32545 7.54595 7.78917 14.7369H14.8804C16.3289 14.7369 17.5031 15.8952 17.5031 17.3242V29.4129C17.5031 30.842 16.3289 32.0003 14.8804 32.0003H2.62271C1.17414 32.0003 0 30.842 0 29.4129V21.4939H0.00125308C0.174179 6.78817 12.5872 1.45649 16.7926 0.0719513C17.5394 -0.174051 18.3452 0.231419 18.5795 0.973133L18.5857 0.991676C18.795 1.6518 18.4767 2.36138 17.8439 2.65806Z" fill="#EDF6FF" />
                                            <path d="M44.3947 2.65806C42.1579 3.70759 35.8762 7.54595 34.34 14.7369H41.4312C42.8797 14.7369 44.0539 15.8952 44.0539 17.3242V29.4129C44.0539 30.842 42.8797 32.0003 41.4312 32.0003H29.1735C27.7249 32.0003 26.5508 30.842 26.5508 29.4129V21.4939H26.552C26.725 6.78817 39.138 1.45649 43.3434 0.0719513C44.0902 -0.174051 44.8959 0.231419 45.1303 0.973133L45.1365 0.991676C45.3458 1.6518 45.0275 2.36138 44.3947 2.65806Z" fill="#EDF6FF" />
                                        </svg>

                                    </div>
                                    <div class="review-item__text">
                                        <?= get_field('text') ?>
                                    </div>
                                    <div class="review-item__date-quote">
                                        <div class="review-item__date">
                                            Дата <?php echo get_the_date('d.m.Y'); ?>
                                        </div>
                                        <div class="review-item__quote">
                                            <svg width="46" height="32" viewBox="0 0 46 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M17.8439 2.65806C15.6072 3.70759 9.32545 7.54595 7.78917 14.7369H14.8804C16.3289 14.7369 17.5031 15.8952 17.5031 17.3242V29.4129C17.5031 30.842 16.3289 32.0003 14.8804 32.0003H2.62271C1.17414 32.0003 0 30.842 0 29.4129V21.4939H0.00125308C0.174179 6.78817 12.5872 1.45649 16.7926 0.0719513C17.5394 -0.174051 18.3452 0.231419 18.5795 0.973133L18.5857 0.991676C18.795 1.6518 18.4767 2.36138 17.8439 2.65806Z" fill="#EDF6FF" />
                                                <path d="M44.3947 2.65806C42.1579 3.70759 35.8762 7.54595 34.34 14.7369H41.4312C42.8797 14.7369 44.0539 15.8952 44.0539 17.3242V29.4129C44.0539 30.842 42.8797 32.0003 41.4312 32.0003H29.1735C27.7249 32.0003 26.5508 30.842 26.5508 29.4129V21.4939H26.552C26.725 6.78817 39.138 1.45649 43.3434 0.0719513C44.0902 -0.174051 44.8959 0.231419 45.1303 0.973133L45.1365 0.991676C45.3458 1.6518 45.0275 2.36138 44.3947 2.65806Z" fill="#EDF6FF" />
                                            </svg>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach;
                        wp_reset_postdata(); ?>

                    </div>

                    <div class="title-btns">
                        <div class="swiper-arrow swiper-prev">
                            <svg width="24" height="33" viewBox="0 0 24 33" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M14.3589 0H24V5.79604L14.3411 16.4131H0L14.3589 0Z" fill="#008EE9" />
                                <path d="M14.3589 32.8262H24V27.0301L14.3411 16.413H0L14.3589 32.8262Z" fill="#008EE9" />
                            </svg>
                        </div>
                        <div class="swiper-arrow swiper-next">
                            <svg width="24" height="33" viewBox="0 0 24 33" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9.64111 0H0V5.79604L9.65892 16.4131H24L9.64111 0Z" fill="#008EE9" />
                                <path d="M9.64111 32.8262H0V27.0301L9.65892 16.413H24L9.64111 32.8262Z" fill="#008EE9" />
                            </svg>
                        </div>
                    </div>

                </div>

            <?php endif ?>
        </div>


    </div>
</div>