<?php
$h2_team = get_field('h2_team') ?: 'Наши специалисты —<br> профессионалы с опытом от 5 лет';
?>

<div class="team p-100">
    <div class="container">
        <h2>
            <?= $h2_team ?>
        </h2>
        <div class="team__sub">
            Каждый мастер проходит обучение для работы с новейшей техникой.
        </div>

        <div class="team-list row">
            <div class="col-3">
                <div class="team-item">
                    <div class="team-item__photo">
                        <img src="/img/team/1.png" alt="">
                    </div>
                    <div class="team-item__content">
                        <div class="team-item__name">
                            Дмитрий
                        </div>
                        <div class="team-item__text">
                            Эксперт по ноутбукам и MacBook, ремонт материнских плат.
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="team-item">
                    <div class="team-item__photo">
                        <img src="/img/team/2.png" alt="">
                    </div>
                    <div class="team-item__content">
                        <div class="team-item__name">
                            Алексей
                        </div>
                        <div class="team-item__text">
                            Мастер по смартфонам и планшетам, замена экранов, восстановление данных.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>