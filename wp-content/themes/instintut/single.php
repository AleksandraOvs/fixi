<?php 
get_header(); 

?>

<div class="content">

    <div class="container">

        <?php breadcrumbs($post->post_title, [['label' => 'Блог', 'link' => '/blog/']]) ?>

        <div class="card">
            <h1><?= $post->post_title ?></h1>
            
            <div class="text-block">
                <?php the_content() ?>
            </div>
        </div>

    </div>
</div>

<?php get_footer(); ?>