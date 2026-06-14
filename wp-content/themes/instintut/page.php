<?php get_header(); ?>

<div class="content p-100">

    <div class="container">

        <?php breadcrumbs($post->post_title); ?>

        <h1><?= $post->post_title ?></h1>
        <div class="card">
            <div class="text-block">
                <?php the_content(); ?>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
