<?php
get_header();

$h1_sub = get_field('h1_sub') ?: 'Fixibot в Омске';
$h1 = get_field('h1') ? get_field('h1') : $post->post_title;

$banner_sub = get_field('sub') ?: '';

$banner_img = get_field('image') ? get_field('image')['sizes']['large'] : '/wp-content/uploads/2026/01/group-243.png';

$is_archive = get_field('is_archive') ?: false;

$breadcrumb_items = [];

// Получаем всех предков текущего поста
if ($post->post_parent) {
    $ancestors = get_post_ancestors($post->ID);
    $ancestors = array_reverse($ancestors);

    foreach ($ancestors as $ancestor_id) {
        $breadcrumb_items[] = [
            'label' => get_the_title($ancestor_id),
            'link' => get_permalink($ancestor_id),
        ];
    }
}

// Данные для формы диагностики (только для archive-страниц)
$_cta_diag = [];
$_cta_devices = [];
$_first = null;
$_cta_models = []; // дочерние страницы-модели (если есть)
if ($is_archive) {
    // Дочерние страницы (модели) текущей archive-страницы
    $_cta_models = get_posts(['post_type' => 'service', 'posts_per_page' => -1, 'post_parent' => $post->ID, 'orderby' => 'menu_order', 'order' => 'ASC']);

    $_cta_devices = get_posts(['post_type' => 'device', 'posts_per_page' => -1, 'orderby' => 'menu_order', 'order' => 'ASC']);
    foreach ($_cta_devices as $_dev) {
        $_slug = sanitize_title($_dev->post_title);
        $_q = new WP_Query(['post_type' => 'diagnostic', 'posts_per_page' => -1, 'meta_query' => [['key' => 'device', 'value' => $_dev->ID, 'compare' => '=']], 'orderby' => 'title', 'order' => 'ASC']);
        if ($_q->have_posts()) {
            $_cta_diag[$_slug] = [];
            while ($_q->have_posts()) {
                $_q->the_post();
                $_cta_diag[$_slug][] = ['title' => get_the_title(), 'url' => get_permalink(), 'slug' => get_post_field('post_name')];
            }
            wp_reset_postdata();
        }
    }
    $_first = array_key_first($_cta_diag);
}
?>

<div class="bg-wrapper p-bottom-0">

    <div class="services-hero__in">
        <div class="container">

            <?php breadcrumbs($post->post_title, $breadcrumb_items); ?>

            <div class="services-hero">

                <div class="services-hero__content">
                    <h1>
                        <?= $h1 ?>
                    </h1>

                    <div class="hero-discount">
                        <div class="hero-discount__top">
                            <div class="hero-discount__offer">Скидка 10% действует ещё:</div>
                            <div class="hero-discount__timer">
                                <div class="hero-discount__timer-col">
                                    <span class="hero-discount__timer-val" id="t-h">00</span>
                                    <span class="hero-discount__timer-lbl">ч</span>
                                </div>
                                <div class="hero-discount__timer-sep">:</div>
                                <div class="hero-discount__timer-col">
                                    <span class="hero-discount__timer-val" id="t-m">00</span>
                                    <span class="hero-discount__timer-lbl">мин</span>
                                </div>
                                <div class="hero-discount__timer-sep">:</div>
                                <div class="hero-discount__timer-col">
                                    <span class="hero-discount__timer-val" id="t-s">00</span>
                                    <span class="hero-discount__timer-lbl">сек</span>
                                </div>
                            </div>
                        </div>
                        <form class="hero-discount__form form">
                            <input type="tel" name="tel" placeholder="+7 (___) ___-__-__" class="hero-discount__tel">
                            <button type="submit" class="btn hero-discount__btn">Получить скидку</button>
                        </form>
                    </div>
                    <script>
                        (function() {
                            function pad(n) {
                                return String(n).padStart(2, '0');
                            }

                            function tick() {
                                var now = new Date(),
                                    end = new Date(now);
                                end.setHours(23, 59, 59, 0);
                                var d = Math.max(0, Math.floor((end - now) / 1000));
                                document.getElementById('t-h').textContent = pad(Math.floor(d / 3600));
                                document.getElementById('t-m').textContent = pad(Math.floor(d % 3600 / 60));
                                document.getElementById('t-s').textContent = pad(d % 60);
                            }
                            tick();
                            setInterval(tick, 1000);
                        })();
                    </script>

                </div>

                <div class="services-hero__img">

                    <div class="services-hero__img-dec">
                        <img src="/img/dec.svg" alt="">
                    </div>

                    <img src="<?= $banner_img ?>" alt="" class="services__img">
                </div>

            </div>
        </div>
    </div>

    <?php if ($is_archive) : ?>

        <?php if (!empty($_cta_models)) : ?>

            <div class="services-hero__cta">
                <div class="container">
                    <form class="search-form" method="GET" id="cta-model-form">
                        <!--noindex-->
                        <select class="search-form__input" id="cta-model-select">
                            <option value="" disabled selected hidden>Выберите модель</option>
                            <?php foreach ($_cta_models as $_m): ?>
                                <option value="<?= esc_url(get_permalink($_m->ID)) ?>"><?= esc_html($_m->post_title) ?></option>
                            <?php endforeach; ?>
                        </select>
                        <select class="search-form__input" id="cta-device-diagnostic">
                            <option value="" selected>Выберите неисправность</option>
                            <?php if ($_first && isset($_cta_diag[$_first])): foreach ($_cta_diag[$_first] as $_d): ?>
                                    <option value="<?= esc_url($_d['url']) ?>"><?= esc_html($_d['title']) ?></option>
                            <?php endforeach;
                            endif; ?>
                        </select>
                        <!--/noindex-->
                        <button type="submit" class="btn btn--orange search-form__btn">Пройти диагностику</button>
                    </form>
                </div>
            </div>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var form = document.getElementById('cta-model-form');
                    if (form) {
                        form.addEventListener('submit', function(e) {
                            e.preventDefault();
                            var modelUrl = document.getElementById('cta-model-select').value;
                            var diagUrl = document.getElementById('cta-device-diagnostic').value;
                            var url = modelUrl || diagUrl;
                            if (url) {
                                window.location.href = url;
                            } else {
                                alert('Пожалуйста, выберите модель или неисправность');
                            }
                        });
                    }
                });
            </script>
        <?php elseif (!empty($_cta_devices)) : ?>
            <div class="services-hero__cta">
                <div class="container">
                    <form class="search-form" method="GET" id="cta-diagnostic-form">
                        <!--noindex-->
                        <select class="search-form__input" id="cta-device-type" name="device" required>
                            <option value="" disabled selected>Вид устройства</option>
                            <?php foreach ($_cta_devices as $_dev): $_slug = sanitize_title($_dev->post_title);
                                if (!empty($_cta_diag[$_slug])): ?>
                                    <option value="<?= esc_attr($_slug) ?>" data-id="<?= esc_attr($_dev->ID) ?>"><?= esc_html($_dev->post_title) ?></option>
                            <?php endif;
                            endforeach; ?>
                        </select>
                        <select class="search-form__input" id="cta-device-diagnostic" name="diagnostic" required>
                            <option value="" selected>Выберите неисправность</option>
                            <?php if ($_first && isset($_cta_diag[$_first])): foreach ($_cta_diag[$_first] as $_d): ?>
                                    <option value="<?= esc_attr($_d['slug']) ?>" data-device="<?= esc_attr($_first) ?>" data-url="<?= esc_url($_d['url']) ?>"><?= esc_html($_d['title']) ?></option>
                            <?php endforeach;
                            endif; ?>
                        </select>
                        <!--/noindex-->
                        <button type="submit" class="btn btn--orange search-form__btn">Пройти диагностику</button>
                    </form>
                </div>
            </div>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var diag = <?= json_encode($_cta_diag, JSON_UNESCAPED_UNICODE) ?>;
                    var devSel = document.getElementById('cta-device-type');
                    var diagSel = document.getElementById('cta-device-diagnostic');
                    var form = document.getElementById('cta-diagnostic-form');
                    if (devSel) {
                        devSel.addEventListener('change', function() {
                            var s = this.value,
                                items = diag[s] || [];
                            diagSel.innerHTML = '<option value="" selected>Выберите неисправность</option>';
                            items.forEach(function(d) {
                                var o = document.createElement('option');
                                o.value = d.slug;
                                o.textContent = d.title;
                                o.setAttribute('data-device', s);
                                o.setAttribute('data-url', d.url);
                                diagSel.appendChild(o);
                            });
                        });
                    }
                    if (form) {
                        form.addEventListener('submit', function(e) {
                            e.preventDefault();
                            var opt = diagSel.options[diagSel.selectedIndex];
                            var url = opt ? opt.getAttribute('data-url') : null;
                            if (url) {
                                window.location.href = url;
                            } else {
                                alert('Пожалуйста, выберите устройство и неисправность');
                            }
                        });
                    }
                });
            </script>
        <?php endif; ?>

        <?php get_template_part('parts/archive-service'); ?>

    <?php else : ?>

        <?php get_template_part('parts/service'); ?>

    <?php endif ?>

    <?php if (get_field('text')) : ?>
        <div class="p-100">
            <div class="container">
                <div class="card">
                    <h2>
                        <?= get_field('text_title') ?>
                    </h2>
                    <div class="text-block">
                        <?= get_field('text') ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endif ?>

</div>

<?php get_footer(); ?>