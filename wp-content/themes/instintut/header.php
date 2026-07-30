<!doctype html>
<html <?php language_attributes(); ?> class="no-js">

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <title><?php wp_title(''); ?></title>

    <link href="//www.google-analytics.com" rel="dns-prefetch">
    <link rel="shortcut icon" href="<?php echo esc_url(get_site_icon_url()); ?>" />
    <link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?>" href="<?php bloginfo('rss2_url'); ?>" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php wp_head(); ?>

    <style>
        .header__city {
            position: relative;
            cursor: pointer
        }

        .header__city>a {
            display: flex;
            align-items: center;
            gap: 5px;
            color: inherit;
            text-decoration: none
        }

        .header__city-list {
            display: none;
            position: absolute;
            right: 0;
            top: calc(100% + 8px);
            background: #fff;
            border: 1px solid #e5e5e5;
            border-radius: 6px;
            padding: 6px 0;
            min-width: 180px;
            z-index: 1000;
            list-style: none;
            margin: 0;
            box-shadow: 0 4px 16px rgba(0, 0, 0, .12);
            columns: 2;
            column-gap: 0
        }

        .header__city.is-open .header__city-list {
            display: block
        }

        .header__city-list li {
            padding: 4px 14px;
            font-size: 13px;
            color: #555;
            white-space: nowrap;
            break-inside: avoid
        }

        .header__city-list li:hover {
            background: #f8f8f8;
            color: #222
        }
    </style>

</head>

<body <?php body_class(); ?>>

    <?php

    $logo = '/img/logo-dark.svg';
    $header_class = 'dark';

    if (is_front_page() || is_404()) {
        $logo = '/img/logo.svg';
        $header_class = '';
    }
    ?>

    <header class="<?= $header_class ?>">
        <div class="container">
            <div class="header__top">
                <div class="header__brand">
                    <a href="/">
                        <img src="<?= $logo ?>" alt="Логотип Fixibot">
                    </a>
                </div>
                <ul class="header-top-nav">
                    <li><a href="/#about">О нас</a></li>
                    <li><a href="/#reviews">Отзывы</a></li>
                    <li><a href="/#contacts">Контакты</a></li>
                    <li class="header__search">
                        <a href="#" class="js-search">
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M7.07378 11.2472C9.32366 11.2472 11.1476 9.36575 11.1476 7.04489C11.1476 4.72402 9.32366 2.84259 7.07378 2.84259C4.82389 2.84259 3 4.72402 3 7.04489C3 9.36575 4.82389 11.2472 7.07378 11.2472Z" stroke="white" />
                                <path d="M10.0391 10.1012L13.0018 13.1574" stroke="white" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            Поиск
                        </a>
                    </li>
                </ul>
                <div class="header__social">
                    <a href="<?= get_field('tg', 'option') ?>" target="_blank">
                        <svg class="fs" width="25" height="20" viewBox="0 0 25 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1.4845 8.71827C1.4845 8.71827 12.1826 4.32313 15.8935 2.77758C17.3183 2.15775 22.1401 0.177524 22.1401 0.177524C22.1401 0.177524 24.3618 -0.691846 24.1767 1.41718C24.1123 2.28655 23.6212 5.31324 23.1221 8.58948C22.3816 13.2261 21.5766 18.2974 21.5766 18.2974C21.5766 18.2974 21.4558 19.7222 20.4013 19.9637C19.3468 20.2133 17.6161 19.1024 17.3102 18.8529C17.0607 18.6677 12.6736 15.8825 11.0637 14.5221C10.629 14.1518 10.1379 13.4113 11.1281 12.5419C13.3498 10.5053 16.0142 7.96965 17.6161 6.35971C18.3567 5.61913 19.0973 3.88844 16.0062 5.98942C11.6191 9.01611 7.28834 11.8657 7.28834 11.8657C7.28834 11.8657 6.29823 12.4855 4.44679 11.9301C2.59536 11.3747 0.429984 10.6341 0.429984 10.6341C0.429984 10.6341 -1.05116 9.70839 1.4845 8.71827Z" fill="white" />
                        </svg>
                    </a>
                    <a href="<?= get_field('wa', 'option') ?>" target="_blank">
                        <svg class="fs" width="26" height="26" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M11.2364 21.9372C9.07734 21.9372 8.074 21.6207 6.32997 20.3545C5.22682 21.7789 1.73352 22.8922 1.58118 20.9876C1.58118 19.5578 1.26599 18.3496 0.908783 17.0306C0.483284 15.4056 0 13.596 0 10.9739C0 4.71138 5.11651 0 11.1786 0C17.2459 0 21.9999 4.94352 21.9999 11.0319C22.0203 17.0262 17.2046 21.9052 11.2364 21.9372ZM11.3257 5.41308C8.37342 5.26008 6.07257 7.31241 5.56302 10.5307C5.14277 13.195 5.88871 16.4397 6.52433 16.6086C6.82901 16.6824 7.59596 16.0599 8.074 15.5798C8.86444 16.1282 9.78491 16.4576 10.7426 16.5347C13.8016 16.6825 16.4154 14.3435 16.6208 11.2746C16.7403 8.1992 14.3851 5.59435 11.3257 5.41836L11.3257 5.41308Z" fill="#fff" />
                        </svg>
                    </a>
                </div>
                <div class="header__phone">
                    <a href="tel:+73812478180">
                        <svg class="fs" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10 15.675C11.93 16.505 14.242 17 17 17V13L13 12L10 15.675ZM10 15.675C6.159 14.023 3.824 11.045 2.5 8M2.5 8C1.4 5.472 1 2.898 1 1H5L6 5L2.5 8Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        +7 3812 478180
                    </a>
                </div>

                <button class="burger-menu js-show-menu">
                    <span></span>
                    <span></span>
                </button>

            </div>
            <div class="header__middle">

                <?php
                /**
                 * Header Navigation from ACF
                 * Вставить в header.php или в файл меню
                 */

                $menu_items = get_field('menu_items', 'option');

                // Текущий путь страницы — для определения активной секции
                $current_path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);

                // Путь родительской секции (для подстраниц типа remont-iphone → remont-apple)
                $ancestor_section_path = '';
                $current_obj = get_queried_object();
                if ($current_obj && isset($current_obj->ID) && $current_obj->post_parent) {
                    $ancestors = get_post_ancestors($current_obj->ID);
                    $top_id = !empty($ancestors) ? end($ancestors) : $current_obj->post_parent;
                    $top_link = get_permalink($top_id);
                    if ($top_link) {
                        $ancestor_section_path = parse_url($top_link, PHP_URL_PATH);
                    }
                }

                if ($menu_items): ?>
                    <ul class="header__nav">
                        <?php foreach ($menu_items as $index => $item): ?>
                            <?php
                            $has_dropdown = !empty($item['has_dropdown']);
                            $title = !empty($item['title']) ? $item['title'] : '';
                            $subtitle = $item['subtitle'] ?? '';
                            $url = $item['url'] ?? '#';
                            $dropdown_tabs = $item['dropdown_tabs'] ?? [];
                            // Секция открыта если текущая страница находится внутри неё (по URL или по предку)
                            $section_path = rtrim(parse_url($url, PHP_URL_PATH) ?? '', '/');
                            $is_current_section = !empty($section_path) && $section_path !== '/'
                                && (strpos($current_path, $section_path) === 0
                                    || (!empty($ancestor_section_path) && strpos($ancestor_section_path, $section_path) === 0));

                            // Генерируем уникальный ID для dropdown
                            $dropdown_id = 'dropdown-' . $index;
                            ?>

                            <li class="<?php echo $has_dropdown ? 'with-childs js-dropdown-parent' : ''; ?>">
                                <?php if ($has_dropdown): ?>
                                    <a href="<?php echo esc_url($url); ?>" class="js-dropdown-toggle">
                                        <?php if (!empty($title)): ?>
                                            <?php echo esc_html($title); ?>
                                            <br>
                                        <?php endif; ?>
                                        <span><?php echo esc_html($subtitle); ?></span>
                                    </a>

                                    <!-- Начало выпадающего меню -->
                                    <div class="dropdown-menu" data-dropdown-id="<?php echo $dropdown_id; ?>">
                                        <div class="dropdown-menu__inner">

                                            <?php if (!empty($dropdown_tabs)): ?>
                                                <!-- Верхняя часть: Табы -->
                                                <div class="dropdown-menu__tabs">
                                                    <?php foreach ($dropdown_tabs as $tab_index => $tab): ?>
                                                        <button
                                                            class="dropdown-tab <?php echo $tab_index === 0 ? 'is-active' : ''; ?>"
                                                            data-tab="<?php echo esc_attr($tab['tab_id']); ?>"
                                                            data-parent="<?php echo $dropdown_id; ?>">
                                                            <?php echo esc_html($tab['tab_name']); ?>
                                                        </button>
                                                    <?php endforeach; ?>
                                                </div>

                                                <?php if ($index === 2): ?>
                                                    <div class="dropdown-menu__content">
                                                        <?php foreach ($dropdown_tabs as $ti => $t): ?>
                                                            <div class="dropdown-content <?php echo $ti === 0 ? 'is-active' : ''; ?>"
                                                                id="<?php echo esc_attr($t['tab_id']); ?>"
                                                                data-parent="<?php echo $dropdown_id; ?>">
                                                                <?php if ($t['tab_id'] === 'laptops'): ?>
                                                                    <ul class="brands-grid">
                                                                        <li><a href="/service/remont-noutbukov-hp/">HP</a></li>
                                                                        <li><a href="/service/remont-noutbukov-lenovo/">Lenovo</a></li>
                                                                        <li><a href="/service/remont-noutbukov-asus/">ASUS</a></li>
                                                                        <li><a href="/service/remont-noutbukov-acer/">Acer</a></li>
                                                                        <li><a href="/service/remont-noutbukov-dell/">Dell</a></li>
                                                                        <li><a href="/service/remont-noutbukov-msi/">MSI</a></li>
                                                                        <li><a href="/service/remont-noutbukov-samsung/">Samsung</a></li>
                                                                        <li><a href="/service/remont-noutbukov-toshiba/">Toshiba</a></li>
                                                                        <li><a href="/service/remont-noutbukov-huawei/">Huawei</a></li>
                                                                        <li><a href="/service/remont-noutbukov-sony/">Sony</a></li>
                                                                        <li><a href="/service/remont-makbuk/">Apple</a></li>
                                                                        <li><a href="/service/remont-noutbukov-lg/">LG</a></li>
                                                                    </ul>
                                                                <?php endif; ?>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    </div>
                                                <?php endif; ?>

                                            <?php endif; ?>

                                        </div>
                                    </div>
                                    <!-- Конец выпадающего меню -->

                                <?php else: ?>
                                    <!-- Обычная ссылка без dropdown -->
                                    <a href="<?php echo esc_url($url); ?>">
                                        <?php if (!empty($title)): ?>
                                            <?php echo esc_html($title); ?>
                                            <br>
                                        <?php endif; ?>
                                        <span><?php echo esc_html($subtitle); ?></span>
                                    </a>
                                <?php endif; ?>
                            </li>

                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
                <div class="header__city">
                    <a href="/#contacts">
                        <svg class="fs" width="12" height="16" viewBox="0 0 12 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6.74062 15.6C8.34375 13.5938 12 8.73125 12 6C12 2.6875 9.3125 0 6 0C2.6875 0 0 2.6875 0 6C0 8.73125 3.65625 13.5938 5.25938 15.6C5.64375 16.0781 6.35625 16.0781 6.74062 15.6ZM6 4C6.53043 4 7.03914 4.21071 7.41421 4.58579C7.78929 4.96086 8 5.46957 8 6C8 6.53043 7.78929 7.03914 7.41421 7.41421C7.03914 7.78929 6.53043 8 6 8C5.46957 8 4.96086 7.78929 4.58579 7.41421C4.21071 7.03914 4 6.53043 4 6C4 5.46957 4.21071 4.96086 4.58579 4.58579C4.96086 4.21071 5.46957 4 6 4Z" fill="#FFBE42" />
                        </svg>
                        Омск
                    </a>
                    <ul class="header__city-list">
                        <li>Омск</li>
                        <li>Барнаул</li>
                        <li>Казань</li>
                        <li>Волгоград</li>
                        <li>Екатеринбург</li>
                        <li>Томск</li>
                        <li>Пермь</li>
                        <li>Самара</li>
                        <li>Москва</li>
                        <li>Санкт-Петербург</li>
                        <li>Челябинск</li>
                        <li>Тюмень</li>
                        <li>Уфа</li>
                        <li>Иркутск</li>
                        <li>Новосибирск</li>
                        <li>Красноярск</li>
                        <li>Краснодар</li>
                        <li>Воронеж</li>
                        <li>Сургут</li>
                        <li>Ульяновск</li>
                        <li>Тольятти</li>
                        <li>Сочи</li>
                        <li>Оренбург</li>
                        <li>Иваново</li>
                        <li>Тверь</li>
                        <li>Ярославль</li>
                        <li>Чебоксары</li>
                        <li>Саратов</li>
                        <li>Владимир</li>
                        <li>Нижний Новгород</li>
                    </ul>
                </div>

                <!-- Скрытая форма поиска -->
                <div class="search-panel js-search-panel">
                    <div class="container search-panel__container">
                        <form action="/" method="get" class="search-panel__form">
                            <!-- Иконка поиска (кнопка сабмита) -->
                            <button type="submit" class="search-panel__submit">
                                <svg width="20" height="20" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M7.07378 11.2472C9.32366 11.2472 11.1476 9.36575 11.1476 7.04489C11.1476 4.72402 9.32366 2.84259 7.07378 2.84259C4.82389 2.84259 3 4.72402 3 7.04489C3 9.36575 4.82389 11.2472 7.07378 11.2472Z" stroke="currentColor" stroke-width="1.5" />
                                    <path d="M10.0391 10.1012L13.0018 13.1574" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </button>

                            <!-- Поле ввода -->
                            <input type="text" name="s" class="search-panel__input js-search-input" placeholder="Что вы ищете?" autocomplete="off">

                            <!-- Кнопка закрыть -->
                            <button type="button" class="search-panel__close js-search-close">
                                <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1 1L13 13M13 1L1 13" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </header>

    <div class="panel-adaptive">
        <?php
        /**
         * Mobile Navigation Content
         * Только для вставки внутрь .panel-adaptive
         */

        $menu_items = get_field('menu_items', 'option');

        if ($menu_items): ?>
            <div class="mobile-nav">
                <ul class="mobile-nav__list">
                    <?php foreach ($menu_items as $index => $item): ?>
                        <?php
                        $has_dropdown = !empty($item['has_dropdown']);
                        $title = !empty($item['title']) ? $item['title'] : '';
                        $subtitle = $item['subtitle'] ?? '';
                        $url = $item['url'] ?? '#';
                        $dropdown_tabs = $item['dropdown_tabs'] ?? [];
                        $item_id = 'mobile-item-' . $index;
                        $section_path = rtrim(parse_url($url, PHP_URL_PATH) ?? '', '/');
                        $is_current_section = !empty($section_path) && $section_path !== '/'
                            && (strpos($current_path, $section_path) === 0
                                || (!empty($ancestor_section_path) && strpos($ancestor_section_path, $section_path) === 0));
                        ?>

                        <li class="mobile-nav__item <?php echo $has_dropdown ? 'has-dropdown' : ''; ?>">
                            <?php if ($has_dropdown && !empty($dropdown_tabs)): ?>
                                <!-- Пункт с dropdown -->
                                <button
                                    class="mobile-nav__link mobile-nav__toggle"
                                    data-target="<?php echo $item_id; ?>">
                                    <span class="mobile-nav__text">
                                        <?php if (!empty($title)): ?>
                                            <?php echo esc_html($title); ?>
                                        <?php endif; ?>
                                        <span><?php echo esc_html($subtitle); ?></span>
                                    </span>
                                    <svg class="mobile-nav__icon" width="20" height="20" viewBox="0 0 20 20">
                                        <polyline points="6 8 10 12 14 8" fill="none" stroke="currentColor" stroke-width="2" />
                                    </svg>
                                </button>

                                <!-- Подменю -->
                                <div class="mobile-nav__dropdown" id="<?php echo $item_id; ?>">
                                    <?php foreach ($dropdown_tabs as $tab_index => $tab): ?>
                                        <?php $tab_id = $item_id . '-tab-' . $tab_index; ?>

                                        <div class="mobile-nav__tab">
                                            <!-- Заголовок таба -->
                                            <button
                                                class="mobile-nav__tab-title"
                                                data-target="<?php echo $tab_id; ?>">
                                                <span><?php echo esc_html($tab['tab_name']); ?></span>
                                                <span class="mobile-nav__badge">
                                                    <?php echo isset($tab['tab_links']) && is_array($tab['tab_links']) ? count($tab['tab_links']) : 0; ?>
                                                </span>
                                                <svg class="mobile-nav__icon" width="16" height="16" viewBox="0 0 20 20">
                                                    <polyline points="6 8 10 12 14 8" fill="none" stroke="currentColor" stroke-width="2" />
                                                </svg>
                                            </button>

                                            <?php if ($index === 2 && !empty($tab['tab_id']) && $tab['tab_id'] === 'laptops'): ?>
                                                <div class="mobile-nav__tab-content" id="<?php echo $tab_id; ?>">
                                                    <ul class="mobile-nav__brands">
                                                        <li><a href="/service/remont-noutbukov-hp/">HP</a></li>
                                                        <li><a href="/service/remont-noutbukov-lenovo/">Lenovo</a></li>
                                                        <li><a href="/service/remont-noutbukov-asus/">ASUS</a></li>
                                                        <li><a href="/service/remont-noutbukov-acer/">Acer</a></li>
                                                        <li><a href="/service/remont-noutbukov-dell/">Dell</a></li>
                                                        <li><a href="/service/remont-noutbukov-msi/">MSI</a></li>
                                                        <li><a href="/service/remont-noutbukov-samsung/">Samsung</a></li>
                                                        <li><a href="/service/remont-noutbukov-toshiba/">Toshiba</a></li>
                                                        <li><a href="/service/remont-noutbukov-huawei/">Huawei</a></li>
                                                        <li><a href="/service/remont-noutbukov-sony/">Sony</a></li>
                                                        <li><a href="/service/remont-makbuk/">Apple</a></li>
                                                        <li><a href="/service/remont-noutbukov-lg/">LG</a></li>
                                                    </ul>
                                                </div>
                                            <?php endif; ?>

                                        </div>

                                    <?php endforeach; ?>
                                </div>

                            <?php else: ?>
                                <!-- Обычная ссылка -->
                                <a href="<?php echo esc_url($url); ?>" class="mobile-nav__link">
                                    <span class="mobile-nav__text">
                                        <?php if (!empty($title)): ?>
                                            <?php echo esc_html($title); ?>
                                        <?php endif; ?>
                                        <span><?php echo esc_html($subtitle); ?></span>
                                    </span>
                                </a>
                            <?php endif; ?>
                        </li>

                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <div class="pa__contacts">
            <div class="pa__contacts__title">
                Связаться с нами
            </div>

            <div class="callback__buttons">
                <div class="callback__main">
                    <a class="" href="tel:+79081191374" data-toggle="modal" data-target="#callback-modal">
                        <svg class="fs" width="18" height="19" viewBox="0 0 18 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9.86377 16.3701C11.7646 17.2394 14.0416 17.7578 16.7578 17.7578V13.5684L12.8184 12.521L9.86377 16.3701ZM9.86377 16.3701C6.08091 14.6398 3.78125 11.5208 2.47729 8.33154M2.47729 8.33154C1.39395 5.68381 1 2.9879 1 1H4.93945L5.92432 5.18945L2.47729 8.33154Z" stroke="#008EE9" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                        +7 (908) 119-13-74
                    </a>
                </div>
                <div class="callback__social">
                    <a href="https://vk.com/fixibot" class="social-vk" target="_blank">
                        <svg class="fs" width="30" height="18" viewBox="0 0 30 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M0 0C0.243598 11.2432 6.08994 18 16.3398 18H16.9207V11.5676C20.6871 11.9279 23.5353 14.5766 24.6783 18H30C28.5384 12.8829 24.6971 10.0541 22.2986 8.97297C24.6971 7.63964 28.07 4.3964 28.8757 0H24.0412C22.9919 3.56757 19.8813 6.81081 16.9207 7.11712V0H12.0862V12.4685C9.08807 11.7477 5.30294 8.25225 5.13429 0H0Z" fill="white"></path>
                        </svg>
                    </a>
                    <a href="https://max.ru/u/f9LHodD0cOJnBW_PxrzDbIjMWx-gf3jsdsGjU1ALTAD-x8gYianGo35FP8k" class="social-wa" target="_blank">
                        <svg class="fs" width="26" height="26" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M11.2364 21.9372C9.07734 21.9372 8.074 21.6207 6.32997 20.3545C5.22682 21.7789 1.73352 22.8922 1.58118 20.9876C1.58118 19.5578 1.26599 18.3496 0.908783 17.0306C0.483284 15.4056 0 13.596 0 10.9739C0 4.71138 5.11651 0 11.1786 0C17.2459 0 21.9999 4.94352 21.9999 11.0319C22.0203 17.0262 17.2046 21.9052 11.2364 21.9372ZM11.3257 5.41308C8.37342 5.26008 6.07257 7.31241 5.56302 10.5307C5.14277 13.195 5.88871 16.4397 6.52433 16.6086C6.82901 16.6824 7.59596 16.0599 8.074 15.5798C8.86444 16.1282 9.78491 16.4576 10.7426 16.5347C13.8016 16.6825 16.4154 14.3435 16.6208 11.2746C16.7403 8.1992 14.3851 5.59435 11.3257 5.41836L11.3257 5.41308Z" fill="#fff"></path>
                        </svg>
                    </a>
                </div>
            </div>

        </div>
    </div>