document.addEventListener('DOMContentLoaded', function () {
    var el = document.querySelector('.header__city');
    if (!el) return;
    el.querySelector('a').addEventListener('click', function (e) {
        e.preventDefault();
        el.classList.toggle('is-open');
    });
    document.addEventListener('click', function (e) {
        if (!el.contains(e.target)) el.classList.remove('is-open');
    });
});