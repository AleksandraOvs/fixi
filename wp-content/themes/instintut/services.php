<?php 
/* Template Name: Услуги */
get_header();

$args = [
    'post_type' => 'service',
    'posts_per_page' => -1,
    'orderby' => 'menu_order',
    'order' => 'ASC',
    'post_parent' => 0,
];

$services = get_posts($args);

$h1 = get_field('h1') ? get_field('h1') : $post->post_title;
?>

<div class="content p-100">
    <div class="container">
        <div class="services-hero">
            <h1><?= $h1 ?></h1>

            <div class="services-hero__sub">
                Свой склад с компонентами
            </div>
            <div class="services-hero__action">
                <a href="#" data-toggle="modal" data-target="#lead-modal" class="btn">Забронировать время</a>
            </div>
        </div>

        <?php get_template_part('parts/services-list'); ?>

    </div>

    <?php get_template_part('parts/callback'); ?>

    <?php get_template_part('parts/faq'); ?>

    <?php get_template_part('parts/features'); ?>

    <?php get_template_part('parts/team'); ?>

    <?php get_template_part('parts/reviews'); ?>

    <?php get_template_part('parts/diagnostic'); ?>

    <?php get_template_part('parts/contacts'); ?>

</div>

<?php get_footer(); ?>