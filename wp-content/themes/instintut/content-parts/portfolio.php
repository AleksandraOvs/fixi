<?php
$key = isset($args['key']) ? $args['key'] : '';

$items = get_sub_field('items') ? get_sub_field('items') : [];

$type = get_sub_field('gallery_type') ? get_sub_field('gallery_type') : 'slider';
$columns = get_sub_field('gallery_columns') ? get_sub_field('gallery_columns') : 3;
$vertPhoto = get_sub_field('vert_photo') ? get_sub_field('vert_photo') : false;
$photoTitle = get_sub_field('title_photo') ? get_sub_field('title_photo') : false;

?>

<?php if (get_sub_field('height')) : ?>
    <style>
        #block-<?= $key ?> .folio-item img {
            height: <?= get_sub_field('height') ?>px;
        }
    </style>
<?php endif ?>

<?php if (count($items)) : ?>
    <div class="card folio folio-new" id="block-<?= $key ?>">
        <div class="title-block">
            <h2><?= get_sub_field('title') ?></h2>

            <?php if ($type == 'slider') : ?>
                <div class="portfolio-slider-nav slider-nav">
                    <button class="swiper-arrow swiper-prev">
                        <svg width="25" height="18" viewBox="0 0 25 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0.433903 8.3582C-0.0184402 8.81055 -0.0184402 9.54394 0.433903 9.99629L7.80528 17.3677C8.25762 17.82 8.99102 17.82 9.44336 17.3677C9.89571 16.9153 9.89571 16.1819 9.44336 15.7296L2.89103 9.17725L9.44336 2.62491C9.89571 2.17257 9.89571 1.43917 9.44336 0.986829C8.99102 0.534485 8.25762 0.534485 7.80528 0.986829L0.433903 8.3582ZM24.4189 8.01895L1.25294 8.01895V10.3355L24.4189 10.3355V8.01895Z" fill="orange"></path>
                        </svg>
                    </button>
                    <button class="swiper-arrow swiper-next">
                        <svg width="25" height="18" viewBox="0 0 25 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M24.1984 9.99531C24.6508 9.54297 24.6508 8.80957 24.1984 8.35723L16.827 0.985852C16.3747 0.533508 15.6413 0.533508 15.189 0.985852C14.7366 1.4382 14.7366 2.17159 15.189 2.62394L21.7413 9.17627L15.189 15.7286C14.7366 16.1809 14.7366 16.9143 15.189 17.3667C15.6413 17.819 16.3747 17.819 16.827 17.3667L24.1984 9.99531ZM0.213379 10.3346H23.3794V8.01797H0.213379V10.3346Z" fill="orange"></path>
                        </svg>
                    </button>
                </div>
            <?php endif ?>

        </div>

        <?php if (get_sub_field('subtitle')) : ?>
            <div class="text-block subtitle">
                <?= get_sub_field('subtitle') ?>
            </div>
        <?php endif ?>

        <?php if ($type == 'slider') : ?>
            <div class="portfolio-slider-<?= $key ?> swiper">
                <div class="swiper-wrapper">
                    <?php foreach ($items as $item) : ?>
                        <div class="swiper-slide">
                            <div class="folio-item <?= $vertPhoto ? 'vert-photo' : '' ?>">
                                <a href="<?= $item['url'] ?>" data-fancybox="gallery-<?= $key ?>"><img src="<?= $item['sizes']['large'] ?>" alt=""></a>
                                <?php if ($photoTitle) : ?>
                                    <div class="folio-item__caption">
                                        <?= $item['caption'] ?>
                                    </div>
                                <?php endif ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php else : ?>
            <div class="row">
                <?php 
                $classCol = $columns == 4 ? 3 : 4;
                ?>
                <?php foreach ($items as $item) : ?>
                    <div class="col-<?= $classCol ?>">
                        <div class="folio-item <?= $vertPhoto ? 'vert-photo' : '' ?>">
                            <a href="<?= $item['url'] ?>" data-fancybox="gallery-<?= $key ?>"><img src="<?= $item['sizes']['large'] ?>" alt=""></a>
                            <?php if ($photoTitle) : ?>
                                <div class="folio-item__caption">
                                    <?= $item['caption'] ?>
                                </div>
                            <?php endif ?>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        <?php endif ?>
    </div>

<?php if ($type == 'slider') : ?>
<script>
jQuery(document).ready(function() {
    var folioSwiper = new Swiper(".portfolio-slider-<?= $key ?>", {
        slidesPerView: 1.5,
        spaceBetween: 20,
        navigation: {
            nextEl: ".portfolio-slider-nav .swiper-next",
            prevEl: ".portfolio-slider-nav .swiper-prev"
        },
        breakpoints: {  
            991: {
                slidesPerView: <?= $columns ?>
            }
        }
    });
});
</script>
<?php endif ?>

<?php endif ?>