<?php
$partners = get_sub_field('items') ? get_sub_field('items') : [];
?>

<?php if (count($partners)) : ?>
    <section class="front-partners m-block card">

        <?php if (get_sub_field('title')) : ?>
            <h2><?= get_sub_field('title') ?></h2>
        <?php endif ?>

        <?php if (get_sub_field('subtitle')) : ?>
            <div class="text-block subtitle">
                <?= get_sub_field('subtitle') ?>
            </div>
        <?php endif ?>

        <div class="partners-slider__in swiper__in">
            <div class="partners-slider swiper">
                <div class="swiper-wrapper">
                    <?php foreach ($partners as $item) : ?>
                        <div class="swiper-slide">
                            <div class="partner-item">
                                <img src="<?= $item['url'] ?>" alt="">
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
            </div> 
        </div>

    </section>
<?php endif ?>