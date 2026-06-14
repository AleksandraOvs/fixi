<?php 
/* Template Name: Блог */
get_header(); 
?>

<div class="blog content p-100">
    <div class="container">

        <?php breadcrumbs('Блог') ?>

        <h1>Блог</h1>
        <div class="card">
            
            <?php if (have_posts()) : ?>

                <div class="row facetwp-template auto-h posts-list">
                    <?php while (have_posts()) : the_post(); ?>
                        <div class="col-12">
                            <article class="post-item">
                                <div class="post-item__img">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail('large'); ?>
                                    </a>
                                </div>
                                <div class="post-item__title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </div>
                                <div class="post-item__more">
                                    <a href="<?php the_permalink(); ?>" class="btn">Читать cтатью</a>
                                </div>
                            </article>
                        </div>
                    <?php endwhile; ?>
                </div>

            <?php else: ?>

                <p>
                    Ничего не найдено
                </p>

            <?php endif; ?>


            <?php get_template_part( 'pagination' ); ?>
        </div>

    </div>
</div>

<?php get_footer(); ?>