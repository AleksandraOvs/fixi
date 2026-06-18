<?php
$team = get_posts([
    'post_type' => 'specs',
    'posts_per_page' => -1,
]);
?>

<div class="team p-100">
    <div class="features__circle_2"></div>
    <div class="container">
        <h2>
            Наши специалисты —
            <br> профессионалы с опытом от 5 лет
        </h2>
        <div class="team__sub">
            Каждый мастер регулярно проходит обучение для работы с новейшей техникой.
        </div>

        <?php if (count($team)) : ?>
            <div class="team-list-slider swiper">
                <div class="swiper-wrapper">
                    <?php foreach ($team as $post) : setup_postdata($post); ?>

                        <div class="team-item swiper-slide team-list-slider__slide">
                            <div class="team-item__photo">
                                <img src="<?= get_field('image')['sizes']['large'] ?>" alt="">
                            </div>
                            <div class="team-item__content">
                                <div class="team-item__name">
                                    <?= $post->post_title ?>
                                </div>
                                <div class="team-item__text">
                                    <?= get_field('post') ?>
                                </div>
                            </div>
                        </div>

                    <?php endforeach;
                    wp_reset_postdata(); ?>
                </div>



            </div>
        <?php endif ?>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        let teamSlider = null;

        function initTeamSlider() {

            if (window.innerWidth <= 992 && teamSlider === null) {

                teamSlider = new Swiper('.team-list-slider', {
                    slidesPerView: 1,
                    spaceBetween: 40,
                    //centeredSlides: true,
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

            } else if (window.innerWidth > 992 && teamSlider !== null) {

                teamSlider.destroy(true, true);
                teamSlider = null;

            }
        }

        initTeamSlider();
        window.addEventListener('resize', initTeamSlider);


    });
</script>