document.addEventListener('DOMContentLoaded', function () {
    // === PARALLAX ЭФФЕКТ ДЛЯ БОТА ===

    const ctaContainer = document.querySelector('.cta');
    const botElement = document.querySelector('.cta__bot');

    if (ctaContainer && botElement) {
        ctaContainer.addEventListener('mousemove', function (e) {
            const relativeX = e.offsetX;
            const relativeY = e.offsetY;

            const ctaWidth = ctaContainer.offsetWidth;
            const ctaHeight = ctaContainer.offsetHeight;
            const ctaCenterX = ctaWidth / 2;
            const ctaCenterY = ctaHeight / 2;

            const mouseX = relativeX - ctaCenterX;
            const mouseY = relativeY - ctaCenterY;

            const moveFactor = 20;

            const offsetX = mouseX / moveFactor;
            const offsetY = mouseY / moveFactor;

            botElement.style.transform = `translate3d(${-offsetX}px, ${-offsetY}px, 0)`;
        });

        ctaContainer.addEventListener('mouseleave', function () {
            botElement.style.transform = 'translate3d(0, 0, 0)';
        });
    }
});