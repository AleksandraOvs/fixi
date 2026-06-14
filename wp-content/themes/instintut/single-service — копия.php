<?php
get_header();

$h1 = get_field('h1') ? get_field('h1') : $post->post_title;
?>

<div class="content p-100">

    <div class="services-hero__in">
        <div class="container">
            <div class="services-hero">
        
                <div class="services-hero__content">
                    <h1>
                        <span>
                            Починим
                            <br> вашу технику
                        </span>
                        <br><?= $h1 ?>
                    </h1>
                    
                    <div class="services-hero__sub">
                        Свой склад  с компонентами
                    </div>
                    
                    <div class="services-hero__action">
                        <a href="#" data-toggle="modal" data-target="#lead-modal" class="btn">Забронировать время</a>
                    </div>
                </div>
        
                <div class="services-hero__img">
        
                    <div class="services-hero__img-dec">
                        <img src="/img/dec.svg" alt="">
                    </div>
        
                    <img src="/img/bot-serv.png" alt="" class="services__img">
                </div>
        
            </div>
        </div>
    </div>

    <div class="container">
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