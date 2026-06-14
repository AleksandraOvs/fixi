<?php
$key = isset($args['key']) ? $args['key'] : '';

$reviews = get_posts([
    'post_type' => 'testimonials',
    'posts_per_page' => -1,
    'include' => get_sub_field('items'),
    'orderby' => 'menu_order',
    'order' => 'ASC',
]);

?>

<?php if (count($reviews)) : ?>
    <section class="reviews card" id="block-<?= $key ?>">
        <div>
            <div class="reviews__in">
                <h2><?= get_sub_field('title') ?></h2>

                <div class="swiper__in reviews-slider__in">
                    <div class="reviews__quote">
                        <svg width="79" height="55" viewBox="0 0 79 55" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path opacity="0.1" d="M14.8 54.2C9.86667 54.2 6.2 53 3.8 50.6C1.53333 48.2 0.4 45.1333 0.4 41.4V38C0.4 34.8 0.866667 31.4667 1.8 28C2.86667 24.5333 4.26667 21.1333 6 17.8C7.73333 14.4667 9.8 11.2667 12.2 8.19999C14.6 5.13332 17.2667 2.39999 20.2 -1.90735e-06H35.6C31.4667 4.13333 28 8.19999 25.2 12.2C22.5333 16.0667 20.5333 20.4 19.2 25.2C22.6667 25.8667 25.2 27.4 26.8 29.8C28.4 32.0667 29.2 34.7333 29.2 37.8V41.4C29.2 45.1333 28 48.2 25.6 50.6C23.3333 53 19.7333 54.2 14.8 54.2ZM58.2 54.2C53.2667 54.2 49.6 53 47.2 50.6C44.9333 48.2 43.8 45.1333 43.8 41.4V38C43.8 34.8 44.2667 31.4667 45.2 28C46.2667 24.5333 47.6667 21.1333 49.4 17.8C51.1333 14.4667 53.2 11.2667 55.6 8.19999C58 5.13332 60.6667 2.39999 63.6 -1.90735e-06H79C74.8667 4.13333 71.4 8.19999 68.6 12.2C65.9333 16.0667 63.9333 20.4 62.6 25.2C66.0667 25.8667 68.6 27.4 70.2 29.8C71.8 32.0667 72.6 34.7333 72.6 37.8V41.4C72.6 45.1333 71.4 48.2 69 50.6C66.7333 53 63.1333 54.2 58.2 54.2Z" fill="white"/>
                        </svg>
                    </div>
                    <div class="reviews-slider swiper">
                        <div class="swiper-wrapper">
                            <?php foreach ($reviews as $post) : setup_postdata($post) ?>
                                <div class="swiper-slide">
                                    <div class="review-item">
                                        

                                        <div class="review-header">

                                            <?php if (get_field('logo')) : ?>
                                                <div class="review-item__logo">
                                                    <img src="<?= get_field('logo')['url'] ?>" alt="">
                                                </div>
                                            <?php endif ?>

                                            <div class="review-item__author-position">
                                                <div class="review-item__author">
                                                    <?= $post->post_title ?>
                                                </div>

                                                <?php if (get_field('position')) : ?>
                                                    <div class="review-item__position">
                                                        <?= get_field('position') ?>
                                                    </div>
                                                <?php endif ?>
                                            </div>
                                        </div>


                                        <div class="review-item__text">
                                            <?= get_field('text') ?>
                                        </div>

                                    </div>
                                </div>
                            <?php endforeach; wp_reset_postdata(); ?>
                        </div>
                    </div>
                    <div class="swiper-nav">
                        <button class="swiper-arrow swiper-prev">
                            <svg width="25" height="18" viewBox="0 0 25 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M0.433903 8.3582C-0.0184402 8.81055 -0.0184402 9.54394 0.433903 9.99629L7.80528 17.3677C8.25762 17.82 8.99102 17.82 9.44336 17.3677C9.89571 16.9153 9.89571 16.1819 9.44336 15.7296L2.89103 9.17725L9.44336 2.62491C9.89571 2.17257 9.89571 1.43917 9.44336 0.986829C8.99102 0.534485 8.25762 0.534485 7.80528 0.986829L0.433903 8.3582ZM24.4189 8.01895L1.25294 8.01895V10.3355L24.4189 10.3355V8.01895Z" fill="#ef3c3b"></path>
                            </svg>
                        </button>
                        <div class="swiper-pagination"></div>
                        <button class="swiper-arrow swiper-next">
                            <svg width="25" height="18" viewBox="0 0 25 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M24.1984 9.99531C24.6508 9.54297 24.6508 8.80957 24.1984 8.35723L16.827 0.985852C16.3747 0.533508 15.6413 0.533508 15.189 0.985852C14.7366 1.4382 14.7366 2.17159 15.189 2.62394L21.7413 9.17627L15.189 15.7286C14.7366 16.1809 14.7366 16.9143 15.189 17.3667C15.6413 17.819 16.3747 17.819 16.827 17.3667L24.1984 9.99531ZM0.213379 10.3346H23.3794V8.01797H0.213379V10.3346Z" fill="#ef3c3b"></path>
                            </svg>
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </section>

<?php endif ?>

