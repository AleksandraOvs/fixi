<?php
$neispravnosti = get_field('neispravnosti') ?: [];
$h2_symptom = get_field('h2_symptom') ?: 'мы справимся неисправностями любой сложности! <br><span>какая неисправность у вашего телефона?</span>';
?>

<?php if (count($neispravnosti)) : ?>
    <section class="problems">


        <div class="problem-icons">
            <div class="container">
                <div class="card">
                    <h2>
                        <?= $h2_symptom ?>
                    </h2>

                    <div class="problem-icons__list">

                        <div class="row auto-h">

                            <?php foreach ($neispravnosti as $item) : ?>
                                <div class="col-4">
                                    <div class="problem-card" data-toggle="modal" data-target="#lead-modal">
                                        <div class="problem-card__icon">
                                            <img src="<?= $item['icon']['url'] ?>" alt="">
                                        </div>
                                        <div class="problem-card__title">
                                            <?= $item['title'] ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach ?>

                        </div>

                    </div>

                </div>

            </div>
        </div>
    </section>
<?php endif ?>