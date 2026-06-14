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
                                        <g clip-path="url(#clip0_437_23355)">
                                        <path d="M17.8439 2.65757C15.6072 3.7071 9.32545 7.54546 7.78917 14.7364H14.8804C16.3289 14.7364 17.5031 15.8947 17.5031 17.3237V29.4124C17.5031 30.8415 16.3289 31.9998 14.8804 31.9998H2.62271C1.17414 31.9998 0 30.8415 0 29.4124V21.4934H0.00125308C0.174179 6.78768 12.5872 1.456 16.7926 0.0714629C17.5394 -0.174539 18.3452 0.230931 18.5795 0.972645L18.5857 0.991188C18.795 1.65131 18.4767 2.36089 17.8439 2.65757Z" fill="#EDF6FF"/>
                                        <path d="M44.3947 2.65757C42.1579 3.7071 35.8762 7.54546 34.34 14.7364H41.4312C42.8797 14.7364 44.0539 15.8947 44.0539 17.3237V29.4124C44.0539 30.8415 42.8797 31.9998 41.4312 31.9998H29.1735C27.7249 31.9998 26.5508 30.8415 26.5508 29.4124V21.4934H26.552C26.725 6.78768 39.138 1.456 43.3434 0.0714629C44.0902 -0.174539 44.8959 0.230931 45.1303 0.972645L45.1365 0.991188C45.3458 1.65131 45.0275 2.36089 44.3947 2.65757Z" fill="#EDF6FF"/>
                                        </g>
                                        <defs>
                                        <clipPath id="clip0_437_23355">
                                        <rect width="45.2" height="32" fill="white"/>
                                        </clipPath>
                                        </defs>
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
                                            <g clip-path="url(#clip0_437_23362)">
                                            <path d="M27.3561 29.3424C29.5928 28.2929 35.8745 24.4545 37.4108 17.2636H30.3196C28.8711 17.2636 27.6969 16.1053 27.6969 14.6763V2.58758C27.6969 1.15855 28.8711 0.000236511 30.3196 0.000236511H42.5773C44.0259 0.000236511 45.2 1.15855 45.2 2.58758V10.5066H45.1987C45.0258 25.2123 32.6128 30.544 28.4074 31.9285C27.6606 32.1745 26.8548 31.7691 26.6205 31.0274L26.6143 31.0088C26.405 30.3487 26.7233 29.6391 27.3561 29.3424Z" fill="#EDF6FF"/>
                                            <path d="M0.8053 29.3424C3.04206 28.2929 9.32377 24.4545 10.86 17.2636H3.76884C2.32028 17.2636 1.14614 16.1053 1.14614 14.6763V2.58758C1.14614 1.15855 2.32028 0.000236511 3.76884 0.000236511H16.0265C17.4751 0.000236511 18.6492 1.15855 18.6492 2.58758V10.5066H18.648C18.475 25.2123 6.06199 30.544 1.85664 31.9285C1.1098 32.1745 0.304068 31.7691 0.0697403 31.0274L0.0634727 31.0088C-0.145792 30.3487 0.172493 29.6391 0.8053 29.3424Z" fill="#EDF6FF"/>
                                            </g>
                                            <defs>
                                            <clipPath id="clip0_437_23362">
                                            <rect width="45.2" height="32" fill="white" transform="matrix(-1 0 0 -1 45.2 32)"/>
                                            </clipPath>
                                            </defs>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; wp_reset_postdata(); ?>

                    </div>

                    <div class="title-btns">
                        <div class="swiper-arrow swiper-prev">
                            <svg width="24" height="33" viewBox="0 0 24 33" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M14.3589 0H24V5.79604L14.3411 16.4131H0L14.3589 0Z" fill="#008EE9"/>
                            <path d="M14.3589 32.8262H24V27.0301L14.3411 16.413H0L14.3589 32.8262Z" fill="#008EE9"/>
                            </svg>
                        </div>
                        <div class="swiper-arrow swiper-next">
                            <svg width="24" height="33" viewBox="0 0 24 33" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9.64111 0H0V5.79604L9.65892 16.4131H24L9.64111 0Z" fill="#008EE9"/>
                            <path d="M9.64111 32.8262H0V27.0301L9.65892 16.413H24L9.64111 32.8262Z" fill="#008EE9"/>
                            </svg>
                        </div>
                    </div>

                </div>

            <?php endif ?>
        </div>
    
    
    </div>
</div>