<?php
/* Template Name: Главная */
get_header();
?>

<div class="main">
    <?php get_template_part('parts/hero') ?>
    <?php get_template_part('parts/front-page/search-box'); ?>


    <?php get_template_part('parts/features'); ?>
    <div class="front-wrapper">
        <?php get_template_part('parts/about-us'); ?>
        <?php get_template_part('parts/reviews'); ?>
        <?php get_template_part('parts/faq-block'); ?>
    </div>

    <?php get_template_part('parts/team-block'); ?>
    <?php get_template_part('parts/cta-block'); ?>
    <?php get_template_part('parts/callback'); ?>
    <?php get_template_part('parts/video-block'); ?>
    <?php get_template_part('parts/cta2'); ?>
    <?php get_template_part('parts/contacts'); ?>

</div>

<?php get_footer(); ?>