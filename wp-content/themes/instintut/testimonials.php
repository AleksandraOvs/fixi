<?php 
/* Template Name: Отзывы */
get_header(); 

$h1 = get_field('h1') ? get_field('h1') : $post->post_title;

$reviews = get_posts([
    'post_type' => 'testimonials',
    'posts_per_page' => -1,
    'include' => get_sub_field('items'),
    'orderby' => 'menu_order',
    'order' => 'DESC',
]);

$docs = get_field('docs', 'option') ? get_field('docs', 'option') : [];
?>
<div class="bread__line">
    <div class="container">
        <?php breadcrumbs($post->post_title) ?>
        <h1><?= $h1 ?></h1>
    </div>
    <div class="bread-line__decor">
        <img src="/img/kor.png" alt="">
    </div>
</div>

<div class="prices-page content">
    
    <div class="container">

        <div class="reviews-list row m-block">
            <?php foreach ($reviews as $post) : setup_postdata($post) ?>
                <div class="col-6">
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

        <div class="docs-list row">
            <?php foreach ($docs as $item) : ?>
                <div class="col-4">
                    <div class="doc-item">
                        <a href="<?= $item['url'] ?>" data-fancybox="gallery">
                            <img src="<?= $item['sizes']['large'] ?>" alt="">
                        </a>
                    </div>
                </div>
            <?php endforeach ?>
        </div>

    </div>
</div>

<?php get_footer(); ?>