<div class="hero__tags m-80">
    <!-- Выбор марки телефона -->
    <div class="m-80">
        <h2>
            ремонтируем популярные 
            <br>марки телефонов.
            <br><span>выберите марку телефона</span>
        </h2>
        
        <div class="tags-list__in">
            <ul class="tags-list" id="brand-list">
                <li><a href="#" class="tag-link active" data-brand="iphone">iPhone</a></li>
                <li><a href="#" class="tag-link" data-brand="samsung">Samsung</a></li>
                <li><a href="#" class="tag-link" data-brand="huawei">Huawei</a></li>
                <li><a href="#" class="tag-link" data-brand="xiaomi">Xiaomi</a></li>
                <li><a href="#" class="tag-link" data-brand="lg">LG</a></li>
                <li><a href="#" class="tag-link" data-brand="oppo">Oppo</a></li>
                <li><a href="#" class="tag-link" data-brand="sony">Sony</a></li>
                <li><a href="#" class="tag-link" data-brand="honor">Honor</a></li>
                <li><a href="#" class="tag-link" data-brand="motorola">Motorola</a></li>
                <li><a href="#" class="tag-link" data-brand="google">Google Pixel</a></li>
                <li><a href="#" class="tag-link" data-brand="asus">Asus</a></li>
                <li><a href="#" class="tag-link" data-brand="nokia">Nokia</a></li>
                <li><a href="#" class="tag-link" data-brand="realme">Realme</a></li>
                <li><a href="#" class="tag-link" data-brand="oneplus">OnePlus</a></li>
                <li><a href="#" class="tag-link" data-brand="vivo">Vivo</a></li>
                <li><a href="#" class="tag-link" data-brand="other">Нет моего телефона</a></li>
            </ul>
        </div>
    </div>

    <!-- Выбор модели -->
    <div class="m-80">
        <h2>
            модель вашего телефона
            <br><span id="model-subtitle">выберите модель iphone</span>
        </h2>

        <div class="tags-list__in">
            <ul class="tags-list" id="model-list">
                <li><a href="#" class="tag-link active" data-model="iphone-11">iPhone 11</a></li>
                <li><a href="#" class="tag-link" data-model="iphone-12">iPhone 12</a></li>
                <li><a href="#" class="tag-link" data-model="iphone-12-pro">iPhone 12 Pro</a></li>
                <li><a href="#" class="tag-link" data-model="iphone-12-pro-max">iPhone 12 Pro Max</a></li>
                <li><a href="#" class="tag-link" data-model="iphone-12-mini">iPhone 12 Mini</a></li>
                <li><a href="#" class="tag-link" data-model="iphone-13">iPhone 13</a></li>
                <li><a href="#" class="tag-link" data-model="iphone-13-pro">iPhone 13 Pro</a></li>
                <li><a href="#" class="tag-link" data-model="iphone-13-pro-max">iPhone 13 Pro Max</a></li>
                <li><a href="#" class="tag-link" data-model="iphone-13-mini">iPhone 13 Mini</a></li>
                <li><a href="#" class="tag-link" data-model="iphone-14">iPhone 14</a></li>
                <li><a href="#" class="tag-link" data-model="iphone-14-pro">iPhone 14 Pro</a></li>
                <li><a href="#" class="tag-link" data-model="iphone-14-pro-max">iPhone 14 Pro Max</a></li>
                <li><a href="#" class="tag-link" data-model="iphone-14-plus">iPhone 14 Plus</a></li>
                <li><a href="#" class="tag-link" data-model="other">Нет моего телефона</a></li>
                <li><a href="#" class="tag-link show-all" data-action="show-all">Смотреть все</a></li>
            </ul>
        </div>
    </div>

    <!-- Выбор типа неисправности -->
    <div class="">
        <h2>
            мы справимся неисправностями
            <br>любой сложности!
            <br><span>неисправность вашего телефона</span>
        </h2>

        <div class="tags-list__in">
            <ul class="tags-list" id="issue-list">
                <li><a href="#" class="tag-link active" data-issue="screen">Повреждение экрана</a></li>
                <li><a href="#" class="tag-link" data-issue="no-dim">Экран не гаснет</a></li>
                <li><a href="#" class="tag-link" data-issue="reboot">Постоянно перезагружается</a></li>
                <li><a href="#" class="tag-link" data-issue="no-charge">Не заряжается</a></li>
                <li><a href="#" class="tag-link" data-issue="volume">Не регулируется громкость</a></li>
                <li><a href="#" class="tag-link show-all" data-action="show-all">Смотреть все</a></li>
            </ul>
        </div>
    </div>

</div>

<!-- Блок с ценами -->
<div class="pricing-section m-80">
    <h2>
        цены за ремонт для <span id="city-name">омска</span>
        <br><span id="pricing-title">замена экрана iphone 11</span>
    </h2>

    <div class="pricing-table">
        <div class="pricing-table__header">
            <div class="pricing-col">Вид ремонта</div>
            <div class="pricing-col">Стоимость (₽)</div>
            <div class="pricing-col">Время (мин.)</div>
        </div>
        <div id="pricing-content">
            <!-- Цены будут загружены через jQuery -->
        </div>
    </div>

    <div class="pricing-note">
        * Цены указаны ориентировочно и зависят от модели iPhone. Точную стоимость уточняйте по телефону 47-81-80 или в WhatsApp/Telegram +7 (908) 119-13-74.
    </div>
</div>

<style>
.tags-list .tag-link:hover {
    background: var(--svetlo-goluboy);
}

.tags-list .tag-link.active {
    background: var(--zheltyy);
    border-color: var(--zheltyy);
    color: var(--chernyy);
}

.tags-list .tag-link.show-all {
    border-color: #0ea5e9;
    background: transparent;
    color: #0ea5e9;
}

.pricing-section {
    margin-top: 60px;
}

.pricing-section h2 {
    text-transform: uppercase;
    margin-bottom: 30px;
}

.pricing-section h2 span {
    color: #0ea5e9;
    text-transform: lowercase;
}

.pricing-table {
    background: #0ea5e9;
    border-radius: 20px;
    padding: 30px;
    color: #fff;
}

.pricing-table__header {
    display: grid;
    grid-template-columns: 2fr 1fr 1fr;
    gap: 20px;
    padding: 20px;
    font-weight: bold;
    font-size: 18px;
    border-bottom: 2px solid rgba(255,255,255,0.3);
    margin-bottom: 10px;
}

.pricing-table__row {
    display: grid;
    grid-template-columns: 2fr 1fr 1fr;
    gap: 20px;
    padding: 20px;
    background: rgba(255,255,255,0.1);
    border-radius: 10px;
    margin-bottom: 10px;
    font-size: 16px;
}

.pricing-col {
    display: flex;
    align-items: center;
}

.pricing-note {
    margin-top: 20px;
    font-size: 14px;
    color: #666;
    line-height: 1.6;
}

@media (max-width: 768px) {
    .pricing-table__header,
    .pricing-table__row {
        grid-template-columns: 1fr;
        gap: 10px;
    }
    
    .pricing-col::before {
        content: attr(data-label);
        font-weight: bold;
        margin-right: 10px;
    }
}
</style>

<script>
jQuery(document).ready(function($) {
    // Данные о ценах для разных моделей и типов ремонта
    const pricingData = {
        'iphone-11': {
            'screen': [
                {service: 'Замена экрана', price: '16 500', time: 'от 90'},
                {service: 'Замена стекла (без замены дисплея)', price: '8 500', time: 'от 60'},
                {service: 'Ремонт подсветки экрана', price: '5 500', time: 'от 120'}
            ],
            'no-dim': [
                {service: 'Замена датчика приближения', price: '3 500', time: 'от 60'},
                {service: 'Ремонт шлейфа датчика', price: '4 500', time: 'от 90'},
                {service: 'Восстановление программного обеспечения', price: '10 500', time: 'от 180'}
            ],
            'reboot': [
                {service: 'Диагностика и устранение сбоя ПО', price: '5 500', time: 'от 90'},
                {service: 'Замена аккумулятора', price: '4 500', time: 'от 60'},
                {service: 'Ремонт материнской платы', price: '12 500', time: 'от 240'}
            ],
            'no-charge': [
                {service: 'Замена разъема зарядки', price: '3 500', time: 'от 90'},
                {service: 'Чистка разъема зарядки', price: '1 500', time: 'от 30'},
                {service: 'Замена контроллера питания', price: '8 500', time: 'от 180'}
            ],
            'volume': [
                {service: 'Замена кнопок громкости', price: '3 500', time: 'от 90'},
                {service: 'Ремонт шлейфа кнопок', price: '4 500', time: 'от 120'},
                {service: 'Замена аудио-кодека', price: '7 500', time: 'от 180'}
            ]
        },
        'iphone-12': {
            'screen': [
                {service: 'Замена экрана', price: '18 500', time: 'от 90'},
                {service: 'Замена стекла (без замены дисплея)', price: '9 500', time: 'от 60'},
                {service: 'Ремонт подсветки экрана', price: '6 500', time: 'от 120'}
            ],
            'no-dim': [
                {service: 'Замена датчика приближения', price: '4 000', time: 'от 60'},
                {service: 'Ремонт шлейфа датчика', price: '5 000', time: 'от 90'},
                {service: 'Восстановление программного обеспечения', price: '11 000', time: 'от 180'}
            ],
            'reboot': [
                {service: 'Диагностика и устранение сбоя ПО', price: '6 000', time: 'от 90'},
                {service: 'Замена аккумулятора', price: '5 500', time: 'от 60'},
                {service: 'Ремонт материнской платы', price: '14 500', time: 'от 240'}
            ],
            'no-charge': [
                {service: 'Замена разъема зарядки', price: '4 000', time: 'от 90'},
                {service: 'Чистка разъема зарядки', price: '1 500', time: 'от 30'},
                {service: 'Замена контроллера питания', price: '9 500', time: 'от 180'}
            ],
            'volume': [
                {service: 'Замена кнопок громкости', price: '4 000', time: 'от 90'},
                {service: 'Ремонт шлейфа кнопок', price: '5 000', time: 'от 120'},
                {service: 'Замена аудио-кодека', price: '8 500', time: 'от 180'}
            ]
        },
        'iphone-13': {
            'screen': [
                {service: 'Замена экрана', price: '21 500', time: 'от 90'},
                {service: 'Замена стекла (без замены дисплея)', price: '11 500', time: 'от 60'},
                {service: 'Ремонт подсветки экрана', price: '7 500', time: 'от 120'}
            ],
            'no-dim': [
                {service: 'Замена датчика приближения', price: '4 500', time: 'от 60'},
                {service: 'Ремонт шлейфа датчика', price: '5 500', time: 'от 90'},
                {service: 'Восстановление программного обеспечения', price: '12 000', time: 'от 180'}
            ],
            'reboot': [
                {service: 'Диагностика и устранение сбоя ПО', price: '6 500', time: 'от 90'},
                {service: 'Замена аккумулятора', price: '6 500', time: 'от 60'},
                {service: 'Ремонт материнской платы', price: '16 500', time: 'от 240'}
            ],
            'no-charge': [
                {service: 'Замена разъема зарядки', price: '4 500', time: 'от 90'},
                {service: 'Чистка разъема зарядки', price: '1 500', time: 'от 30'},
                {service: 'Замена контроллера питания', price: '10 500', time: 'от 180'}
            ],
            'volume': [
                {service: 'Замена кнопок громкости', price: '4 500', time: 'от 90'},
                {service: 'Ремонт шлейфа кнопок', price: '5 500', time: 'от 120'},
                {service: 'Замена аудио-кодека', price: '9 500', time: 'от 180'}
            ]
        },
        'samsung-a53': {
            'screen': [
                {service: 'Замена экрана', price: '12 500', time: 'от 90'},
                {service: 'Замена стекла (без замены дисплея)', price: '6 500', time: 'от 60'},
                {service: 'Ремонт подсветки экрана', price: '4 500', time: 'от 120'}
            ],
            'no-charge': [
                {service: 'Замена разъема зарядки', price: '2 500', time: 'от 90'},
                {service: 'Чистка разъема зарядки', price: '1 000', time: 'от 30'},
                {service: 'Замена контроллера питания', price: '6 500', time: 'от 180'}
            ]
        }
    };

    const modelNames = {
        'iphone-11': 'iPhone 11',
        'iphone-12': 'iPhone 12',
        'iphone-12-pro': 'iPhone 12 Pro',
        'iphone-12-pro-max': 'iPhone 12 Pro Max',
        'iphone-12-mini': 'iPhone 12 Mini',
        'iphone-13': 'iPhone 13',
        'iphone-13-pro': 'iPhone 13 Pro',
        'iphone-13-pro-max': 'iPhone 13 Pro Max',
        'iphone-13-mini': 'iPhone 13 Mini',
        'iphone-14': 'iPhone 14',
        'iphone-14-pro': 'iPhone 14 Pro',
        'iphone-14-pro-max': 'iPhone 14 Pro Max',
        'iphone-14-plus': 'iPhone 14 Plus',
        'samsung-a53': 'Samsung Galaxy A53'
    };

    const issueNames = {
        'screen': 'Повреждение экрана',
        'no-dim': 'Экран не гаснет',
        'reboot': 'Постоянно перезагружается',
        'no-charge': 'Не заряжается',
        'volume': 'Не регулируется громкость'
    };

    let currentBrand = 'iphone';
    let currentModel = 'iphone-11';
    let currentIssue = 'screen';

    // Функция обновления цен
    function updatePricing() {
        const data = pricingData[currentModel] && pricingData[currentModel][currentIssue];
        const modelName = modelNames[currentModel] || currentModel;
        const issueName = issueNames[currentIssue] || currentIssue;

        $('#pricing-title').text(issueName.toLowerCase() + ' ' + modelName.toLowerCase());

        if (data) {
            let html = '';
            data.forEach(function(item) {
                html += `
                    <div class="pricing-table__row">
                        <div class="pricing-col" data-label="Вид ремонта:">${item.service}</div>
                        <div class="pricing-col" data-label="Стоимость:">${item.price}</div>
                        <div class="pricing-col" data-label="Время:">${item.time}</div>
                    </div>
                `;
            });
            $('#pricing-content').html(html);
        } else {
            $('#pricing-content').html(`
                <div class="pricing-table__row">
                    <div class="pricing-col" style="grid-column: 1 / -1;">
                        Цены для данной модели уточняйте по телефону
                    </div>
                </div>
            `);
        }
    }

    // Обработчик выбора марки
    $('#brand-list').on('click', '.tag-link', function(e) {
        e.preventDefault();
        $('#brand-list .tag-link').removeClass('active');
        $(this).addClass('active');
        currentBrand = $(this).data('brand');

        // Здесь можно динамически загружать модели для выбранной марки
        // Для примера просто обновляем подзаголовок
        let subtitle = 'выберите модель ';
        if (currentBrand === 'iphone') {
            subtitle += 'iPhone';
        } else if (currentBrand === 'samsung') {
            subtitle += 'Samsung';
        } else {
            subtitle += currentBrand;
        }
        $('#model-subtitle').text(subtitle);
        
        updatePricing();
    });

    // Обработчик выбора модели
    $('#model-list').on('click', '.tag-link', function(e) {
        e.preventDefault();
        if ($(this).data('action') === 'show-all') return;
        
        $('#model-list .tag-link').removeClass('active');
        $(this).addClass('active');
        currentModel = $(this).data('model');
        
        updatePricing();
    });

    // Обработчик выбора неисправности
    $('#issue-list').on('click', '.tag-link', function(e) {
        e.preventDefault();
        if ($(this).data('action') === 'show-all') return;
        
        $('#issue-list .tag-link').removeClass('active');
        $(this).addClass('active');
        currentIssue = $(this).data('issue');
        
        updatePricing();
    });

    // Инициализация при загрузке
    updatePricing();
});
</script>
