<?php
$problems_list = get_field('problems_list') ?: [];
$h2_symptom = get_field('h2_symptom') ?: '';
if (!empty($problems_list)) :
$_tags_count = count(array_filter($problems_list, function($i){ return !empty($i['title']); }));
$_show_limit = 16;
$_idx = 0;
?>
<div class="hero-tags m-40">
    <div class="container">
        <div class="card">
            <?php if ($h2_symptom) : ?>
            <h2><?= $h2_symptom ?></h2>
            <?php else : ?>
            <h2>Неисправности <span class="accent"><?= get_the_title() ?></span></h2>
            <?php endif; ?>
            <div class="tags-list-in">
                <ul class="tags-list">
                    <?php foreach ($problems_list as $item) : if (empty($item['title'])) continue; $_idx++; ?>
                    <li<?= $_idx > $_show_limit ? ' class="tag-extra" style="display:none"' : '' ?>><a href="#faq" class="tag-link"><?= esc_html($item['title']) ?></a></li>
                    <?php endforeach; ?>
                </ul>
                <?php if ($_tags_count > $_show_limit) : ?>
                <a href="#" class="tag-link show-all tags-show-more" data-action="show-problems">
                    Показать все неисправности ↓
                </a>
                <script>
                (function(){
                    var btn=document.currentScript.previousElementSibling;
                    btn.addEventListener('click',function(e){
                        e.preventDefault();
                        var extras=btn.closest('.tags-list-in').querySelectorAll('.tag-extra');
                        var isHidden=extras.length && extras[0].style.display==='none';
                        extras.forEach(function(el){ el.style.display=isHidden ? '' : 'none'; });
                        btn.textContent=isHidden ? 'Свернуть ↑' : 'Показать все неисправности ↓';
                    });
                })();
                </script>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<?php
$prices = get_field('prices') ?: [];
?>

<?php if (count($prices)) : ?>
    <div class="prices p-100">
        <div class="container">
            <div class="row auto-h">
                <div class="col-8">

                    <div class="card">
                        <div class="price-container">
                            <!-- Header -->
                            <div class="price-header">
                                <div class="price-header-cell">Услуга</div>
                                <div class="price-header-cell">Цена (₽)</div>
                                <div class="price-header-cell">Время (мин.)</div>
                            </div>

                            <!-- Rows -->

                            <?php foreach ($prices as $item) : ?>
                                <div class="price-row">
                                    <div class="price-cell"><?= $item['title'] ?></div>
                                    <div class="price-cell"><?= $item['price'] ?></div>
                                    <div class="price-cell"><?= $item['duration'] ?></div>
                                </div>
                            <?php endforeach ?>

                            <!-- Show More Button -->
                            <?php if (1 == 2) : ?>
                                <button class="show-more-btn">
                                    Смотреть все модели
                                    <svg width="22" height="19" viewBox="0 0 22 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                      <path d="M17.7539 8.03981L17.7539 4L15.3253 4L10.8765 8.04727L10.8765 14.0565L17.7539 8.03981Z" fill="#008EE9" />
                                      <path d="M4 8.03981L4 4L6.42865 4L10.8774 8.04727L10.8774 14.0565L4 8.03981Z" fill="#008EE9" />
                                    </svg>
                                </button>
                            <?php endif ?>

                            <!-- Contact Info -->
                            <div class="contact-info">
                                * Уточняйте стоимость по телефону 47-81-80 или в WhatsApp/Telegram +7 (908) 119-13-74.
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-4">
                    <div class="card_blue prices__include">
                        <div class="prices__include-title">
                            Что входит в стоимость?
                        </div>
                        <ul>
                            <li>
                                Оригинальный дисплей и все необходимые компоненты.
                            </li>
                            <li>
                                Полная замена дисплейного модуля (экран, сенсор, стекло).
                            </li>
                            <li>
                                Диагностика и тестирование после ремонта.
                            </li>
                            <li>
                                Гарантия на работу и запчасти.
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif ?>

<?php get_template_part('parts/reviews'); ?>

<?php get_template_part('parts/callback'); ?>

<?php get_template_part('parts/prob-service'); ?>

<div class="white-wrapper m-100">
    <?php get_template_part('parts/faq'); ?>
    <?php get_template_part('parts/team'); ?>

    <?php get_template_part('parts/steps'); ?>
</div>

<?php get_template_part('parts/contacts'); ?>

<?php get_template_part('parts/cta'); ?>
