<?php
/* Template Name: Самодиагностика хабовая */
get_header();

$h1 = get_field('h1') ? get_field('h1') : $post->post_title;
?>

<div class="content">
    <div class="container">
        <div class="hero__diagnostic m-80">
            <?php breadcrumbs($post->post_title); ?>
            <h1>
                <span>Поможем вам<br> самостоятельно провести<br> диагностику вашей техники. </span>
                Подскажем стоимость
                <br> и отремонтируем любую технику!
            </h1>
            <div class="services-hero__action">
                <a href="#" data-toggle="modal" data-target="#lead-modal" class="btn">Забронировать время</a>
            </div>
        </div>
    </div>

    <div class="search-box-diagnostic">
        <?php get_template_part('parts/search-diag'); ?>
    </div>

    <?php get_template_part('parts/callback'); ?>

    <div class="white-wrapper m-100">

        <div class="features-no-padd"><?php get_template_part('parts/features'); ?></div>

        <?php get_template_part('parts/front-page/reviews'); ?>

        <?php get_template_part('parts/contacts'); ?>

    </div>

    <?php get_template_part('parts/cta'); ?>
</div>



<?php get_footer(); ?>