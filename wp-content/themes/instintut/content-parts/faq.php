<?php
$key = isset($args['key']) ? $args['key'] : '';
?>

<div class="card block" id="block-<?= $key ?>">
    <?php
        $faq = get_sub_field('faq') ? get_sub_field('faq') : [];
    ?>

    <div class="row">
        <div class="col-4">
            <?php if (get_sub_field('title')) : ?>
                <h2><?= get_sub_field('title') ?></h2>
            <?php endif ?>

            <?php if (get_sub_field('subtitle')) : ?>
                <div class="text-block subtitle">
                    <?= get_sub_field('subtitle') ?>
                </div>
            <?php endif ?>
            <div class="contact__btns">
                <div class="row">
                    <div class="col-12">
                        <a href="<?= get_field('tg', 'options') ?>">
                            <div class="contact__btn contact__btn_tg" style="margin-bottom: 10px;">
                                <i class="svg">
                                    <svg width="38.000000" height="38.000000" viewBox="0 0 38 38" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <defs>
                                            <clipPath id="clip203_96">
                                                <rect id="01" width="38.000000" height="38.000000" fill="white" fill-opacity="0"/>
                                            </clipPath>
                                        </defs>
                                        <rect id="01" width="38.000000" height="38.000000" fill="#FFFFFF" fill-opacity="0"/>
                                        <g clip-path="url(#clip203_96)">
                                            <path id="Vector" d="M38 19C38 29.4934 29.4934 38 19 38C8.50659 38 0 29.4934 0 19C0 8.50659 8.50659 0 19 0C29.4934 0 38 8.50659 38 19Z" fill="#039BE5" fill-opacity="1.000000" fill-rule="evenodd"/>
                                            <path id="Vector" d="M8.69312 18.5887L27.0122 11.5254C27.8625 11.2183 28.605 11.7328 28.3296 13.0185L28.3311 13.0169L25.2119 27.7119C24.9807 28.7537 24.3618 29.007 23.4956 28.5162L18.7456 25.0154L16.4546 27.2226C16.2012 27.4759 15.9875 27.6896 15.4966 27.6896L15.834 22.8558L24.6372 14.9026C25.0203 14.5654 24.5518 14.3754 24.0466 14.7111L13.1675 21.5606L8.47778 20.0976C7.45972 19.7746 7.4375 19.0795 8.69312 18.5887Z" fill="#FFFFFF" fill-opacity="1.000000" fill-rule="nonzero"/>
                                        </g>
                                    </svg>
                                </i>
                            
                                <div class="contact-btn__title">
                                    написать в Telegram
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-12">
                        <a href="<?= get_field('wa', 'options') ?>">
                            <div class="contact__btn contact__btn_wa">
                                <i class="svg">
                                    <svg width="38.000000" height="38.000000" viewBox="0 0 38 38" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                        
                                        <defs>
                                            <clipPath id="clip203_102">
                                                <rect id="02" width="38.000000" height="38.000000" fill="white" fill-opacity="0"/>
                                            </clipPath>
                                        </defs>
                                        <rect id="02" width="38.000000" height="38.000000" fill="#FFFFFF" fill-opacity="0"/>
                                        <g clip-path="url(#clip203_102)">
                                            <path id="Vector" d="M19.0048 0L18.9952 0C8.51917 0 0 8.52148 0 19C0 23.1562 1.33948 27.0085 3.61707 30.1364L1.24927 37.1949L8.55237 34.8602C11.5568 36.8505 15.1406 38 19.0048 38C29.4808 38 38 29.4761 38 19C38 8.52386 29.4808 0 19.0048 0Z" fill="#fff" fill-opacity="1.000000" fill-rule="evenodd"/>
                                            <path id="Vector" d="M30.0614 26.83C29.603 28.1244 27.7838 29.1979 26.3326 29.5114C25.34 29.7228 24.0432 29.8914 19.6779 28.0817C14.0942 25.7684 10.4985 20.0945 10.2183 19.7264C9.94995 19.3583 7.96204 16.722 7.96204 13.9955C7.96204 11.269 9.34668 9.94141 9.90479 9.3714C10.3632 8.9035 11.1207 8.68976 11.8475 8.68976C12.0826 8.68976 12.2941 8.70166 12.484 8.71112C13.0421 8.73486 13.3224 8.76813 13.6906 9.64923C14.1489 10.7537 15.2651 13.4802 15.3982 13.7604C15.5336 14.0406 15.6689 14.4207 15.4789 14.7888C15.3008 15.1688 15.144 15.3374 14.8638 15.6604C14.5835 15.9834 14.3175 16.2304 14.0372 16.5771C13.7808 16.8788 13.4911 17.2018 13.8141 17.7599C14.1371 18.3062 15.2533 20.1277 16.8967 21.5908C19.0177 23.4789 20.7372 24.0822 21.3523 24.3386C21.8107 24.5286 22.3569 24.4835 22.6918 24.1273C23.1169 23.6689 23.6418 22.9089 24.1761 22.1608C24.5562 21.624 25.0359 21.5575 25.5394 21.7475C26.0524 21.9257 28.7671 23.2675 29.3252 23.5454C29.8833 23.8256 30.2515 23.9586 30.3868 24.1938C30.5198 24.4289 30.5198 25.5333 30.0614 26.83Z" fill="#51C85D" fill-opacity="1.000000" fill-rule="nonzero"/>
                                        </g>
                                    </svg>

                                </i>
                            
                                <div class="contact-btn__title">
                                    Написать в WhatsApp
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-8">
            <?php if (count($faq)) : ?>
            
                <div class="faq-list" itemscope itemtype="https://schema.org/FAQPage">
            <div class="faq-list-items">
                    <?php foreach ($faq as $item) : ?>
                        <div class="faq-item" itemprop="mainEntity" itemscope itemtype="https://schema.org/Question">
                            <div class="faq-question">
                                <div itemprop="name">
                                    <?= $item['question'] ?>
                                </div>
                                <div class="faq-item__btn">
                                    <svg width="24" height="14" viewBox="0 0 24 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                      <path d="M10.9393 13.0607C11.5251 13.6464 12.4749 13.6464 13.0607 13.0607L22.6066 3.51472C23.1924 2.92893 23.1924 1.97918 22.6066 1.3934C22.0208 0.807611 21.0711 0.807611 20.4853 1.3934L12 9.87868L3.51472 1.3934C2.92893 0.807612 1.97918 0.807612 1.3934 1.3934C0.807611 1.97919 0.807611 2.92893 1.3934 3.51472L10.9393 13.0607ZM10.5 11L10.5 12L13.5 12L13.5 11L10.5 11Z" fill="orange" />
                                    </svg>
                                </div>
                            </div>
                            <div class="faq-answer" itemprop="acceptedAnswer" itemscope itemtype="https://schema.org/Answer">
                                <div class="faq-answer__in text-block" itemprop="text">
                                    <?= $item['answer'] ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
            
            <?php endif ?>
        </div>        </div>
    </div></div>