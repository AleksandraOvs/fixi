<?php
get_header();

$h1 = get_field('h1') ? get_field('h1') : $post->post_title;

$banner_img = get_field('image') ? get_field('image')['sizes']['large'] : '/wp-content/uploads/2026/01/3721592-2.png';
$banner_title = get_field('title') ?: '';
$banner_sub = get_field('sub') ?: '';

$solutions = get_field('solutions') ?: [];
?>

<div class="services-hero__in">
    <div class="container">

        <?php breadcrumbs($post->post_title, [
            ['link' => '/samodiagnostika/', 'label' => 'Самодиагностика']
        ]); ?>

        <section class="services-hero">
            <div class="services-hero__content">
                <h1>
                    <span>
                        <?= $h1 ?>
                    </span>
                    <br>поможем это исправить
                </h1>

                <?php if ($banner_sub) : ?>
                    <div class="services-hero__sub">
                        <?= $banner_sub ?>
                    </div>
                <?php endif ?>

                <div class="services-hero__action">
                    <a href="#" data-toggle="modal" data-target="#lead-modal" class="btn">Забронировать время</a>
                </div>
            </div>

            <div class="services-hero__img">
                <img src="<?= $banner_img ?>" alt="" class="services__img">
                <div class="img-shadow"></div>
            </div>
        </section>

    </div>
</div>

<?php if (count($solutions)) : ?>
    <section class="diagnostic">
        <div class="container">
            <div class="card">
                <h2>
                    Возможные решения<br> при данной неисправности
                    <br>
                    <span>
                        выберите подходящий
                    </span>
                </h2>

                <div class="solutions-list">

                    <?php foreach ($solutions as $item) : ?>

                        <!-- <div class="sol-item"> -->

                        <div class="solution-card" style="--p: <?= $item['probability'] ?>">
                            <div class="icon-wrapper">
                                <div class="icon-base">
                                    <div class="chart-value"><?= $item['probability'] ?><span>%</span></div>

                                    <div class="bars-container">
                                        <div class="bar" style="--h: 40%; --limit: 0">
                                            <div class="bar-layer layer-yellow"></div>
                                            <div class="bar-layer layer-blue"></div>
                                        </div>
                                        <div class="bar" style="--h: 60%; --limit: 49">
                                            <div class="bar-layer layer-yellow"></div>
                                            <div class="bar-layer layer-blue"></div>
                                        </div>
                                        <div class="bar" style="--h: 80%; --limit: 74">
                                            <div class="bar-layer layer-yellow"></div>
                                            <div class="bar-layer layer-blue"></div>
                                        </div>
                                        <div class="bar" style="--h: 100%; --limit: 99">
                                            <div class="bar-layer layer-yellow"></div>
                                            <div class="bar-layer layer-blue"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="sol-item__content">
                                <div class="sol-item__title">
                                    <?= $item['title'] ?>
                                </div>
                                <div class="sol-item__text">
                                    <?= $item['short']  ?>
                                </div>
                                <div class="sol-item__price">
                                    Cтоимость ремонта от: <?= $item['price'] ?> руб.
                                </div>
                            </div>
                        </div>



                        <!-- </div> -->

                    <?php endforeach ?>

                </div>

                <div class="solution-list__sub">
                    * Более точную стоимость уточняйте по телефону 47-81-80 или в MAX/Telegram +7 (908) 119-13-74.
                </div>
            </div>
        </div>
    </section>
<?php endif ?>

<?php get_template_part('parts/callback'); ?>

<?php if (get_field('text')) : ?>
    <div class="p-100">
        <div class="container">
            <div class="card">
                <h2>
                    <?= get_field('text_title') ?>
                </h2>
                <div class="text-block text-block-collapsed js-read-more">
                    <div class="text-block__inner">
                        <?= get_field('text') ?>
                    </div>
                    <div class="text-block__fade"></div>
                </div>
                <button class="read-more-btn" data-target=".js-read-more">
                    Читать полностью
                    <svg class="read-more-btn__icon" width="14" height="11" viewBox="0 0 14 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M14 4.11182L14 6.11959e-07L11.5281 5.03907e-07L7 4.11941L7 10.2357L14 4.11182Z" fill="#008EE9" />
                        <path d="M4.4742e-07 4.11182V6.11959e-07L2.47194 7.20011e-07L7 4.11941V10.2357L4.4742e-07 4.11182Z" fill="#008EE9" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
<?php endif ?>


<?php get_template_part('parts/front-page/reviews', null, ['css_class' => 'padd-0']); ?>

<?php get_template_part('parts/team'); ?>
<?php get_template_part('parts/steps'); ?>
<?php get_template_part('parts/contacts'); ?>


<?php get_template_part('parts/cta'); ?>

<script>
    document.querySelectorAll('.read-more-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const target = document.querySelector(this.dataset.target);
            const isOpen = target.classList.toggle('is-open');
            this.classList.toggle('is-open', isOpen);
            this.childNodes[0].textContent = isOpen ? 'Свернуть ' : 'Читать полностью ';
        });
    });
</script>


<?php get_footer(); ?>