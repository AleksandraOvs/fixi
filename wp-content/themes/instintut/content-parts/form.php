<?php
$key = isset($args['key']) ? $args['key'] : '';
?>


<?php if (get_sub_field('type') == 2) : ?>
    <section class="cons cons_2 card m-block" id="block-<?= $key ?>">

        <div class="cons__in">

            <form action="/" class="form">

                <div class="cons__title">
                    <h2><?= get_sub_field('title') ?></h2>
                </div>

                <?php if (get_sub_field('sub')) : ?>
                    <div class="cons__sub">
                        <?= get_sub_field('sub') ?>
                    </div>
                <?php endif ?>
            
                <div class="row">
                    <div class="col-6 form-group">
                        <input type="text" name="fio" placeholder="Введите имя">
                    </div>
                    
                    <div class="col-6 form-group">
                        <input type="text" name="tel" placeholder="+7 (_ _ _) _ _ _ – _ _ – _ _">
                    </div>
                    
                </div>

                <div class="form__submit">
                    <button type="submit" class="btn">
                        <?php if (get_sub_field('btn_text')) : ?>
                            <?= get_sub_field('btn_text') ?>
                        <?php else : ?>
                            Оставить заявку
                        <?php endif ?>
                    </button>
                </div>

                <div class="form__terms">
                    Нажимая на кнопку, вы разрешаете обработку персональных данных и соглашаетесь с политикой конфиденциальности.
                </div>
            
            </form>

        </div>
        
    </section>
<?php else : ?>
    <section class="cons card m-block" id="block-<?= $key ?>">

        <div class="cons__in">
            <div class="row">
                <div class="col-6">
                    <div class="cons__title">
                        <h2><?= get_sub_field('title') ?></h2>
                    </div>

                    <?php if (get_sub_field('sub')) : ?>
                        <div class="cons__sub">
                            <?= get_sub_field('sub') ?>
                        </div>
                    <?php endif ?>

                </div>
                <div class="col-6">
                    <form action="/" class="form" enctype="multipart/form-data">
                    
                        <div class="row">
                            <div class="col-6 form-group">
                                <input type="text" name="fio" placeholder="Введите имя">
                            </div>
                            
                            <div class="col-6 form-group">
                                <input type="text" name="tel" placeholder="+7 (_ _ _) _ _ _ – _ _ – _ _">
                            </div>
                            
                        </div>

                        <div class="row">
                            <div class="col-6 form-group">
                                <input type="email" name="email" placeholder="Введите почту">
                            </div>
                            <div class="col-6 form-group file-group">
                                <label for="file-<?= $key ?>">
                                    <div class="file__icon">
                                        <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M19.6534 10.1291L11.2293 18.5533C10.1972 19.5853 8.79752 20.1651 7.33802 20.1651C5.87852 20.1651 4.47879 19.5853 3.44677 18.5533C2.41475 17.5213 1.83496 16.1216 1.83496 14.6621C1.83496 13.2025 2.41475 11.8028 3.44677 10.7708L11.8709 2.34663C12.559 1.65862 13.4921 1.27209 14.4651 1.27209C15.4381 1.27209 16.3713 1.65862 17.0593 2.34663C17.7473 3.03465 18.1338 3.9678 18.1338 4.9408C18.1338 5.9138 17.7473 6.84695 17.0593 7.53497L8.62594 15.9591C8.28193 16.3031 7.81535 16.4964 7.32885 16.4964C6.84235 16.4964 6.37578 16.3031 6.03177 15.9591C5.68776 15.6151 5.4945 15.1486 5.4945 14.6621C5.4945 14.1756 5.68776 13.709 6.03177 13.365L13.8143 5.59163" stroke="white" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                    </div>
                                    <div class="file__title">
                                        Прикрепить файл
                                    </div>
                                    <div class="file__sub">
                                        До 20 Мб.
                                    </div>
                                </label>
                                <input type="file" id="file-<?= $key ?>" name="attachment">
                            </div>
                        </div>

                        <div class="form-group">
                            <textarea name="comment" id="" rows="6" placeholder="Комментарий"></textarea>
                        </div>

                        <div class="form__submit">
                            <button type="submit" class="btn">
                                <?php if (get_sub_field('btn_text')) : ?>
                                    <?= get_sub_field('btn_text') ?>
                                <?php else : ?>
                                    Оставить заявку
                                <?php endif ?>
                            </button>
                        </div>

                        <div class="form__terms">
                            Нажимая на кнопку, вы разрешаете обработку персональных данных и соглашаетесь с политикой конфиденциальности.
                        </div>
                    
                    </form>
                </div>
            </div>
        </div>
        
    </section>
<?php endif ?>