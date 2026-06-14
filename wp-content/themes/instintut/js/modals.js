jQuery(document).ready(function ($) {
    let selectedRating = 0;

    // Обработка выбора звезд
    $('.star').on('click', function () {
        selectedRating = parseInt($(this).data('rating'));
        updateStars(selectedRating);
        $('#submit-rating').prop('disabled', false);
    });

    $('.star').on('mouseenter', function () {
        const rating = parseInt($(this).data('rating'));
        updateStars(rating);
    });

    $('.stars-container').on('mouseleave', function () {
        updateStars(selectedRating);
    });

    function updateStars(rating) {
        $('.star').each(function (index) {
            if (index < rating) {
                $(this).addClass('active');
            } else {
                $(this).removeClass('active');
            }
        });
    }

    // Отправка оценки
    $('#submit-rating').on('click', function () {
        if (selectedRating === 0) return;

        $('#rating-modal').hide();

        // Сохраняем оценку для отправки с формой
        $('#rating-value').val(selectedRating);

        // Если оценка больше 3 - показываем форму с агрегаторами
        if (selectedRating > 3) {
            setTimeout(function () {
                $('#review-aggregator-modal').css('display', 'flex');
            }, 300);
        } else {
            // Если оценка 3 и меньше - показываем форму обратной связи
            setTimeout(function () {
                $('#feedback-modal').css('display', 'flex');
            }, 300);
        }

        // Опционально: отправка оценки на сервер
        sendRatingToServer(selectedRating);
    });

    // Обработка отправки формы обратной связи
    $('#feedback-form').on('submit', function (e) {
        e.preventDefault();

        var formData = $(this).serialize();

        // Отправка данных на сервер через AJAX
        $.ajax({
            url: '/lead.php',
            type: 'POST',
            data: formData,
            success: function (response) {
                alert('Спасибо за ваш отзыв! Мы обязательно учтём ваши пожелания.');
                $('#feedback-modal').hide();
                $('#feedback-form')[0].reset();
                resetRatingModal();
            },
            error: function () {
                alert('Произошла ошибка при отправке. Попробуйте позже.');
            }
        });
    });

    // Функция отправки оценки на сервер (опционально)
    function sendRatingToServer(rating) {
        $.ajax({
            url: '/rating.php',
            type: 'POST',
            data: {
                rating: rating
            },
            dataType: 'json',
            success: function (data) {
                console.log('Оценка отправлена:', data);
            },
            error: function (error) {
                console.error('Ошибка отправки оценки:', error);
            }
        });
    }

    // Сброс состояния модального окна с оценкой
    function resetRatingModal() {
        selectedRating = 0;
        updateStars(0);
        $('#submit-rating').prop('disabled', true);
    }
});
