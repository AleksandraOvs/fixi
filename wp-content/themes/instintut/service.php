<?php 
/* Template Name: Услуга */
get_header(); 

$h1 = get_field('h1') ? get_field('h1') : $post->post_title;
?>

<div class="content p-100">

    <div class="container">
        <div class="card">
            <h1><?= $post->post_title ?></h1>
            
            <div class="text-block">
                <?php the_content(); ?>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>