<?php
/* Template Name: Контент */

get_header();

$h1 = get_field('h1') ? get_field('h1') : $post->post_title;

$bread = [];

if ($post->post_parent) {
    // Получаем ID всех родительских постов
    $ancestors = get_post_ancestors($post->ID);

    // Перебираем всех родителей, начиная с самого верхнего
    foreach (array_reverse($ancestors) as $ancestor_id) {
        $bread[] = [
            'label' => get_the_title($ancestor_id),
            'link'  => get_permalink($ancestor_id),
        ];
    }
}
?>

<?php if (get_field('image')) : ?>

    <?php
    $hero_style = get_field('image') ? 'background: url(' . get_field('image')['url'] . '); background-size: cover; background-position: right;' : '';
    ?>

    <div class="hero card hero_serv" style="<?= $hero_style ?>">
        <div class="hero__main">
            <div class="container">
                <div class="hero__in">

                    <?php breadcrumbs($post->post_title, $bread) ?>
                    
                    <h1 class="hero__h1">
                        <?= $h1 ?>
                    </h1>

                    <div class="hero__sub">
                        <?= get_field('sub') ?>
                    </div>

                    <div class="hero__btn-price">
                        <div class="hero__btn">
                            <a href="#" data-toggle="modal" data-target="#lead-modal" class="btn">Получить расчет</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

<?php else : ?>
    <div class="container">
        
        <?php breadcrumbs($post->post_title) ?>

        <h1><?= $h1 ?></h1>

    </div>
<?php endif ?>

<div class="service-content">
    <div class="container">
        <?= get_template_part('_content') ?>
    </div>
</div>

<?php get_footer(); ?>