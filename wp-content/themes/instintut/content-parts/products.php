<?php
$products = get_sub_field('items') ? get_sub_field('items') : [];
?>


<?php if (count($products)) : ?>
    <div class="card front-products full-width m-block">

        <div class="container">
            <?php if (get_sub_field('title')) : ?>
                <h2><?= get_sub_field('title') ?></h2>
            <?php endif ?>
            
            <div class="row auto-h m-2">
                <?php foreach ($products as $item) :  ?>
                    <div class="col-3">
                        <div class="product-card">
                            <div class="product-card__image">
                                <a href="<?= $item['image']['url'] ?>" data-fancybox="">
                                    <img src="<?= $item['image']['sizes']['large'] ?>" alt="" title="" loading="lazy">
                                </a>
                            </div>

                            <div class="product-card__title">
                                <a href="<?= $item['link'] ?>">
                                    <?= $item['title'] ?>
                                </a>
                            </div>

                            <div class="product-card__short">
                                <?= $item['text'] ?>
                            </div>

                            <?php if ($item['price']) : ?>
                                <div class="product-card__price-block">
                                    <div class="product-card__price">
                                        <?= $item['price'] ?>
                                    </div>
                                </div>
                            <?php endif ?>

                            <div class="product-item__actions">
                                
                                <?php if ($item['link']) : ?>
                                    <a href="<?= $item['link'] ?>" class="btn">Подробнее</a>
                                <?php else : ?>
                                    <a href="#" data-toggle="modal" data-target="#lead-modal" class="btn">Заказать</a>
                                <?php endif ?>

                            </div>
            
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

    </div>
<?php endif ?>