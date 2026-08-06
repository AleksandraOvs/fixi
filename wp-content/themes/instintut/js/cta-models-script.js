document.addEventListener('DOMContentLoaded', function () {
    var form = document.getElementById('cta-model-form');
    if (form) {
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            var modelUrl = document.getElementById('cta-model-select').value;
            var diagUrl = document.getElementById('cta-device-diagnostic').value;
            var url = modelUrl || diagUrl;
            if (url) {
                window.location.href = url;
            } else {
                alert('Пожалуйста, выберите модель или неисправность');
            }
        });
    }
});