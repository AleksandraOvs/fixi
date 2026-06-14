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
            <div class="team-list row">

                <?php foreach ($team as $post) : setup_postdata($post); ?>
                    <div class="col-3">
                        <div class="team-item">
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
                    </div>
                <?php endforeach;
                wp_reset_postdata(); ?>

            </div>
        <?php endif ?>
    </div>
</div>