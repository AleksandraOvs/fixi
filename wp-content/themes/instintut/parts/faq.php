<?php
$faq = get_field('faq') ?: get_field('faq', 16);

$faq_title = get_field('h2_faq') ?: 'Ответы на частые вопросы о ремонте в Fixibot <br> <span>Вопрос/ответ</span>';
?>

<div class="faq m-80">
    <div class="container">
        <h2>
            <?= $faq_title ?>
        </h2>

        <div class="row">

            <?php if (count($faq)) : ?>

                <div class="col-8">
                    <div class="faq-list" itemscope itemtype="https://schema.org/FAQPage">
                        <div class="faq-list-items">
                            <?php foreach ($faq as $item) : ?>

                                <div class="faq-item" itemprop="mainEntity" itemscope itemtype="https://schema.org/Question">
                                    <div class="faq-question">
                                        <div itemprop="name">
                                            <h3><?= $item['question'] ?></h3>
                                        </div>
                                        <div class="faq-item__btn">
                                            <svg width="22" height="19" viewBox="0 0 22 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M17.7539 8.03981L17.7539 4L15.3253 4L10.8765 8.04727L10.8765 14.0565L17.7539 8.03981Z" fill="#222222" />
                                                <path d="M4 8.03981L4 4L6.42865 4L10.8774 8.04727L10.8774 14.0565L4 8.03981Z" fill="#222222" />
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
                    </div>
                </div>

            <?php endif ?>


            <div class="col-4">
                <div class="faq-form">
                    <form action="" class="form">
                        <h2>
                            не нашли ответ
                            <br>на свой вопрос?
                        </h2>
                        <div class="faq-form__sub">
                            Напишите нам, мы вам поможем.
                        </div>

                        <input type="hidden" name="subject" value="Вопрос">

                        <div class="form-group">
                            <input type="text" name="fio" placeholder="Имя">
                        </div>
                        <div class="form-group">
                            <input type="text" name="tel" placeholder="*Телефон" required>
                        </div>
                        <div class="form-group">
                            <textarea name="question" id="" placeholder="Ваш вопрос" rows="4" required></textarea>
                        </div>
                        <div class="form-group form-group__terms">
                            <label for="term">
                                <input type="checkbox" id="term" required>
                                <div>
                                    Я выражаю <a href="/soglasie-na-obrabotku-personalnyh-dannyh/" target="_blank">Согласие на передачу и обработку персональных данных</a>, в соответствии с <a href="/privacy-policy/" target="_blank">Политикой конфиденциальности</a>
                                </div>
                            </label>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn">Отправить</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>