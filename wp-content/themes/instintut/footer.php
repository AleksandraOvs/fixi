﻿<?php
$footer_list_1 = get_field('footer_menu_1', 'option');
$footer_list_2 = get_field('footer_menu_2', 'option');

$phone = get_field('phone', 'option');
$phone_clean = preg_replace('/[^0-9+]/', '', $phone);

$email = get_field('email', 'option');
$email_2 = get_field('email_2', 'option');

$f_max = get_field('wa', 'option');
?>

<footer>
    <div class="container">
        <div class="footer__in">
            <div class="footer__col">
                <div class="footer__logo">
                    <img src="/img/logo.svg" alt="Логотип Fixibot">
                </div>
                <div class="footer__address-mail">
                    <div class="footer__address">
                        <?= get_field('address', 'option') ?>
                    </div>
                    <div class="footer__mail">
                        <a href="mailto:<?= esc_attr($email_2) ?>">
                            <?= esc_html($email_2) ?>
                        </a>
                    </div>
                </div>
            </div>

            <?php if (has_nav_menu('footer-menu1')) : ?>
                <div class="footer__col">
                    <?php
                    wp_nav_menu([
                        'theme_location' => 'footer-menu1',
                        'container'      => false,
                        'menu_class'     => 'footer-menu__list',
                        'fallback_cb'    => false,
                    ]);
                    ?>
                </div>
            <?php endif; ?>

            <?php if (has_nav_menu('footer-menu2')) : ?>
                <div class="footer__col">
                    <?php
                    wp_nav_menu([
                        'theme_location' => 'footer-menu2',
                        'container'      => false,
                        'menu_class'     => 'footer-menu__list',
                        'fallback_cb'    => false,
                    ]);
                    ?>
                </div>
            <?php endif; ?>





            <div class="footer__col">
                <div class="footer__phone-sub">
                    Единый контактный центр
                </div>
                <div class="footer__call">
                    <a href="tel:<?php echo $phone_clean ?>" class="btn">
                        <?= get_field('phone', 'option') ?>
                    </a>
                </div>
                <div class="footer__mail_last">
                    <a href="mailto:<?= esc_attr($email) ?>">
                        <?= esc_html($email) ?>
                    </a>
                </div>
                <div class="footer__pay-title">
                    Способы оплаты
                </div>
                <div class="footer__pays">
                    <img src="/img/pays.svg" alt="">
                </div>
            </div>
        </div>
        <div class="footer__bottom">
            <div class="footer__social-block">
                <div class="footer__social-title">
                    FIXIBOT в соц. сетях
                </div>
                <div class="footer__social">
                    <a href="<?= get_field('vk', 'option') ?>" target="_blank" rel="noopener noreferrer">
                        <svg width="42" height="42" viewBox="0 0 42 42" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect width="41.8883" height="41.8883" rx="20.9442" fill="#008EE9" />
                            <g clip-path="url(#clip0_4001_415)">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M7.58984 14.1631C7.81098 24.3694 13.1181 30.503 22.4227 30.503H22.95V24.6638C26.369 24.991 28.9546 27.3953 29.9922 30.503H34.8231C33.4963 25.8578 30.0092 23.2899 27.8319 22.3085C30.0092 21.0982 33.071 18.154 33.8025 14.1631H29.4139C28.4613 17.4016 25.6376 20.3458 22.95 20.6238V14.1631H18.5614V25.4816C15.8398 24.8274 12.4037 21.6543 12.2506 14.1631H7.58984Z" fill="white" />
                            </g>
                            <defs>
                                <clipPath id="clip0_4001_415">
                                    <rect width="26.7098" height="19.1177" fill="white" transform="translate(7.58984 11.3857)" />
                                </clipPath>
                            </defs>
                        </svg>
                    </a>
                    <a href="<?php echo $f_max ?>" target="_blank" class="footer-max" rel="noopener noreferrer">
                        <svg class="fs" width="26" height="26" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                            focusable="false">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M11.2364 21.9372C9.07734 21.9372 8.074 21.6207 6.32997 20.3545C5.22682 21.7789 1.73352 22.8922 1.58118 20.9876C1.58118 19.5578 1.26599 18.3496 0.908783 17.0306C0.483284 15.4056 0 13.596 0 10.9739C0 4.71138 5.11651 0 11.1786 0C17.2459 0 21.9999 4.94352 21.9999 11.0319C22.0203 17.0262 17.2046 21.9052 11.2364 21.9372ZM11.3257 5.41308C8.37342 5.26008 6.07257 7.31241 5.56302 10.5307C5.14277 13.195 5.88871 16.4397 6.52433 16.6086C6.82901 16.6824 7.59596 16.0599 8.074 15.5798C8.86444 16.1282 9.78491 16.4576 10.7426 16.5347C13.8016 16.6825 16.4154 14.3435 16.6208 11.2746C16.7403 8.1992 14.3851 5.59435 11.3257 5.41836L11.3257 5.41308Z" fill="#fff" />
                        </svg>
                    </a>
                    <a href="<?= get_field('tg', 'option') ?>" target="_blank" rel="noopener noreferrer">
                        <svg width="42" height="42" viewBox="0 0 42 42" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_4021_422)">
                                <rect x="8.71875" y="9.96289" width="23.6719" height="24.8887" fill="white" />
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M41.6663 20.8332C41.6663 32.339 32.339 41.6663 20.8332 41.6663C9.32733 41.6663 0 32.339 0 20.8332C0 9.32733 9.32733 0 20.8332 0C32.339 0 41.6663 9.32733 41.6663 20.8332ZM21.5797 15.38C19.5534 16.2228 15.5036 17.9672 9.43029 20.6132C8.44409 21.0054 7.92747 21.3891 7.88044 21.7642C7.80096 22.3983 8.59492 22.6479 9.67609 22.9879C9.82315 23.0341 9.97554 23.082 10.1318 23.1328C11.1955 23.4786 12.6263 23.8831 13.3702 23.8992C14.0449 23.9137 14.798 23.6356 15.6295 23.0646C21.3039 19.2342 24.2331 17.2981 24.417 17.2564C24.5468 17.227 24.7265 17.1899 24.8484 17.2982C24.9702 17.4065 24.9582 17.6115 24.9453 17.6665C24.8666 18.0018 21.75 20.8993 20.1372 22.3987C19.6344 22.8662 19.2778 23.1978 19.2048 23.2735C19.0415 23.4431 18.8751 23.6036 18.7151 23.7578C17.7269 24.7104 16.9858 25.4248 18.7561 26.5914C19.6069 27.1521 20.2876 27.6157 20.9668 28.0782C21.7085 28.5833 22.4482 29.087 23.4054 29.7145C23.6493 29.8743 23.8822 30.0403 24.109 30.2021C24.9722 30.8174 25.7476 31.3703 26.7057 31.2821C27.2624 31.2309 27.8374 30.7074 28.1294 29.1462C28.8196 25.4566 30.1762 17.4625 30.4897 14.1682C30.5172 13.8796 30.4826 13.5103 30.4549 13.3481C30.4271 13.186 30.3691 12.9549 30.1584 12.7839C29.9088 12.5814 29.5234 12.5387 29.3511 12.5417C28.5675 12.5555 27.3653 12.9735 21.5797 15.38Z" fill="#008EE9" />
                            </g>
                            <defs>
                                <clipPath id="clip0_4021_422">
                                    <rect width="41.6663" height="41.6663" fill="white" />
                                </clipPath>
                            </defs>
                        </svg>
                    </a>
                </div>
            </div>
            <!--noindex-->
            <div class="footer__bottom-links">
                <a href="/privacy-policy/">Политика конфиденциальности</a>
                <a href="/karta-sajta/">Карта сайта</a>
                <a href="/politika-cookie/">Политика Cookie</a>
                <a href="/publichnaya-oferta/">Публичная оферта</a>
            </div><!--/noindex-->
        </div>

        <!--noindex-->
        <div class="footer__disclaimer">
            Сайт не является публичной офертой. Apple, iPhone, iPad, MacBook, iMac, Apple Watch — товарные знаки Apple Inc., введённых в гражданский оборот на территории РФ. Мы не являемся официальными представителями Apple. Ремонт проводится в неавторизованных сервисных центрах. Сайт использует файлы cookie.
        </div><!--/noindex-->
    </div>


</footer>

<div id="success-modal" class="blue-modal modal">
    <div class="modal-content">
        <span class="close"></span>

        <div class="modal-title">
            Ваш вопрос<br> отправлен
        </div>
        <!--noindex-->
        <div class="modal-sub">
            <p>
                Спасибо за обращение
            </p>
        </div><!--/noindex-->

    </div>
</div>

<?php wp_footer(); ?>

<?php get_template_part('parts/modals') ?>

</body>

</html>